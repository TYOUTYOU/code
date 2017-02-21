<?php
session_start();

//データベース接続
require_once 'hw3_dbm.php';
$db = getDb();

//smartyの呼び出し
require_once( 'hw3_common.php' );

//エンコード
require_once 'Encode.php';

// ログイン状態チェック
if (!isset($_SESSION["id"])) {
    header("Location:hw3_logout.php");
    exit;
}

$id = isset($_POST['id'])? htmlspecialchars($_POST['id']) : null;
$con = isset($_POST['con'])? htmlspecialchars($_POST['con']) : null;
$sub = isset($_POST['sub'])? htmlspecialchars($_POST['sub']) : null;;
$cha= isset($_POST['cha'])? htmlspecialchars($_POST['cha']) : null;;
$del= isset($_POST['del'])? htmlspecialchars($_POST['del']) : null;;

$pa = array(
    'id'=>$id,
    'con' => $con,
    'sub' => $sub,
    'cha' => $cha,
    'del' => $del,
    'name' => $_SESSION['name']
);
$params='';

//投稿機能
if(!empty($_POST['sub']) && $con !== '') {
            //投稿内容をデータベースに書き入れる
            $id = $_SESSION['id'];
            $ins = $db->prepare("INSERT INTO post(contents,user_id)VALUES(:con,:user_id)");//データベースにデータを入れる
            $ins->bindValue(':con', $con);
            $ins->bindValue(':user_id',$_SESSION['id'] );
            $ins->execute();

            //投稿成功したかどうかのチェックと表示
            $s_id = intval($_SESSION['id']);
            $sel=$db->prepare("SELECT id FROM post WHERE user_id=$s_id AND contents=$con");
            $sel->execute();
            $sel_result = $sel->fetch();
            $db_id = $sel_result['id'];

            if($db_id !==''){
            $main_m1= 1;
            $params = array('main_m1' => $main_m1);
            }else{
            $main_m2= 1;
            $params = array('main_m2' => $main_m2);
            }
}

//投稿変更機能
if(!empty($_POST['cha']) && $id !=='' && $con !== '') {
    //半角英数字であるかどうかのチェック
    if (preg_match("/^[a-zA-Z0-9]+$/", $id)) {
        $sel = $db->prepare("SELECT user_id FROM post WHERE id = $id");
        $sel->execute();
        $sel_result = $sel->fetch();
        $db_user_id = $sel_result['user_id'];

        //入力した投稿IDが対応する投稿は本人の投稿であるかどうかをチェック
        if ($_SESSION['id'] === $db_user_id) {
            //入力した内容をデータベース内で更新する
            $cha = $db->query("UPDATE post SET contents=$con WHERE id=$id");
            $cha->execute();
            $cha_result = $cha->fetch();
            $db_con = $cha_result['contents'];

            //変更成功かどうかのチェックと表示
            if ($db_con !== '') {
                $main_m3 = 1;
                $params = array('main_m3' => $main_m3);
            } else {
                $main_m4 = 1;
                $params = array('main_m4' => $main_m4);
            }

        } elseif ($_SESSION["id"] !== $db_user_id) {
            $main_m5 = 1;
            $params = array('main_m5' => $main_m5);
        }
    } else {
        $num_m = 1;
        $params = array('num_m' => $num_m);
    }
}

//投稿削除機能
if(!empty($_POST['del']) && $id !== '') {
    //半角英数字であるかどうかのチェック
    if (preg_match("/^[a-zA-Z0-9]+$/", $id)) {
        $sel = $db->prepare("SELECT user_id FROM post WHERE id = $id");
        $sel->execute();
        $sel_result = $sel->fetch();
        $db_user_id = $sel_result['user_id'];

        //入力した投稿IDが対応する投稿は本人の投稿であるかどうかをチェック
        if ($_SESSION['id'] === $db_user_id) {
            $del = $db->prepare("DELETE FROM post WHERE id = ?");
            $del->execute(array($id));

            //削除成功かどうかのチェックと表示
            $sel = $db->prepare("SELECT id FROM post WHERE id=$id");
            $sel->execute();
            $sel_result = $sel->fetch();
            $db_id = $sel_result['id'];

            if ($db_id === NULL) {
                $main_m6 = 1;
                $params = array('main_m6' => $main_m6);
            } else {
                $main_m7 = 1;
                $params = array('main_m7' => $main_m7);
            }

        } elseif ($_SESSION['id'] !== $db_user_id) {
            $main_m5 = 1;
            $params = array('main_m8' => $main_m5);
        }
    }else {
            $num_m = 1;
            $params = array('num_m' => $num_m);
        }
    }

//投稿内容の表示
try{
    $stt = $db->prepare('select post.id, member.name, post.contents from post, member where post.user_id = member.id order by post.id desc');
    $stt->execute();
    $item = $stt->fetchAll(PDO::FETCH_ASSOC);
    $db = NULL;
    $smarty->assign('item', $item);
}catch (PDOException $e) {
    die("エラーメッセージ: {$e->getMessage()}");
}


$smarty->assign('pa', $pa);
$smarty->assign('params', $params);
$smarty->display('hw3_main.tpl');

//ログアウトボタンを押したら、ログアウト画面に移行
if(isset($_POST["logout"])){
    header("Location:hw3_logout.php");
}else{
    //何もしない
}

?>