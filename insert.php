<?php
require_once "common.php";

if(!isset($_POST['content']))
    die("받아 온 포스팅 내용이 없습니다.");

$content = sanitize($_POST['content']);
$wdate = date("Y-m-d H:i", time());
$visibility = isset($_POST['visibility'])? (int)0:(int)1;

$query = "INSERT INTO {$db_prefix}entries (content, wdate, visibility) VALUES('{$content}', '{$wdate}', $visibility)";

mysqli_query($conn, $query);
mysqli_close($conn);

header("Location: index.php");
?>
