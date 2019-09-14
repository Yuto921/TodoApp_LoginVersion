<?php
session_start();

// 文字化け対策
header("Content-type: application/json; charset=utf-8");

// Todo.phpを読み込む
require_once('Models/Todo.php');

// ユーザーが入力したタスクを変数に格納
$task = $_POST['task'];
$user = $_SESSION['user'];
$loginUserId = $user['id'];

// Todoクラスのインスタンスを作成し、変数todoにいれる
$todo = new Todo();

// Todoクラスのcreateメソッドを実行
$lastId = $todo->create($loginUserId,$task);

// createメソッドのreturnにIDが返ってくるから
// echo $lastId;

// 一覧画面に戻る // 二重投稿できなくしている(理由: リクエストスコープの作動範囲を超えるから。index->create->index)
header('location: index.php');
exit();


