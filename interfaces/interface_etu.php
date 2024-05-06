<?php
session_start();
if (!isset($_SESSION['autoriser'])){
    header('Location: ../interfaces/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Etudiant</title>
    <style>
        .container{
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
        }
        .header{
            flex: 1;
        }
        .main{
            margin-top: 7rem;
            margin-left: 8rem;
            margin-right: 3rem;
        }
    </style>
</head>
<body>
    
    <header class="header">
    <?php include '../navigations/navigation_etu.php';?>
    </header>
    <main class="main">
        <?php include '../navigations/index.php';?>
    </main>




    
</body>
</html>