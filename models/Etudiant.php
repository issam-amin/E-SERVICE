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
    public function getEtubyNiv($idniv){
        global $db;
        $sql = "SELECT Nom,Prenom FROM etudiant WHERE IdNiveau =:Idniveau";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':Idniveau', $idniv, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch the result as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
 
}