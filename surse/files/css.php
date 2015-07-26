<?php
error_reporting(0);
header("Pragma: public");
header("Cache-Control: maxage=3600");
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
header("Content-type: text/css", true);
include 'minifier/minifier.php';

ob_start("minifycss");
$files = array(
    "bootstrap.min.css",
    "font-awesome.min.css",
    "summernote.css",
    "main.css",
    "media.css"
);

foreach ($files as $file) {
    echo file_get_contents('static/css/' . $file);
}
ob_end_flush();
