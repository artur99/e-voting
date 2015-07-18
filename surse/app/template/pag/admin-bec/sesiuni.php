<ul class="pull-left">
    <li class="text-success">Sesiuni pregătite</li>
    <li class="text-info">Sesiuni în curs de desfășurare</li>
    <li class="text-danger">Sesiuni de vot încheiate</li>
</ul>
<a href="admin-bec/adaugare" class="btn btn-lg btn-1 pull-right">Crează sesiune nouă</a>
<table class="table table-bordered table1">
    <tr>
        <th>#</th>
        <th>Titlu</th>
        <th>Detalii</th>
        <th>Început</th>
        <th>Încheiere</th>
        <th>Acț.</th>
    </tr>
    <?php
    $res = $db->query("SELECT * FROM sesiuni_vot ORDER BY inceput DESC");
    while ($data = $res->fetch_array()) {
        if (time() > $data['incheiere']) {
            echo '<tr class="danger">';
        } elseif (time() < $data['inceput']) {
            echo '<tr class="success">';
        } else {
            echo '<tr class="info">';
        }
        echo '<td>' . $data['id'] . '</td>';
        echo '<td>' . $data['titlu'] . '</td>';
        echo '<td>' . $data['detalii'] . '</td>';
        echo '<td>' . date("d.m.Y H:i", $data['inceput']) . '</td>';
        echo '<td>' . date("d.m.Y H:i", $data['incheiere']) . '</td>';
        echo '<td><a href="admin-bec/editare/' . $data['id'] . '" title="Editare"><i class="fa fa-edit"></i></a><a href="admin-bec/candidati/' . $data['id'] . '" title="Administrare Candidați"><i class="fa fa-users"></i></a></td>';
        echo '</tr>';
    }
    ?>
</table>