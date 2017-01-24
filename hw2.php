<html>
    <head>
        <title>掲示板</title>
    </head>

    <body>
    <section>
        <h2>掲示板</h2>
        <form method="POST" action="hw2.php">
            ID：<br>
            <input type="text" name="id" value=""><br>
            ユーザー名：<br>
            <input type="text" name="name" value=""><br><br>
            本文：<br>
            <textarea name="con" cols="50" rows="3" maxlength="150" wrap="hard" placeholder="150字以内に入力してください。"></textarea><br>
            <input type="submit" name="sub" value="投稿">
        </form>

        <?php
        require_once 'hw2_dbm.php';
        $id = isset($_POST['id'])? htmlspecialchars($_POST['id']) : null;;
        $name = isset($_POST['name'])? htmlspecialchars($_POST['name']) : null;;
        $con = isset($_POST['con'])? htmlspecialchars($_POST['con']) : null;;


        //ID,ユーザー名と投稿内容を入力したかどうかをチェックする
        if(!empty($_POST['sub'])) {
            if($id === "" && $name === "" && $con === "" && !empty($_POST['sub'])){
                print "ID、ユーザー名、投稿内容を入れてください。";
            }elseif ($id === "" && $name !== "" && $con !== "" && !empty($_POST['sub'])) {
                print  "IDを入れてください。";
            }elseif ($id === "" && $name == "" && $con !== "" && !empty($_POST['sub'])) {
                print  "IDとユーザー名を入れてください。";
            }elseif($id !== "" && $name == "" && $con !== "" && !empty($_POST['sub'])){
                print  "ユーザー名を入れてください。";
            }elseif ($id == "" && $name !== "" && $con == "" && !empty($_POST['sub'])){
                print "IDと投稿内容を入れてください。";
            }elseif($id !== "" && $name == "" && $con == "" && !empty($_POST['sub'])){
                print "ユーザー名と投稿内容を入れてください。";
            }elseif($id !== "" && $name !== "" && $con == "" && !empty($_POST['sub'])){
                print "投稿内容を入れてください。";
            }

            //ID,ユーザー名と投稿内容を全部入力したら、データベースに接続し、入力したデータをデータベースに入れる
            if ($id !== "" && $name !== "" && $con !== "" && !empty($_POST['sub'])) {
                try {
                    $db = getDb();
                    $s = $db->prepare('INSERT INTO post(id,name,contents)VALUES(:id, :name, :con)');//データベースにデータを入れる
                    $s->bindValue(':id', $_POST['id']);
                    $s->bindValue(':name', $_POST['name']);
                    $s->bindValue(':con', $_POST['con']);
                    $s->execute();
                    $db = NULL;
                    header('Location: http://localhost/hw2.php'); //リダイレクト
                    exit;
                } catch (PDOException $e) {
                    die("エラーメッセージ:{$e->getMessage()}");
                }
            }
        }
        ?>
    </section>

    <section>
        <h2>投稿内容</h2>
        <?php
        require_once 'Encode.php';
        try {
            $db = getDb();
            $s = $db->prepare('SELECT * FROM post ORDER BY id DESC ');
            $s->execute();
            while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo 'ID:'; e($row['id']);?></td>
                    <td><?php echo 'ユーザー名:'; e($row['name']);?></td></br>
                    <td><?php e($row['contents']);?></td>
                </tr>
                <hr>
                <?php
            }
            $db = NULL;
        }catch (PDOException $e) {
            die("エラーメッセージ:{$e->getMessage()}");
        }
        ?>
    </section>

    </body>

</html>