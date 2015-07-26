<?php
if(session_id()==''){
    @session_start();
}
require __SITE_PATH . '/app/config.php';
require __SITE_PATH . '/app/functions.php';

require __SITE_PATH . '/app/controller.php';
require __SITE_PATH . '/app/model.php';
require __SITE_PATH . '/app/view.php';

date_default_timezone_set($conf['sys_timezone']);
define('__URL', 'http://'.$_SERVER['SERVER_NAME'].$conf['sys_path']);
$pagURL = explode("/", isset($_GET['pg'])?$_GET['pg']:'');
$userip = $_SERVER['REMOTE_ADDR'];

$db = @new mysqli($conf['sys_db_host'], $conf['sys_db_username'], $conf['sys_db_password'], $conf['sys_db_name']);
$fct = new functions($db, $pagURL);

$model = new model($db, $pagURL);
$view = new view($db);
$controller = new controller($db, $pagURL);

$controller->start();
