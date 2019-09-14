<?php

require_once('Models/User.php');

// 送信されてきたユーザー名とパスワードを取得
$username = $_POST['username'];
$password = $_POST['password'];

// パスワードを暗号化 (PHPのもともと用意してある password_hash() )
$hashPass = password_hash($password, PASSWORD_BCRYPT);

$signup = new User();

// ユーザーの登録
$signup->create($username, $hashPass);

// 登録したユーザーを取得
$user = $signup->findByUserName($username);


// セッションにログイン情報を保存 (画面遷移したとしても残っているデータの領域 *消せという命令をするまで)

// セッションの開始
session_start();

// セッションにログイン情報の登録 (ユーザという引き出し名で..)
$_SESSION['user'] = $user;

// 一覧の画面に遷移
header('Location: index.php');

