<form class="form-horizontal" id="persres-form" role="form" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="cnp">CNP:<br><i>CNP-ul persoanei care dorește resetarea parolei</i></label>
        <div class="col-sm-10"><input type="text" name="cnp" class="form-control" id="cnp" placeholder="Introduceți CNP-ul..."></div>
    </div>
    <div class="form-group nomarginbtm">
        <label class="control-label col-sm-2" for="email">E-mail:<br><i>Adresa de e-mail introdusă anterior</i></label>
        <div class="col-sm-10"><input type="text" name="email" class="form-control" id="email" placeholder="Introduceți adresa de e-mail..."></div>
    </div>
    <div class="checkbox">
        <label class="control-label col-sm-2" for=""></label>
        <div class="col-sm-10"><label><input type="checkbox" name="check" id="check" value="1">Am respectat regulamentul de înscriere și declar pe proprie răspundere că aceste date sunt corecte.</label></div>
    </div><br>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-lg btn-1" value="Resetare parolă">
            <div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div>
        </div>
    </div>
</form>
