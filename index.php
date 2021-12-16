<?php
require_once "common.php";

session_start();

if(!isset($_GET['page_num']))
    $page_num = 1;
else
    $page_num = $_GET['page_num'];

$page_size = 10;
$page_scale = 5;

$result = mysqli_query($conn, "SELECT COUNT(*) FROM monolog_entries");
$total = mysqli_fetch_array($result)[0];

$page_max = ceil($total / $page_size);
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
        <a class="navbar-brand" href="index.php"><?php echo "{$screenname}&rsquo;s Monologue"; ?></a>
        <ul class="navbar-nav float-right">
<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
?>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
<?php
}
else
{
?>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
<?php
}
?>
        </ul>
    </nav>
</header>

<div class="container">
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
{
?>
    <div class="row">
        <div class="col-xs-12 m-3 mt-4 w-100">
            <form action="insert.php" method="post">
                <div class="form-group">
                    <textarea class="form-control p-3" name="content"></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Post!</button>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>
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
    $offset = ($page_num - 1) * $page_size;

    $block = floor(($page_num - 1) / $page_scale);

    $query = "SELECT * FROM monolog_entries ORDER BY id DESC LIMIT ${offset}, ${page_size}";
    $result = mysqli_query($conn, $query);
?>
<?php
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
<?php
if($total > 0)
{
?>
            <section>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
<?php $prev_block = ($block - 1) * $page_scale + 1; ?>
                        <a class="page-link" href="<?php if($block > 0) { echo "?page_num={$prev_block}"; } else { echo "javascript:;"; } ?>">&laquo;</a>
                    </li>
                    <li class="page-item">
<?php $prev_page = $page_num - 1; ?>
                        <a class="page-link" href="<?php if($page_max > 1 && $offset != 0 && $page_num && $page_num > 1) { echo "?page_num={$prev_page}"; } else { echo "javascript:;"; } ?>">&lsaquo;</a>
                    </li>
<?php
    $start_page = $block * $page_scale + 1;
    for($i=1; $i<=$page_scale && $start_page<=$page_max; $i++, $start_page++)
    {
?>
                    <li class="page-item<?php if($start_page == $page_num) { echo " active"; } ?>">
                        <a class="page-link" href="<?php if($start_page == $page_num) { echo "javascript:;"; } else { echo "?page_num={$start_page}"; }; ?>"><?php echo "{$start_page}"; ?></a>
                    </li>
<?php
    }
?>
                    <li class="page-item">
<?php $next_page = $page_num + 1; ?>
                        <a class="page-link" href="<?php if($page_max > $page_num) { echo "?page_num={$next_page}"; } else { echo "javascript:;"; } ?>">&rsaquo;</a>
                    </li>
                    <li class="page-item">
<?php $next_block = ($block + 1)*$page_scale + 1; ?>
                        <a class="page-link" href="<?php if($page_max > ($block + 1)*$page_scale) { echo "?page_num={$next_block}"; } else { echo "javascript:;"; } ?>">&raquo;</a>
                    </li>
                </ul>
            </section>
<?php
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
