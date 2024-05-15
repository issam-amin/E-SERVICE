<?php
require_once '../config/Database.php';
class Filiere
{
    public function __construct()
    {}
    public function GetAll()
    {
        global $db;
        $res = $db->prepare("SELECT * FROM filiere");
        $res->execute();
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
   public function getidfilier($filiere)
   {
       global $db;
       $res = $db->prepare("SELECT idfiliere FROM filiere WHERE nomfiliere = ?");
       $res->execute(array($filiere));
       $result = $res->fetch(PDO::FETCH_ASSOC);
       return $result;
   }
//    public function getbyUser()
//    {
//        global $db;
//        $res = $db->prepare("SELECT * From
//        filiere join coordinateur on filiere.IdFiliere=coordinateur.Idfiliere
//        join users on users.IdUser=coordinateur.Iduser");
//        $res->bindParam(':idcoor', PDO::PARAM_INT);
//        $res->execute();
//        $result = $res->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($result);
//        return $result;
//    }
}
// $test = new Filiere();
// $test->getbyUser();