<?php

ob_start(); // turn on output buffering
session_start(); // starts session

date_default_timezone_set("Asia/Kolkata");

$servername = "localhost";
$username = "root";
$password = "";
$database = "premier";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    exit("Connection failed: ".$e->getMessage());
}

?>