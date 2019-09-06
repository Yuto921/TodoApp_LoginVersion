<?php

// Todo.phpを読み込む
require_once('Models/Todo.php');

// ユーザーが入力したタスクを変数に格納
$task = $_POST['task'];

// Todoクラスのインスタンスを作成し、変数todoにいれる
$todo = new Todo();

// Todoクラスのcreateメソッドを実行
$todo->create($task);

// echo $todo->table;
// echo '<br>';
// var_dump($todo->db_manager);


// 一覧画面に戻る // 二重投稿できなくしている(理由: リクエストスコープの作動範囲を超えるから。index->create->index)
header('location: index.php');
exit();


