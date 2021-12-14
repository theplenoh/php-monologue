<?php
require_once "common.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
{
$message = "이미 로그인 된 상태입니다.";
echo<<<EOT
<script>
    alert("{$message}");
    location.href="index.php";
</script>
EOT;
exit;
}

if(empty($username) || empty($password))
{
$message = "아이디와 패스워드를 입력해주세요.";
echo<<<EOT
<script>
    alert("{$message}");
    location.href="login.php";
</script>
EOT;
}

$username = sanitize($username);
$password = sanitize($password);

$query = "SELECT username, password, screenname FROM monolog_auth WHERE username='{$username}' AND password='{$password}'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = mysqli_num_rows($result);

if($count == 1)
{
session_start();

$_SESSION['loggedin'] = true;
//$_SESSION['username'] = $username;
//$_SESSION['screenname'] = $screenname;

$message = "로그인에 성공하였습니다.";
echo<<<EOT
<script>
    //alert("{$message}");
    location.href="index.php";
</script>
EOT;
exit;
}
else
{
$message = "유효한 아이디나 패스워드가 아닙니다.";
echo<<<EOT
<script>
    alert("{$message}");
    location.href="login.php";
</script>
EOT;
exit;
}
?>
