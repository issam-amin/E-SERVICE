<?php
include 'database.php';

session_start();
@$email = $_POST['email'];
@$password = $_POST['password'];
@$valider=$_POST['connect'];
$message = "";
if(isset($_POST['connect'])){
/*    echo "connected successfully";*/
        global $db;
        $res = $db->prepare('SELECT * FROM etudiant where Email=? and Mdp=?');
        $params = array($email, $password);  /*je peux directement les inserer dans le execute*/
        $res->execute($params);
        $tab = $res->fetch(PDO::FETCH_ASSOC);

        if ($tab) {
            if ($tab['Email'] == $email && $tab['Mdp'] == $password) {
                $_SESSION['nom'] = $tab['Nom'];
                $_SESSION['prenom'] = $tab['Prenom'];
                $_SESSION['email'] = $tab['Email'];
                $_SESSION['autoriser']="oui";
                header('Location: ../../interfaces/interface_etu.php');
                exit();
            } else {
                $message="<strong>Email or password is incorrect</strong>";
                header("Location:../WEB_PROJECT/interfaces/login.php");


            }

        }
        else{
            echo "<strong>Email or password is incorrect</strong>";
            header("Location: ../WEB_PROJECT/interfaces/login.php");
        }


}
?>