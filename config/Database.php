<?php
global $db;
$host       = 'localhost:3306';
$username = "root";
$database  = "projectweb";
$password = "";

try {

    $db = new PDO("mysql:host=$host;dbname=projectweb", $username, $password);
/*    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
    echo "Connected successfully<br>";
   }catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage()."<br>";
}



