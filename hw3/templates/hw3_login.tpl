{*ログインと登録のテンプレート*}
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

    {*ログインボタンを押した際の入力チェック*}
    {if !empty($pa.log) && $pa.name === '' && $pa.password === ''}
        <p>ユーザー名とパスワードを入力してください。</p>
    {elseif !empty($pa.log) && $pa.name ==='' && $pa.password !== ''}
        <p>ユーザー名を入力してください。</p>
    {elseif !empty($pa.log) && $pa.name !=='' && $pa.password === ''}
        <p>パスワードを入力してください。</p>
    {/if}

    {*登録ボタンを押した際の入力チェック*}
    {if !empty($pa.reg) && $pa.name === '' && $pa.password === ''}
        <p>ユーザー名とパスワードを入力してください。</p>
    {elseif !empty($pa.reg) && $pa.name ==='' && $pa.password !== ''}
        <p>ユーザー名を入力してください。</p>
    {elseif !empty($pa.reg) && $pa.name !=='' && $pa.password === ''}
        <p>パスワードを入力してください。</p>
    {/if}

　　{*認証失敗の時のエラー表示*}
    {if isset($params.err1)}
        <p>ユーザー名とパスワードが間違っています。</p>
    {/if}

{*入力したユーザー名がすでに登録された時のエラー表示*}
    {if isset($params.err2)}
          <p>このユーザー名はすでに登録されています。ほかのユーザー名にしてください。</p>
    {/if}

{*入力したユーザー名がすでに登録された時のエラー表示*}
{if isset($params.m1)}
    <p>登録しました。もう一度ログインしてください。</p>
{/if}

{if isset($params.m2)}
    <p>登録失敗しました。</p>
{/if}


{*半角英数字であるかどうかのチェック*}
{if isset($params.num_m)}
    <p>半角英数を入力してください</p>
{/if}