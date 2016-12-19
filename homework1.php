<!--課題1電卓-->

<html>
    <head>
        <title>電卓</title>
    </head>
    <body>
    <form method="POST" action="homework1.php">
    数字を入れて、演算符号（＋、－、×、÷）を選んで、「計算」というボタンを押してください。</br></br>
    <input type="text" name="L" size="15">
        <select name="S" size=1>
            <option value="">選択してください</option>
            <option value="+">＋</option>
            <option value="-">－</option>
            <option value="*">×</option>
            <option value="/">÷</option>
        </select>
    <input type="text" name="R" size="15">=
    <input type="submit"  value="計算"/>
    </form>

    <?php
    $L = isset($_POST['L'])? htmlspecialchars($_POST['L']) : null;//postで受けたものを新たな変数に代入する
    $R = isset($_POST['R'])? htmlspecialchars($_POST['R']) : null;
    $S = isset($_POST['S'])? htmlspecialchars($_POST['S']) : null;
    $answer='';

    if ($L!==''and $R!=='') { //数字を入れているかどうかを確認する
        if ($S !== '') {//演算符号を選んでいるかどうかを確認する
            switch ($S ) {//計算
                case '+':
                    $answer = $L + $R;
                    break;

                case'-':
                    $answer = $L - $R;
                    break;

                case'*':
                    $answer = $L * $R;
                    break;

                case'/';
                    if ($R === '0') {//÷のとき、右の空欄に０を入れているかどうかをチェックする
                        echo '右の空欄に0を入れないでください。0で割ることができません。原因についてはgoogle先生かyahoo先生かに聞いてください。';
                    } else {
                        $answer = $L / $R;
                    }
                    break;
            }
            echo $answer;
        } else {
            $answer = '';
            echo '演算符号を選んでください';}
    } else {
        echo '数字を入れてください';
    }
    ?>


    </body>
</html>