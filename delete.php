<?php

require_once('Models/Todo.php');

// 削除ボタンがクリックされたTodoのIDを取得
$id = $_GET['id'];

// Todoクラスをインスタンス化
$delete = new Todo();

// 削除の実行
$delete->delete($id);

// 一覧画面に戻る
header('Location: index.php');
exit();
