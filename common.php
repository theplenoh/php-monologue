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
?>
