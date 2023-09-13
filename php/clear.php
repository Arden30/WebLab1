<?php
session_start();

if(isset($_SESSION["denis"])) {
    $_SESSION["denis"] = array();
}

include "add_in_table.php";
