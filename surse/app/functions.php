<?php

//Variabile globale
$db = $pag = $pagsub = $pagarr = $userip = $pgtype = "";

function dbconnect() {
    global $dbconf, $db;
    $db = @new mysqli($dbconf['sys_db_host'], $dbconf['sys_db_username'], $dbconf['sys_db_password'], $dbconf['sys_db_name']);
    //Conectarea la baza de date...
    if ($db->connect_error) {
        return false;
    } else {
        $db->query("SET NAMES 'utf8'");
        return true;
    }
}

function chkerr() {
    global $db;
    $laste = error_get_last();
    //Cautam daca existat o ultima eroare pe pagina
    if ($laste) {
        if (!$db->connect_error) {
            //Daca conexiunea la baza de date e activa, inseram in baza de date mesajul de eroare
            $tm = time();
            $laste = $db->real_escape_string(htmlentities($laste['message'] . " in " . $laste['file'] . " on line " . $laste['line']));
            $db->query("INSERT INTO error_log VALUES (NULL, '$laste', $tm)");
        }
    }
}

function advencryptor($string) {
    //Functie de encodare pentru parolele de administrare
    return sha1(md5($string));
}

function secure($text, $chk = 1) {
    global $db, $userip;
    if ($chk == 1) {
        $pot = array("'", '"', " OR ", " or ");
    } elseif ($chk == 2) {
        $pot = array("</script>");
    }
    //$pot = Caracterele care marcheaza un string ce contine caractere pentru sql injection
    $sec = 0; //Flag pt verificare string
    foreach ($pot as $pots) {
        if (strpos($text, $pots) !== FALSE) {
            $sec = 1;
        }
    }
    if ($sec) {
        //Daca utilizatorul a incercat un sql injection($text contine unul din elementele din $pot)
        $headers = $db->real_escape_string(serialize(getallheaders()));
        $time = time();
        $get = $db->real_escape_string(serialize($_GET));
        $post = $db->real_escape_string(serialize($_POST));
        //Inseram toate datele despre potentialul hacker in baza de date
        $db->query("INSERT INTO hack_log VALUES (NULL, '$headers', '$post', '$get', '$userip', $time)");
    }
}

function loggedin() {
    global $db;
    if (isset($_SESSION['in']) && isset($_SESSION['cnp']) && isset($_SESSION['email']) && isset($_SESSION['nume']) && isset($_SESSION['prenume'])) {
        //Daca sunt setate sesiunile utilizatorului => utilizatorul e logat
        return true;
    } else {
        return false;
    }
}

function truncate($text, $len = 70) {
    $text = substr($text . " ", 0, $len);
    $text = substr($text, 0, strrpos($text, ' ')) . "...";
    return $text;
}

function vot() {
    global $db, $pagarr, $userip;
    $id = intval($pagarr[1]);
    //Preluam ID-ul candidatului din adresa
    $chk = $db->query("SELECT id_sesiune FROM candidati_vot WHERE id=$id LIMIT 1");
    //Extragem id-ul sesiunii de vot pentru candidat
    if ($chk->num_rows == 1) {
        //Daca candidatul exista
        $sid = $chk->fetch_array();
        $ssid = $sid['id_sesiune'];
        //stocam ID-ul sesiunii in variabila
        $tm = time();
        $chk2 = $db->query("SELECT 1 FROM sesiuni_vot WHERE id=$ssid AND inceput<$tm AND incheiere>$tm LIMIT 1")->num_rows;
        //Verificam daca aceasta sesiune de vot este deschisa si se poate vota
        if ($chk2 == 1) {
            $cnp = $_SESSION['cnp'];
            $chkimp = $db->query("SELECT 1 FROM voturi WHERE sesiune_vot=$ssid AND cnp=$cnp")->num_rows;
            //Verificam daca utilizatorul a mai votat dejoa sau nu
            if ($chkimp == 0) {
                $db->query("INSERT INTO voturi VALUES(NULL, $cnp, $ssid, '$userip', $tm)");
                //Marcam faptul ca utilizatorul a votat in aceasta sesiune
                $db->query("UPDATE candidati_vot SET voturi = voturi + 1 WHERE id=$id");
                //Crestem numarul de voturi cu 1 la candidatul ales
            }
        }
    }
    header("Location: " . __URL . "votare/");
    //Redirectionam utilizatorul inapoi la pagina principala
}

