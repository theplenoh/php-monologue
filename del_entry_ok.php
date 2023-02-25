<?php
include "common.php";

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
$message = "로그인을 해주세요.";
echo<<<EOT
<script>
alert("{$message}");
location.href="login.php";
</script>
EOT;
exit;
}

$entryID = $_GET['entryID'];

mysqli_query($conn, "DELETE FROM {$db_prefix}entries WHERE entryID='{$entryID}'");
echo<<<EOT
<script>
alert("삭제되었습니다.");
location.href="index.php";
</script>
EOT;
?>
