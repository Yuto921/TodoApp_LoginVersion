<?php

// 文字化け対策
header("Content-type: application/json; charset=utf-8");

// Todo.phpを読み込む
require_once('Models/Todo.php');

// ユーザーが入力したタスクを変数に格納
$task = $_POST['task'];

// Todoクラスのインスタンスを作成し、変数todoにいれる
$todo = new Todo();

// Todoクラスのcreateメソッドを実行
$lastId = $todo->create($task);

// createメソッドのreturnにIDが返ってくるから
// echo $lastId;

// echo $todo->table;
// echo '<br>';
// var_dump($todo->db_manager);


// 取得した最新のIDをもとに、タスクを取得
$newTask = $todo->get($lastId);

// ajaxからのレスポンスを返している
echo json_encode($newTask);
exit();



// 一覧画面に戻る // 二重投稿できなくしている(理由: リクエストスコープの作動範囲を超えるから。index->create->index)
// header('location: index.php');
// exit();


