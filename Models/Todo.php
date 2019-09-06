<?php

require_once('config/dbconnect.php');

// Todoを操作するクラス(もの)
// - 追加する機能
// - 検索する機能
// - 編集する機能
// - 削除する機能

class Todo
{
    // プロパティ
    // - テーブル名
    // - DbManagerインスタンスを持つ変数

    // テーブル名
    private $table = 'tasks'; // todoから操作されるのはtasksだけだから、他の人が書き換えられないようにprivate

    // DbManagerクラスのインスタンス
    private $db_manager;

    // コンストラクタ：生まれた瞬間に実行(インスタンス化した時に呼び出される)
    public function __construct()
    {
        // db_managerプロパティは、
        // DbManagerクラスのインスタンス
        $this->db_manager = new DbManager();

        // データベースに接続
        $this->db_manager->connect();
    }

    public function create($post)
    {
        // INSERT文を準備
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO ' . $this->table . '(name) VALUES (?)');

        // 準備したものを実行する
        $stmt->execute([$post]);
        // $stmt->execute([$_POST['task']]); これでもOK
    }

    public function getAll()
    {
        // INSERT文を準備
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table);

        //　準備したものを実行する
        $stmt->execute();

        // 配列にする
        $results = $stmt->fetchAll();

        // 取得した結果を返す
        return $results;

    }
}