<?php
require_once "common.php";

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
?>
<?php
$filename = $_POST['backup-file'];
$xml = simplexml_load_file("backups/{$filename}") or die("Error: cannot create object");
?>
<?php
$idx = count($xml->entry) - 1;
for($idx; $idx >= 0; $idx--)
{
    $content = htmlspecialchars_decode($xml->entry[$idx]->content);
    $wdate = ($xml->entry[$idx]->wdate);
    $visibility = ($xml->entry[$idx]->visibility)=="public"? "1":"0";
    $pinned = ($xml->entry[$idx]->pinned)=="pinned"? "1":"0";

    $query = "INSERT INTO {$db_prefix}entries (content, wdate, visibility, pinned) VALUES('{$content}', '{$wdate}', '{$visibility}', '{$pinned}')";

    mysqli_query($conn, $query);
}
mysqli_close($conn);
?>
<?php
header("Location: index.php");
?>
