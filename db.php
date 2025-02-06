<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test2";

$db = mysqli_connect($servername, $username, $password, $database);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

function query($sql)
{
    global $db;
    return $db->query($sql);
}
?>