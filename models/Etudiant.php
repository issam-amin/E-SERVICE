<?php
require_once '../config/Database.php';
class Etudiant
{

    public function __construct()
    {
        
    }
    public function GetAll()
    {
        global $db;
        $res = $db->prepare("SELECT * FROM etudiant");
        $res->execute();
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function GetEtudiantByfiliere($idfiliere)
    {
        global $db;
        $res = $db->prepare("SELECT * FROM etudiant JOIN filiere ON etudiant.IdFiliere = filiere.IdFiliere 
        WHERE etudiant.IdFiliere = ?");
        $params = array($idfiliere);
        $res->execute($params);
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function InsertEtu($nom, $prenom, $dateN, $cin, $email, $password, $etat, $cne, $niveau, $specialisation, $anneeS, $idfiliere)
    {
        global $db;
        $res = $db->prepare("INSERT INTO etudiant VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $params = array($nom, $prenom, $dateN, $cin, $email, $password, 1, $cne, $niveau, $specialisation, $anneeS, $idfiliere);
        $res->execute($params);
        return $res;
    }
}