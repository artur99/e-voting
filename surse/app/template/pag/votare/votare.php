<?php

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
    echo '<h2 class="sesnam">' . $sesiune['titlu'] . '</h2>';
    echo '<div class="alert alert-info sm-alert">' . $sesiune['detalii'] . '</div>';
    echo '<h3 class="bignotif">Votul se va încheia la ora ' . date("H:i:s", $sesiune['incheiere']) . ' pe ' . date("d.m.Y", $sesiune['incheiere']) . '.</h3>';
    //Verificam daca cetateanul a votat in aceasta sesiune
    $cnp = $_SESSION['cnp'];
    $votat = $db->query("SELECT * FROM voturi WHERE cnp=$cnp AND sesiune_vot=$idses LIMIT 1")->num_rows;
    if ($votat) {
        echo '<h3 class="bignotif">Ați votat deja în această sesiune...<br><br>Vă mulțumim!</h3>';
    } else {
        //Generare token votare - anti CSRF
        $randlet = array_merge(range('a', 'z'), range(0,9));
        shuffle($randlet);
        $token =  time().implode("", $randlet);
        $_SESSION['token'] = $token;

        //Preluam lista candidatilor din baza de date
        $candres = $db->query("SELECT * FROM candidati_vot WHERE id_sesiune=$idses");
        $ciii = 1;
        echo '<div class="row">';
        while ($canddata = $candres->fetch_assoc()) {
            //Pentru fiecare candidat
            //Modal detalii candidat
            echo '<div class="modal fade" id="candidat-' . $canddata['id'] . '" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">' . $canddata['nume'] . '</h4></div><div class="modal-body"><img src="app/data/uploads/' . $canddata['id'] . '.png?'.time().'" class="modal-img"><div class="modal-datap">' . $canddata['detalii'] . '</div></div></div></div></div>';
            //Modal confirmare votare
            echo '<div class="modal fade" id="confirm-' . $canddata['id'] . '" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">Votează</h4></div><div class="modal-body"><div class="modal-datap2">Sigur votezi <br><b>' . $canddata['nume'] . '</b>? <div><a href="vot/' . $canddata['id'] . '/'.$token.'" class="btn btn-style1">Votează</a><a href="#" class="btn btn-style2" type="button" class="close" data-dismiss="modal">Anulează</a></div></div></div></div></div></div>';
            echo '<div class="col-md-3 col-lg-3 col-sm-4 col-xs-12"><div class="candidat">';
            echo '<div class="candidat_sub" data-toggle="modal" data-target="#candidat-' . $canddata['id'] . '">';
            if (file_exists(__SITE_PATH . '/app/data/uploads/' . $canddata['id'] . '.png')) {
                $imgsrc = 'app/data/uploads/' . $canddata['id'] . '.png';
            }else{
                $imgsrc = 'app/data/uploads/def.png';
            }
            echo '<a href="javascript:void();" class="c_sub_a_tooltip" data-toggle="tooltip" data-placement="top" title="' . truncate(strip_tags($canddata['detalii']), 70) . '"><img src="' . $imgsrc . '"></a>';
            echo '<h2>' . $canddata['nume'] . '</h2>';
            echo '</div>';
            echo '<div class="votebtn-up"><a href="#" class="votebtn" data-toggle="modal" data-target="#confirm-' . $canddata['id'] . '">Votează</a></div>';
            echo '</div></div>';
            //4/3/1 in a row - display pentru grila responsive
            if ($ciii % 4 == 0) {
                echo '<div class="clearfix visible-md-lg-block"></div>';
            } if ($ciii % 3 == 0) {
                echo '<div class="clearfix visible-md-sm-block"></div>';
            } if ($ciii % 1 == 0) {
                echo '<div class="clearfix visible-xs-block"></div>';
            }
            $ciii++;
        }
        echo '</div>';
    }
} else {
    //Nu este nici o sesiune activa
    $tm = time();
    $res = $db->query("SELECT * FROM sesiuni_vot WHERE inceput>$tm ORDER BY inceput ASC LIMIT 1");
    if ($res->num_rows == 0) {
        //Nici o sesiune activa sau programata
        echo '<h3 class="bignotif">În acest moment nu este nici o sesiune de vot deschisă sau pregătită!</h3>';
    } else {
        $data = $res->fetch_array();
        echo '<p class="imsg">Sesiunea <b>"' . $data['titlu'] . '"</b> va fi activă începând cu ora ' . date("H:i", $data['inceput']) . ' pe ' . date("d.m.Y", $data['inceput']) . ', și se va încheia la ora ' . date("H:i", $data['incheiere']) . ' pe ' . date("d.m.Y", $data['incheiere']) . '</p>';
        echo '<div class="alert alert-info sm-alert">' . $data['detalii'] . '</div>';
        echo '<h3>Candidați</h3>';
        echo '<ol>';
        $id = $data['id'];
        $cand = $db->query("SELECT * FROM candidati_vot WHERE id_sesiune=$id");
        while ($data2 = $cand->fetch_array()) {
            echo '<li><b>' . $data2['nume'] . '</b><br>' . $data2['detalii'] . '</li>';
        }
        echo '</ol>';
        if ($cand->num_rows == 0) {
            echo '<div class="alert alert-danger" role="alert">Nici un candidat înscris până acum...</div>';
        }
    }
}
?>
