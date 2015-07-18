<!DOCTYPE html>
<html>
    <?php include __SITE_PATH . '/app/template/sub/head.php'; ?>
    <body class="admin">
        <?php if ($devadm != "1") { ?>
            <i class="fa fa-exclamation-triangle bigicon"></i>
            <div class="box3">
                <h3>Accesul este permis doar persoanelor autorizate! Vă rugăm introduceți codurile de acces:</h3>
                <form action="admin-dev" method="POST">
                    <?php if ($devadm == "-1") { ?>
                        <span class="smerrmsg">Combinație de coduri greșită!</span>
                    <?php } ?>
                    <input type="password" class="adminpsw" name="pass1" placeholder="Introduceți codul 1...">
                    <input type="password" class="adminpsw" name="pass2" placeholder="Introduceți codul 2...">
                    <input type="submit" class="adminpswsu" value="Accesare">
                </form>
            </div>
        <?php } else { ?>
            <div class="header">
                <div class="hleft">
                    <img src="app/data/files/stema.png">
                    <h3>Biroul Electoral Central<br>Guvernul României</h3>
                </div>
                <div class="hright">
                    <h2>Bun venit, Dezvoltator!</h2>
                    <h2><a href="out">Delogare</a></h2>
                </div>
            </div>
            <h1>Panou administrare Dezvoltatori</h1>
            <div class="box2">
                <div class="inmenu">
                    <span class="mobilemenu">
                        <a href="admin-dev" class="menui<?php echo ($p == 1) ? ' active' : ''; ?>">Hack_log</a>
                    </span>
                    <span class="mobilemenu">
                        <a href="admin-dev/error" class="menui<?php echo ($p == 2) ? ' active' : ''; ?>">Error_log</a>
                    </span>
                </div>
                <h3 class="subtit"><?php echo $titlul; ?></h3>
                <div class="boxinc">
                    <?php
                    if ($p == 2) {
                        include __SITE_PATH . '/app/template/pag/admin-dev/error.php';
                    } else {
                        include __SITE_PATH . '/app/template/pag/admin-dev/hack.php';
                    }
                    ?>
                </div>
            </div>
    <?php include __SITE_PATH . '/app/template/sub/footer.php'; ?>
<?php } ?>
    </body>
</html>
