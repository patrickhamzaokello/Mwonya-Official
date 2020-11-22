<?php

$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "mwonya";


// $hostname = "localhost";
// $username = "mwonyaAdmin";
// $password = "UpjYTaZ8Lg#g";
// $databasename = "mwonya";


try {
    $conn = new PDO("mysql:host=$hostname;dbname=$databasename", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Database connected successfully";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}