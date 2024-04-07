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
    <!-- FLEX -->
    <div class="container">    
             <!-- login   -->
        <form action="" method="post" >
        <h2>LOGIN</h2>
        <div class="input_id">
            <input type="text" name="Email"  placeholder="E-mail" required>
                        <i class="fa-solid fa-user"></i>
        </div>
        <div class="input_id">
            <input type="password" name="name" id="Password" placeholder="Password"  required>
            <i class="fa-solid fa-lock"></i>
        </div>
    <!-- checkBox -->
    <div class="remenber">
        <label><input type="checkbox">Remenber me</label>
            <a href="">forget password</a>
    </div>
    
    <button type="button" class="btn"> login </button>
    
    <div class="notregister">
        <p>You Don't have an account ?<a href=""> Register</a></p>
        
    </div>
    </form>
    
        

</body>
</html>