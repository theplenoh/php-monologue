<?php
/*** default ***/
// Encoding
header("Content-Type: text/html; charset=utf-8");

// Display errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

/*** lib ***/
function sanitize($text)
{
    return htmlentities(addslashes($text));
}

function filter($text)
{
    return nl2br($text);
}

function get_day($date, $locale)
{
    $days_en = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
    $days_ko = ['일', '월', '화', '수', '목', '금', '토'];

    if($locale == "en")
    {
        return $days_en[date('w', strtotime($date))];
    }
    elseif($locale == "ko")
    {
        return $days_ko[date('w', strtotime($date))];
    }
}

/*** database ***/
require_once "dbinfo.php";

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_query($conn, "SET NAMES utf8");

$result = mysqli_query($conn, "SELECT screenname FROM monolog_auth");
$screenname = mysqli_fetch_array($result, MYSQLI_ASSOC)['screenname'];
?>
