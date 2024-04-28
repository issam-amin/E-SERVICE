<?php
global $mysqli;
include('database.php');
    $sql="INSERT INTO etudiant (nom, prenom, email,password, id_filiere, id_promo)
    VALUES ('ADNABES', 'Salma', 'boukhari.salma@etu.uae.ac.ma', '9988', '4', '14'); ";
    mysqli_query($mysqli, $sql);

    mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html lang="fr"></html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN </title>

    <!-- Estilos -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- JS -->
    <script type="text/javascript" src="js/validation.js"></script>


</head>
<body>
<section class="ev__user--section-container">
    <div id="js-login-popup" class="ev__user--box-signin-container">
        <div class="ev__user--img-container">
            <img src="img/ensah.png" alt="Utilisateur de connexion"/>
        </div>
        <div class="ev__user--box-form-container">
            <form name="form1" action="login.html"
                  method="GET" onsubmit="return validarFormLogin(this);">
                <h1>WELCOME TO E-SERVICE</h1>
                <div class="ev__user--items-container">
                    <label for="email_sigin"></label>
                    <input type="text"
                           name="email"
                           placeholder="Adresse e-mail"
                           onfocus="this.select();"
                           required>

                    <label for="password"></label>
                    <input type="password"
                           name="password"
                           placeholder="Mot de passe"
                           onfocus="this.select();"
                           required>
                </div>
                <div class="ev__user--button-container">
                    <input class="ev__user--button-success" type="submit" value="Se connecter">
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
            <img src="img/ensah.png" alt="Utilisateur de connexion"/>
        </div>
    </div>
    <div id="js-register-popup" class="ev__user--box-signup-container">
        <div class="ev__user--img-signup-container">
            <img src="img/grey_register.jpg" alt="Utilisateur d'inscription"/>
        </div>
        <div class="ev__user-signup--box-form-container">
            <form name="form2" action="/index.html"
                  method="GET" onsubmit="return validarFormRegister(this);">
                <h1>S'inscrire</h1>
                <div class="ev__user-signup--items-container">
                    <label for="email">
                        Nom : <span class="itemR" onclick="infoNombre()">(*)</span>
                    </label>
                    <input
                            type="text"
                            name="usuario"
                            placeholder="Nom d'utilisateur"
                            onfocus="this.select();">

                    <label for="email_sigup">
                        Courrier : <span class="itemR" onclick="infoEmail()">(*)</span>
                    </label>
                    <input
                            type="text"
                            name="email"
                            placeholder="Adresse e-mail"
                            onfocus="this.select();">

                    <label for="password1">
                        Mot de passe : <span class="itemR" onclick="infoPassword()">(*)</span>
                    </label>
                    <input
                            type="password"
                            name="password"
                            placeholder="Mot de passe"
                            onfocus="this.select();">
                    <input
                            type="password"
                            name="password2"
                            placeholder="Confirmer le mot de passe"
                            onfocus="this.select();">
                </div>
                <div class="ev__user--button-container">
                    <input class="ev__user--button-info" type="reset" value="Effacer">
                </div>
                <div class="ev__user--options-container">
                    <div>
                        <p>
                            Vous avez déjà un compte ?
                            <a id="js-login-toggle" href="#">
                                Se connecter
                            </a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
        <div class="ev__user--img-signup-mobile-container">
            <img src="img/grey_register.jpg" alt="Utilisateur d'inscription"/>
        </div>
    </div>
</section>
</body>
</html>

<!-- JS -->
<script type="text/javascript" src="js/theme.js"></script>