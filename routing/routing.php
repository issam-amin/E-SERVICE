<?php

if(isset($_POST['connect'])){
    session_start();
    require_once '../controllers/loginController.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = new loginController();

    $user->login($email, $password);

}
switch ($_GET['action'])
{
    case 'module':
        session_start();
        require_once '../controllers/ControllerNiveau.php';
        $niveau = new ControllerNiveau();
        $_SESSION['niveaux']=$niveau->GetByIdCoor();
        var_dump($_SESSION['niveaux']);    
        require_once '../controllers/ControllerModules.php';
        $module = new ControllerModules();
        // $_SESSION['modules']=$module->GetAll();
       
        $_SESSION['modules']=$module->GetById('IdDep');
        var_dump($_SESSION['modules']);
        header("location:../views/coordinateur/ConsulterListeMod.php");
        exit();
        break;




    case 'etudiant':
        require_once '../controllers/ControllerNiveau.php';
        $niveau = new ControllerNiveau();
        // $_SESSION['niveaux']=$niveau->GetAll();
        $_SESSION['niveaux']=$niveau->GetByIdCoor();
        // var_dump($_SESSION['niveaux']);    


        header("location:../views/coordinateur/ConsulterListeEtu.php");
        exit();
        break;

    case 'noteCoor':
        session_start();
        require_once '../controllers/ControllerNote.php';
        $note = new ControllerNote();
        $id = $_SESSION['IdUser'];
        $test = $note->cooruserfilier($id);
        $_SESSION['notes']=$test;
        //var_dump($_SESSION);

        header("location:../views/coordinateur/PublierNote.php");
        exit();

}
