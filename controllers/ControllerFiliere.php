<?php
//require_once '../models/Filiere.php';
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\models\Filiere.php');
class ControllerFiliere
{
    private $filiere;
    public function __construct()
    {
        $this->filiere = new Filiere();
    }
    public function GetAll()
    {
        $results=$this->filiere->GetAll();
        return $results;  
    }
    public function getfilierCor($idcor)
    {
        $results=$this->filiere->getfilierCor($idcor);
        return $results;  
    }
}