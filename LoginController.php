<?php

require_once('Models/User.php');

$username = $_POST['username'];
$password = $_POST['password'];

// ユーザー名をもとに、データベースからユーザーを取得
$user = new User();
$loginUser = $user->findByUserName($username);


// 1. 入力されたユーザー名が存在しない
// -> ログイン画面に戻る
if (!$loginUser) {
    header('Location: login.html');
}

// echo $password; // 入力された文字 (パスワード)
// var_dump($loginUser); // データベースの文字 (暗号化のパスワード)

// 2. ユーザーはいたけど、パスワードが一致しない
// -> ログイン画面に戻る

// 画面から送信されたパスワードを暗号化する
// $hashPass = password_hash($password, PASSWORD_BCRYPT);
// if ($hashPass != $loginUser['password']) {

if (password_verify($password, $loginUser['password'])) {
    header('Location: login.html');
}


// 3. ユーザーはいて、パスワードが一致
// -> タスク一覧画面に遷移
if (password_verify($password, $loginUser['password'])) {
    // ログイン情報をセッションに保存
    session_start();
    $_SESSION['user'] = $loginUser;
    header('Location: index.php');
}