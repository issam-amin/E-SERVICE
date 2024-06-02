<?php
session_start(); 

if (!isset($_SESSION['autoriser']) || $_SESSION['autoriser'] !== true) {
   
    header('Location: ../../public/login.php');
    exit();
}
?>
