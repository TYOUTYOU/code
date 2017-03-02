<?php
session_start();

require_once ('./hw3_dbm.php');

//smartyの呼び出し
require_once( './hw3_common.php');

//エンコード
require_once ('./Encode.php');

// ログイン状態チェック
if (!isset($_SESSION["id"])) {
    header("Location: ./hw3_logout.php");
    exit;
}

$id = isset($_POST['id'])? $_POST['id']: null;
$contents = isset($_POST['contents'])? $_POST['contents'] : null;
$submit = isset($_POST['submit'])? $_POST['submit'] : null;
$change= isset($_POST['change'])? $_POST['change']: null;
$delete= isset($_POST['delete'])? $_POST['delete'] : null;

$params1 = array(
    'id'=>$id,
    'contents' => $contents,
    'submit' => $submit,
    'change' => $change,
    'delete' => $delete,
    'name' => $_SESSION['name']
);
$params2='';

//投稿機能
if(!empty($_POST['submit']) && $contents !== '') {
    //投稿内容をデータベースに書き入れる
    try {
        $db = getdb();
        $id = $_SESSION['id'];
        $insert = $db->prepare("INSERT INTO post(contents,user_id)VALUES(:contents,:user_id)");//データベースにデータを入れる
        $insert->bindValue(':contents', $contents);
        $insert->bindValue(':user_id', $_SESSION['id']);
        $insert->execute();
    }catch (PDOException $e) {
        die("エラーメッセージ: {$e->getMessage()}");
    }

    //投稿成功したかどうかのチェックと表示
    try {
        $db = getdb();
        $session_id = intval($_SESSION['id']);
        $select = $db->prepare("SELECT id FROM post WHERE user_id = :session_id AND contents = :contents");
        $select->bindValue(':session_id',$session_id);
        $select->bindValue(':contents',$contents);
        $select->execute();
        $select_result = $select->fetch();
        $db_id = $select_result['id'];

    }catch (PDOException $e) {
        die("エラーメッセージ: {$e->getMessage()}");
    }

    if ($db_id !== '') {
        $main_message1 = 1;
        $params2 = array('main_message1' => $main_message1);
    } else {
        $main_message2 = 1;
        $params2 = array('main_message2' => $main_message2);
    }
}

//投稿変更機能
if(!empty($_POST['change']) && $id !=='' && $contents !== '') {
    //半角英数字であるかどうかのチェック

       if (preg_match("/^[a-zA-Z0-9]+$/", $id)) {
           try {
               $db = getdb();
               $select = $db->prepare("SELECT user_id FROM post WHERE id = :id");
               $select->bindValue(':id',$id);
               $select->execute();
               $select_result = $select->fetch();
               $db_user_id = $select_result['user_id'];
           }catch (PDOException $e) {
               die("エラーメッセージ: {$e->getMessage()}");
           }
           //入力した投稿IDが対応する投稿は本人の投稿であるかどうかをチェック
           if ($_SESSION['id'] === $db_user_id) {
               //入力した内容をデータベース内で更新する
               try{
                   $db = getdb();
                   $update = $db->prepare("UPDATE post SET contents = :contents WHERE id = :id");
                   $update->bindValue(':contents',$contents);
                   $update->bindValue(':id',$id);
                   $update->execute();
                   $update_result = $update->fetch();
                   $db_contents = $update_result['contents'];
               }catch (PDOException $e) {
                   die("エラーメッセージ: {$e->getMessage()}");
               }
               //変更成功かどうかのチェックと表示
               if ($db_contents !== '') {
                   $main_message3 = 1;
                   $params2 = array('main_message3' => $main_message3);
               } else {
                   $main_message4 = 1;
                   $params2 = array('main_message4' => $main_message4);
               }

           } elseif ($_SESSION["id"] !== $db_user_id) {
               $main_message5 = 1;
               $params2 = array('main_message5' => $main_message5);
           }
       } else {
           $num_message = 1;
           $params2 = array('num_message' => $num_message);
       }
}

//投稿削除機能
if(!empty($_POST['delete']) && $id !== '') {
    //半角英数字であるかどうかのチェック
    if (preg_match("/^[a-zA-Z0-9]+$/", $id)) {
        try{
            $db = getdb();
        $select = $db->prepare("SELECT user_id FROM post WHERE id = :id");
        $select->bindValue(':id',$id);
        $select->execute();
        $select_result = $select->fetch();
        $db_user_id = $select_result['user_id'];
        }catch (PDOException $e) {
            die("エラーメッセージ: {$e->getMessage()}");
        }

        if ($_SESSION['id'] === $db_user_id) {//入力した投稿IDが対応する投稿は本人の投稿であるかどうかをチェック
            try{
                $db = getdb();
                $DEL = $db->prepare("DELETE FROM post WHERE id = :id");
                $DEL->bindValue(':id',$id);
                $DEL->execute();
            }catch (PDOException $e) {
                die("エラーメッセージ: {$e->getMessage()}");
            }

            //削除成功かどうかのチェックと表示
            try{
                $db = getdb();
                $select = $db->prepare("SELECT id FROM post WHERE id = :id");
                $select->bindValue(':id',$id);
                $select->execute();
                $select_result = $select->fetch();
                $db_id = $select_result['id'];
            }catch (PDOException $e) {
                die("エラーメッセージ: {$e->getMessage()}");
            }

            if ($db_id === NULL) {
                $main_message6 = 1;
                $params2 = array('main_message6' => $main_message6);
            } else {
                $main_message7 = 1;
                $params2 = array('main_message7' => $main_message7);
            }

        } elseif ($_SESSION['id'] !== $db_user_id) {
            $main_message5 = 1;
            $params2 = array('main_message8' => $main_message5);
        }
    }else {
            $num_message = 1;
            $params2 = array('num_message' => $num_message);
        }
    }

//投稿内容の表示
try{
    $db = getdb();
    $select = $db->prepare('select post.id, member.name, post.contents from post, member where post.user_id = member.id order by post.id desc');
    $select->execute();
    $item = $select->fetchAll(PDO::FETCH_ASSOC);
    $db = NULL;
    $smarty->assign('item', $item);
}catch (PDOException $e) {
    die("エラーメッセージ: {$e->getMessage()}");
}

//ログアウトボタンを押したら、ログアウト画面に移行
if(isset($_POST["logout"])){
    header("Location: ./hw3_logout.php");
}else{
    //何もしない
}

$smarty->assign('params1', $params1);
$smarty->assign('params2', $params2);
$smarty->display('hw3_main.tpl');
?>