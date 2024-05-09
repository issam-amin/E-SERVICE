<?php

require_once '../config/Database.php';
class Users
{
   public function GetUser($email, $password)
    {
        global $db;
        $res = $db->prepare("SELECT * FROM users where email=? and mdp=?");
        $params = array($email, $password);  /*je peux directement les inserer dans le execute*/
        $res->execute($params);
        $tab = $res->fetch(PDO::FETCH_ASSOC);
        return $tab;
    }
}



