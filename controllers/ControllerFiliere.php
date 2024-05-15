<?php
require_once '../models/Filiere.php';
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
}