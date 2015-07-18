<?php
$sid = intval($pagarr[2]);
$data = $db->query("SELECT * FROM candidati_vot WHERE id=$sid LIMIT 1")->fetch_array();
?>
<div class="modal fade" id="img-modal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-mid"> <div class="modal-content"> <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Schimbare imagine</h4></div> <div class="modal-body"> <form action="#" method="POST" id="imgformdata"> <div class="form-group"><label>Imagine</label><input name="file" type="file" class="form-control" placeholder="Alegeți o imagine de profil..." id="imgfile"></div> <div class="uplprogress"> <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">Încărcare...</span></div> </div> <input type="submit" class="btn btn-lg btn-1 c-b" value="Trimite"> </form> <div class="modmsg"></div> </div> </div> </div> </div>
<form class="form-horizontal" id="candedit-form" role="form" method="POST">
    <input type="hidden" name="sid" value="<?php echo $data['id_sesiune']; ?>">
    <div class="form-group">
        <label class="control-label col-sm-2" for="">ID unic:</label>
        <div class="col-sm-10">
            <input type="text" name="id" class="form-control" value="<?php echo $sid; ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="nume">Nume:</label>
        <div class="col-sm-10"><input type="text" name="nume" class="form-control" id="nume" value="<?php echo $data['nume']; ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="descreditor">Imagine:</label>
        <div class="col-sm-10">
            <a href="#" data-toggle="modal" data-target="#img-modal" class="btn btn-primary btn-1">Uploadare imagine</a>
        </div>
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
            <a href="#" class="btn btn-lg btn-2" data-toggle="modal" data-target="#confirm-modal">Șterge aceast candidat</a>
            <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">Șterge candidat</h4></div><div class="modal-body"><div class="modal-datap2">Sigur vrei să ștergi aceast candidat? <div><a href="" id="delcandbut" class="btn btn-style1">Șterge</a><a href="#" class="btn btn-style2" type="button" class="close" data-dismiss="modal">Anulează</a></div></div></div></div></div></div>
            <div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div>
        </div>
    </div>
</form>
