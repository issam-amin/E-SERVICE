<?php 
require_once "../config/Database.php";
class ChefDep{
    // collecter id du departement 
    public function getidDep($iduser){
        global $db;
                $sql = "SELECT * 
                from chefdep 
                join users on users.IdUser=chefdep.Iduser
                WHERE users.IdUser=:iduser";
            $res = $db->prepare($sql);
            $res->bindParam(':iduser',$iduser);
            $res->execute();
            $result = $res->fetch(PDO::FETCH_ASSOC);
            var_dump($result);

            return $result;
       
    }
    
}

// $chefDep = new ChefDep();
// $idUtilisateur = 4;
// $resultat = $chefDep->getidDep($idUtilisateur);
?>