<?php
session_start();
require_once( 'hw3_common.php' );

if($_SESSION['id']!==''){
    echo "ログアウトしました";
    @session_destroy();
    $logout_m = 1;
    $params = array('logout_m' => $logout_m);
}
$smarty->assign('params', $params);
$smarty->display('hw3_logout.tpl');
?>