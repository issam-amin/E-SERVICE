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
        // $_SESSION['niveaux']=$niveau->GetByIdCoor();
        var_dump($_SESSION['niveaux']);    
        require_once '../controllers/ControllerModules.php';
        $module = new ControllerModules();
        // $_SESSION['modules']=$module->GetAll();
       
        $_SESSION['modules']=$module->GetById('IdDep');
        var_dump($_SESSION['modules']);
        header("location:../views/coordinateur/ConsulterListeMod.php");
        exit();
        break;




    // case 'etudiant':
    //     require_once '../controllers/ControllerNiveau.php';
    //     $niveau = new ControllerNiveau();
    //     // $_SESSION['niveaux']=$niveau->GetAll();
    //     $_SESSION['niveaux']=$niveau->GetByIdCoor();
    //     // var_dump($_SESSION['niveaux']);    


        header("location:../views/coordinateur/ConsulterListeEtu.php");
        exit();
        break;

    case 'noteCoor':
        session_start();
        require_once '../controllers/loginController.php';
        $obj=new Getelement();
        $id=$_SESSION['IdUser'];
        $_SESSION['niveaux']=$obj->GetNivbyIdUs($id);
        var_dump($obj->GetNivbyIdUs($id));
        header("location:../views/coordinateur/listeniveaux.php");
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
            // var_dump($_SESSION['modules_Specifique_Prof']);
            header("location:../views/prof/noteEtu.php");
            exit();
            break;
            
        case 'Gestiondemodule':
            session_start();
            require_once '../controllers/ControllerChefDep.php';
            $chefDep = new ControllerChefDep();
            $idUtilisateur= $chefDep->getidDep($_SESSION['IdUser']);
            require_once '../controllers/ControllerModules.php';
            $disp = new ControllerModules();
            
            $_SESSION['dispModules'] = $disp->displaymod($idUtilisateur);
            header("location:../views/chef_dep/gestionModule.php");
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
    if (isset($_POST['selcetniv'])){
        
            header("location:../views/coordinateur/ConsulterListeEtu.php");
            exit();
        
        }
// prof les notes
            // listes des etudiants
            
        if(isset($_GET['module']) &&isset($_GET['prof'])) 
        {        
            session_start();
            require_once '../controllers/ControllerModules.php';
            $test=new Modules();
            $idmod = intval($_GET['module']);
            $idProf = intval($_GET['prof']);
            $_SESSION['IdModule']=$_GET['module'];
            $_SESSION['IdProf']=$_GET['prof'];
            $idniveau=$test->getidniveau($idProf,$idmod);
            require_once '../controllers/GetEtudiant.php';
            $test1=new Etudiant;
            $_SESSION['listesEtudiant']=$test1->getEtubyNiv($idniveau);
            if(empty($_SESSION['listesEtudiant'])){
                $_SESSION['listesEtudiant']=$test1->getEtud($idniveau);
            }
            var_dump($_SESSION['listesEtudiant']);
            header("location:../views/prof/ListeEtu.php");
            exit();
            
        }
        // submissions 

        if (isset($_POST['submitnote'])) {
            session_start();     
            if (isset($_SESSION['listesEtudiant'])) {
                $etudiants = $_POST['etudiants'];
                $_SESSION['etudiantsids'] = $_POST['etudiants'];
                $success = true;
        
                require_once('../controllers/ControllerNote.php');
                $obj = new ControllerNote;
        
                foreach ($etudiants as $id => $etudiant) {
                    $idetud = htmlspecialchars($etudiant['id']);
                    $note = htmlspecialchars($etudiant['note']);
                    $idmodule = (int)$_SESSION['IdModule'];
                    $idprof = (int)$_SESSION['IdProf'];
        
                    $res = $obj->insertNote($note, $idprof, $idmodule, $idetud);
                    
                    if (!$res) {
                        $success = false;
                    }
                }
                       if ($success) {
                        $_SESSION['message'] = "INSERTION DES NOTES AVEC SUCCES";
                        $_SESSION['message_type'] = "success";
                        $_SESSION['inserer_note'] = true;

                    } else {
                        $_SESSION['message'] = "There was an error submitting the notes.";
                        $_SESSION['message_type'] = "error";
                    }
                    $_SESSION['inserer_note'] = true;
                } else {
                    $_SESSION['message'] = "No student data received.";
                    $_SESSION['message_type'] = "error";
                }
            
            header("location:../views/prof/ListeEtu.php");
            exit();
        }
        if (isset($_POST['Updatenote'])){
            session_start();     
            if (isset($_SESSION['listesEtudiant'])) {
                $etudiants = $_POST['etudiants'];
                $_SESSION['etudiantsids'] = $_POST['etudiants'];
                $success = true;
        
                require_once('../controllers/ControllerNote.php');
                $obj = new ControllerNote;
        
                foreach ($etudiants as $id => $etudiant) {
                    $idetud = htmlspecialchars($etudiant['id']);
                    $note = htmlspecialchars($etudiant['note']);
                    $res = $obj->updatenote($note, $idetud);
                    if (!$res) {
                        $success = false;
                    }
                }
                       if ($success) {
                        $_SESSION['message'] = "UPDATE DES NOTES AVEC SUCCES";
                        $_SESSION['message_type'] = "success";
                        $_SESSION['inserer_note'] = true;

                    } else {
                        $_SESSION['message'] = "There was an error submitting the notes.";
                        $_SESSION['message_type'] = "error";
                    }
                    $_SESSION['inserer_note'] = true;
                } else {
                    $_SESSION['message'] = "No student data received.";
                    $_SESSION['message_type'] = "error";
                }

                // require_once '../controllers/GetEtudiant.php';
                // $test1=new Etudiant;
                // $_SESSION['listesEtudiant']=$test1->getEtubyNiv($idniveau);
                header("location:../views/prof/ListeEtu.php");
                exit();
            
          

        }

     


    
        
