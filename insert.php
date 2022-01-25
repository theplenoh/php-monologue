<?php
require_once "common.php";

if(!isset($_POST['content']))
    die("받아 온 포스팅 내용이 없습니다.");

$content = sanitize($_POST['content']);
$wdate = date("Y-m-d H:i", time());

$query = "INSERT INTO monologue_entries (content, wdate, visibility) VALUES('{$content}', '{$wdate}', 1)";

mysqli_query($conn, $query);
mysqli_close($conn);

header("Location: index.php");
?>
