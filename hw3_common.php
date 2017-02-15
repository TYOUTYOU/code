<?php
ini_set( 'display_errors', 1 );
define('SMARTY_DIR', 'C:/smarty/libs/');
require_once(SMARTY_DIR . "Smarty.class.php");

// Smartyオブジェクト取得
function & getSmartyObj()
{
    static $smarty = null;

    if( is_null( $smarty ) ){
        $smarty = new Smarty();
        $smarty->template_dir = 'C:/xampp/htdocs/var/www/smarty/templates/';
        $smarty->compile_dir  = 'C:/xampp/htdocs/var/www/smarty/templates_c/';
        $smarty->config_dir   = 'C:/xampp/htdocs/var/www/smarty/configs/';
        $smarty->cache_dir    = 'C:/xampp/htdocs/var/www/smarty/cache/';
    }

    return $smarty;
}
?>