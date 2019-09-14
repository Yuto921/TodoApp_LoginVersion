<?php

// セッション開始
session_start();

// セッションにあるログイン情報を破棄
session_destroy();

header('Location: login.html');

// unset($_SESSION['user']); // セッションの中の'user'という引き出しの値を消します