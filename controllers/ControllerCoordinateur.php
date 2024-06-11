<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\models\Coordinateur.php');

class ControllerCoord{
    private $coord;
    public function __construct()
    {
        $this->coord = new Coordinateur();
    }
    public function getidCoo($iduser)
    {
        $results=$this->coord->GetidCoo($iduser);
        // var_dump($results);
        return $results;  
    }
    public function  Getidfilier($iduser)
    {
        $results=$this->coord-> Getidfilier($iduser);
        // var_dump($results);
        return $results;  
    }
}
?>