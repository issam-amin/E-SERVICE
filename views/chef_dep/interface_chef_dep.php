<?php
include '../../securite.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Chef Depo</title>
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
            margin-left: 7rem;
            margin-right: 3rem;
        }
    </style>
</head>
<body>
    
    <header class="header">
    <?php require_once '../navigations/navigation_chef.php';?>
    </header>
    <main class="main">
        <?php require_once './index_chef.php';?>
    </main>




    
</body>
</html>