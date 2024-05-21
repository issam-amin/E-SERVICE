<?php
require_once '../models/ChefDep.php';
class ControllerChefDep{
    private $chef;
    public function __construct()
    {
        $this->chef = new ChefDep();
    }
    public function getidDep($iduser)
    {
        $results=$this->chef->getidDep($iduser);
        var_dump($results);
        return $results;  
    }
}
?>