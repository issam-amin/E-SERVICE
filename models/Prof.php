<?php
require_once'../config/Database.php';
class Prof{

        public function getprofbyfiliere($idfiliere){
            global $db;
            $stmt = $db->prepare("SELECT * FROM prof WHERE IdFiliere = :IdFiliere");
            $stmt->bindParam(':IdFiliere', $idfiliere, PDO::PARAM_INT);
            $stmt->execute();
            $prof = $stmt->fetchAll();
            var_dump($prof);
            return $prof;
           
        }
        // get the specific idprof  of the user
        public function getprofbyuser($iduser)
        {
            global $db;
            $stmt = $db->prepare("SELECT prof.Nom, prof.PRENOM, prof.IdProf FROM prof
                                  JOIN users ON users.IdUser = prof.Iduser
                                  WHERE users.IdUser = :IdUser");
            $stmt->bindParam(':IdUser', $iduser, PDO::PARAM_INT);
            $stmt->execute();
            $prof = $stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($prof);
            return $prof;
        }
        
}
