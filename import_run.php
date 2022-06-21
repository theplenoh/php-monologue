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
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title><?php echo $screenname; ?>'s Monologue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>
<header>
<?php require_once "nav.php"; ?>
</header>

<div class="container">
    <div class="row">
        <div class="col-xs-12 w-100 p-3">
            <h1>Import Preview</h1>
            <form method="post" action="import_confirm.php">
                <p>
<?php
$filename = $_POST['backup-file'];
?>
<?php
$xml=simplexml_load_file("backups/{$filename}") or die("Error: cannot create object");
echo "Backup filename: backups/{$filename}";
?>
                </p>
                <pre class="result">
<?php
$idx = count($xml->entry) - 1;
for($idx; $idx >= 0; $idx--)
{
    $content = htmlentities($xml->entry[$idx]->content, ENT_QUOTES);
    $wdate = ($xml->entry[$idx]->wdate);
    $visibility = ($xml->entry[$idx]->visibility)=="public"? "1":"0";

    $query = "INSERT INTO monologue_entries (content, wdate, visibility) VALUES('{$content}', '{$wdate}', '{$visibility}')";

    echo "[$idx]".$query."\n";
    //mysqli_query($conn, $query);
}
mysqli_close($conn);
?>
                </pre>
                <p>
                    <input type="hidden" name="backup-file" value="<?=$filename?>">
                    <input type="submit" value="Confirm" class="btn btn-danger">
                </p>
            </form>
        </div>
    </div>
</div>
<script crossorigin="anonymous" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script crossorigin="anonymous" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
