<?php
/* Smarty version 3.1.30, created on 2017-02-15 12:36:36
  from "C:\xampp\htdocs\var\www\smarty\templates\hw3_login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a43d44da57e6_27976144',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6b0d0dc3f022fab761c6b757ae896c8af54006b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\var\\www\\smarty\\templates\\hw3_login.tpl',
      1 => 1487158594,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58a43d44da57e6_27976144 (Smarty_Internal_Template $_smarty_tpl) {
?>

<head>
    <title>掲示板ログイン</title>
    <meta charset="utf-8">
</head>

<form method="POST" action="hw3_login.php">
    掲示板ログイン<br><br>
    ユーザー名:<input type="text" name="name" value="" /><br>
    パスワード:<input type="text" name="password" value="" /><br>
    <input type="submit" name="log" value="ログイン" />
    <input type="submit" name="reg" value="登録" /><br>
</form>

    
    <?php if (!empty($_smarty_tpl->tpl_vars['params']->value['log']) && $_smarty_tpl->tpl_vars['params']->value['name'] === '' && $_smarty_tpl->tpl_vars['params']->value['password'] === '') {?>
        <p>ユーザー名とパスワードを入力してください。</p>
    <?php } elseif (!empty($_smarty_tpl->tpl_vars['params']->value['log']) && $_smarty_tpl->tpl_vars['params']->value['name'] === '' && $_smarty_tpl->tpl_vars['params']->value['password'] !== '') {?>
        <p>ユーザー名を入力してください。</p>
    <?php } elseif (!empty($_smarty_tpl->tpl_vars['params']->value['log']) && $_smarty_tpl->tpl_vars['params']->value['name'] !== '' && $_smarty_tpl->tpl_vars['params']->value['password'] === '') {?>
        <p>パスワードを入力してください。</p>
    <?php }?>

    
    <?php if (!empty($_smarty_tpl->tpl_vars['params']->value['reg']) && $_smarty_tpl->tpl_vars['params']->value['name'] === '' && $_smarty_tpl->tpl_vars['params']->value['password'] === '') {?>
        <p>ユーザー名とパスワードを入力してください。</p>
    <?php } elseif (!empty($_smarty_tpl->tpl_vars['params']->value['reg']) && $_smarty_tpl->tpl_vars['params']->value['name'] === '' && $_smarty_tpl->tpl_vars['params']->value['password'] !== '') {?>
        <p>ユーザー名を入力してください。</p>
    <?php } elseif (!empty($_smarty_tpl->tpl_vars['params']->value['reg']) && $_smarty_tpl->tpl_vars['params']->value['name'] !== '' && $_smarty_tpl->tpl_vars['params']->value['password'] === '') {?>
        <p>パスワードを入力してください。</p>
    <?php }?>

　　
    <?php if (isset($_smarty_tpl->tpl_vars['params']->value['err1'])) {?>
        <p>ユーザー名とパスワードが間違っています。</p>
    <?php }?>


    <?php if (isset($_smarty_tpl->tpl_vars['params']->value['err2'])) {?>
          <p>このユーザー名はすでに登録されています。ほかのユーザー名にしてください。</p>
    <?php }?>


<?php if (isset($_smarty_tpl->tpl_vars['params']->value['m1'])) {?>
    <p>登録しました。もう一度ログインしてください。</p>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['params']->value['m2'])) {?>
    <p>登録失敗しました。</p>
<?php }?>



<?php if (isset($_smarty_tpl->tpl_vars['params']->value['num_m'])) {?>
    <p>半角英数を入力してください</p>
<?php }
}
}
