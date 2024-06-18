<?php
require_once('connection.php');

function createData($post)
{
  createTodoData($post['content']);
}

// 取得したデータを画面に表示させる
function getTodoList()
{
    return getAllRecords();
}

// 
// 
// 口頭レビュー２の記述
// 編集画面の作成
// function getSelectedTodo($id)
// {
//     return getTodoTextById($id);
// }

// // savePostedData関数の定義
// function savePostedData($post)
// {
//     $path = getRefererPath();
//     switch ($path) {
//         case '/new.php':
//             createTodoData($post['content']);
//             break;
//         case '/edit.php':
//             updateTodoData($post);
//             break;
//         default:
//             break;
//     }
// }

// function getRefererPath()
// {
//     $urlArray = parse_url($_SERVER['HTTP_REFERER']);
//     return $urlArray['path'];
// }