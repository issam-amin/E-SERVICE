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
    public function getEtud($idniv){
        global $db;
        $sql = "SELECT Nom,Prenom,IdEtudiant FROM etudiant    
        WHERE IdNiveau =:Idniveau";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':Idniveau', $idniv, PDO::PARAM_INT);
        $stmt->execute();        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        return $result;
    }
    public function getEtubyNiv($idniv){
        

        global $db;
        $sql = "SELECT Nom,Prenom,IdEtudiant,valeurs FROM etudiant 
        join tempnote on etudiant.IdEtudiant=tempnote.idetu
        WHERE IdNiveau =:Idniveau";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':Idniveau', $idniv, PDO::PARAM_INT);
        $stmt->execute();        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
        return $result;

    }
 
}
// $test=new Etudiant;
// $test->getEtubyNiv(6);