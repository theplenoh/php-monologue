<?php
require_once "common.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>Login - <?php echo $screenname; ?>'s Monologue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" rel="stylesheet">
</head>

<body>
<header>
    <nav class="navbar bg-dark navbar-dark">
        <a class="navbar-brand" href="index.php"><?php echo "{$screenname}&rsquo;s Monologue"; ?></a>
        <ul class="navbar-nav float-right">
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="row">
        <div class="col-xs-12 w-100 p-3">
            <form action="login_ok.php" method="post">
                <div class="form-group">
                    <label for="username">아이디: </label>
                    <input type="text" id="username" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">패스워드: </label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">로그인</button>
                <!--input type="submit" value="로그인" class="btn btn-primary"-->
            </form>
        </div>
    </div>
</div>
<script crossorigin="anonymous" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script crossorigin="anonymous" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
