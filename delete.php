<?php

session_start();

require_once('Models/Todo.php');

// 削除ボタンがクリックされたTodoのIDを取得
$id = $_GET['id'];

$loginUser = $_SESSION['user'];
$loginUserId = $loginUser['id'];


// Todoクラスをインスタンス化
$delete = new Todo();

// 削除の実行
$delete->delete($id, $loginUserId);




// 一覧画面に戻る　(ajax処理の場合は、いらない)
header('Location: index.php');
exit();
