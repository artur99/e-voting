<form class="form-horizontal" id="sesedit-form" role="form" method="POST">
    <input type="hidden" name="id" value="new">
    <div class="form-group">
        <label class="control-label col-sm-2" for="titlu">Titlu:</label>
        <div class="col-sm-10"><input type="text" name="titlu" class="form-control" id="titlu" placeholder="Titlu..."></div>
    </div>
    <hr>
    <div class="form-group">
        <label class="control-label col-sm-2" for="idata">Data începerii:<br><i>Format(zz-ll-aaaa)</i></label>
        <div class="col-sm-10"><input type="text" name="idata" class="form-control" id="idata" value="<?php echo date("d-m-Y"); ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="iora">Ora începerii:<br><i>Format(oo:mm:ss)</i></label>
        <div class="col-sm-10"><input type="text" name="iora" class="form-control" id="iora" value="<?php echo date("H:i:s"); ?>"></div>
    </div>
    <hr>
    <div class="form-group">
        <label class="control-label col-sm-2" for="fdata">Data încheiere:<br><i>Format(zz-ll-aaaa)</i></label>
        <div class="col-sm-10"><input type="text" name="fdata" class="form-control" id="fdata" value="<?php echo date("d-m-Y"); ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="fora">Ora încheiere:<br><i>Format(oo:mm:ss)</i></label>
        <div class="col-sm-10"><input type="text" name="fora" class="form-control" id="fora" value="<?php echo date("H:i:s"); ?>"></div>
    </div>
    <hr>
    <div class="form-group">
        <label class="control-label col-sm-2" for="descreditor">Descriere:</label>
        <div class="col-sm-10">
            <div id="descreditor" class="form-control">Introduceți detalii legate de această sesiune de vot...</div>
        </div>
    </div>
    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-lg btn-1" value="Salvează">
            <div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div>
        </div>
    </div>
</form>