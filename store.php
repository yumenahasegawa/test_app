<?php
require_once('functions.php');
createData($_POST);
// savePostedData($_POST); // 追記
header('Location: ./index.php');