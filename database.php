<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "project-web";
$conn=null;

try {
    $conn =  mysqli_connect($host, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    echo "Connection failed:" . $e->getMessage(). '<br>';
}


if ($conn) {
        echo '<strong>DATABASE Connected</strong>.<br>';
} else {
    echo 'connection failed.<br>';
}