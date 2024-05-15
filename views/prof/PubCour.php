<?php
include '../../securite.php'
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
            margin-left: 10rem;
            margin-right: 3rem;
        }
        i{
                    font-size: 25px;
     }
    </style>
</head>
<body>
    
    <header class="header">
    <?php require_once '../navigations/navigation_prof.php';?>
    </header>
    <main class="main">
      <strong>WELCOME TO YOUR DASHBOARD PROFESSEUR</strong>
    </main>




    
</body>
</html>