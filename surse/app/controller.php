<?php

@session_start();

include __SITE_PATH . '/app/' . 'functions.php';
include __SITE_PATH . '/app/phpdata/' . 'switcher.php';
include __SITE_PATH . '/app/phpdata/' . 'minifier.php';

selpag();

chkerr();
