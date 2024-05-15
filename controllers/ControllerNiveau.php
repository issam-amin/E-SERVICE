<?php
require_once '../models/Niveau.php';
class ControllerNiveau
{
    private $niveau;
    public function __construct()
    {
        $this->niveau = new Niveau();
    }
    public function GetAll()
    {
        $results=$this->niveau->GetAll();
        return $results;  
    }
    public function GetByIdCoor()
    {
        $result=$this->niveau->GetByIdCoor();
        return $result;
    }
}

