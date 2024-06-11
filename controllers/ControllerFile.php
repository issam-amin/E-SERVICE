<?php
require_once '../models/File.php';

class ControllerFile
{
    private $file;
    public function __construct()
    {
        $this->file = new File();
    }
    public function GetAll()
    {
        
        $_SESSION['files']=$this->file->GetAll();
        // var_dump($_SESSION['files']);
        header("location:./download.php") ;
        exit();
    }
    public function upload($filenames, $filesize, $filetype,$profid,$modprof)
    { 
        // session_start();

        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
            $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
            if (!in_array($file_type, $allowed_types)) {
                $_SESSION['message'] = "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
            } else {
                try {
                    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        
                    $filenames = $_FILES["file"]["name"];
                    $filesize = $_FILES["file"]["size"];
                    $filetype = $_FILES["file"]["type"];
                    $modprof=$_SESSION['modupload'];
                    $profid=$_SESSION['profpload'];
                    
                    $this->file->uploadFile($filenames, $filesize, $filetype,$profid,$modprof);
        var_dump($this->file->uploadFile($filenames, $filesize, $filetype,$profid,$modprof));
                    $_SESSION['message'] = "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                } catch (Exception $e) {
                    $_SESSION['message'] = "Sorry, there was an error uploading your file: " . $e->getMessage();
                }
            }
        } else {
            $_SESSION['message'] = "No file was uploaded.";
        }
        
        // header("location:../views/prof/UPLOAD.php"); // Redirect back to the upload page
        // exit();
}
}


