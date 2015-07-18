<!DOCTYPE html>
<html>
    <?php include __SITE_PATH . '/app/template/sub/head.php'; ?>
    <body class="votare">
        <div class="header">
            <div class="hleft">
                <img src="app/data/files/stema.png">
                <h3>Biroul Electoral Central<br>Guvernul României</h3>
            </div>
            <div class="hright">
                <h2>Bine ai venit, <strong><?php echo $_SESSION['nume'] . ' ' . $_SESSION['prenume']; ?></strong>!</h2>
                <h2><a href="out">Delogare</a></h2>
            </div>
        </div>
        <h1>Votează acum online!</h1>
        <div class="box2">
            <?php
            $pagsub = $pg2;
            if ($pagsub == "informatii") {
                $titlul = 'Informații';
                $p = 2;
            } elseif ($pagsub == "legislatie") {
                $titlul = 'Legislație';
                $p = 3;
            } elseif ($pagsub == "reclamatie") {
                $titlul = 'Reclamație';
                $p = 4;
            } else {
                $titlul = 'Votează';
                $p = 1;
            }
            ?>
            <div class="inmenu">
                <span class="mobilemenu">
                    <a href="votare" class="menui<?php echo ($p == 1) ? ' active' : ''; ?>">Votează</a>
                    <a href="votare/informatii" class="menui<?php echo ($p == 2) ? ' active' : ''; ?>">Informații</a>
                </span>
                <span class="mobilemenu">
                    <a href="votare/legislatie" class="menui<?php echo ($p == 3) ? ' active' : ''; ?>">Legislație</a>
                    <a href="votare/reclamatie" class="menui<?php echo ($p == 4) ? ' active' : ''; ?>">Reclamație</a>
                </span>
            </div>
            <h3 class="subtit"><?php echo $titlul; ?></h3>
            <div class="boxinc">
                <?php
                if ($p == 4) {
                    $reclamatie = reclamatie();
                    include __SITE_PATH . '/app/template/pag/votare/reclamatie.php';
                } elseif ($p == 3) {
                    include __SITE_PATH . '/app/template/pag/votare/legislatie.html';
                } elseif ($p == 2) {
                    include __SITE_PATH . '/app/template/pag/votare/informatii.html';
                } else {
                    include __SITE_PATH . '/app/template/pag/votare/votare.php';
                }
                ?>
            </div>
        </div>
        <?php include __SITE_PATH . '/app/template/sub/footer.php'; ?>
    </body>
</html>
