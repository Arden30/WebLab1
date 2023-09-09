<?php

function validate($x, $y, $r) {
    if (!is_numeric($x) || !is_numeric($y) || !is_numeric($r)) {
        return false;
    } else {
        $x_num = intval($x);
        $y_num = floatval($y);
        $r_num = floatval($r);

        if (!($x_num >= -5 && $x_num <= 3 && $y_num >= -3 && $y_num <= 3 && in_array($r_num, array(1, 1.5, 2, 2.5, 3)))) {
            return false;
        }
    }
    return true;
}
function checkHit ($x, $y, $r) {
    $rectangle = false;
    $triangle = false;
    $circle = false;

    if ($x >= -$r / 2 && $x <= 0 && $y >= 0 && $y <= $r) {
        $rectangle = true;
    }
    if ($y <= -0.5*$x + $r/2 && $y >= 0 && $y <= $r/2 && $x >= 0 && $x <= $r) {
        $triangle = true;
    }
    if (pow($x,2) + pow($y, 2) <= pow($r/2,2) && $x >= 0 && $x <= $r/2 && $y >= -$r/2 && $y <= 0) {
        $circle = true;
    }

    return $rectangle || $triangle || $circle;
}

if (isset($_GET['x']) && isset($_GET['y']) && isset($_GET['r'])) {
    if (validate($_GET["x"], $_GET["y"], $_GET["r"])) {
        $x = intval($_GET["x"]);
        $y = floatval($_GET["y"]);
        $r = intval($_GET["r"]);
        if (checkHit($x, $y ,$r)) $checkedHit = "TRUE";
        else $checkedHit = "FALSE";

        exit("
            <tr>
                <th>$x</th>
                <th>$y</th>
                <th>$r</th>
                <th>0</th>
                <th>0</th>
                <th>$checkedHit</th>
            </tr> 
            ");
    } else {
        exit("Server got incorrect data!");
    }
}

