<?php

function minifycss($css) {
	include 'minify/cssmin.php';
	$css = str_replace(array("\n", "\r"), "", cssminify($css));
	return $css;
}
/*
function minifyjs($js){
	include 'minify/jsmin.php';
	$js = str_replace(array("\n", "\r"), "", JSMin::minify($js));
	return $js;
}

function minifyhtml($html){
	return preg_replace(array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'), array('>', '<', '\\1'), $html);
}
*/
?>
