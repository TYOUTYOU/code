<?php
/* Smarty version 3.1.30, created on 2017-02-15 13:23:42
  from "C:\xampp\htdocs\var\www\smarty\templates\hw3_main.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a4484ed46435_96664914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e3035e6ab7845b842d4a240d61a6b8a2aa3960b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\var\\www\\smarty\\templates\\hw3_main.tpl',
      1 => 1487161412,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58a4484ed46435_96664914 (Smarty_Internal_Template $_smarty_tpl) {
?>

<head>
    <title>掲示板投稿ページ</title>
    <meta charset="utf-8">
</head>

    <hr>
<form method="POST" action="hw3_main.php">
        ようこそ<?php echo '<?php ';?>echo htmlspecialchars($_SESSION['NA'],ENT_QUOTES); <?php echo '?>';?>さん<input type="submit" name="logout" value="ログアウト"><br><br>

        掲示板の利用方法：<br>
        投稿方法：本文の空欄に内容を入れて、投稿ボタンを押してください。<br>
        投稿した内容の変更方法：本文の空欄に新しい内容を入れて、投稿IDの空欄に変更したい投稿IDを入れて、内容変更ボタンを押してください。<br>
        投稿した内容の削除方法：投稿IDの空欄に変更削除したい投稿IDを入れて、削除ボタンを押してください。<br>
        ※注意事項：他人の投稿を変更、削除することができません。変更または削除したい投稿は自分の投稿に限る。<br>
        <hr>
        本文：<br>
        <textarea name="con" cols="50" rows="3" maxlength="150" wrap="hard" placeholder="150字以内に入力してください。"></textarea><br>
        <input type="submit" name="sub" value="投稿"><br><br>
        <input type="submit" name="cha" value="変更">
        <input type="submit" name="del" value="削除">
        投稿ID<input type="text" name="id" value="">
        <br>
</form>


<?php if (!empty($_smarty_tpl->tpl_vars['params']->value['sub']) && $_smarty_tpl->tpl_vars['params']->value['con'] === '') {?>
    <p>本文を入力してください。</p>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['params']->value['main_m1'])) {?>
    <p>投稿しました。</p>
<?php }
if (isset($_smarty_tpl->tpl_vars['params']->value['main_m2'])) {?>
    <p>投稿失敗。</p>
<?php }?>




<?php if (!empty($_smarty_tpl->tpl_vars['params']->value['cha']) && $_smarty_tpl->tpl_vars['params']->value['id'] === '' && $_smarty_tpl->tpl_vars['params']->value['con'] === '') {?>
    <p>投稿IDと新しい内容を入れてください。</p>
<?php } elseif (!empty($_smarty_tpl->tpl_vars['params']->value['cha']) && $_smarty_tpl->tpl_vars['params']->value['id'] !== '' && $_smarty_tpl->tpl_vars['params']->value['con'] === '') {?>
    <p>新しい内容を入れてください。</p>
<?php } elseif (!empty($_smarty_tpl->tpl_vars['params']->value['cha']) && $_smarty_tpl->tpl_vars['params']->value['id'] === '' && $_smarty_tpl->tpl_vars['params']->value['con'] !== '') {?>
    <p>投稿IDを入れてください。</p>"
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['params']->value['main_m3'])) {?>
    <p>変更しました。</p>
<?php }
if (isset($_smarty_tpl->tpl_vars['params']->value['main_m4'])) {?>
    <p>変更失敗。</p>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['params']->value['main_m5'])) {?>
    <p>入力した投稿IDは他人の投稿です。注意事項をもう一度読んでください。</p>
<?php }?>




<?php if (!empty($_smarty_tpl->tpl_vars['params']->value['del']) && $_smarty_tpl->tpl_vars['params']->value['id'] === '') {?>
<p>投稿IDを入れてください。</p>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['params']->value['main_m6'])) {?>
    <p>削除しました。</p>
<?php }
if (isset($_smarty_tpl->tpl_vars['params']->value['main_m7'])) {?>
    <p>削除失敗。</p>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['params']->value['main_m8'])) {?>
    <p>入力した投稿IDは他人の投稿です。注意事項をもう一度読んでください。</p>
<?php }?>


<?php if (isset($_smarty_tpl->tpl_vars['params']->value['num_m'])) {?>
    <p>投稿IDの空欄に半角英数を入力してください</p>
<?php }?>


<h2>投稿内容</h2>
<hr>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value, 'itemdata');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['itemdata']->value) {
?>
    <p>投稿ID:<?php echo $_smarty_tpl->tpl_vars['itemdata']->value['id'];?>
  ユーザー名:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['itemdata']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</p>
    <p>内容:<?php echo $_smarty_tpl->tpl_vars['itemdata']->value['contents'];?>
</p>
    <hr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}
}
