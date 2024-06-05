<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\config\Database.php');

class Coordinateur
{
   public function GetidCoo($iduser)
    {
        global $db;
        $res = $db->prepare("SELECT IdCoord FROM coordinateur where  IdUser=?");
        $params = array($iduser);  /*je peux directement les inserer dans le execute*/
        $res->execute($params);
        $tab = $res->fetch(PDO::FETCH_ASSOC);
        return $tab;
    }
   

  
}