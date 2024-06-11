<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\config\Database.php');
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
    public function GetbyIDMod($idmod)
    {
        global $db;
        $res = $db->prepare("SELECT Intitule FROM module where IdModule=:idmod");
        $res->bindParam(':idmod', $idmod, PDO::PARAM_INT);
        $res->execute();
        $result = $res->fetch(PDO::FETCH_ASSOC);
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
        $sql = "SELECT module.IdModule, module.Intitule ,prof.Nom,prof.Prenom, prof.IdProf,module.IdNiveau FROM module
        join  prof on prof.IdProf=module.IdProf
        where IdNiveau=:IdNiveau";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':IdNiveau', $idNiveau, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch modules as associative array
        $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Return modules as JSON
        echo json_encode($modules);
            
            return $modules;
    }
    public function getidniveau($idprof, $idmod)
    {
        global $db;
        $sql = "SELECT IdNiveau FROM module WHERE IdProf = :idprof AND IdModule = :idmod";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idprof', $idprof, PDO::PARAM_INT);
        $stmt->bindParam(':idmod', $idmod, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
       return $result['IdNiveau'];
    }
    public function getmod($iddep)
    {
        global $db;
        $sql = "SELECT module.IdModule, module.Intitule, specialite.nom_specialite,specialite.id_specialite
                FROM module 
                INNER JOIN specialite ON module.idSpecialite = specialite.id_specialite
                WHERE IdDep=:iddep";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':iddep', $iddep, PDO::PARAM_INT);    
        $stmt->execute();
        
        // Fetch the result as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
       return $result;
    }

    public function displaymod($iddep) {
        global $db;
    
        $sql = "SELECT module.IdModule, module.Intitule, niveau.nivNom, departement.Nom, specialite.nom_specialite,specialite.id_specialite
                FROM module 
                INNER JOIN niveau ON module.IdNiveau = niveau.IdNiveau
                INNER JOIN departement ON module.IdDep = departement.IdDep
                INNER JOIN specialite ON module.idSpecialite = specialite.id_specialite
                WHERE departement.IdDep = :IDdep";
    
        try {
            $res = $db->prepare($sql);
            $res->bindParam(':IDdep', $iddep, PDO::PARAM_INT);  // Ensure parameter is bound
            $res->execute();
            $result = $res->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function updateNomIdSP($idmod, $idsp, $nomMod)
    {
        global $db;
    
        
        var_dump($nomMod);
    
        $sql = "UPDATE module 
                SET Intitule = :NouveauNom, idSpecialite = :NouvelIdSpecialite 
                WHERE IdModule = :IdDuModule";
        $res = $db->prepare($sql);
        $res->bindParam(':NouveauNom', $nomMod, PDO::PARAM_STR);
        $res->bindParam(':NouvelIdSpecialite', $idsp, PDO::PARAM_INT);
        $res->bindParam(':IdDuModule', $idmod, PDO::PARAM_INT);
        $res->execute();
    
        return $res->rowCount(); // Return the number of affected rows
    }
    public function getModulesParIdFiliere($idfiliere)
    {
        global $db;
        $sql = "SELECT IdNiveau FROM module WHERE IdProf = :idprof AND IdModule = :idmod";
        $stmt = $db->prepare($idfiliere);
        $stmt->bindParam(':idprof', $idfiliere, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
       return $result['IdNiveau'];
    }
}    