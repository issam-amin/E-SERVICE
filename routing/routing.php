<?php

if(isset($_POST['connect'])){
    session_start();
    require_once '../controllers/loginController.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = new loginController();

    $user->login($email, $password);

}
if(isset($_GET['action'])){
switch ($_GET['action'])
{
    // COORDINATEUR
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
        // recuperation de ID 
        $note = new ControllerNote();
        $id = $_SESSION['IdUser'];
        $_SESSION['profs']= $note->cooruserfilier($id);
        echo "<br>";
        //  
        // foreach ($_SESSION['profs'] as $Prof){
        //     $idProf=$Prof['IdProf'];
        //     $_SESSION['modules_profs']=$note->getmodbyidprof($idProf);
        //     foreach ($_SESSION['modules_profs'] as $module) {
        //         echo "<a href=\"../../routing/routing.php?id=" . $module['IdProf'] . "\" class=\"btn btn-primary\">Voir</a>";
        //     }
        //     echo "<br>";
        //     // var_dump($_SESSION['modules_profs']);echo "<br>";
        // }
        
        header("location:../views/coordinateur/PublierNote.php");
        exit();
        break;
        
        // PROFESSEUR
        case 'profNote':
            session_start();
            // recuperation de id  prof
            require_once'../controllers/ControllerProf.php';
            $prof=new ControllerProf(); 
            $test=$prof->getprofbyuser($_SESSION['IdUser']);
            // recuperation des modules du profs
            require_once '../controllers/ControllerNote.php';
            $test1 = new ControllerNote();
            $_SESSION['modules_Specifique_Prof']=$test1->getmodbyidprof($test['IdProf']);
                    // prof
           
            // var_dump($_SESSION['modules_Specifique_Prof']);
            header("location:../views/prof/noteEtu.php");
            exit();
            break;

}
}
// coordinateur
if(isset($_GET['id']))
        {
            session_start();
            require_once '../controllers/ControllerNote.php';   
            $MOD= new ControllerNote();
            $_SESSION['idmod']=$_GET['id'];
            echo $_GET['id'];

            $_SESSION['modules_profs']=$MOD->getmodbyidprof($_GET['id']);
            foreach ($_SESSION['modules_profs'] as $module) {
                echo "<a href=\"../../routing/routing.php?id=" . $module['IdProf'] . "\" class=\"btn btn-primary\">Voir</a>";
            }
            echo "<br>";
            // var_dump($_SESSION['modules_profs']);echo "<br>";
        
            header("location:../views/coordinateur/TableModule.php");
            exit();
    
        }
        if(isset($_GET['module']) &&isset($_GET['prof'])) 
        {
            session_start();
            require_once '../controllers/ControllerModules.php';
            $test10=new Modules();
            $idmod = intval($_GET['module']);
            $idProf = intval($_GET['prof']);

            $idniveau=$test10->getidniveau($idProf,$idmod);
          
            
            require_once '../controllers/GetEtudiant.php';
            $test11=new Etudiant;
            var_dump($test11->getEtubyNiv($idniveau));
            $_SESSION['listesEtudiant']=$test11->getEtubyNiv($idniveau);
            header("location:../views/prof/ListeEtu.php");
            exit();
            
        }