<form class="form-horizontal" id="persadd-form" role="form" method="POST">
    <input type="hidden" name="id" value="new">
    <div class="form-group">
        <label class="control-label col-sm-2" for="cnp">CNP:</label>
        <div class="col-sm-10"><input type="text" name="cnp" class="form-control" id="cnp" placeholder="Introduceți CNP-ul..."></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="nume">Nume:<br><i>(Numele de familie cu diacritice [ăîâțș] dacă este cazul)</i></label>
        <div class="col-sm-10"><input type="text" name="nume" class="form-control" id="nume" placeholder="Introduceți numele..."></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="nastere">Data nașterii:<br><i>Format(zz-ll-aaaa)</i></label>
        <div class="col-sm-10"><input type="text" name="nastere" class="form-control" id="nastere" placeholder="zz-ll-aaaa"></div>
    </div>
    <div class="form-group nomarginbtm">
        <label class="control-label col-sm-2" for="email">E-mail:<br><i>Completă, incluzând @domeniu.com</i></label>
        <div class="col-sm-10"><input type="text" name="email" class="form-control" id="email" placeholder="Introduceți adresa de e-mail..."></div>
    </div>
    <div class="checkbox">
        <label class="control-label col-sm-2" for=""></label>
        <div class="col-sm-10"><label><input type="checkbox" name="check" id="check" value="1">Am respectat regulamentul de înscriere și declar pe proprie răspundere că aceste date sunt corecte.</label></div>
    </div><br>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-lg btn-1" value="Adaugă">
            <div class="alert alert-danger fade in" role="alert"><strong>Eroare!</strong> </div>
        </div>
    </div>
</form>
