<?php
require_once '../config/Database.php';
class Niveau
{
    public function __construct()
    {}
    public function GetAll()
    {
        global $db;
        $res = $db->prepare("SELECT * FROM niveau");
        $res->execute();
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function GetByIdCoor($idUser){
           global $db;
        // Get IdUser from session
         $idUser =  $_SESSION["IdUser"];

        // Your SQL query with IdUser from session
        $sql = "SELECT *
                FROM niveau
                JOIN coordinateur ON coordinateur.Idfiliere = niveau.IdFiliere
                JOIN users ON users.IdUser = coordinateur.'$idUser'
                WHERE users.IdUser = '$idUser' ";

        $res = $db->prepare($sql);
        $res->execute();
        $result = $res->fetch(PDO::FETCH_ASSOC);
        return $result;
   }
   
   
}
// $test=new Etudiant;
// $test->getEtubyNiv(2);