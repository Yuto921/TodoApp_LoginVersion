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

    public function create($loginUserId, $task)
    {
        // INSERT文を準備
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO ' . $this->table . '(user_id ,name) VALUES (?, ?)');

        // 準備したものを実行する
        $stmt->execute([$loginUserId, $task]);
        // $stmt->execute([$_POST['task']]); これでもOK

        // 今作成したタスクのIDを返す (ajax)
        // PHPのPDOが用意してくれているメソッド
        return $this->db_manager->dbh->lastInsertId();
    }

    public function getAll($loginUserId)
    {
        // SELECT文を準備
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table . ' WHERE user_id = ?');

        //　準備したものを実行する
        $stmt->execute([$loginUserId]);

        // 配列にする
        $results = $stmt->fetchAll();

        // 取得した結果を返す
        return $results;
    }

    public function delete($id, $loginUserId)
    {
        // DELETE文を準備 (該当IDを削除するSQL文)
        $stmt = $this->db_manager->dbh->prepare('DELETE FROM ' . $this->table . ' WHERE id = ? && user_id = ?');

        // 準備したものを実行する
        $stmt->execute([$id, $loginUserId]);
    }

    // IDをもとにタスクを1行だけ取得するメソッド
    public function get($id, $loginUserId)
    {
        // SQL文を準備
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table . ' WHERE id = ? && user_id = ?');

        // 実行
        $stmt->execute([$id, $loginUserId]);

        // 一件だけ取るとき
        // $results = $stmt->fetch();

        $results = $stmt->fetchAll();

        // 取得したタスクを返す
        return $results;
    }

    public function update($name, $id, $loginUserId)
    {
        $stmt = $this->db_manager->dbh->prepare('UPDATE ' . $this->table . ' SET name = ? , updated_at = now() WHERE id = ? && user_id = ?');

        $stmt->execute([$name, $id, $loginUserId]);
    }
}