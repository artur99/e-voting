<?php
$res = $db->query("SELECT * FROM error_log ORDER BY timp DESC");
while($data=$res->fetch_array()){
    ?>

    <div class="alert alert-danger" role="alert">
        <p><strong>Data/ora: </strong> <?php echo date("d.m.Y H:i:s", $data['timp']);?></p>
        <p><strong>Eroare: </strong><br><em><?php echo htmlentities($data['eroare']);?></em></p>
    </div>

    <?php
}
?>
