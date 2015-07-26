<?php
error_reporting(0);
header("Pragma: public");
header("Cache-Control: maxage=3600");
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
header("Content-type: text/javascript", true);
include 'minifier/minifier.php';

//ob_start("minifyjs");
$files = array(
    "jquery.min.js",
    "bootstrap.min.js",
    "summernote.min.js",
    "main.js"
);
foreach ($files as $file) {
    echo file_get_contents('static/js/' . $file);
}
//ob_end_flush();
