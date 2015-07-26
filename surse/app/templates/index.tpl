<!DOCTYPE html>
<html lang="ro">
<head>{ H-head }</head>
<body>
    <div class="modal fade slide-left login-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-med">
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title" >Logează-te!</h4></div>
            <div class="modal-body">
            <form id="login-form" method="POST">
                <div class="form-group"><label class="control-label">CNP:</label><input type="text" class="form-control" placeholder="1200904256097" name="cnp"></div>
                <div class="form-group"><label class="control-label">Email:</label><input type="text" class="form-control" placeholder="mail@domeniu.com" name="email"></div>
                <div class="form-group"><label class="control-label">Parola:</label><input type="password" class="form-control" placeholder="Parola..." name="parola"></div>
                <div class="form-group"><input type="submit" class="btn btn-primary btn-lg btn-1" value="Logare!"></div>
                <div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Eroare!</strong></div>
            </form>
            </div>
        </div>
        </div>
    </div>
    <div class="box1">
        <h1 class="bigtitle">Votează acum online!</h1>
        <a href="#" class="bigbutton" data-toggle="modal" data-target=".login-modal">Loghează-te!</a>
    </div>
    { F-footer }
</body>
</html>
