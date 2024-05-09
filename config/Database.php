<?php
global $db;
$host       = 'localhost:3308';
$username = "root";
$database  = "project-web";
$password = "";

try {

    $db = new PDO("mysql:host=$host;dbname=project-web", $username, $password);
/*    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
    echo "Connected successfully<br>";
   }catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage()."<br>";
}



