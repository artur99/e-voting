<!DOCTYPE html>
<html>
    <?php include __SITE_PATH . '/app/template/sub/head.php'; ?>
    <body class="admin">
        <?php if ($becadm != "1") { ?>
            <i class="fa fa-exclamation-triangle bigicon"></i>
            <div class="box3">
                <h3>Accesul este permis doar persoanelor autorizate! Vă rugăm introduceți codurile de acces:</h3>
                <form action="admin-bec" method="POST">
                    <?php if ($becadm == "-1") { ?>
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
                    <h2>Bun venit, Administrator!</h2>
                    <h2><a href="out">Delogare</a></h2>
                </div>
            </div>
            <h1>Panou administrare BEC</h1>
            <div class="box2">
                <div class="inmenu">
                    <span class="mobilemenu">
                        <a href="admin-bec" class="menui<?php echo ($p == 1) ? ' active' : ''; ?>">Sesiuni de vot</a>
                    </span>
                    <span class="mobilemenu">
                        <a href="admin-bec/reclamatii" class="menui<?php echo ($p == 2) ? ' active' : ''; ?>">Reclamații</a>
                    </span>
                </div>
                <h3 class="subtit"><?php echo $titlul; ?></h3>
                <div class="boxinc">
                    <?php
                    if ($p == 2) {
                        include __SITE_PATH . '/app/template/pag/admin-bec/reclamatii.php';
                    } else {
                        if ($pp == 1) {
                            include __SITE_PATH . '/app/template/pag/admin-bec/editare_ses.php';
                        } elseif ($pp == 2) {
                            include __SITE_PATH . '/app/template/pag/admin-bec/adaugare_ses.php';
                        } elseif ($pp == 3) {
                            include __SITE_PATH . '/app/template/pag/admin-bec/administrare_cand.php';
                        } elseif ($pp == 4) {
                            include __SITE_PATH . '/app/template/pag/admin-bec/editare_cand.php';
                        } elseif ($pp == 5) {
                            include __SITE_PATH . '/app/template/pag/admin-bec/adaugare_cand.php';
                        } else {
                            include __SITE_PATH . '/app/template/pag/admin-bec/sesiuni.php';
                        }
                    }
                    ?>
                </div>
            </div>
    <?php include __SITE_PATH . '/app/template/sub/footer.php'; ?>
<?php } ?>
    </body>
</html>
