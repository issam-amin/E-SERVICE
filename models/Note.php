<?php 
require_once '../config/Database.php';
class Note{
    public function cooruserfilier($iduser){
        global $db;
        $sql = "SELECT  prof.Nom, prof.PRENOM  FROM prof
        JOIN coordinateur on coordinateur.Idfiliere = prof.IdFiliere
        AND coordinateur.Iduser = :iduser";
        
        $res = $db->prepare($sql);
        $res->bindParam(':iduser', $iduser, PDO::PARAM_INT);
        $res->execute();
    
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

}
$test=new Note;
$id = $_SESSION['IdUser'];
$test->cooruserfilier($id);