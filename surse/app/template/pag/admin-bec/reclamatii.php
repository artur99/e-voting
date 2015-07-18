<table class="table table-bordered table1">
    <tr>
        <th>#</th>
        <th>Telefon</th>
        <th>Email</th>
        <th>Reclamatie</th>
        <th>Timp</th>
    </tr>
    <?php
        $res = $db->query("SELECT * FROM reclamatii ORDER BY timp DESC");
        while($data = $res->fetch_array()){
            echo '<tr>';
            echo '<td>'.$data['id'].'</td>';
            echo '<td>'.$data['telefon'].'</td>';
            echo '<td>'.$data['email'].'</td>';
            echo '<td>'.$data['reclamatie'].'</td>';
            echo '<td>'.date("d.m.Y H:i", $data['timp']).'</td>';
            echo '</tr>';
        }
    ?>
</table>