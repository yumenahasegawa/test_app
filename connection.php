<?php
require_once('config.php');

// PDOクラスのインスタンス化
function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
        // throw new PDOException('momo');
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

// 例外処理
function divideByRandomInt($paramInt)
{
    try {
        $int = rand(0, 2);
        if ($int === 0) {
            throw new Exception('0が出てしまいました…もう一度お試しください。');
        }
        return $paramInt / $int;
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

// echo divideByRandomInt(10);

// 新規作成処理
function createTodoData($todoText)
{
    $dbh = connectPdo();
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    $dbh->query($sql);
}

// データの取得処理
function getAllRecords()
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
    // echo '<pre>';
    // var_dump
    // var_dump($dbh->query($sql)->fetchAll());
    // echo '</pre>';
    return $dbh->query($sql)->fetchAll();
}




// 
// 
//以下、口頭レビュー２の記述
// 更新処理
// function updateTodoData($post)
// {
//     $dbh = connectPdo();
//     $sql = 'UPDATE todos SET content = "' . $post['content'] . '" WHERE id = ' . $post['id'];
//     $dbh->query($sql);
// }

// function getTodoTextById($id)
// {
//     $dbh = connectPdo();
//     $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = $id';
//     $data = $dbh->query($sql)->fetch();
//     return $data['content'];
// }