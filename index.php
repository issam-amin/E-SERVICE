<?php
include('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>login page</title>
</head>
<body>
    <div class="container">
        <div  class="login">
                <form action="login.php" method="post">
                    <h2>Login</h2>
                    <div class="input-group">
                        <label for="username">Username :</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password :</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn">Login</button>
                </form> 
        </div>
       <img src="" alt="">
    </div>
</body>
</html>