function reclamatie() {
    //Functie pentru verificare si introducere in baza de date a reclamatiilor
    if (!(isset($_POST['reclamatie']) && isset($_POST['tel']))) {
        return false;
    } else {
        global $db, $userip;
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
        } else {
            $email = "";
        }
        secure($_POST['tel'] . $_POST['reclamatie'], 2);
        $tel = $db->real_escape_string(htmlentities($_POST['tel']));
        $reclamatie = $db->real_escape_string(nl2br(htmlentities($_POST['reclamatie'])));
        $tm = time();
        $db->query("INSERT INTO reclamatii VALUES(NULL, '$tel', '$reclamatie', '$userip', '$email', $tm)");
        return true;
    }
}

function admin_bec_check() {
    global $db;
    //Functie de autentificare in panoul de administrare bec
    if (isset($_POST['pass1']) && isset($_POST['pass2'])) {
        $p1 = advencryptor($_POST['pass1']);
        $p2 = advencryptor($_POST['pass2']);
        //Daca au fost trimise parolele, se encripteaza
        $c1 = $db->query("SELECT 1 FROM setari WHERE nume='admin-bec-pass-1' AND valoare='$p1' LIMIT 1")->num_rows;
        //Si se verifica daca codul 1 este corect
        if ($c1 == 1) {
            $c2 = $db->query("SELECT 1 FROM setari WHERE nume='admin-bec-pass-2' AND valoare='$p2' LIMIT 1")->num_rows;
            if ($c2 == 1) {
                //daca si codul 2 este corect, setam sesiunea cu codul 1, si returam "1"(logat)
                $_SESSION['becss1'] = $_POST['pass1'];
                return "1";
            }
        }
        return "-1";
        //altfel returnam "-1"(parola gresita)
    } elseif (isset($_SESSION['becss1'])) {
        $p1 = advencryptor($_SESSION['becss1']);
        //Daca exista setata o sesiune, encriptam parola, si verificam in baza de date
        $c1 = $db->query("SELECT 1 FROM setari WHERE nume='admin-bec-pass-1' AND valoare='$p1' LIMIT 1")->num_rows;
        if ($c1 == 1) {
            return "1";
            //Daca este corect returnam valoarea "1"(logat)
        }
    }
    return "0";
    //Altfel returnam "0"(Pagina de logare)
}

function sescheck($id) {
    global $db;
    //Functie de verificare daca exista sesiunea $id
    $idc = intval($id);
    $c = $db->query("SELECT * FROM sesiuni_vot WHERE id=$idc LIMIT 1")->num_rows;
    if ($c == 1) {
        return true;
    }
    return false;
}

function candcheck($id) {
    global $db;
    //Functie de verificare daca exista candidatul $id
    $idc = intval($id);
    $c = $db->query("SELECT * FROM candidati_vot WHERE id=$idc LIMIT 1")->num_rows;
    if ($c == 1) {
        return true;
    }
    return false;
}

function admin_prim_check(){
    global $db;
    //Functie de autentificare in panoul de administrare al primariei
    if (isset($_POST['pass1']) && isset($_POST['postal'])) {
        $p1 = intval($_POST['postal']);
        $p2 = advencryptor($_POST['pass1']);
        //Daca au fost trimise parolele, se encripteaza
        $c1 = $db->query("SELECT * FROM primarii WHERE codpostal='$p1' AND parola='$p2' LIMIT 1");
        //Si se verifica daca codul 1 este corect
        if ($c1->num_rows == 1) {
                //daca cnp-ul corespunde cu sesiunea, setam sesiunea cu codul 1, si returam "1"(logat)
                $_SESSION['primss1'] = $_POST['postal'];
                $primdata = $c1->fetch_array();
                $_SESSION['nume'] = $primdata['nume'];
                return "1";
        }
        return "-1";
        //altfel returnam "-1"(parola gresita)
    } elseif (isset($_SESSION['primss1'])&&isset($_SESSION['nume'])) {
        //Daca exista setata o sesiune, verificam daca exista codul postal in baza de date
        $p1 = $_SESSION['primss1'];
        $c1 = $db->query("SELECT 1 FROM primarii WHERE codpostal='$p1' LIMIT 1")->num_rows;
        if ($c1 == 1) {
            return "1";
            //Daca este corect returnam valoarea "1"(logat)
        }
    }
    return "0";
    //Altfel returnam "0"(Pagina de logare)
}

