{*掲示板メイン画面*}
<head>
    <title>掲示板投稿ページ</title>
    <meta charset="utf-8">
</head>

    <hr>
<form method="POST" action="hw3_main.php">
        ようこそ<?php echo htmlspecialchars($_SESSION['NA'],ENT_QUOTES); ?>さん<input type="submit" name="logout" value="ログアウト"><br><br>

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

{*投稿する際の入力チェック*}
{if  !empty($params.sub) && $params.con === '' }
    <p>本文を入力してください。</p>
{/if}
{*投稿成功と失敗の表示*}
{if isset($params.main_m1)}
    <p>投稿しました。</p>
{/if}
{if isset($params.main_m2)}
    <p>投稿失敗。</p>
{/if}



{*変更する際の入力チェック*}
{if !empty($params.cha) && $params.id === '' && $params.con === ''}
    <p>投稿IDと新しい内容を入れてください。</p>
{elseif  !empty($params.cha) && $params.id !== '' && $params.con ==='' }
    <p>新しい内容を入れてください。</p>
{elseif !empty($params.cha) && $params.id === '' && $params.con !== ''}
    <p>投稿IDを入れてください。</p>"
{/if}
{*変更成功と失敗の表示*}
{if isset($params.main_m3)}
    <p>変更しました。</p>
{/if}
{if isset($params.main_m4)}
    <p>変更失敗。</p>
{/if}
{*変更する際入力した投稿IDが他人のIDである場合のエラー表示*}
{if isset($params.main_m5)}
    <p>入力した投稿IDは他人の投稿です。注意事項をもう一度読んでください。</p>
{/if}



{*削除する際の入力チェック*}
{if !empty($params.del) && $params.id === ''}
<p>投稿IDを入れてください。</p>
{/if}
{*削除成功と失敗の表示*}
{if isset($params.main_m6)}
    <p>削除しました。</p>
{/if}
{if isset($params.main_m7)}
    <p>削除失敗。</p>
{/if}
{*削除する際入力した投稿IDが他人のIDである場合のエラー表示*}
{if isset($params.main_m8)}
    <p>入力した投稿IDは他人の投稿です。注意事項をもう一度読んでください。</p>
{/if}

{*半角英数字であるかどうかのチェック*}
{if isset($params.num_m)}
    <p>投稿IDの空欄に半角英数を入力してください</p>
{/if}


<h2>投稿内容</h2>
<hr>
{*投稿内容の表示*}
{foreach $item as $itemdata}
    <p>投稿ID:{$itemdata.id}  ユーザー名:{$itemdata.name|escape}</p>
    <p>内容:{$itemdata.contents}</p>
    <hr>
{/foreach}