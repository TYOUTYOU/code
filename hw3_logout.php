<?php
session_start();

require_once( 'hw3_common.php' );
$smarty =& getSmartyObj();
$smarty->template_dir = "C:/xampp/htdocs/var/www/smarty/templates";

if($_SESSION['id']!==''){
    echo "ログアウトしました";
    @session_destroy();
    $logout_m = 1;
    $params = array('logout_m' => $logout_m);
}
$smarty->assign('params', $params);
//テンプレートに出力
$smarty->display('hw3_logout.tpl');
?>