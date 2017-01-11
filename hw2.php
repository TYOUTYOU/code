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
        if(!empty($_POST['sub'])) {
            try {
                $db = getDb();
                $s = $db->prepare('INSERT INTO usercontents(id,name,contents)VALUES(:id, :name, :con)');//データベースにデータを入れる
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
         ?>
    </section>

    <section>
        <h2>投稿内容</h2>
        <?php
        require_once 'Encode.php';
       try {
           $db = getDb();
           $s = $db->prepare('SELECT * FROM usercontents ORDER BY id DESC ');
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