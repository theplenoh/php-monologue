<?php
// Encoding
header("Content-Type: text/html; charset=utf-8");

// Display errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

function sanitize($text)
{
    return htmlentities(addslashes($text));
}
?>
