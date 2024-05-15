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

}
