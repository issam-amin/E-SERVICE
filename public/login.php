<?php
session_start();
// if (isset($_POST['connect'])) {
//     if (!(isset($_POST['email']) && isset($_POST['password']))) {
        
//             echo "LOGIN ou mot de passe incorrect";
//         }
   
// } 
?>
<!DOCTYPE html>
<html lang="fr"></html
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN </title>

    <!-- Estilos -->
    <style>
        <?php include '../css/style.css';?>
    </style>


    <!-- JS -->
    <script type="text/javascript" src="../../../js/validation.js"></script>


</head>

<body>
    <section class="ev__user--section-container">
        <div id="js-login-popup" class="ev__user--box-signin-container">

            <div class="ev__user--img-container">
                <img src="../img/ensah.png" alt="Utilisateur de connexion" style="height: 30rem ;width: 26rem">
            </div>

            <div class="ev__user--box-form-container">

                <form name="form1" action="../routing/routing.php" method="POST" >

                    <h1>WELCOME <br>TO<br> E-SERVICE</h1>

                    <div class="ev__user--items-container">
                        <label for="email_sigin"></label>

                        <input type="text" name="email" placeholder="Adresse e-mail" onfocus="this.select();" required>

                        <label for="password"></label>

                        <input type="password" name="password" placeholder="Mot de passe" onfocus="this.select();" required>
                    </div>

                    <div class="ev__user--button-container">
                        <input class="ev__user--button-success" type="submit" value="Se connecter" name="connect">
                        <input class="ev__user--button-info" type="reset" value="Effacer">
                    </div>

                    <div class="ev__user--options-container">
                        <div>
                            <p>Mot de passe oublié ?
                                <a href="#">
                                    Récupérer le mot de passe
                                </a>
                            </p>
                        </div>

                    </div>
                </form>
            </div>

            <div class="ev__user--img-mobile-container">
                <img src="../../../img/ensah.png" alt="Utilisateur de connexion"/>
            </div>

        </div>

    </section>
</body>
</html>

<!-- JS -->
<script type="text/javascript" src="../../../js/theme.js"></script>