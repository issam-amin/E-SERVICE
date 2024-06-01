<?php


// Informations de connexion à la base de données
$servername = "localhost"; // Nom du serveur
$username = "root"; // Nom d'utilisateur MySQL
$password = "1234567"; // Mot de passe MySQL
$dbname = "projectweb"; // Nom de la base de données

try {
    // Création de la connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Configuration des attributs PDO pour générer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pour utiliser le jeu de caractères UTF-8
    $pdo->exec("SET NAMES utf8");
    
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher le message d'erreur
    die("La connexion a échoué : " . $e->getMessage());
}

?>


