<?php

    session_start();

    require_once('Models/Todo.php');

    // URLのキー(ここでいうと、id=値の id) URL?〇〇=XX $_GET[〇〇]->XXが取れる
    $id = $_GET["id"];

    $loginUser = $_SESSION['user'];
    $loginUserId = $loginUser['id'];

    // echo $id;

    // 設計図から実態を作成(インスタンス化)
    $edit = new Todo();

    // getメソッドを実行
    $selectEdits = $edit->get($id, $loginUserId);
    // var_dump($selectEdits);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO APP</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="px-5 bg-primary">
        <nav class="navbar navbar-dark">
            <a href="index.php" class="navbar-brand">TODO APP</a>
            <div class="justify-content-end">
                <span class="text-light">
                    Yuto Hisamatsu
                </span>
            </div>
        </nav>
    </header>
    <main class="container py-5">
        <section>
            <form class="form-row" action="update.php" method="POST">
                <div class="col-12 col-md-9 py-2">
                    <input type="text" name="task" class="form-control" placeholder="ADD TODO" 
                    value="<?php foreach ($selectEdits as $edit) : ?><?php echo $edit["name"]; ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $edit["id"]; ?>"><?php endforeach; ?>
                <div class="py-2 col-md-3 col-12">
                    <button type="submit" class="col-12 btn btn-primary btn-block">UPDATE</button>
                </div>
            </form>
        </section>
    </main>
    
    <!-- <script src="assets/js/app.js"></script> -->
</body>
</html>

<?php
/*

*もし ->fetch(); で一件ずつ取得してたら、
HTMLでforeachで回さず、
    <?php echo edit['name']; ?>のように簡単に取ることができる


*/
?>