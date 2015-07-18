<?php
$sid = intval($pagarr[2]);
$datases = $db->query("SELECT * FROM sesiuni_vot WHERE id=$sid LIMIT 1")->fetch_array();
$cvts1 = $db->query("SELECT 1 FROM voturi WHERE ip LIKE 'urna%'")->num_rows; //Voturi date la urna
$cvts2 = $db->query("SELECT 1 FROM voturi")->num_rows; //Numarul total de voturi
?>

<div class="alert alert-info sm-alert">
    <strong>Voturi date la urnă: </strong> <?php echo $cvts1;?><br>
    <strong>Voturi date pe platformă: </strong> <?php echo($cvts2-$cvts1);?><br>
    <strong>Voturi în total: </strong> <?php echo $cvts2;?><br>
</div>

<h4 class="pull-left">Candidații din sesiunea "<?php echo $datases['titlu']; ?>":</h4>
<a href="admin-bec/adaugare-cand/<?php echo $sid;?>" class="btn btn-lg btn-1 pull-right">Adaugă candidat</a>
<table class="table table-bordered table1">
    <tr>
        <th>#</th>
        <th>Img.</th>
        <th>Nume</th>
        <th>Detalii</th>
        <th>Voturi</th>
        <th>Acț.</th>
    </tr>
    <?php
    $res = $db->query("SELECT * FROM candidati_vot WHERE id_sesiune=$sid");
    while ($data = $res->fetch_array()) {
        echo '<tr>';
        echo '<td>' . $data['id'] . '</td>';
        if (file_exists(__SITE_PATH . '/app/data/uploads/' . $data['id'] . '.png')) {
            $imgsrc = 'app/data/uploads/' . $data['id'] . '.png?'.time();
        } else {
            $imgsrc = 'app/data/uploads/def.png';
        }
        echo '<td><img src="' . $imgsrc . '"></td>';
        echo '<td>' . $data['nume'] . '</td>';
        echo '<td>' . $data['detalii'] . '</td>';
        echo '<td>' . $data['voturi'] . '</td>';
        echo '<td><a href="admin-bec/editare-cand/' . $data['id'] . '" title="Editare"><i class="fa fa-edit"></i></a></td>';
        echo '</tr>';
    }
    ?>
</table>
<?php
if ($res->num_rows == 0) {
    echo '<div class="alert alert-danger" role="alert">Nici un candidat înregistrat...</div>';
}
?>
