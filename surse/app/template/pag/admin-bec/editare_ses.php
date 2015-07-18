<?php
$sid = intval($pagarr[2]);
$data = $db->query("SELECT * FROM sesiuni_vot WHERE id=$sid LIMIT 1")->fetch_array();
?>
<form class="form-horizontal" id="sesedit-form" role="form" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="">ID unic:</label>
        <div class="col-sm-10">
            <input type="text" name="id" class="form-control" value="<?php echo $sid; ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="titlu">Titlu:</label>
        <div class="col-sm-10"><input type="text" name="titlu" class="form-control" id="titlu" value="<?php echo $data['titlu']; ?>"></div>
    </div>
    <hr>
    <div class="form-group">
        <label class="control-label col-sm-2" for="idata">Data începerii:<br><i>Format(zz-ll-aaaa)</i></label>
        <div class="col-sm-10"><input type="text" name="idata" class="form-control" id="idata" value="<?php echo date("d-m-Y", $data['inceput']); ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="iora">Ora începerii:<br><i>Format(oo:mm:ss)</i></label>
        <div class="col-sm-10"><input type="text" name="iora" class="form-control" id="iora" value="<?php echo date("H:i:s", $data['inceput']); ?>"></div>
    </div>
    <hr>
    <div class="form-group">
        <label class="control-label col-sm-2" for="fdata">Data încheiere:<br><i>Format(zz-ll-aaaa)</i></label>
        <div class="col-sm-10"><input type="text" name="fdata" class="form-control" id="fdata" value="<?php echo date("d-m-Y", $data['incheiere']); ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="fora">Ora încheiere:<br><i>Format(oo:mm:ss)</i></label>
        <div class="col-sm-10"><input type="text" name="fora" class="form-control" id="fora" value="<?php echo date("H:i:s", $data['incheiere']); ?>"></div>
    </div>
    <hr>
    <div class="form-group">
        <label class="control-label col-sm-2" for="descreditor">Descriere:</label>
        <div class="col-sm-10">
            <div id="descreditor" class="form-control"><?php echo $data['detalii']; ?></div>
        </div>
    </div>
    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-lg btn-1" value="Salvează">
            <a href="#" class="btn btn-lg btn-2" data-toggle="modal" data-target="#confirm-modal">Șterge această sesiune</a>
            <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">Șterge sesiune</h4></div><div class="modal-body"><div class="modal-datap2">Sigur vrei să ștergi această sesiune de vot? <div><a href="" id="delsesbut" class="btn btn-style1">Șterge</a><a href="#" class="btn btn-style2" type="button" class="close" data-dismiss="modal">Anulează</a></div></div></div></div></div></div>
            <div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div>
        </div>
    </div>
</form>