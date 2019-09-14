<?php
// rootから見ているから 自分の現在のフォルダから見ていない
require_once('config/dbconnect.php');

class User
{
    private $table = 'users';

    private $db_manager;

    public function __construct()
    {
        // db_managerプロパティは、
        // DbManagerクラスのインスタンス
        $this->db_manager = new DbManager();
        // データベースに接続
        $this->db_manager->connect();
    }


    // ユーザーを新規作成
    public function create($username, $password)
    {
        // SQLを準備
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO ' . $this->table . ' (username, password, created_at) VALUES (?, ?, now())');
        // 実行
        $stmt->execute([$username, $password]);
    }

    // ユーザー名を元にユーザーを取得する
    public function findByUserName($username)
    {
        // SQL準備
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table . ' WHERE username = ?');
        // 実行
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        return $user;
    }

}