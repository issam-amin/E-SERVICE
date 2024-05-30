<?php
require_once '../models/specialite.php';
class ControllerSpecialite{
    private $spe;
    public function __construct(){
        $this->spe = new specialite();
    }
    public function GetAll(){
        return $this->spe->GetAll();
    }

}
