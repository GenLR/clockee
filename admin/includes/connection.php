<?php
$server = "cwsok8k4o4wwkkgso8sg8cwo";
$username = "mysql";
$password = "7TdlsNu627p2yfxGIdh7kkk9r793ofcXy2eBs4M29mpPxL4GGsSAqStmqERYmMYw";
$database = "default";

$connection = mysqli_connect($server, $username, $password, $database);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
