<?php
/* Smarty version 3.1.30, created on 2017-02-15 13:08:20
  from "C:\xampp\htdocs\var\www\smarty\templates\hw3_logout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a444b408e4e7_07008638',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e7be817532c969fbe34d4613e806e601931cbc7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\var\\www\\smarty\\templates\\hw3_logout.tpl',
      1 => 1487160352,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58a444b408e4e7_07008638 (Smarty_Internal_Template $_smarty_tpl) {
?>
<head>
    <title>ログアウト</title>
    <meta charset="utf-8">
</head>
<li><a href="hw3_login.php">ログイン画面に戻る</a></li>

<?php if (isset($_smarty_tpl->tpl_vars['logout_m']->value)) {?>
    <p>ログアウトしました</p>
<?php }
}
}
