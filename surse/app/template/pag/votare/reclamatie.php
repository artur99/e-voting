<?php
if ($reclamatie) {
    echo '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Reclamație înregistrată cu succes! </div>';
}
?>
<form action="votare/reclamatie" method="POST" class="reclform">
    <div class="overflow">
        <p><b>Număr de telefon</b></p>
        <input type="text" name="tel" placeholder="0700808080" required>
        <br><br><p><b>Reclamație</b></p>
        <textarea name="reclamatie" placeholder="Vă rugăm să includeți adresa și locația dvs., și să detaliați cât mai bine cazul! Vă mulțumim!" required></textarea>
    </div>
    <input type="submit" class="btn btn-lg btn-1" value="Trimite!">
</form>