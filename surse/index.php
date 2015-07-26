<?php
//Afisare erori - Debugging mode
error_reporting(E_ALL);

//Definire locatie
define('__SITE_PATH', realpath(dirname(__FILE__)));

//Cronometrare timp generare pagina
$qstmr = microtime(true);

//Initializare
require __SITE_PATH . '/app/init.php';
