<?php

function minifycss($css) {
	include 'minify/cssmin.php';
	$css = str_replace(array("\n", "\r"), "", cssminify($css));
	return $css;
}

function minifyhtml($html){
	return preg_replace(array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'), array('>', '<', '\\1'), $html);
}
?>
