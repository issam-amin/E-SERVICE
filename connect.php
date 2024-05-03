<?php

session_start();
require_once 'database.php';


if(isset($_POST['connect'])){
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        global $db;
        $res = $db->prepare('SELECT * FROM etudiant where Email=? and Mdp=?');
        $params = array($email, $password);
        $res->execute($params);

        $row = $res->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            if ($row['Email'] == $email && $row['Mdp'] == $password) {
                /*  echo $row['email'];
                  echo $row['password'];*/
                $_SESSION['email'] = $row['Email'];
                $_SESSION['nom'] = $row['Nom'];
                $_SESSION['prenom'] = $row['Prenom'];
                header('Location: interface/interface_etu.php');
            } else {
                echo $row['Email'];
                echo $row['Mdp'];
                echo "Email or password is incorrect";
                //header('Location: login.php');
                exit();
            }
        }
    }
}
?>