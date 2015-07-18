<!DOCTYPE html>
<html>
    <?php include __SITE_PATH . '/app/template/sub/head.php'; ?>
    <body class="admin">
        <?php if ($urnaadm != "1") { ?>
            <i class="fa fa-exclamation-triangle bigicon"></i>
            <div class="box3">
                <h3>Accesul este permis doar persoanelor autorizate! Vă rugăm introduceți codurile de acces:</h3>
                <form action="admin-urna" method="POST">
                    <?php if ($urnaadm == "-1") { ?>
                        <span class="smerrmsg">Combinație de coduri greșită!</span>
                    <?php } ?>
                    <input type="text" class="adminpsw" name="postal" placeholder="Introduceți codul postal...">
                    <input type="password" class="adminpsw" name="pass1" placeholder="Introduceți parola...">
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
                    <h2>Bun venit, <?php echo $_SESSION['nume'];?>!</h2>
                    <h2><a href="out">Delogare</a></h2>
                </div>
            </div>
            <h1>Panou administrare Urnă</h1>
            <div class="box2">
                <div class="inmenu">
                    <span class="mobilemenu">
                        <a href="admin-urna" class="menui<?php echo ($p == 1) ? ' active' : ''; ?>">P. Principală</a>
                    </span>
                    <!--
                    <span class="mobilemenu">
                        <a href="admin-urna/adaugare" class="menui<?php echo ($p == 2) ? ' active' : ''; ?>">Adăugare</a>
                        <a href="admin-urna/resetare" class="menui<?php echo ($p == 3) ? ' active' : ''; ?>">Resetare</a>
                    </span>
                    -->
                </div>
                <h3 class="subtit"><?php echo $titlul; ?></h3>
                <div class="boxinc">
                    <?php
                    if ($pp == 2) {
                        include __SITE_PATH . '/app/template/pag/admin-urna/sesiune.php';
                        //Pagina unei sesiuni
                    } else {
                        include __SITE_PATH . '/app/template/pag/admin-urna/index.php';
                        //Pagina principala
                    }
                    ?>
                </div>
            </div>
            <?php include __SITE_PATH . '/app/template/sub/footer.php'; ?>
        <?php } ?>
    </body>
</html>
