<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\config\Database.php');
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
    public function getEtubyNiv($idniv,$idprof,$idmod){
        

        global $db;
        $sql = "SELECT Nom,Prenom,IdEtudiant,valeurs,idprof,idmodule FROM etudiant 
        join tempnote on etudiant.IdEtudiant=tempnote.idetu
        WHERE IdNiveau =:Idniveau and idprof=:Idprof and IdModule=:IdModule";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':Idniveau', $idniv, PDO::PARAM_INT);
        $stmt->bindParam(':Idprof', $idprof, PDO::PARAM_INT);
        $stmt->bindParam(':IdModule', $idmod, PDO::PARAM_INT);
        $stmt->execute();        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        return $result;

    }
 
}
