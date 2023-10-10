<?php

function validate($x, $y, $r): bool {
    if (!is_numeric($x) || !is_numeric($y) || !is_numeric($r)) {
        return false;
    } else {
        $x_num = intval($x);
        $y_num = floatval($y);
        $r_num = floatval($r);

        if (!($x_num >= -5 && $x_num <= 3 && $y_num > -3 && $y_num < 3 && in_array($r_num, array(1, 1.5, 2, 2.5, 3)))) {
            return false;
        }
    }
    return true;
}
function checkHit ($x, $y, $r): bool {
    $rectangle = false;
    $triangle = false;
    $circle = false;

    if (($x >= -($r / 2)) && ($x <= 0) && ($y >= 0) && ($y <= $r)) {
        $rectangle = true;
    }
    else if (($y <= -0.5*$x + $r/2) && ($y >= 0) && ($y <= $r/2) && ($x >= 0) && ($x <= $r)) {
        $triangle = true;
    }
    else if ((pow($x,2) + pow($y, 2) <= pow($r/2,2)) && ($x >= 0) && ($x <= $r/2) && ($y >= -$r/2) && ($y <= 0)) {
        $circle = true;
    }
    return ($rectangle || $triangle) || $circle;
}

session_start();

if(!isset($_SESSION["denis"])){
    $_SESSION["denis"] = array();
}

if (isset($_GET['x']) && isset($_GET['y']) && isset($_GET['r'])) {
    if (validate($_GET["x"], $_GET["y"], $_GET["r"])) {
        $start = microtime(true);
        $x = intval($_GET["x"]);
        $y = floatval($_GET["y"]);
        $r = floatval($_GET["r"]);
        $checkedHit = checkHit($x, $y ,$r);

        date_default_timezone_set('Etc/GMT' . $_GET['timezone'] / 60);
        $currentTime = date("Y, j F, H:i:s T");
        $time = number_format(microtime(true) - $start, 10, ".", "") * 1000000;

        $result = array($x, $y, $r, $currentTime, $time, $checkedHit);
        array_push($_SESSION["denis"], $result);

    } else {
        http_response_code(400);
        return;
    }
}

include "add_in_table.php";
