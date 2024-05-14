<?php

if (!isset($_SESSION['autoriser'])) {
    session_start();
    header('Location: ../../public/login.php');
    exit();
}
