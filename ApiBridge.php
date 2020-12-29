<?php
include_once("dbconfig.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appname = mysqli_real_escape_string($db, $_POST['appname']);
    date_default_timezone_set("Asia/Kolkata");
    $datetime = date("Y-m-d H:i:s");
    $sql = "update apps set triggertime = '$datetime',exitcode = '0',runs = runs + 1 where appname = '$appname'";
    $result = mysqli_query($db, $sql);
}
