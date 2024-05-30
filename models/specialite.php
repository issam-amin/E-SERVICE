<?php
require_once '../config/Database.php';
class specialite
{
    public function __construct()
    {}
    public function GetAll()
    {
        global $db;
        $res = $db->prepare("SELECT * FROM specialite");
        $res->execute();
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    
   }
   
}