<?php
//Functia de selectie a unei pagini
function selpag() {
    global $pag, $db, $userip, $pagsub, $pagarr, $pgtype;
    //Setare IP in $userip
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $userip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $userip = $_SERVER['REMOTE_ADDR'];
    }

    //Setam path-ul predefinit
    $path = "template/index.php";
    $pgtype = "html";
    if (!dbconnect()) {
        $path = "template/msg.php";
        $_SESSION['err_msg'] = "Eroare la conectarea la baza de date!";
    } else {
        $pagarr = explode('/', isset($_GET['pg'])?$_GET['pg']:"");
        $pg1 = isset($pagarr[0])?$pagarr[0]:"";
        $pg2 = isset($pagarr[1])?$pagarr[1]:"";
        $pg3 = isset($pagarr[2])?$pagarr[2]:"";

        if($pg1=="votare"){
            //Pagina utilizatorului
            if(!loggedin()){
                $_SESSION['err_msg'] = "Nu ai acces aici! Te rugăm să te loghezi!";
                $path = "template/msg.php";
            }else{
                $path = "template/votare.php";
            }
        }elseif($pg1=="ajax"){
            //Pagina de interactiuni ajax
            $path = "ajax.php";
        }elseif($pg1=="out"){
            //Pagina de delogare
            $_SESSION = array();
            session_destroy();
            session_start();
            $pgtype="text";
        }elseif($pg1=="vot"&&loggedin()){
            //Pagina de inregistrare vot
            if(isset($_SESSION['token'])&&$pg3==$_SESSION['token']&&candcheck($pg2)){
                vot();
                $pgtype="text";
            }else{
                $_SESSION['err_msg'] = 'Sesiune invalidă! Vă rugăm să activați cookie-urile! Click <a href="votare">aici</a> pentru a vă întoarce.';
                $path = "template/msg.php";
            }
        }elseif($pg1=="admin-bec"){
            //Pagina de administrare a Biroului Electoral Central
            $becadm = admin_bec_check();
            $pp = 0;
            if ($pg2 == "reclamatii") {
                //Pagina cu lista de reclamatii
                $p = 2; $titlul = 'Reclamații';
            } elseif ($pg2 == "editare" && isset($pagarr[2]) && sescheck($pagarr[2])) {
                //Daca exista sesiunea, pagina de editare
                $p = 1; $pp = 1; $titlul = 'Editare Sesiune';
            } elseif ($pg2 == "adaugare") {
                $p = 1; $pp = 2; $titlul = 'Creare sesiune nouă de vot';
            }  elseif ($pg2 == "candidati" && isset($pagarr[2]) && sescheck($pagarr[2])) {
                $p = 0; $pp = 3; $titlul = 'Administrare candidați';
            }  elseif ($pg2 == "editare-cand" && isset($pagarr[2]) && candcheck($pagarr[2])) {
                $p = 0; $pp = 4; $titlul = 'Editare candidat';
            }  elseif ($pg2 == "adaugare-cand" && isset($pagarr[2]) && sescheck($pagarr[2])) {
                $p = 0; $pp = 5; $titlul = 'Adăugare candidat';
            } else {
                //Pagina cu lista de sesiuni de  vot
                $p = 1; $titlul = 'Sesiuni de vot';
            }
            $path = 'template/' . 'admin-bec.php';

        }elseif($pg1=="admin-prim"){
            //Pagina de administrare a Primariilor
            $primadm = admin_prim_check();
            if($primadm){
                if ($pg2 == "adaugare") {
                    //Pagina de inscriere persoana in baza de date
                    $p = 2; $titlul = 'Înscriere persoană';
                } elseif($pg2 == "resetare") {
                    //Pagina de resetare a parolei
                    $p = 3; $titlul = 'Resetare parolă';
                } else{
                    //Pagina principala
                    $p = 1; $titlul = 'Pagina Principală';
                }
            }
            $path = 'template/' . 'admin-prim.php';
        }elseif($pg1=="admin-urna"){
            //Pagina de inregistrare si verificare a voturilor date la urna
            $urnaadm = admin_urna_check();
            if($urnaadm){
                if($pg2=="ses"&&sescheck($pg3)){
                    $p = 1; $titlul = 'Sesiune'; $pp=2;
                }else{
                    $p = 1; $titlul = 'Pagina Principală'; $pp=1;
                }
            }
            $path = 'template/' . 'admin-urna.php';
        }elseif($pg1=="admin-dev"){
            //Pagina de inregistrare si verificare a voturilor date la urna
            $devadm = admin_dev_check();
            if($devadm){
                if($pg2=="error"){
                    $p = 2; $titlul = 'Log-ul erorilor';
                }else{
                    $p = 1; $titlul = 'Log-ul încercărilor de hacking';
                }
            }
            $path = 'template/' . 'admin-dev.php';
        }
    }

    $incfile = __SITE_PATH . '/app/' . $path;

    if($pgtype=="html"){
        ob_start("minifyhtml");
        include($incfile);
        ob_end_flush();
    }else{
        include($incfile);
    }
}
