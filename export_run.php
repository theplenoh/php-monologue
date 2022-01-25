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
</head>

<body>
<header>
<?php require_once "nav.php"; ?>
</header>

<div class="container">
    <div class="row">
        <div class="col-xs-12 w-100 p-3">
<?php
$query = "SELECT * FROM monolog_entries ORDER by id DESC";
$result = mysqli_query($conn, $query);
?>
            <h1>Export Result</h1>
<?php
$xml = "<monologue>\n";

while($record = mysqli_fetch_array($result, MYSQLI_NUM))
{
    $entry = array(
        'entryID' => $record[0], 
        'content' => $record[1], 
        'wdate' => $record[2], 
        'visibility' => "public"
    );

    $xml .= "<entry>\n";

    foreach ($entry as $attrib => $content)
    {
        $xml .= "  <{$attrib}>";
        $xml .= filter($content);
        $xml .= "</{$attrib}>\n";
    }

    $xml .= "</entry>\n";
}

$xml .= "</monologue>";
//echo(htmlentities($xml));
?>
            <p>
<?php
$filename = "backup-monologue.xml";
$homedir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos($_SERVER['DOCUMENT_ROOT'], '/'));
$filepath = $homedir.'/'.$filename;

$fp = fopen($filepath, "w");

if($fp == false)
{
    echo "Error in opening a new file";
    exit;
}
fwrite($fp, $xml);
fclose($fp);

echo "<code>{$filepath}</code> generated.";
?>
            </p>
        </div>
    </div>
</div>
<script crossorigin="anonymous" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script crossorigin="anonymous" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
