<?php

class model{
    public function __construct($db){
        $this->db=$db;
    }
    public function head(){
        $res = "";
        $res .='<title>Votează online!</title>';
        $res .='<meta charset="utf-8">';
        $res .='<base href="' . __URL . 'index.php' . '">';
        $res .='<meta name="viewport" content="width=device-width, user-scalable=no">';
        $res .='<link rel="shortcut icon" href="files/img/favicon.png">';
        $res .='<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">';
        $res .='<link href="http://fonts.googleapis.com/css?family=Ubuntu:300,400,400italic,500&subset=latin,latin-ext" rel="stylesheet" type="text/css">';
        $res .='<link  href="files/css.php" rel="stylesheet" type="text/css">';
        $res .='<script src="files/js.php" type="text/javascript"></script>';
        return $res;
    }
    public function footer(){
        $res = '';
        $res .='<div class="footer"><div class="line"></div>';
        $res .='<b><em>Guvernul României</em></b> - Cap. III, Art. 325: Fapta de a introduce, modifica sau şterge, fără drept, date informatice ori de a restricţiona, fără drept, accesul la aceste date, rezultând date necorespunzătoare adevărului, în scopul de a fi utilizate în vederea producerii unei consecinţe juridice, constituie infracţiune şi se pedepseşte cu închisoare de la 2 la 7 ani.<br>Acest sistem NU este oficial și nu are nici o legătură cu Guvernul României! Acest sistem este doar o prezentare!';
        $res .='</div>';
        return $res;
    }
    public function errmsg($msg){
        return !empty($msg)?$msg:'Eroare!';
    }
    public function HsesNume($pgtype){
        if($pgtype=="votare")$res=$_SESSION['nume'].' '.$_SESSION['prenume'];
        elseif($pgtype=="dev")$res="Dezvoltator";
        elseif($pgtype=="bec")$res="Administrator";
        elseif($pgtype=="prim"||$pgtype=="urna")$res=$_SESSION['nume'];

        return isset($res)?$res:"Necunoscut";
    }
    public function votare(){
        global $db, $fct;$ret='';
        //Verificam daca sunt sesiuni de vot deschise in acest moment
        $time = time();
        $data_desc = $db->query("SELECT * FROM sesiuni_vot WHERE inceput<$time AND incheiere>$time LIMIT 1");
        if ($data_desc->num_rows > 0) {
            //Daca exista o sesiune deschisa acum
            //Preluam datele din baza de date
            $sesiune = $data_desc->fetch_array();
            //Extragem id-ul
            $idses = $sesiune['id'];
            //Afisam numele sesiunii de vot
            $ret.='<h2 class="sesnam">' . $sesiune['titlu'] . '</h2>';
            $ret.='<div class="alert alert-info sm-alert">' . $sesiune['detalii'] . '</div>';
            $ret.='<h3 class="bignotif">Votul se va încheia la ora ' . date("H:i:s", $sesiune['incheiere']) . ' pe ' . date("d.m.Y", $sesiune['incheiere']) . '.</h3>';
            //Verificam daca cetateanul a votat in aceasta sesiune
            $cnp = $_SESSION['cnp'];
            $votat = $db->query("SELECT * FROM voturi WHERE cnp=$cnp AND sesiune_vot=$idses LIMIT 1")->num_rows;
            if ($votat) {
                $ret.='<h3 class="bignotif">Ați votat deja în această sesiune...<br><br>Vă mulțumim!</h3>';
            } else {
                //Generare token votare - anti CSRF
                $randlet = array_merge(range('a', 'z'), range(0,9));
                shuffle($randlet);
                $token =  time().implode("", $randlet);
                $_SESSION['token'] = $token;

                //Preluam lista candidatilor din baza de date
                $candres = $db->query("SELECT * FROM candidati_vot WHERE id_sesiune=$idses");
                $ciii = 1;
                $ret.='<div class="row">';
                while ($canddata = $candres->fetch_assoc()) {
                    //Pentru fiecare candidat
                    $imgsrc=file_exists(__SITE_PATH.'/files/img/uploads/'.$canddata['id'].'.png')?('files/img/uploads/'.$canddata['id'].'.png'):'files/img/uploads/def.png';
                    //Modal detalii candidat
                    $ret.='<div class="modal fade" id="candidat-' . $canddata['id'] . '" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">' . $canddata['nume'] . '</h4></div><div class="modal-body"><img src="'.$imgsrc.'?'.time().'" class="modal-img"><div class="modal-datap">' . $canddata['detalii'] . '</div></div></div></div></div>';
                    //Modal confirmare votare
                    $ret.='<div class="modal fade" id="confirm-' . $canddata['id'] . '" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">Votează</h4></div><div class="modal-body"><div class="modal-datap2">Sigur votezi <br><b>' . $canddata['nume'] . '</b>? <div><a href="vot/' . $canddata['id'] . '/'.$token.'" class="btn btn-style1">Votează</a><a href="#" class="btn btn-style2" type="button" class="close" data-dismiss="modal">Anulează</a></div></div></div></div></div></div>';
                    $ret.='<div class="col-md-3 col-lg-3 col-sm-4 col-xs-12"><div class="candidat">';
                    $ret.='<div class="candidat_sub" data-toggle="modal" data-target="#candidat-' . $canddata['id'] . '">';
                    $ret.='<a href="javascript:void();" class="c_sub_a_tooltip" data-toggle="tooltip" data-placement="top" title="' . $fct->truncate(strip_tags($canddata['detalii']), 70) . '"><img src="' . $imgsrc . '?'.time().'"></a>';
                    $ret.='<h2>' . $canddata['nume'] . '</h2>';
                    $ret.='</div>';
                    $ret.='<div class="votebtn-up"><a href="#" class="votebtn" data-toggle="modal" data-target="#confirm-' . $canddata['id'] . '">Votează</a></div>';
                    $ret.='</div></div>';
                    //4/3/1 in a row - display pentru grila responsive
                    if ($ciii % 4 == 0) {
                        $ret.='<div class="clearfix visible-md-lg-block"></div>';
                    } if ($ciii % 3 == 0) {
                        $ret.='<div class="clearfix visible-md-sm-block"></div>';
                    } if ($ciii % 1 == 0) {
                        $ret.='<div class="clearfix visible-xs-block"></div>';
                    }
                    $ciii++;
                }
                $ret.='</div>';
            }
        } else {
            //Nu este nici o sesiune activa
            $tm = time();
            $res = $db->query("SELECT * FROM sesiuni_vot WHERE inceput>$tm ORDER BY inceput ASC LIMIT 1");
            if ($res->num_rows == 0) {
                //Nici o sesiune activa sau programata
                $ret.='<h3 class="bignotif">În acest moment nu este nici o sesiune de vot deschisă sau pregătită!</h3>';
            } else {
                $data = $res->fetch_array();
                $ret.='<p class="imsg">Sesiunea <b>"' . $data['titlu'] . '"</b> va fi activă începând cu ora ' . date("H:i", $data['inceput']) . ' pe ' . date("d.m.Y", $data['inceput']) . ', și se va încheia la ora ' . date("H:i", $data['incheiere']) . ' pe ' . date("d.m.Y", $data['incheiere']) . '</p>';
                $ret.='<div class="alert alert-info sm-alert">' . $data['detalii'] . '</div>';
                $ret.='<h3>Candidați</h3>';
                $ret.='<ol>';
                $id = $data['id'];
                $cand = $db->query("SELECT * FROM candidati_vot WHERE id_sesiune=$id");
                while ($data2 = $cand->fetch_array()) {
                    $ret.='<li><b>' . $data2['nume'] . '</b><br>' . $data2['detalii'] . '</li>';
                }
                $ret.='</ol>';
                if ($cand->num_rows == 0) {
                    $ret.='<div class="alert alert-danger" role="alert">Nici un candidat înscris până acum...</div>';
                }
            }
        }
        return $ret;
    }
    public function menu($page, $id){
        //Page este numele paginii cu template-ul "normal.tpl"
        //iar id-ul este id-ul extras din functia get_normalpg_header();
        $res='';
        if($page=="votare"){
            $res='<span class="mobilemenu"><a href="votare" class="menui{ m-1 }">Votează</a><a href="votare/informatii" class="menui{ m-2 }">Informații</a></span><span class="mobilemenu"><a href="votare/legislatie" class="menui{ m-3 }">Legislație</a><a href="votare/reclamatie" class="menui{ m-4 }">Reclamație</a></span>';
        }elseif($page=="dev"){
            $res='<span class="mobilemenu"><a href="admin-dev" class="menui{ m-1 }">Hack_log</a><a href="admin-dev/error" class="menui{ m-2 }">Error_log</a></span>';
        }elseif($page=="bec"){
            $res='<span class="mobilemenu"><a href="admin-bec" class="menui{ m-1 }">Sesiuni de vot</a></span><span class="mobilemenu"><a href="admin-bec/reclamatii" class="menui{ m-2 }">Reclamații</a></span>';
        }elseif($page=="prim"){
            $res='<span class="mobilemenu"><a href="admin-prim" class="menui{ m-1 }">P. Principală</a></span><span class="mobilemenu"><a href="admin-prim/adaugare" class="menui{ m-2 }">Adăugare</a><a href="admin-prim/resetare" class="menui{ m-3 }">Resetare</a></span>';
        }elseif($page=="urna"){
            $res='<span class="mobilemenu"><a href="admin-urna" class="menui{ m-1 }">P. Principală</a></span>';
        }
        //Adaugam clasa active la elementul $id, apoi stergem toate celelalte "{..}"
        return preg_replace('/\\{\\ \\m\\-\\d+\\ \\}/i', '', str_replace("{ m-".$id." }", " active", $res));
    }
    public function get_normalpg_header($page){
        global $pagURL,$fct; $ret=array(1);
        //Aceasta functie ruleaza doar pentru paginile cu template-ul "normal.tpl"
        //Functia care returneaza un array cu: id-ul paginii, titlul paginii si titlul sectiunii
        $pg1 = isset($pagURL[1])?$pagURL[1]:"";//Extragem URL-ul paginii
        $pg2 = isset($pagURL[2])?$pagURL[2]:"";
        if($page=="votare"){
            $ret=array(1,"Votează","Votează acum online!");
            if($pg1=="informatii"){
                $ret[0] = 2;
                $ret[1] = "Informații";
            }elseif($pg1=="legislatie"){
                $ret[0] = 3;
                $ret[1] = "Legislație";
            }elseif($pg1=="reclamatie"){
                $ret[0] = 4;
                $ret[1] = "Reclamație";
            }
        }elseif($page=="dev"){
            $ret=array(1,"Log-ul încercărilor de hacking", "Panou administrare Dezvoltatori");
            if($pg1=="error"){
                $ret[0] = 2;
                $ret[1] = "Log-ul erorilor";
            }
        }elseif($page=="bec"){
            $ret=array(1,"Sesiuni de vot", "Panou administrare BEC");
            if($pg1=="reclamatii"){
                $ret[0] = 2;
                $ret[1] = "Reclamații";
            }elseif($pg1=="adaugare"){
                $ret[0] = 3;
                $ret[1] = "Creare sesiune nouă de vot";
            }elseif($pg1=="editare"&&$fct->sescheck($pg2)){
                $ret[0] = 4;
                $ret[1] = "Editare Sesiune";
            }elseif($pg1=="candidati"&&$fct->sescheck($pg2)){
                $ret[0] = 5;
                $ret[1] = "Administrare candidați";
            }elseif($pg1=="adaugare-cand"&&$fct->candcheck($pg2)){
                $ret[0] = 6;
                $ret[1] = "Adăugare candidat";
            }elseif($pg1=="editare-cand"&&$fct->candcheck($pg2)){
                $ret[0] = 7;
                $ret[1] = "Editare candidat";
            }
        }elseif($page=="prim"){
            $ret=array(1,"Pagina Principală", "Panou administrare Primărie");
            if($pg1=="adaugare"){
                $ret[0] = 2;
                $ret[1] = "Înscriere persoană";
            }elseif($pg1=="resetare"){
                $ret[0] = 3;
                $ret[1] = "Resetare parolă";
            }
        }elseif($page=="urna"){
            $ret=array(1,"Pagina Principală", "Panou administrare Urnă");
            if($pg1=="ses"&&$fct->sescheck($pg2)){
                $ret[0] = 2;
                $ret[1] = "Sesiune";
            }
        }
        $ret[3] = $this->HsesNume($page); //Numele utilizatorului
        $ret[4] = $this->menu($page, $ret[0]); //Codul html pentru meniu
        return $ret; //Returnam ID-ul, titlul paginii, titlul sectiunii, numele utilizatorului si meniul
    }
    public function get_pgdata($sect, $page, $opts=array()){
        global $fct,$db,$pagURL;//Functia de generare a continutului paginilor
        $id = isset($opts['id'])?$opts['id']:0;
        $pgsub = isset($pagURL[2])?$pagURL[2]:"";
        $res='';
        if($sect=="normal"){
            if($page=="votare"){
                //Pagina utilizatorului de rand
                if($id==1)$res=$this->votare();
                elseif($id==2) $res='<div class="info"><h2><i class="fa fa-info-circle"></i>Cum votez?</h2><p>1. Cetățeanul trebuie să se prezinte la primăria locală cu buletinul, certificatul de naștere și adresa de email personală.</p><p>2. Personalul angajat la primărie are obligația de a înregistra datele despre cetățean pe o platformă special amenajată, în prezența vizuală a cetățeanului în cauză.</p><p>3. Cetățeanul va primi un email pe adresa de emai personală cu o parolă. De pe calculatorul personal, avesta va accesa căsuța poștală electronică și va verifica existența e-mailului.</p><p>4. Cetățeanul va putea accesa în orice moment pagina online de vot, cu adresa de email personală, CNP-ul și parola primită prin email, iar în momentul în care se poate vota, acesta va putea alege un candidat, iar votul lui va fi înregistrat în mod anonim în baza de date.</p><h2><i class="fa fa-info-circle"></i>Am descoperit o fraudă. Ce fac?</h2><p>1. După logarea pe platforma online, orice cetățean, poate trimite detaliile legate de o fraudă sau o nerespectare a regulamentului, pe pagina Reclamație, ce poate fi accesată din meniu, sau <a href="votare/reclamatie">printr-un click aici</a>.</p></div>';
                elseif($id==3) $res=file_get_contents(__SITE_PATH . '/app/static_pages/legislatie.txt');
                elseif($id==4) $res=($fct->reclamatie()?'<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Reclamație înregistrată cu succes! </div>':'').'<form action="votare/reclamatie" method="POST" class="reclform"><div class="overflow"><p><b>Număr de telefon</b></p><input name="tel" placeholder="0700808080" required><br><br><p><b>Reclamație</b></p><textarea name="reclamatie" placeholder="Vă rugăm să includeți adresa și locația dvs., și să detaliați cât mai bine cazul! Vă mulțumim!" required></textarea></div><input type="submit" class="btn btn-lg btn-1" value="Trimite!"></form>';
            }elseif($page=="dev"){
                //Pagina dezvoltatorilor
                $query = $db->query("SELECT * FROM ".($id==1?"hack_log":"error_log")." ORDER BY timp DESC");
                while($data=$query->fetch_array()){
                    $res.='<div class="alert alert-danger" role="alert">';
                    if($id==1){
                        //Log-ul incercarilor de hacking
                        $res.='<p><strong>IP: </strong>'.$data['ip'].'</p>';
                        $res.='<p><strong>Data/ora: </strong>'.date("d.m.Y H:i:s", $data['timp']).'</p>';
                        $res.='<p><strong>POST: </strong><br><em>'.htmlentities($data['post']).'</em></p>';
                        $res.='<p><strong>GET: </strong><br><em>'.htmlentities($data['get']).'</em></p>';
                        $res.='<p><strong>Headere: </strong><br><em>'.htmlentities($data['headere']).'</em></p>';
                    }else{
                        //Log-ul erorilor
                        $res.='<p><strong>Data/ora: </strong>'.date("d.m.Y H:i:s", $data['timp']).'</p>';
                        $res.='<p><strong>Eroare: </strong><br><em>'.htmlentities($data['eroare']).'</em></p>';
                    }
                    $res.='</div>';
                }
            }elseif($page=="bec"){
                if($id==1){
                    //Lista sesiunilor de vot
                    $query = $db->query("SELECT * FROM sesiuni_vot ORDER BY inceput DESC");
                    //Legenda
                    $res.='<ul class="pull-left"><li class="text-success">Sesiuni pregătite</li><li class="text-info">Sesiuni în curs de desfășurare</li><li class="text-danger">Sesiuni de vot încheiate</li></ul>';
                    //Butonul de creare sesiune noua
                    $res.='<a href="admin-bec/adaugare" class="btn btn-lg btn-1 pull-right">Crează sesiune nouă</a>';
                    //Tabelul
                    $res.='<table class="table table-bordered table1">';
                    $res.='<tr><th>#</th><th>Titlu</th><th>Detalii</th><th>Început</th><th>Încheiere</th><th>Acț.</th></tr>';
                    while ($data = $query->fetch_array()) {
                        //Fiecare candidat
                        if(time() > $data['incheiere']) $res.='<tr class="danger">';
                        elseif(time() < $data['inceput']) $res.='<tr class="success">';
                        else $res.='<tr class="info">';
                        $res.='<td>' . $data['id'] . '</td>';
                        $res.='<td>' . $data['titlu'] . '</td>';
                        $res.='<td>' . $data['detalii'] . '</td>';
                        $res.='<td>' . date("d.m.Y H:i", $data['inceput']) . '</td>';
                        $res.='<td>' . date("d.m.Y H:i", $data['incheiere']) . '</td>';
                        $res.='<td><a href="admin-bec/editare/' . $data['id'] . '" title="Editare"><i class="fa fa-edit"></i></a><a href="admin-bec/candidati/' . $data['id'] . '" title="Administrare Candidați"><i class="fa fa-users"></i></a></td>';
                        $res.='</tr>';
                    }$res.='</table>';
                }elseif($id==2){
                    //Pagina de citire a reclamatiilor
                    $query = $db->query("SELECT * FROM reclamatii ORDER BY timp DESC");
                    $res.='<table class="table table-bordered table1"><tr><th>#</th><th>Telefon</th><th>Email</th><th>Reclamatie</th><th>Timp</th></tr>';
                    while($data = $query->fetch_array()){
                        $res.='<tr><td>'.$data['id'].'</td><td>'.$data['telefon'].'</td><td>'.$data['email'].'</td><td>'.$data['reclamatie'].'</td><td>'.date("d.m.Y H:i", $data['timp']).'</td></tr>';
                    }$res.='</table>';
                }elseif($id==3){
                    //Pagina cu formularul de creare sesiune noua
                    $res.='<form class="form-horizontal" id="sesedit-form" role="form" method="POST">';
                    $res.='<input type="hidden" name="id" value="new">';
                    //Input-ul pentru titlul sesiunii
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="titlu">Titlu:</label><div class="col-sm-10"><input type="text" name="titlu" class="form-control" id="titlu" placeholder="Titlu..."></div></div><hr>';
                    //Input-urile pentru data/ora inceperii votului
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="idata">Data începerii:<br><i>Format(zz-ll-aaaa)</i></label><div class="col-sm-10"><input type="text" name="idata" class="form-control" id="idata" value="'.date("d-m-Y").'"></div></div>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="iora">Ora începerii:<br><i>Format(oo:mm:ss)</i></label><div class="col-sm-10"><input type="text" name="iora" class="form-control" id="iora" value="'.date("H:i:s").'"></div></div><hr>';
                    //Input-urile pentru data/ora încheierii votului
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="fdata">Data încheiere:<br><i>Format(zz-ll-aaaa)</i></label><div class="col-sm-10"><input type="text" name="fdata" class="form-control" id="fdata" value="'.date("d-m-Y").'"></div></div>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="fora">Ora încheiere:<br><i>Format(oo:mm:ss)</i></label><div class="col-sm-10"><input type="text" name="fora" class="form-control" id="fora" value="'.date("H:i:s").'"></div></div><hr>';
                    //Editor-ul pentru introducerea descrierii
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="descreditor">Descriere:</label><div class="col-sm-10"><div id="descreditor" class="form-control">Introduceți detalii legate de această sesiune de vot...</div></div></div>';
                    //Butonul de trimitere si locul alertei pentru raspunsul primit de la ajax
                    $res.='<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><input type="submit" class="btn btn-lg btn-1" value="Salvează"><div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div></div></div>';
                    $res.='</form>';
                }elseif($id==4){
                    //Pagina cu formularul de editare a unei sesiuni existente
                    $sid=intval($pgsub);
                    $data = $db->query("SELECT * FROM sesiuni_vot WHERE id=$sid LIMIT 1")->fetch_array();
                    $res.='<form class="form-horizontal" id="sesedit-form" role="form" method="POST">';
                    //Input-ul pentru titlul sesiunii si ID-ul din baza de date
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="">ID unic:</label><div class="col-sm-10"><input type="text" name="id" class="form-control" value="'.$sid.'" disabled></div></div>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="titlu">Titlu:</label><div class="col-sm-10"><input type="text" name="titlu" class="form-control" id="titlu" value="'.$data['titlu'].'"></div></div><hr>';
                    //Input-urile pentru data/ora inceperii votului
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="idata">Data începerii:<br><i>Format(zz-ll-aaaa)</i></label><div class="col-sm-10"><input type="text" name="idata" class="form-control" id="idata" value="'.date("d-m-Y", $data['inceput']).'"></div></div>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="iora">Ora începerii:<br><i>Format(oo:mm:ss)</i></label><div class="col-sm-10"><input type="text" name="iora" class="form-control" id="iora" value="'.date("H:i:s", $data['inceput']).'"></div></div><hr>';
                    //Input-urile pentru data/ora încheierii votului
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="fdata">Data încheiere:<br><i>Format(zz-ll-aaaa)</i></label><div class="col-sm-10"><input type="text" name="fdata" class="form-control" id="fdata" value="'.date("d-m-Y", $data['incheiere']).'"></div></div>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="fora">Ora încheiere:<br><i>Format(oo:mm:ss)</i></label><div class="col-sm-10"><input type="text" name="fora" class="form-control" id="fora" value="'.date("H:i:s", $data['incheiere']).'"></div></div><hr>';
                    //Editor-ul pentru descriere
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="descreditor">Descriere:</label><div class="col-sm-10"><div id="descreditor" class="form-control">'.$data['detalii'].'</div></div></div>';
                    //Butonul de trimitere si locul alertei pentru raspunsul primit de la ajax
                    $res.='<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><input type="submit" class="btn btn-lg btn-1" value="Salvează"><a href="#" class="btn btn-lg btn-2" data-toggle="modal" data-target="#confirm-modal">Șterge această sesiune</a><div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">Șterge sesiune</h4></div><div class="modal-body"><div class="modal-datap2">Sigur vrei să ștergi această sesiune de vot? <div><a href="" id="delsesbut" class="btn btn-style1">Șterge</a><a href="#" class="btn btn-style2" type="button" class="close" data-dismiss="modal">Anulează</a></div></div></div></div></div></div><div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div></div></div>';
                    $res.='</form>';
                }elseif($id==5){
                    //Pagina cu lista candidatilor
                    $sid=intval($pgsub);
                    $query = $db->query("SELECT * FROM candidati_vot WHERE id_sesiune=$sid");
                    $datases = $db->query("SELECT * FROM sesiuni_vot WHERE id=$sid LIMIT 1")->fetch_array();
                    //Voturi date la urna
                    $cvts1 = $db->query("SELECT COUNT(1) FROM voturi WHERE ip LIKE 'urna%'")->fetch_array()[0];
                    //Numarul total de voturi
                    $cvts2 = $db->query("SELECT COUNT(1) FROM voturi")->fetch_array()[0];
                    //Statisticile
                    $res.='<div class="alert alert-info sm-alert"><strong>Voturi date la urnă: </strong> '.$cvts1.'<br><strong>Voturi date pe platformă: </strong> '.($cvts2-$cvts1).'<br><strong>Voturi în total: </strong> '.$cvts2.'<br></div>';
                    $res.='<h4 class="pull-left">Candidații din sesiunea "'.$datases['titlu'].'":</h4><a href="admin-bec/adaugare-cand/'.$sid.'" class="btn btn-lg btn-1 pull-right">Adaugă candidat</a>';
                    $res.='<table class="table table-bordered table1"><tr><th>#</th><th>Img.</th><th>Nume</th><th>Detalii</th><th>Voturi</th><th>Acț.</th></tr>';
                    while ($data = $query->fetch_array()) {
                        $res.='<tr>';
                        $res.='<td>' . $data['id'] . '</td>';
                        if (file_exists(__SITE_PATH . '/files/img/uploads/' . $data['id'] . '.png')) {
                            $imgsrc = 'files/img/uploads/' . $data['id'] . '.png?'.time();
                        } else {
                            $imgsrc = 'files/img/uploads/def.png';
                        }
                        $res.='<td><img src="' . $imgsrc . '"></td>';
                        $res.='<td>' . $data['nume'] . '</td>';
                        $res.='<td>' . $fct->truncate(strip_tags($data['detalii']),80) . '</td>';
                        $res.='<td>' . $data['voturi'] . '</td>';
                        $res.='<td><a href="admin-bec/editare-cand/' . $data['id'] . '" title="Editare"><i class="fa fa-edit"></i></a></td>';
                        $res.='</tr>';
                    }$res.='</table>';
                    if ($query->num_rows == 0)$res.='<div class="alert alert-danger" role="alert">Nici un candidat înregistrat...</div>';
                }elseif($id==6){
                    //Pagina de adaugare candidat
                    $sid = intval($pgsub);
                    $res.='<form class="form-horizontal" id="candedit-form" role="form" method="POST">';
                    $res.='<input type="hidden" name="id" value="new">';
                    $res.='<input type="hidden" name="sid" value="'.$sid.'">';
                    //Input-urile pentru nume si descriere candidat
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="nume">Nume:</label><div class="col-sm-10"><input type="text" name="nume" class="form-control" id="nume" placeholder="Nume..."></div></div>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="descreditor">Descriere:</label><div class="col-sm-10"><div id="descreditor" class="form-control">Descriere...</div></div></div>';
                    //Butonul de trimitere si locul pentru mejsajul de la ajax
                    $res.='<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><input type="submit" class="btn btn-lg btn-1" value="Adaugă"><div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div></div></div>';
                    $res.='</form>';
                }elseif($id==7){
                    //Pagina de editare candidat
                    $sid = intval($pgsub);
                    $data = $db->query("SELECT * FROM candidati_vot WHERE id=$sid LIMIT 1")->fetch_array();
                    $res.='<div class="modal fade" id="img-modal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-mid"> <div class="modal-content"> <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Schimbare imagine</h4></div> <div class="modal-body"> <form action="#" method="POST" id="imgformdata"> <div class="form-group"><label>Imagine</label><input name="file" type="file" class="form-control" placeholder="Alegeți o imagine de profil..." id="imgfile"></div> <div class="uplprogress"> <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">Încărcare...</span></div> </div> <input type="submit" class="btn btn-lg btn-1 c-b" value="Trimite"> </form> <div class="modmsg"></div> </div> </div> </div> </div>';
                    $res.='<form class="form-horizontal" id="candedit-form" role="form" method="POST">';
                    $res.='<input type="hidden" name="sid" value="'.$data['id_sesiune'].'">';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="">ID unic:</label><div class="col-sm-10"><input type="text" name="id" class="form-control" value="'.$sid.'" disabled></div></div>';
                    //Input-urile pentru nume, descriere si imagine candidat
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="nume">Nume:</label><div class="col-sm-10"><input type="text" name="nume" class="form-control" id="nume" value="'.$data['nume'].'"></div></div>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="descreditor">Imagine:</label><div class="col-sm-10"><a href="#" data-toggle="modal" data-target="#img-modal" class="btn btn-primary btn-1">Uploadare imagine</a></div></div><hr>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="descreditor">Descriere:</label><div class="col-sm-10"><div id="descreditor" class="form-control">'.$data['detalii'].'</div></div></div>';
                    //Butonul de trimitere si locul pentru mejsajul de la ajax
                    $res.='<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><input type="submit" class="btn btn-lg btn-1" value="Salvează"><a href="#" class="btn btn-lg btn-2" data-toggle="modal" data-target="#confirm-modal">Șterge aceast candidat</a><div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">Șterge candidat</h4></div><div class="modal-body"><div class="modal-datap2">Sigur vrei să ștergi aceast candidat? <div><a href="" id="delcandbut" class="btn btn-style1">Șterge</a><a href="#" class="btn btn-style2" type="button" class="close" data-dismiss="modal">Anulează</a></div></div></div></div></div></div><div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div></div></div>';
                    $res.='</form>';
                }
            }elseif($page=="prim"){
                if($id==1){
                    //Pagina principala de la primarie
                    $res.='<div class="alert alert-danger sm-alert" role="alert"><b>Atenție!</b><br>Orice încălcare a legislației legată de accesul pe această pagină reprezită o infracțiune și se pedepsește conform legii.<br>Formularele vor fi completate doar în prezența persoanelor în cauză, iar administratorul este direct responsabile pentru menținerea parolei secretă.</div>';
                    $res.='<div class="center"><a href="admin-prim/adaugare" class="btn btn-lg btn-1 btnblce">Înscriere persoană</a><br><a href="admin-prim/resetare" class="btn btn-lg btn-1 btnblce">Resetare parolă persoană</a></div>';
                }elseif($id==2){
                    //Pagina de inregistrare a unui nou utilizator in sistem
                    $res.='<form class="form-horizontal" id="persadd-form" role="form" method="POST">';
                    $res.='<input type="hidden" name="id" value="new">';
                    //Input-urile
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="cnp">CNP:</label><div class="col-sm-10"><input type="text" name="cnp" class="form-control" id="cnp" placeholder="Introduceți CNP-ul..."></div></div>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="nume">Nume:<br><i>(Numele de familie cu diacritice [ăîâțș] dacă este cazul)</i></label><div class="col-sm-10"><input type="text" name="nume" class="form-control" id="nume" placeholder="Introduceți numele..."></div></div>';
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="nastere">Data nașterii:<br><i>Format(zz-ll-aaaa)</i></label><div class="col-sm-10"><input type="text" name="nastere" class="form-control" id="nastere" placeholder="zz-ll-aaaa"></div></div>';
                    $res.='<div class="form-group nomarginbtm"><label class="control-label col-sm-2" for="email">E-mail:<br><i>Completă, incluzând @domeniu.com</i></label><div class="col-sm-10"><input type="text" name="email" class="form-control" id="email" placeholder="Introduceți adresa de e-mail..."></div></div>';
                    $res.='<div class="checkbox"><label class="control-label col-sm-2" for=""></label><div class="col-sm-10"><label><input type="checkbox" name="check" id="check" value="1">Am respectat regulamentul de înscriere și declar pe proprie răspundere că aceste date sunt corecte.</label></div></div><br>';
                    //Butonul de trimitere, locul pentru alerta
                    $res.='<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><input type="submit" class="btn btn-lg btn-1" value="Adaugă"><div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div></div></div>';
                    $res.='</form>';
                }elseif($id==3){
                    //Pagina de resetare a parolei utilizatorilor deja inregistrati
                    $res.='<form class="form-horizontal" id="persres-form" role="form" method="POST">';
                    //Input-urile
                    $res.='<div class="form-group"><label class="control-label col-sm-2" for="cnp">CNP:<br><i>CNP-ul persoanei care dorește resetarea parolei</i></label><div class="col-sm-10"><input type="text" name="cnp" class="form-control" id="cnp" placeholder="Introduceți CNP-ul..."></div></div>';
                    $res.='<div class="form-group nomarginbtm"><label class="control-label col-sm-2" for="email">E-mail:<br><i>Adresa de e-mail introdusă anterior</i></label><div class="col-sm-10"><input type="text" name="email" class="form-control" id="email" placeholder="Introduceți adresa de e-mail..."></div></div>';
                    $res.='<div class="checkbox"><label class="control-label col-sm-2" for=""></label><div class="col-sm-10"><label><input type="checkbox" name="check" id="check" value="1">Am respectat regulamentul de înscriere și declar pe proprie răspundere că aceste date sunt corecte.</label></div></div><br>';
                    //Butonul de trimitere, locul pentru alerta
                    $res.='<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><input type="submit" class="btn btn-lg btn-1" value="Resetare parolă"><div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div></div></div>';
                    $res.='</form>';
                }
            }elseif($page=="urna"){
                $tm = time();
                if($id==1){
                    //Pagina principala pentru persoanele responsabile de la urna
                    $query = $db->query("SELECT * FROM sesiuni_vot ORDER BY inceput DESC");
                    $res.='<table class="table table-bordered table1"><tr><th>Titlu</th><th>Detalii</th><th>Accesare Panou Adm.</th></tr>';
                    while ($data = $query->fetch_array()) {
                        if($data['inceput']<$tm){
                            if($data['incheiere']>$tm){
                                //Sesiunea este activa - acum se voteaza
                                $sts = array(1, "success", "Sesiune activă");
                            }else{
                                //Sesiunea s-a incheiat
                                $sts = array(-1, "danger", "Sesiune încheiată");
                            }
                        }else{
                            //Sesiunea inca nu a inceput, dar a fost pregatita
                            $sts = array(0, "info", "Sesiune pregătită");
                        }
                        $res.= '<tr class="'.$sts[1].'">';
                        $res.= '<td><strong class="text-'.$sts[1].'">('.$sts[2].')</strong><br>' . $data['titlu'] . '</td>';
                        $res.= '<td><strong>' . date("d.m.Y H:i", $data['inceput']).' - '.date("d.m.Y H:i", $data['incheiere']) . '</strong><br>'.$data['detalii'].'</td>';
                        $res.= '<td><a href="admin-urna/ses/'.$data['id'].'" class="btn btn-1 btn-lg'.($sts[0]!=1?' disabled':'').'"'.($sts[0]!=1?' disabled':'').'>Accesare <i class="fa fa-angle-double-right"></i></a></td>';
                        $res.= '</tr>';
                    }
                    $res.='</table>';
                }elseif($id==2){
                    $id = intval($pgsub);
                    $chk = $db->query("SELECT titlu FROM sesiuni_vot WHERE id=$id AND inceput<$tm AND incheiere>$tm LIMIT 1");
                    if(!$chk){
                        $res = '<div class="alert alert-danger sm-alert">Nu aveți acces la această sesiune!</div>';
                    }else{
                        $chkdd=$chk->fetch_array();
                        $res = '<h2 class="sestt">'.$chkdd['titlu'].'</h2>';
                        $res.= '<form class="form-inline finlinp" action="#" method="POST" id="urna-form"><input type="hidden" name="sid" value="'.$id.'">';
                        $res.= '<div class="form-group"><div class="form-group"><label class="control-label col-sm-2" for="nume">CNP:</label></div><div class="form-group"><input type="text" name="cnp" class="form-control" id="cnp" placeholder="Introduceți CNP-ul persoanei pentru a verifica"></div><div class="form-group"><input type="submit" class="btn btn-lg btn-1 btn-inl" value="Verifică"></div></div>';
                        $res.= '<div class="w95box"><div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div></div>';
                        $res.= '</form>';
                    }
                }
            }
        }elseif($sect=="adm_login"){
            $res='<form action="admin-'.$page.'" method="POST">';
            //Daca au fost introduse niste date de logare gresite
            if($opts['status']==-1)$res.='<span class="smerrmsg">Combinație de coduri greșită!</span>';

            if($page=="bec"||$page=="dev"){
                $res.='<input type="password" class="adminpsw" name="pass1" placeholder="Introduceți codul 1...">';
                $res.='<input type="password" class="adminpsw" name="pass2" placeholder="Introduceți codul 2...">';
            } elseif($page=="prim"||$page=="urna"){
                $res.='<input type="text" class="adminpsw" name="postal" placeholder="Introduceți codul poștal...">';
                $res.='<input type="password" class="adminpsw" name="pass1" placeholder="Introduceți parola...">';
            }
            $res.='<input type="submit" class="adminpswsu" value="Accesare">';
            $res.='</form>';
        }
        return isset($res)?$res:"";
    }
}
