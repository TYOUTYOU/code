<?php
/* Smarty version 3.1.30, created on 2017-02-21 10:09:16
  from "C:\xampp\htdocs\templates\hw3_logout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58ac03bc67c1f5_79514237',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bcf2838d2aa503edb7fe53327acb441607890454' => 
    array (
      0 => 'C:\\xampp\\htdocs\\templates\\hw3_logout.tpl',
      1 => 1487160352,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58ac03bc67c1f5_79514237 (Smarty_Internal_Template $_smarty_tpl) {
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
