<?php
session_start();

//データベース接続
require_once 'hw3_dbm.php';
$db = getdb();

//smartyの呼び出し
require_once( 'hw3_common.php' );
$smarty =& getSmartyObj();
$smarty->template_dir = "C:/xampp/htdocs/var/www/smarty/templates";

//エンコード
require_once 'Encode.php';

$name = isset($_POST['name'])? htmlspecialchars($_POST['name']) : null;;
$password = isset($_POST['password'])? htmlspecialchars($_POST['password']) : null;;
$log = isset($_POST['log'])? htmlspecialchars($_POST['log']) : null;;
$reg= isset($_POST['reg'])? htmlspecialchars($_POST['reg']) : null;;

    $params = array(
        'name' => $name,
        'password' => $password,
        'log' => $log,
        'reg' => $reg,
    );

//ログイン機能
//半角英数字であるかどうかのチェック
    if (!empty($log) && $name !== '' && $password !== '') {
        if(preg_match("/^[a-zA-Z0-9]+$/", $name) && preg_match("/^[a-zA-Z0-9]+$/",$password)){
        $db = getdb();
        $sel_id = $db->prepare("SELECT id FROM member WHERE name =?  AND password = ?");
        $sel_id->bindValue(1, $name);
        $sel_id->bindValue(2, $password);
        $sel_id->execute();
        $result = $sel_id->fetch();
        $db_id = $result['id'];

        if ($db_id === NULL) {
            $err1 = 1;
            $params = array('err1' => $err1);
        } else {
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $name;
            header('Location: http://localhost/hw3_main.php');
            exit();
        }

        }else{
            $num_m= 1;
            $params = array('num_m' => $num_m);
        }
    }

//登録機能
if (!empty($_POST['reg']) && $name !== '' && $password !== '') {
    if(preg_match("/^[a-zA-Z0-9]+$/", $name) && preg_match("/^[a-zA-Z0-9]+$/",$password)) {
        $sel_name = $db->prepare("SELECT name FROM member WHERE name =? ");
        $sel_name->bindValue(1, $name);
        $sel_name->execute();
        $result_n1 = $sel_name->fetch();
        $db_name1 = $result_n1['name'];

        if ($name === $db_name1) {
            $err2 = 1;
            $params = array('err2' => $err2);

        } else {
            require_once 'hw3_dbm.php';
            $db = getdb();
            $ins = $db->prepare('INSERT INTO member(name,password)VALUES(:name,:password)');//データベースにデータを入れる
            $ins->bindValue(':name', $name);
            $ins->bindValue(':password', $password);
            $ins->execute();
            $result_n2 = $ins->fetch();
            $db_name2 = $result_n2['name'];

            //登録したかどうかのチェック
            if ($db_name2 !== '') {
                $m1 = 1;
                $params = array('m1' => $m1);
            } else {
                $m2 = 1;
                $params = array('m2' => $m2);
            }
        }
    }else{
        $num_m= 1;
        $params = array('num_m' => $num_m);
    }
}


$smarty->assign('params', $params);
//テンプレートに出力
$smarty->display('hw3_login.tpl');

?>