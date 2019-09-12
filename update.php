<?php
require_once('Models/Todo.php');

// POST送信された情報を取得
$id = $_POST['id'];
$task = $_POST['task'];

// echo $id;
// echo $task;

// 設計図から実態を作成(インスタンス化)
$update = new Todo();

// updateメソッドを実行
$update->update($task, $id);

// 一覧画面に戻る
header('Location: index.php');
exit();