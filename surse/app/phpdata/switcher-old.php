<?php
//Functia de selectie a unei pagini

function selpag() {
    global $pag, $db, $userip, $pagsub, $pagarr;
    //Setare IP in $userip
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $userip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $userip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $userip = $_SERVER['REMOTE_ADDR'];
    }
    //Verificare conexiune baza de date

    if (dbconnect()) {
        if (isset($_GET['pg'])) {
            $pagarr = explode('/', $_GET['pg']);
            $pag = $pagarr[0];
            if ($pagarr[0] == "out") {
                session_destroy();
                session_start();
            }
            if (!loggedin() && $pagarr[0] == "votare") {
                //Daca utilizatorul nelogat intra pe pagina de votare
                $pag = "msg";
                $_SESSION['err_msg'] = "Nu ai acces aici! Te rugăm să te loghezi!";
            }
        } else {
            $pag = "index";
        }
    } else {
        $pag = "msg";
        $_SESSION['err_msg'] = "Eroare la conectarea la baza de date!";
    }
    if (($pag == "votare" || $pag == "admin-bec" || $pag == "admin-prim") && isset($pagarr[1])) {
        $pagsub = $pagarr[1];
    }
    if($pag=="vot"&&!(isset($pagarr[1])&&isset($pagarr[2])&&isset($_SESSION['token'])&&$_SESSION['token']==$pagarr[2])){
        $pag = "msg";
        $_SESSION['err_msg'] = 'Sesiune invalidă! Vă rugăm să activați cookie-urile! Click <a href="votare">aici</a> pentru a vă întoarce.';
    }
    //Includerea paginilor
    switch ($pag) {
        case "msg":
            include __SITE_PATH . '/app/template/' . 'msg.php';
            break;
        case "votare":
            include __SITE_PATH . '/app/template/' . 'votare.php';
            break;
        case "admin-bec":
            $becadm = admin_bec_check();
            include __SITE_PATH . '/app/template/' . 'admin-bec.php';
            break;
        case "admin-prim":
            $primadm = admin_prim_check();
            include __SITE_PATH . '/app/template/' . 'admin-prim.php';
            break;
        case "ajax":
            include __SITE_PATH . '/app/' . 'ajax.php';
            break;
        case "vot":
            vot();
            break;
        default:
            include __SITE_PATH . '/app/template/' . 'index.php';
            break;
    }
}
