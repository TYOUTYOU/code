<?php
session_start();

require_once ('./hw3_dbm.php');

//smartyの呼び出し
require_once ('./hw3_common.php');

//エンコード
require_once ('./Encode.php');

$name = isset($_POST['name'])? $_POST['name'] : null;
$password = isset($_POST['password'])? $_POST['password'] : null;
$login = isset($_POST['login'])? $_POST['login'] : null;
$register= isset($_POST['register'])? $_POST['register']: null;

    $params1 = array(
        'name' => $name,
        'password' => $password,
        'login' => $login,
        'register' => $register,
    );
    $params2 = '';


//ログイン機能
    if (!empty($login) && $name !== '' && $password !== '') {
        //半角英数字であるかどうかのチェック
        if (preg_match("/^[a-zA-Z0-9]+$/", $name) && preg_match("/^[a-zA-Z0-9]+$/", $password)) {
            try{
                $db = getdb();
                $select_id = $db->prepare("SELECT id FROM member WHERE name = :name AND password = :password");
                $select_id->bindValue(':name',$name);
                $select_id->bindValue(':password',$password);
                $select_id->execute();
                $result = $select_id->fetch();
                $db_id = $result['id'];

                if ($db_id === NULL) {
                    $error1 = 1;
                    $params2 = array('error1' => $error1);
                } else {
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['name'] = $name;
                    header("Location: ./hw3_main.php");
                    exit();
                }
            }catch (PDOException $e) {
                die("エラーメッセージ: {$e->getMessage()}");
            }
        } else {
            $num_message = 1;
            $params2 = array('num_message' => $num_message);
        }
    }

//登録機能
    if (!empty($_POST['register']) && $name !== '' && $password !== '') {
        //半角英数字であるかどうかのチェック
        if (preg_match("/^[a-zA-Z0-9]+$/", $name) && preg_match("/^[a-zA-Z0-9]+$/", $password)) {
            try{
                $db = getdb();
                $select_name = $db->prepare("SELECT name FROM member WHERE name = :name ");
                $select_name->bindValue(':name', $name);
                $select_name->execute();
                $result_name1 = $select_name->fetch();
                $db_name1 = $result_name1['name'];
            }catch (PDOException $e) {
                die("エラーメッセージ: {$e->getMessage()}");
            }
            //入力したユーザー名がすでに登録されたかどうかのチェック
            if ("$name" === "$db_name1") {
                $error2 = 1;
                $params2 = array('error2' => $error2);

            } else {
                try{
                    $db = getdb();
                    $insert = $db->prepare('INSERT INTO member(name,password)VALUES(:name,:password)');//データベースにデータを入れる
                    $insert->bindValue(':name', $name);
                    $insert->bindValue(':password', $password);
                    $insert->execute();
                    $result_name2 = $insert->fetch();
                    $db_name2 = $result_name2['name'];
                }catch (PDOException $e) {
                    die("エラーメッセージ: {$e->getMessage()}");
                }

                //登録成功かどうかのチェックと表示
                if ($db_name2 !== '') {
                    $message1 = 1;
                    $params2 = array('message1' => $message1);
                } else {
                    $message2 = 1;
                    $params2 = array('message2' => $message2);
                }
            }
        } else {
            $num_message = 1;
            $params2 = array('num_message' => $num_message);
        }
    }

    $smarty->assign('params1', $params1);
    $smarty->assign('params2', $params2);
    $smarty->display('hw3_login.tpl');

?>