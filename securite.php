<?php
session_start();
if (!isset($_SESSION['autoriser'])) {
    header('Location: ../../public/login.php');
    exit();
}
