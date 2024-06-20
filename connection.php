<?php
require_once('config.php');

// PDOクラスのインスタンス化
function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
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
    $sql = 'INSERT INTO todos (content) VALUES ( :todoText )';
    $stmt = $dbh->prepare($sql); //追記
    $stmt->bindValue(':todoText', $todoText, PDO::PARAM_STR); //追記
    $stmt->execute();
}

// データの取得処理
function getAllRecords()
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
    return $dbh->query($sql)->fetchAll();
}




// 
// 
// 口頭レビュー２の追記
// 更新処理
function updateTodoData($post)
{
    $dbh = connectPdo();
    $sql = 'UPDATE todos SET content = :todoText WHERE id = :id';
    $stmt = $dbh->prepare($sql); //編集
    $stmt->bindValue(':todoText', $post['content'], PDO::PARAM_STR); //編集
    $stmt->bindValue(':id', (int) $post['id'], PDO::PARAM_INT); //編集
    $stmt->execute(); //編集
}

function getTodoTextById($id)
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = :id';
    $stmt = $dbh -> prepare($sql);
    $stmt ->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $stmt ->execute();
    $data = $stmt ->fetch();
    return $data['content'];
}

// 論理削除のDB処理
function deleteTodoData($id)
{
    $dbh = connectPdo();
    $now = date('Y-m-d H:i:s');
    $sql = 'UPDATE todos SET deleted_at = :now WHERE id = :id';
    $stmt = $dbh -> prepare($sql);
    $stmt ->bindValue(':now', $now, PDO::PARAM_STR);
    $stmt ->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $stmt ->execute();
}