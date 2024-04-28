<!DOCTYPE html>
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG OUT</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- JS -->
    <script type="text/javascript" src="js/validation.js"></script>

    <!-- Favicon -->
    <link href="img/EV_favicon.ico" rel="icon"/>  
</head>
<body>
    <section class="ev__user--section-container">
        <div id="js-login-popup" class="ev__user--box-signin-container">
            <div class="ev__user--img-container">
                <img src="img/log-img.jpg" alt="Login User"/>
            </div>
            <div class="ev__user--box-form-container">
                <form name="form1" action="login.html" 
                    method="GET" onsubmit="return validarFormLogin(this);">
                    <h1>WELCOME BACK</h1>
                    <div class="ev__user--items-container">
                        <label for="email_sigin"></label>
                        <input type="text"
                            name="email"
                            placeholder="Email Address"
                            onfocus="this.select();"
                            required>

                        <label for="password"></label>
                        <input type="password" 
                            name="password"
                            placeholder="Password"
                            onfocus="this.select();"
                            required>
                    </div>
                    <div class="ev__user--button-container">
                        <input class="ev__user--button-success" type="submit" value="Sign In">
                        <input class="ev__user--button-info" type="reset" value="Clear">
                    </div>
                    <div class="ev__user--options-container">
                        <div>
                            <p>Forgot password? 
                                <a href="#">
                                    Recover password
                                </a>
                            </p>
                        </div>
                     
                    </div>                    
                </form>
            </div>
            <div class="ev__user--img-mobile-container">
                <img src="img/log-img.jpg" alt="Login User"/>
            </div>
        </div>
        <div id="js-register-popup" class="ev__user--box-signup-container">
            <div class="ev__user--img-signup-container">
                <img src="img/grey_register.jpg" alt="Registration User"/>
            </div>
            <div class="ev__user-signup--box-form-container">
                <form name="form2" action="/index.html" 
                    method="GET" onsubmit="return validarFormRegister(this);">
                    <h1>Sign Up</h1>
                    <div class="ev__user-signup--items-container">
                        <label for="email">
                            Name: <span class="itemR" onclick="infoNombre()">(*)</span>
                        </label>
                        <input 
                            type="text"
                            name="usuario" 
                            placeholder="Username"
                            onfocus="this.select();">

                        <label for="email_sigup">
                            Email: <span class="itemR" onclick="infoEmail()">(*)</span>
                        </label>
                        <input 
                            type="text"
                            name="email"
                            placeholder="Email Address"
                            onfocus="this.select();">

                        <label for="password1">
                            Password: <span class="itemR" onclick="infoPassword()">(*)</span>
                        </label>
                        <input 
                            type="password"
                            name="password" 
                            placeholder="Password"
                            onfocus="this.select();">
                        <input 
                            type="password"
                            name="password2"
                            placeholder="Confirm Password"
                            onfocus="this.select();">
                    </div>
                    <div class="ev__user--button-container">
                        <input class="ev__user--button-info" type="reset" value="Clear">
                    </div>
                    <div class="ev__user--options-container">
                        <div>
                            <p>
                                Already have an account? 
                                <a id="js-login-toggle" href="#">
                                    Sign In
                                </a>
                            </p>
                        </div>
                    </div>                    
                </form>
            </div>
            <div class="ev__user--img-signup-mobile-container">
                <img src="img/grey_register.jpg" alt="Registration User"/>
            </div>
        </div>
    </section>
</body>
</html>

<!-- JS -->
<script type="text/javascript" src="js/theme.js"></script>