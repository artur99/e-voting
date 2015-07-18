<?php
//Afisare erori - Debugging mode
error_reporting(0);

//Definire locatie
define('__SITE_PATH', realpath(dirname(__FILE__)));

//Includere configurari
require __SITE_PATH . '/app/config.php';

//Setare timezone
date_default_timezone_set($timezone);

//Definire locatie pentru <base>
define('__URL', 'http://' . $_SERVER['SERVER_NAME'] . $path);

//Initiere
require __SITE_PATH . '/app/controller.php';
?>
