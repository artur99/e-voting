<?php
$res='';
//Daca exista un string dupa /ajax/
if (isset($pagarr[1])) {
    //Scriptul pentru logarea utilizatorilor
    if ($pagarr[1] == "login" && isset($_POST['cnp']) && isset($_POST['email']) && isset($_POST['parola'])) {
        //Extragem datele
        $cnp = $_POST['cnp'];
        $email = $_POST['email'];
        $parola = $_POST['parola'];
        //Adaugam in log, daca cumva stringul contine caractere rau-intentionate
        $fct->secure($cnp . " " . $email . " " . $parola);
        if (!preg_match("/^(\\d{13})$/", $cnp)) {
            //Verificam daca CNP-ul e compus din 13 cifre
            $res.='CNP-ul introdus este incorect!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Verificam daca adresa de email este valida
            $res.='Adresa de email introdusă este incorectă!';
        } elseif (strlen($parola) < 4) {
            //Veridicam daca lungimea parolei e mai mica de 4 caractere
            $res.='Parola introdusă este prea scurtă!';
        } else {
            //Verificam daca CNP-ul din baza de date are alocată o adresă de email
            $email = $db->real_escape_string($email);
            $num00 = $db->query("SELECT 1 FROM persoane WHERE cnp='$cnp'")->num_rows;
            $num0 = $db->query("SELECT 1 FROM persoane WHERE cnp='$cnp' AND email IS NULL")->num_rows;
            $num = $db->query("SELECT 1 FROM persoane WHERE cnp='$cnp' AND email='$email'")->num_rows;
            if (!$num00) {
                //CNP-ul nu are o adresa de email alocata
                $res.='CNP-ul introdus nu se află în baza noastră de date!';
            } elseif ($num0) {
                //CNP-ul nu are o adresa de email alocata
                $res.='Vă rugăm să vă înregistrați adresa de email la primăria locală! CNP-ul introdus nu are nici o adresă de email alocată!';
            } elseif (!$num) {
                //Adresa de email pt acest CNP este incorecta
                $res.='Adresa de email introdusă nu corespunde cu cea declarată!';
            } else {
                $parola = $fct->advencryptor($parola);
                //Encodam parola, si verificam daca parola, emailul si cnp-ul este corect
                $num2 = $db->query("SELECT * FROM persoane WHERE cnp='$cnp' AND email='$email' AND parola='$parola'");
                if (!$num2->num_rows) {
                    //Parola este gresita
                    $res.='Parola introdusă este incorectă!';
                } else {
                    $userdata = $num2->fetch_array();
                    //Calculam varsta persoanei
                    //Stocata ca aaaallzz in baza de date
                    $nastdb = (string)$userdata['nastere'];
                    $nastedb = $nastdb[6].$nastdb[7]."-".$nastdb[4].$nastdb[5]."-".$nastdb[0].$nastdb[1].$nastdb[2].$nastdb[3];
                    //punem in $nastedb data in formatul zz-ll-aaaa
                    $tmpdate = new DateTime(date("Y-m-d H:i", strtotime($nastedb." 9:00")));
                    $difer = $tmpdate->diff(new DateTime(date("Y-m-d H:i", time())));
                    if ($difer->y<18) {
                        //Persoana nu a implinit 18 ani
                        $res.='Nu aveți încă vârsta minimă obligatorie de 18 ani pentru a vota!';
                    }else{
                        //UTILIZATORUL ESTE LOGAT IN SISTEM----
                        $_SESSION = array();
                        $_SESSION['in'] = 1;
                        $_SESSION['cnp'] = $cnp;
                        $_SESSION['email'] = $email;
                        $_SESSION['nume'] = $userdata['nume'];
                        $_SESSION['prenume'] = $userdata['prenume'];
                        $_SESSION['nastere'] = $userdata['nastere'];
                        $res='1';
                        //UTILIZATORUL ESTE LOGAT IN SISTEM----
                    }
                }
            }
        }
    }
    //Scriptul pentru editarea sesiunilor de vot
    elseif ($pagarr[1] == "editare-ses" && $fct->admin_bec_check() == "1" && isset($_POST['id']) && isset($_POST['titlu']) && isset($_POST['descr']) && isset($_POST['idata']) && isset($_POST['iora']) && isset($_POST['fdata']) && isset($_POST['fora'])) {
        $id = intval($_POST['id']);
        $titlu = $db->real_escape_string(htmlentities($_POST['titlu']));
        $descr = $db->real_escape_string($_POST['descr']);
        $itime = strtotime($_POST['idata'] . " " . $_POST['iora']);
        $ftime = strtotime($_POST['fdata'] . " " . $_POST['fora']);
        //Aici data/ora este stocata in UNIX
        if (!$fct->sescheck($id)) {
            $res.='Această sesiune nu există!';
        } elseif (!$itime) {
            $res.='Data sau ora începerii votului nu sunt corecte!';
        } elseif (!$ftime) {
            $res.='Data sau ora încheierii votului nu sunt corecte!';
        } elseif ($itime > $ftime) {
            $res.='Data/ora încheierii trebuie să fie după data/ora începerii votului!';
        } else {
            $resq = $db->query("UPDATE sesiuni_vot SET titlu='$titlu', inceput=$itime, incheiere=$ftime, detalii='$descr' WHERE id=$id");
            if ($resq) {
                $res='1';
            } else {
                $res.=$db->error;
            }
        }
    }

    //Scriptul pentru adaugarea sesiunilor de vot
    elseif ($pagarr[1] == "adaugare-ses" && $fct->admin_bec_check() == "1" && isset($_POST['id']) && isset($_POST['titlu']) && isset($_POST['descr']) && isset($_POST['idata']) && isset($_POST['iora']) && isset($_POST['fdata']) && isset($_POST['fora'])) {
        $titlu = $db->real_escape_string(htmlentities($_POST['titlu']));
        $descr = $db->real_escape_string($_POST['descr']);
        $itime = strtotime($_POST['idata'] . " " . $_POST['iora']);
        $ftime = strtotime($_POST['fdata'] . " " . $_POST['fora']);
        //Aici data/ora este stocata in UNIX
        if (!$itime) {
            $res.='Data sau ora începerii votului nu sunt corecte!';
        } elseif (!$ftime) {
            $res.='Data sau ora încheierii votului nu sunt corecte!';
        } elseif ($itime > $ftime) {
            $res.='Data/ora încheierii trebuie să fie după data/ora începerii votului!';
        } else {
            $query = $db->query("INSERT INTO sesiuni_vot VALUES(NULL,'$titlu','$descr',$itime,$ftime)");
            if ($query) {
                $res='1';
            } else {
                $res.=$db->error;
            }
        }
    }

    //Scriptul pentru stergerea unei sesiuni de vot
    elseif ($pagarr[1] == "del-ses" && $fct->admin_bec_check() == "1" && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $resq = $db->query("DELETE FROM sesiuni_vot WHERE id=$id LIMIT 1");
        if ($resq) {
            $res='1';
        } else {
            $res.=$db->error;
        }
    }

    //Scriptul pentru editarea candidatilor
    elseif ($pagarr[1] == "editare-cand" && $fct->admin_bec_check() == "1" && isset($_POST['id']) && isset($_POST['nume']) && isset($_POST['descr'])) {
        $id = intval($_POST['id']);
        $nume = $db->real_escape_string(htmlentities($_POST['nume']));
        $descr = $db->real_escape_string($_POST['descr']);
        if (!$fct->candcheck($id)) {
            $res.='Aceast candidat nu există!';
        } else {
            $resq = $db->query("UPDATE candidati_vot SET nume='$nume', detalii='$descr' WHERE id=$id");
            if ($resq) {
                $res='1';
            } else {
                $res.=$db->error;
            }
        }
    }

    //Scriptul pentru adaugarea candidatilor
    elseif ($pagarr[1] == "adaugare-cand" && $fct->admin_bec_check() == "1" && isset($_POST['id']) && isset($_POST['nume']) && isset($_POST['descr'])) {
        $id = intval($_POST['id']);
        $nume = $db->real_escape_string(htmlentities($_POST['nume']));
        $descr = $db->real_escape_string($_POST['descr']);
        if (!$fct->candcheck($id)) {
            $res.='Aceast candidat nu există!';
        } else {
            $resq = $db->query("INSERT INTO candidati_vot VALUES(NULL, $id, '$nume','$descr',0)");
            if ($resq) {
                $res='1';
            } else {
                $res.=$db->error;
            }
        }
    }

    //Scriptul pentru stergerea unui candidat
    elseif ($pagarr[1] == "del-cand" && $fct->admin_bec_check() == "1" && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $resq = $db->query("DELETE FROM candidati_vot WHERE id=$id LIMIT 1");
        if ($resq) {
            unlink(__SITE_PATH . '/files/img/uploads/' . $id . '.png');
            $res='1';
        } else {
            $res.=$db->error;
        }
    }
    //Scriptul pentru adaugare imagine candidat
    if ($pagarr[1] == "img-cand" && $fct->admin_bec_check() && isset($pagarr[2]) && $fct->candcheck($pagarr[2])) {
        //Variabile pentru a schimba dimensiunile imaginilor(px)
        $dimimg = 210;
        $id = $pagarr[2];
        $info = @getimagesize($_FILES['file']['tmp_name']);
        if (!isset($_FILES['file']['error']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            //Daca apare o eroare la uploadare
            $res.="Eroare la uploadare!";
        } elseif ($info === FALSE || ($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
            //Daca fisierul nu e o imagine
            $res.="Fișierul nu este o imagine!";
        } else {
            //Localizam imaginea temporara
            $sursa = $_FILES['file']['tmp_name'];
            //Extragem informatiile
            list($img_wi, $img_he, $fis) = $info;
            //In functie de tipul imaginii, o extragem in variabila $sursa_img
            switch ($fis) {
                case IMAGETYPE_GIF:
                    $sursa_img = imagecreatefromgif($sursa);
                    break;
                case IMAGETYPE_JPEG:
                    $sursa_img = imagecreatefromjpeg($sursa);
                    break;
                case IMAGETYPE_PNG:
                    $sursa_img = imagecreatefrompng($sursa);
                    break;
            }
            //Extragem raportul dintre dimensiuni
            $sursa_ratio = $img_wi / $img_he;
            //Verificam daca latimea e mai mare decat inaltimea
            if ($sursa_ratio > 1) {
                $tmp_he = $dimimg;
                $tmp_wi = (int)($dimimg * $sursa_ratio);
            } else {
                $tmp_wi = $dimimg;
                $tmp_he = (int)($dimimg / $sursa_ratio);
            }
            $temp_gdim = imagecreatetruecolor($tmp_wi, $tmp_he);
            //Creem o noua imagine temporara
            imagecopyresampled($temp_gdim, $sursa_img, 0, 0, 0, 0, $tmp_wi, $tmp_he, $img_wi, $img_he);
            //Copiem imaginea uploadata in cea temporara de rezoluite $tmp_wi x $tmp_he ($dimimg x $dimimg)
            $x0 = ($tmp_wi - $dimimg) / 2;
            $y0 = ($tmp_he - $dimimg) / 2;
            //Calculam coordonatele pentru a copia din imaginea temporara in imaginea finala
            $final_img = imagecreatetruecolor($dimimg, $dimimg);
            imagecopy($final_img, $temp_gdim, 0, 0, $x0, $y0, $dimimg, $dimimg);
            imagepng($final_img, __SITE_PATH . '/files/img/uploads/' . $id . '.png');
            imagedestroy($final_img);
            imagedestroy($sursa_img);
            $res='1';
        }
    }
    //Scriptul pentru inscirerea persoanelor pentru votul online
    elseif(($pagarr[1] == "adaugare-pers" || $pagarr[1] == "resetare-pers") && $fct->admin_prim_check() != "1"){
        $res.='Vă rugăm să vă relogați în acest panou de administrare!';
    }
    elseif ($pagarr[1] == "adaugare-pers" && $fct->admin_prim_check() == "1" && isset($_POST['cnp']) && isset($_POST['nume']) && isset($_POST['nastere']) && isset($_POST['email'])) {
        $cnp = preg_replace("/[^0-9,.]/", "", $_POST['cnp']);
        $nume = $db->real_escape_string(htmlentities($_POST['nume']));
        $nsarray = explode("-", $_POST['nastere']);
        //[0]-d  [1]-m  [2]-y
        //H, m, s, m, d, y
        $zi = $nsarray[0];
        $luna = $nsarray[1];
        $an = $nsarray[2];
        $nastere = $zi."-".$luna."-".$an." 9:00";
        $email = $db->real_escape_string(htmlentities($_POST['email']));
        if (strlen($cnp)!=13) {
            //Verificam daca CNP-ul e compus din 13 cifre
            $res.='CNP-ul introdus este incorect!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Verificam daca adresa de email este valida
            $res.='Adresa de email introdusă este incorectă!';
        } elseif($nastere === false){
            //Verificam daca data nasterii in unix a fost introdusa corect
            $res.='Data nașterii introdusă nu este corectă!';
        } else {
            $resq = $db->query("SELECT * FROM persoane WHERE cnp=$cnp LIMIT 1");
            $rdata = $resq->fetch_array();
            $nastdb = (string)$rdata['nastere'];
            $nastedb = $nastdb[6].$nastdb[7]."-".$nastdb[4].$nastdb[5]."-".$nastdb[0].$nastdb[1].$nastdb[2].$nastdb[3];
            //In format aaaallzz transformat in zz-ll-aaaa

            $tmpdate = new DateTime($nastedb);
            $difer = $tmpdate->diff(new DateTime($nastere));

            if($resq->num_rows==0){
                //Verificam daca CNP-ul exista in baza de date
                $res.='Acest CNP nu există în baza de date! Dacă credeți că aceasta este o eroare, vă rugăm să sesizați autorităților!';
            }elseif(strpos($rdata['email'],'@') !== false){
                //Verificam daca persoana nu a mai declarat odata o adresa de email
                $res.='Această persoană a mai declarat odată adresa de email! Vă rugăm să utilizați formularul de resetare parolă!';
            }elseif(!($difer->y==0&&$difer->m==0&&$difer->d==0&&$difer->h<15)){
                //Verificam daca data nasterii din baza de date corespunde cu cea declarata
                $res.='Data de naștere introdusă nu corespunde cu cea din baza de date!';
            }elseif(strtolower(preg_replace('/[[:^print:]]/', '', $rdata['nume']))!=strtolower(preg_replace('/[[:^print:]]/', '', $_POST['nume']))){
                //Verificam daca numele din baza de date corespunde cu cel declarat
                $res.='Numele introdus nu corespunde cu cel din baza de date!';
            }else{
                //Generam o parola
                $pass = array_merge(range('a', 'z'), range(0,9));shuffle($pass);
                $passf =  substr(implode("", $pass), -8);
                $passenc = $fct->advencryptor($passf);
                //Facem update la email si parola in baza de date
                $ins = $db->query("UPDATE persoane SET email='$email', parola='$passenc' WHERE cnp=$cnp LIMIT 1");
                if ($ins) {
                    $fct->sendmail("adaugare-pers", $email, $passf);
                    $res='1';
                } else {
                    $res.=$db->error;
                }
            }
        }
    }
    //Scriptul pentru resetarea parolei pentru persoanele care voteaza online
    elseif ($pagarr[1] == "resetare-pers" && $fct->admin_prim_check() == "1" && isset($_POST['cnp']) && isset($_POST['email'])) {
        $cnp = preg_replace("/[^0-9,.]/", "", $_POST['cnp']);
        $email = $db->real_escape_string(htmlentities($_POST['email']));
        if (strlen($cnp)!=13) {
            //Verificam daca CNP-ul e compus din 13 cifre
            $res.='CNP-ul introdus este incorect!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Verificam daca adresa de email este valida
            $res.='Adresa de email introdusă este incorectă!';
        } else {
            $resq = $db->query("SELECT * FROM persoane WHERE cnp=$cnp LIMIT 1");
            $res2 = $db->query("SELECT * FROM persoane WHERE cnp=$cnp AND email='$email' LIMIT 1");
            $rdata = $resq->fetch_array();
            if($resq->num_rows==0){
                //Verificam daca CNP-ul exista in baza de date
                $res.='Acest CNP nu există în baza de date! Dacă credeți că aceasta este o eroare, vă rugăm să sesizați autorităților!';
            }elseif($res2->num_rows==0){
                $res.='Adresa de email introdusă nu corespunde cu cea declarată anterior!';
            }else{
                //Generam o parola
                $pass = array_merge(range('a', 'z'), range(0,9));shuffle($pass);
                $passf =  substr(implode("", $pass), -8);
                $passenc = $fct->advencryptor($passf);
                //Facem update la email si parola in baza de date
                $ins = $db->query("UPDATE persoane SET email='$email', parola='$passenc' WHERE cnp=$cnp LIMIT 1");
                if ($ins) {
                    $fct->sendmail("resetare-pers", $email, $passf);
                    $res='1';
                } else {
                    $res.=$db->error;
                }
            }
        }
    }
    //Scriptul pentru verificarea persoanelor
    elseif($pagarr[1] == "urna-pers" && $fct->admin_urna_check() == "1" && isset($_POST['sid']) && isset($_POST['cnp'])){
        $sid = intval($_POST['sid']);
        $cnp = preg_replace("/[^0-9,.]/", "", $_POST['cnp']);
        //Primul caracter din rezultat reprezinta tipul mesajului 1-succes, 0-eroare
        if (!$fct->sescheck($sid)) {
            $res.='0Această sesiune nu există!';
        }else{
            $tm = time();
            $chk = $db->query("SELECT 1 FROM sesiuni_vot WHERE id=$sid AND inceput<$tm AND incheiere>$tm LIMIT 1");
            if($chk->num_rows==0){
                $res.='0Nu aveți acces în această sesiune!';
            }else{
                $chk2 = $db->query("SELECT * FROM persoane WHERE cnp=$cnp");
                if($chk2->num_rows==0){
                    $res.='0Acest CNP nu există în baza de date!';
                }else{
                    $chk3 = $db->query("SELECT ip, timp FROM voturi WHERE cnp=$cnp AND sesiune_vot=$sid");
                    if($chk3->num_rows==1){
                        $chk3d = $chk3->fetch_array();
                        $res.='0Această persoană a mai votat odată la această sesiune de vot pe '.date("d.m.Y", $chk3d['timp']).' la ora '.date("H:i", $chk3d['timp']).' de ';
                        if(strpos($chk3d['ip'],'urna') !== false){
                            $res.=' la '.$chk3d['ip'];
                        }else{
                            $res.=' pe platforma online';
                        }
                        $res.=', și nu poate vota încă odată!';
                    }else{
                        $chk2d = $chk2->fetch_array();
                        $res='1';
                        $res.='<em class="pull-right">Această persoană nu a votat încă...</em>';
                        $res.='<table class="pull-left">';
                        $res.='<tr><td><strong>CNP:</strong></td><td>'.$chk2d['cnp'].'</td></tr>';
                        $res.='<tr><td><strong>Nume:</strong></td><td>'.$chk2d['nume'].' '.$chk2d['prenume'].'</td></tr>';
                        $res.='<tr><td><strong>Anul nașterii: </strong></td><td>'.substr($chk2d['nastere'], 0, 4).'</td></tr>';
                        $res.='</table>';
                        $res.='<button class="btn btn-1 pull-right" onclick="urna_adaug(event, \''.$chk2d['cnp'].'\')">Marchează faptul că a votat la urnă</button>';
                    }
                }
            }
        }
    }
    //Scriptul pentru marcarea faptului ca o persoana a votat la urna
    elseif($pagarr[1] == "urna-adaug" && $fct->admin_urna_check() == "1" && isset($_POST['sid']) && isset($_POST['cnp'])){
        $sid = intval($_POST['sid']);
        $cnp = preg_replace("/[^0-9,.]/", "", $_POST['cnp']);
        //verificam daca sesiunea este deschisa
        $tm = time();
        $chk = $db->query("SELECT 1 FROM sesiuni_vot WHERE id=$sid AND inceput<$tm AND incheiere>$tm LIMIT 1");
        //Verificam daca exista CNP-ul
        $chk2 = $db->query("SELECT 1 FROM persoane WHERE cnp=$cnp");
        //Verificam daca aceasta persoana a mai votat odata
        $chk3 = $db->query("SELECT 1 FROM voturi WHERE cnp=$cnp AND sesiune_vot=$sid");

        if(!$fct->sescheck($sid)){
            $res.='Sesiunea de vot nu există!';
        }elseif($chk->num_rows==0){
            $res.='Sesiunea de vot s-a încheiat, sau nu a început încă!';
        }elseif($chk2->num_rows==0){
            $res.='CNP-ul nu există in baza de date!';
        }elseif($chk3->num_rows>0){
            $res.='Această persoană a mai votat odată!';
        }else{
            $codpostal = intval($_SESSION['urnass1']);
            $db->query("INSERT INTO voturi VALUES(NULL, $cnp, $sid, 'urna-$codpostal', $tm)");
            $res='1';
        }
    }
}
