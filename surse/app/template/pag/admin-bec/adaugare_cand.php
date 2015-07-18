<?php
$sid = intval($pagarr[2]);
?>
<form class="form-horizontal" id="candedit-form" role="form" method="POST">
    <input type="hidden" name="id" value="new">
    <input type="hidden" name="sid" value="<?php echo $sid; ?>">
    <div class="form-group">
        <label class="control-label col-sm-2" for="nume">Nume:</label>
        <div class="col-sm-10"><input type="text" name="nume" class="form-control" id="nume" placeholder="Nume..."></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="descreditor">Descriere:</label>
        <div class="col-sm-10">
            <div id="descreditor" class="form-control">Descriere...</div>
        </div>
    </div>
    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-lg btn-1" value="Adaugă">
            <div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div>
        </div>
    </div>
</form>