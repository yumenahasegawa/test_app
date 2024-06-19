<?php
require_once('functions.php');
createData($_POST);
// var_dump($_POST);
// exit;
// savePostedData($_POST); // 口頭レビュー２の記述
header('Location: ./index.php');