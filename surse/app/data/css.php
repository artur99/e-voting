<?php
header("Pragma: public");
header("Cache-Control: maxage=3600");
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
header("Content-type: text/css", true);
include '../phpdata/minifier.php';
ob_start("minifycss");
$files = array(
    "bootstrap.min.css",
    "font-awesome.min.css",
    "summernote.css",
    "main.css",
    "media.css"
);
foreach ($files as $file) {
    echo file_get_contents('files/' . $file);
}
ob_end_flush();
?>
