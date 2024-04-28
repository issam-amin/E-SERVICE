<?php
$host = 'localhost';
$username = 'root';
$password = '1234567';
$dbname = 'e_service';
$mysqli="";

$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli) {
        echo '<strong>DATABASE Connected</strong>.<br>';
} else {
    echo 'connection failed';
}