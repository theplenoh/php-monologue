<?php
include "common.php";

if(!isset($_POST['content']))
    die("받아 온 포스팅 내용이 없습니다.");

$content = sanitize($_POST['content']);

$query = "INSERT INTO monolog_entries (content, wdate) VALUES('{$content}', NOW())";

mysqli_query($conn, $query);
mysqli_close($conn);

header("Location: index.php");
?>