function admin_urna_check(){
    global $db;
    //Functie de autentificare in panoul de administrare de la urna, cu datele primariei
    if (isset($_POST['pass1']) && isset($_POST['postal'])) {
        $p1 = intval($_POST['postal']);
        $p2 = advencryptor($_POST['pass1']);
        //Daca au fost trimise parolele, se encripteaza
        $c1 = $db->query("SELECT * FROM primarii WHERE codpostal='$p1' AND parola='$p2' LIMIT 1");
        //Si se verifica daca codul 1 este corect
        if ($c1->num_rows == 1) {
                //daca cnp-ul corespunde cu sesiunea, setam sesiunea cu codul 1, si returam "1"(logat)
                $_SESSION['urnass1'] = $_POST['postal'];
                $primdata = $c1->fetch_array();
                $_SESSION['nume'] = $primdata['nume'];
                return "1";
        }
        return "-1";
        //altfel returnam "-1"(parola gresita)
    } elseif (isset($_SESSION['urnass1'])&&isset($_SESSION['nume'])) {
        //Daca exista setata o sesiune, verificam daca exista codul postal in baza de date
        $p1 = $_SESSION['urnass1'];
        $c1 = $db->query("SELECT 1 FROM primarii WHERE codpostal='$p1' LIMIT 1")->num_rows;
        if ($c1 == 1) {
            return "1";
            //Daca este corect returnam valoarea "1"(logat)
        }
    }
    return "0";
    //Altfel returnam "0"(Pagina de logare)
}

function admin_dev_check() {
    global $db;
    //Functie de autentificare in panoul dezvoltatorilor
    if (isset($_POST['pass1']) && isset($_POST['pass2'])) {
        $p1 = advencryptor($_POST['pass1']);
        $p2 = advencryptor($_POST['pass2']);
        //Daca au fost trimise parolele, se encripteaza
        $c1 = $db->query("SELECT 1 FROM setari WHERE nume='admin-dev-pass-1' AND valoare='$p1' LIMIT 1")->num_rows;
        //Si se verifica daca codul 1 este corect
        if ($c1 == 1) {
            $c2 = $db->query("SELECT 1 FROM setari WHERE nume='admin-dev-pass-2' AND valoare='$p2' LIMIT 1")->num_rows;
            if ($c2 == 1) {
                //daca si codul 2 este corect, setam sesiunea cu codul 1, si returam "1"(logat)
                $_SESSION['admss1'] = $_POST['pass1'];
                return "1";
            }
        }
        return "-1";
        //altfel returnam "-1"(parola gresita)
    } elseif (isset($_SESSION['admss1'])) {
        $p1 = advencryptor($_SESSION['admss1']);
        //Daca exista setata o sesiune, encriptam parola, si verificam in baza de date
        $c1 = $db->query("SELECT 1 FROM setari WHERE nume='admin-dev-pass-1' AND valoare='$p1' LIMIT 1")->num_rows;
        if ($c1 == 1) {
            return "1";
            //Daca este corect returnam valoarea "1"(logat)
        }
    }
    return "0";
    //Altfel returnam "0"(Pagina de logare)
}

function sendmail($tip, $email, $data=""){
    global $db;
    file_put_contents("data.txt", $email.PHP_EOL.$tip.PHP_EOL.$data);
}



//die(advencryptor("aaaaaaaaa")."-".advencryptor("bbbbbbbbbb")); - Admin bec
//die(advencryptor("cccccccccc"); - Admin prim
//die(advencryptor("eeeeeeeeee")."-".advencryptor("ffffffffff")); - Admin dev
