    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="index.php"><?php echo "{$screenname}&rsquo;s Thoughts"; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
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
                <li class="nav-item"><a class="nav-link" href="migration.php">Migration</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
<?php
}
?>
            </ul>
        </div>
    </nav>
