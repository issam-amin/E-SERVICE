<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\config\Database.php');
class File{
  
  
    public function GetAll()
    {
        global $db;
          
        try {
            $stmt = $db->prepare("SELECT * FROM files");
            $stmt->execute();
            $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching files: " . $e->getMessage();
            exit;
        }
        return $files;
    }
  public function uploadFile($filenames, $filesize, $filetype,$profid,$modid): false|PDOStatement
  {
    global $db;
    $stmt= $db->prepare("INSERT INTO files (filenames,filesize,filetype,IdProf,IdModule) VALUES (?,?,?,?,?)");
    $stmt->execute([$filenames, $filesize, $filetype,$profid,$modid]);
    return $stmt;
}

}