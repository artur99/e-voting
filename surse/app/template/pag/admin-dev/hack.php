<?php
$res = $db->query("SELECT * FROM hack_log ORDER BY timp DESC");
while($data=$res->fetch_array()){
    ?>

    <div class="alert alert-danger" role="alert">
        <p><strong>IP: </strong> <?php echo $data['ip'];?></p>
        <p><strong>Data/ora: </strong> <?php echo date("d.m.Y H:i:s", $data['timp']);?></p>
        <p><strong>POST: </strong><br><em><?php echo htmlentities($data['post']);?></em></p>
        <p><strong>GET: </strong><br><em><?php echo htmlentities($data['get']);?></em></p>
        <p><strong>Headere: </strong><br><em><?php echo htmlentities($data['headere']);?></em></p>
    </div>

    <?php
}
?>
