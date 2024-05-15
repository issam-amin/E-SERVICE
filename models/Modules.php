<?php
require_once '../config/Database.php';
class Modules{


    public function __construct()
    {
    }
    public function GetAll()
    {
        global $db;
        $res = $db->prepare("SELECT * FROM module");
        $res->execute();
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function GetById($id)
    {
        global $db;
        $res = $db->prepare("SELECT * FROM module WHERE IdDep = $id");
        $res->execute();
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getModulesByNiveau($idNiveau) {
        global $db;
        $modules = [];    
        // Prepare and execute SQL query to fetch modules based on the selected ID
        $sql = "SELECT * FROM module WHERE IdNiveau = :IdNiveau";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':IdNiveau', $idNiveau, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch modules as associative array
        $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Return modules as JSON
        echo json_encode($modules);
            
            return $modules;
    }

}