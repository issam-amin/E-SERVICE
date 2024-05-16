<?php 
require_once '../config/Database.php';
class Note{
    public function cooruserfilier($iduser){
        global $db;
        $sql = "SELECT  prof.Nom, prof.PRENOM, prof.IdProf  FROM prof
        JOIN coordinateur on coordinateur.Idfiliere = prof.IdFiliere
        AND coordinateur.Iduser = :iduser";
        
        $res = $db->prepare($sql);
        $res->bindParam(':iduser', $iduser, PDO::PARAM_INT);
        $res->execute();
    
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
   
    function getmodbyidprof($idprof){
        global $db;
        // $sql = "SELECT prof.Nom, prof.PRENOM, prof.IdProf, module.Intitule 
        //         FROM projectweb.module 
        //         JOIN prof ON prof.IdProf = module.IdProf 
        //         WHERE prof.IdProf = :idprof";
        $sql="SELECT * from module WHERE IdProf = :idprof";
        $res = $db->prepare($sql);
        $res->bindParam(':idprof', $idprof, PDO::PARAM_INT);
        $res->execute();
    
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } 
    

}
// $test=new Note;
// $id = $_SESSION['IdUser'];
// $test->cooruserfilier($id);