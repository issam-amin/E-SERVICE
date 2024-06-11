<?php 
require_once '../config/Database.php';
class Note{
    public function cooruserfilier($iduser){
        global $db;
        $sql = "SELECT  prof.Nom, prof.PRENOM, prof.IdProf  FROM prof
        JOIN coordinateur on coordinateur.Idfiliere = prof.IdFiliere
        AND coordinateur.Iduser = :iduser";
        
        $res = $db->prepare($sql);
        $res->bindParam(':iduser', $iduser, PDO::PARAM_INT);
        $res->execute();
    
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
   
    function getmodbyidprof($idprof){
        global $db;
        $sql="SELECT * 
            FROM module 
            JOIN niveau ON niveau.IdNiveau = module.IdNiveau
            WHERE IdProf = :idprof
            ORDER BY module.IdNiveau ASC;
            ";
        $res = $db->prepare($sql);
        $res->bindParam(':idprof', $idprof, PDO::PARAM_INT);
        $res->execute();
    
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function NoteV($verif, $idprof, $idmodule, $idetud) {
        global $db;
        $sql = "UPDATE tempnote
                SET verif = :verif
                WHERE idetu = :idetu AND idmodule = :idmod AND idprof = :idprof";
        $res = $db->prepare($sql);
        $res->bindParam(':verif', $verif, PDO::PARAM_STR); 
        $res->bindParam(':idetu', $idetud, PDO::PARAM_STR); 
        $res->bindParam(':idprof', $idprof, PDO::PARAM_STR); 
        $res->bindParam(':idmod', $idmodule, PDO::PARAM_STR); 
        $res->execute();
    
        return $res->rowCount(); 
    }
    
    public function insertNote($value, $idprof, $idmodule, $idetud){
            global $db;
            $sql = "INSERT INTO tempnote (valeurs, idprof, idmodule, idetu) VALUES (:value, :idprof, :idmodule, :idetud)";
            $res = $db->prepare($sql);
            $res->bindParam(':value', $value, PDO::PARAM_STR); // Adjust PARAM type based on the actual type of 'value'
            $res->bindParam(':idprof', $idprof, PDO::PARAM_INT);
            $res->bindParam(':idmodule', $idmodule, PDO::PARAM_INT);
            $res->bindParam(':idetud', $idetud, PDO::PARAM_INT);
            $res->execute();

            return $res->rowCount(); // Return the number of rows affected
    }
    public function getnote($idmodule, $idprof) {
        global $db;
                $sql = "SELECT DISTINCT tempnote.valeurs, etudiant.Nom, etudiant.Prenom,etudiant.IdEtudiant
                FROM tempnote
                JOIN etudiant ON tempnote.idetu = etudiant.IdEtudiant
                WHERE tempnote.Idmodule = :idmodule AND tempnote.idprof = :idprof";
    
        try {
            $res = $db->prepare($sql);
            $res->bindParam(':idmodule', $idmodule, PDO::PARAM_INT);
            $res->bindParam(':idprof', $idprof, PDO::PARAM_INT);
            $res->execute();
            $result = $res->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
    public function updatenote($value,$idetu,$idmod,$idprof){
                global $db;
                $sql = "UPDATE tempnote SET valeurs = :valeur WHERE idetu = :idetu and tempnote.idmodule=:idmod and tempnote.idprof=:idprof";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':idetu', $idetu, PDO::PARAM_INT);
                $stmt->bindParam(':valeur', $value, PDO::PARAM_INT);
                $stmt->bindParam(':idmod', $idmod, PDO::PARAM_INT);
                $stmt->bindParam(':idprof', $idprof, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt;
    }
    public function getnoteetu($idmodule, $idprof){
        global $db;
        
        // Define your SQL query with placeholders for module and professor IDs
        $sql = "SELECT DISTINCT tempnote.valeurs
                FROM tempnote
                JOIN etudiant ON tempnote.idetu = etudiant.IdEtudiant
                WHERE tempnote.Idmodule = :idmodule AND tempnote.idprof = :idprof";
    
        try {
            // Prepare the query
            $res = $db->prepare($sql);
            
            // Bind parameters
            $res->bindParam(':idmodule', $idmodule, PDO::PARAM_INT);
            $res->bindParam(':idprof', $idprof, PDO::PARAM_INT);
            
            // Execute the query
            $res->execute();
    
            // Fetch all results as associative array
            $result = $res->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        } catch (PDOException $e) {
            // Handle PDO exception (e.g., log error, throw custom exception, etc.)
            die("Query failed: " . $e->getMessage());
        }
    }


    public function GetNoteEtus($idetu){
        global $db;
        $sql="select valeurs,Intitule from tempnote
        join etudiant on etudiant.IdEtudiant=tempnote.idetu
        join module on module.IdModule=tempnote.idmodule
        where etudiant.IdEtudiant=:idEtu";
        
        $res = $db->prepare($sql);
        $res->bindParam(':idEtu', $idetu, PDO::PARAM_INT);
        $res->execute();
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}

// $test=new Note;
// var_dump($test->GetNoteEtus(2));