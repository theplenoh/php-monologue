<?php
require_once "lib.php";
require_once "dbinfo.php";

$screenname = "Plenoh";

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_query($conn, "SET NAMES utf8");

$result = mysqli_query($conn, "SELECT COUNT(*) FROM monolog_entries");
$total = mysqli_fetch_array($result)[0];
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
    <nav class="navbar bg-dark navbar-dark">
        <a class="navbar-brand"><?php echo "{$screenname}&rsquo;s Monologue"; ?></a>
        <ul class="navbar-nav float-right">
            <li class="nav-item"><a class="nav-link" href="javascript:;">Login</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="row">
        <div class="col-xs-12 w-100 p-3">
<?php
if($total == 0)
{
?>
            <section class="card my-3">
                <div class="card-body">등록된 포스팅이 없습니다.</div>
            </section>
<?php
}
else
{
    $query = "SELECT * FROM monolog_entries ORDER BY id DESC";
    $result = mysqli_query($conn, $query);

    while($entry = mysqli_fetch_array($result))
    {
        $content = filter($entry['content']);
        $wdate = explode(" ", $entry['wdate']);
        $customdate = $wdate[0].' '.get_day($wdate[0], "en").' '.$wdate[1];

?>
            <section class="card mt-3 mb-3">
                <div class="card-body"><?php echo $content; ?></div>
                <div class="card-footer small"><?php echo $customdate; ?></div>
            </section>
<?php
    }
}
?>
            <footer class="mt-3 mb-3">
                <p>
                    <?php echo $screenname; ?>의 독백로그(모놀로그)입니다. 자신의 생각을 그때그때 기록하는 곳입니다.
                </p>
            </footer>
        </div>
    </div>
</div>
<script crossorigin="anonymous" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script crossorigin="anonymous" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
