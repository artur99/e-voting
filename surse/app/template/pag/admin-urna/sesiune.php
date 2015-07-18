<?php
//Verificam daca sesiunea este activa
$tm = time();
$id = intval($pg3);
$chk = $db->query("SELECT titlu FROM sesiuni_vot WHERE id=$id AND inceput<$tm AND incheiere>$tm LIMIT 1");

if(!$chk){
    echo '<div class="alert alert-danger sm-alert">Nu aveți acces la această sesiune!</div>';
}else{
    $chkdd=$chk->fetch_array();
    echo '<h2 class="sestt">'.$chkdd['titlu'].'</h2>'
?>
<form class="form-inline finlinp" action="#" method="POST" id="urna-form">
    <input type="hidden" name="sid" value="<?php echo $pg3;?>">
    <div class="form-group">
        <div class="form-group">
            <label class="control-label col-sm-2" for="nume">CNP:</label>
        </div>
        <div class="form-group">
            <input type="text" name="cnp" class="form-control" id="cnp" placeholder="Introduceți CNP-ul persoanei pentru a verifica">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-lg btn-1 btn-inl" value="Verifică">
        </div>
    </div>
    <div class="w95box">
        <div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div>
    </div>
</form>

<?php
}
?>
