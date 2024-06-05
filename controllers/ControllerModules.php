<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\models\Modules.php');
class ControllerModules
{
    private $modules;
    public function __construct()
    {
        $this->modules = new Modules();
    }
    public function GetAll()
    {
        $results=$this->modules->GetAll();
        return $results;  
    }
    public function GetbyIDMod($idmod)
    {
        $results=$this->modules->GetbyIDMod($idmod);
        return $results;  
    }
    public function GetById($id)
    {
        $result=$this->modules->GetById($id);
        return $result;
    }
    public function getModulesByNiveau($idNiveau) {
        
            $modules = $this->modules->getModulesByNiveau($idNiveau);
            return $modules;
      
    }
    public function getidniveau($idprof, $idmod){
        $result=$this->modules->getidniveau($idprof, $idmod);
       
        return $result;
    }
    public function displaymod($iddep){
        $result=$this->modules-> displaymod($iddep);
       
        return $result;
    }
    public function updateNomIdSP($idmod, $idsp, $nomMod){
        $result=$this->modules-> updateNomIdSP($idmod, $idsp, $nomMod);
       
        return $result;
    }
    public function getmod($iddep){
        $result=$this->modules-> getmod($iddep);
       
        return $result;
    }
}

// $chefDep = new ControllerModules();
// $idUtilisateur = 1;
// $resultat = $chefDep->displaymod($idUtilisateur);
// var_dump($resultat);