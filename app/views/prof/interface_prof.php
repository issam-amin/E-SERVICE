<?php
include '../../../securite.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Professeur</title>
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
            margin-left: 3rem;
            margin-right: 3rem;
        }
    </style>
</head>
<body>
    
    <header class="header">
    <?php require_once '../navigations/navigation_prof.php';?>
    </header>
    <main class="main">
        <?php require_once '../navigations/index.php';?>
    </main>




    
</body>
</html>