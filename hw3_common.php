<?php
require_once(dirname( __FILE__ )."/libs/Smarty.class.php");

$smarty = new Smarty();

$smarty->template_dir = dirname( __FILE__ ).'/templates/';
$smarty->compile_dir  = dirname( __FILE__ ).'/templates_c/';
$smarty->config_dir   = dirname( __FILE__ ).'/configs/';
$smarty->cache_dir    = dirname( __FILE__ ).'/cache/';

?>