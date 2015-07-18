<table class="table table-bordered table1">
    <tr>
        <th>Titlu</th>
        <th>Detalii</th>
        <th>Accesare Panou Adm.</th>
    </tr>
    <?php
    $tm = time();
    $res = $db->query("SELECT * FROM sesiuni_vot ORDER BY inceput DESC");
    while ($data = $res->fetch_array()) {
        if($data['inceput']<$tm){
            if($data['incheiere']>$tm){
                $sts = 1; //Sesiunea este activa - acum se voteaza
                $sscls = "success";
                $sssts = "Sesiune activă";
            }else{
                $sts = -1; //Sesiunea s-a incheiat
                $sscls = "danger";
                $sssts = 'Sesiune încheiată';
            }
        }else{
            $sts = 0; //Sesiunea inca nu a inceput, dar a fost pregatita
            $sscls = "info";
            $sssts = 'Sesiune pregătită';
        }
        echo '<tr class="'.$sscls.'">';
        echo '<td><strong class="text-'.$sscls.'">('.$sssts.')</strong><br>' . $data['titlu'] . '</td>';
        echo '<td><strong>' . date("d.m.Y H:i", $data['inceput']).' - '.date("d.m.Y H:i", $data['incheiere']) . '</strong><br>'.$data['detalii'].'</td>';
        echo '<td><a href="admin-urna/ses/'.$data['id'].'" class="btn btn-1 btn-lg'.($sts!=1?' disabled':'').'"'.($sts!=1?' disabled':'').'>Accesare <i class="fa fa-angle-double-right"></i></a></td>';
        echo '</tr>';
    }
    ?>
</table>
<?php
    if($res->num_rows==0){
            echo '<div class="alert alert-info sm-alert">Nu există nici o sesiune de vot activă sau programată!</div>';
    }
?>
