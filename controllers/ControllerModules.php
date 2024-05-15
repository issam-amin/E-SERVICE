<?php
require_once '../models/Modules.php';
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
    public function GetById($id)
    {
        $result=$this->modules->GetById($id);
        return $result;
    }
    public function getModulesByNiveau($idNiveau) {
        if (isset($_POST['idNiveau'])) {
            $idNiveau = $_POST['idNiveau'];
            $modules = $this->modules->getModulesByNiveau($idNiveau);
            return $modules;
        } else {
            echo json_encode(array('error' => 'idNiveau parameter is missing'));
        }
    }
}
