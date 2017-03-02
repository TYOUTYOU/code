<?php
session_start();
require_once( './hw3_common.php' );

if($_SESSION['id']!==''){
    @session_destroy();
    $logout_message = 1;
    $params = array('logout_message' => $logout_message);
}
$smarty->assign('params', $params);
$smarty->display('hw3_logout.tpl');
?>