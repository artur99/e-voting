<!DOCTYPE html>
<html>
    <?php include __SITE_PATH . '/app/template/sub/head.php'; ?>
    <body>
        <i class="fa fa-exclamation-triangle bigicon"></i>
        <div class="box3">
            <?php
            if (isset($_SESSION['err_msg']) && !empty($_SESSION['err_msg'])) {
                echo $_SESSION['err_msg'];
            } else {
                echo 'Eroare!';
            }
            ?>
            <a href="." class="back">Înapoi la Pagina principală</a>
        </div>
    </body>
</html>
