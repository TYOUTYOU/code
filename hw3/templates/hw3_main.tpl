{*掲示板メイン画面*}
<head>
    <title>掲示板投稿ページ</title>
    <meta charset="utf-8">
</head>

    <hr>
<form method="POST" action="hw3_main.php">
        ようこそ{$params1['name']}さん<input type="submit" name="logout" value="ログアウト"><br><br>

        掲示板の利用方法：<br>
        投稿方法：本文の空欄に内容を入れて、投稿ボタンを押してください。<br>
        投稿した内容の変更方法：本文の空欄に新しい内容を入れて、投稿IDの空欄に変更したい投稿IDを入れて、内容変更ボタンを押してください。<br>
        投稿した内容の削除方法：投稿IDの空欄に変更削除したい投稿IDを入れて、削除ボタンを押してください。<br>
        ※注意事項：他人の投稿を変更、削除することができません。変更または削除したい投稿は自分の投稿に限る。<br>
        <hr>
        本文：<br>
        <textarea name="contents" cols="50" rows="3" maxlength="150" wrap="hard" placeholder="150字以内に入力してください。"></textarea><br>
        <input type="submit" name="submit" value="投稿"><br><br>
        <input type="submit" name="change" value="変更">
        <input type="submit" name="delete" value="削除">
        投稿ID<input type="text" name="id" value="">
        <br>
</form>

{*投稿する際の入力チェック*}
{if  !empty($params1.submit) && $params1.contents === '' }
    <p>本文を入力してください。</p>
{/if}
{*投稿成功と失敗の表示*}
{if isset($params2.main_message1)}
    <p>投稿しました。</p>
{/if}
{if isset($params2.main_message2)}
    <p>投稿失敗。</p>
{/if}



{*変更する際の入力チェック*}
{if !empty($params1.change) && $params1.id === '' && $params1.contents === ''}
    <p>投稿IDと新しい内容を入れてください。</p>
{elseif  !empty($params1.change) && $params1.id !== '' && $params1.contents ==='' }
    <p>新しい内容を入れてください。</p>
{elseif !empty($params1.change) && $params1.id === '' && $params1.contents !== ''}
    <p>投稿IDを入れてください。</p>"
{/if}
{*変更成功と失敗の表示*}
{if isset($params2.main_message3)}
    <p>変更しました。</p>
{/if}
{if isset($params2.main_message4)}
    <p>変更失敗。</p>
{/if}
{*変更する際入力した投稿IDが他人のIDである場合のエラー表示*}
{if isset($params2.main_message5)}
    <p>入力した投稿IDは他人の投稿です。注意事項をもう一度読んでください。</p>
{/if}



{*削除する際の入力チェック*}
{if !empty($params1.delete) && $params1.id === ''}
<p>投稿IDを入れてください。</p>
{/if}
{*削除成功と失敗の表示*}
{if isset($params2.main_message6)}
    <p>削除しました。</p>
{/if}
{if isset($params2.main_message7)}
    <p>削除失敗。</p>
{/if}
{*削除する際入力した投稿IDが他人のIDである場合のエラー表示*}
{if isset($params2.main_message8)}
    <p>入力した投稿IDは他人の投稿です。注意事項をもう一度読んでください。</p>
{/if}

{*半角英数字であるかどうかのチェック*}
{if isset($params2.num_message)}
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