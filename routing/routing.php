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
        require_once '../controllers/loginController.php';
        $obj=new Getelement();
        $id=$_SESSION['IdUser'];
        $_SESSION['niveaux']=$obj->GetNivbyIdUs($id);
        // var_dump($_SESSION['niveaux'][0]['IdNiveau']);
        header("location:../views/coordinateur/niveaux.php");
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
    case 'creemploi':
        header("location:../views/coordinateur/emploi.php");
        exit();
        break;
        // PROFESSEUR
        case 'profNote':
            session_start();
            // recuperation de id  prof
            require_once '../controllers/ControllerProf.php';
            $prof=new ControllerProf(); 
            $test=$prof->getprofbyuser($_SESSION['IdUser']);
            var_dump($test['IdProf']);
            echo "<br>";
            // recuperation des modules du profs
            require_once '../controllers/ControllerNote.php';
            $test1 = new ControllerNote();
            $_SESSION['modules_Specifique_Prof']=$test1->getmodbyidprof($test['IdProf']);           
            var_dump($_SESSION['modules_Specifique_Prof']);
            echo "<br>";
            header("location:../views/prof/noteEtu.php");
            exit();
            break;
        //chef departement
            
        case 'Gestiondemodule':
            session_start();
            require_once '../controllers/ControllerChefDep.php';
            $chefDep = new ControllerChefDep();
            $idUtilisateur= $chefDep->getidDep($_SESSION['IdUser']);
            $_SESSION['depart']=$idUtilisateur['idDep'];
            require_once '../controllers/ControllerModules.php';
            $disp = new ControllerModules();
            // $_SESSION['dispModules'] = $disp->displaymod($idUtilisateur['idDep']);
            $_SESSION['dispModules'] = $disp->getmod($idUtilisateur['idDep']);
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
        if (isset($_POST['niveauSelect'])){
            session_start();
            $_SESSION['selected_niveau'] = $_POST['niveauSelect'];
             echo $_SESSION['selected_niveau'];
             $niv= $_SESSION['selected_niveau'];
            require_once '../controllers/GetEtudiant.php';
            $obj=new GetEtudiant();
            $test=$obj->getEtud($niv);
            $_SESSION['list_etu_co']=$test;
            // var_dump($test);
            header("location:../views/coordinateur/ConsulterListeEtu.php");
            exit();
        
        }
        if (isset($_GET['detail'])){
            session_start();
            $idetu=$_GET['detail'];
            require_once '../controllers/ControllerNote.php';
            $obj=new ControllerNote();
            $_SESSION['mod1Etu']=$obj->GetNoteEtus($idetu);
            var_dump($_SESSION['mod1Etu']);
            header("location:../views/coordinateur/module1Etu.php");
            exit();
        // var_dump($_GET['detail']);
        }
        if (isset($_POST['ModulduNiv'])){
            session_start();
            $_SESSION['sel_niveau'] = $_POST['ModulduNiv'];
             echo $_SESSION['sel_niveau'];
             $niv= $_SESSION['sel_niveau'];
            require_once '../controllers/ControllerModules.php';
            $obj=new ControllerModules();
            $test=$obj->getModulesByNiveau($niv);
            $_SESSION['list_modul_niv']=$test;
            var_dump($test);
            header("location:../views/coordinateur/listeModNiv.php");
            exit();
        
        }
        if(isset($_GET['module']) &&isset($_GET['prof'])&&isset($_GET['niveau'])){
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
            $_SESSION['listesEtudiant']=$test1->getEtubyNiv($idniveau,$idProf,$idmod);
            if(empty($_SESSION['listesEtudiant'])){
                $_SESSION['listesEtudiant']=$test1->getEtud($idniveau);
            }
            // var_dump($_SESSION['listesEtudiant']);
            header("location:../views/coordinateur/listetudiant.php");
            exit();
        }

        if (isset($_POST['valider'])) {
            session_start();
            if (isset($_SESSION['listesEtudiant'])) {
                $etudiants = $_POST['etudiants'];
                $_SESSION['etudiantsids'] = $_POST['etudiants'];
                $success = true;
                // var_dump($etudiants);
                
                
                foreach ($etudiants as $etudiant) {
                    // Ensure all keys are set before accessing them
                    if (isset($etudiant['id'], $etudiant['note'], $etudiant['md'], $etudiant['pr'])) {
                        $idetud = htmlspecialchars($etudiant['id']);
                        $note = htmlspecialchars($etudiant['note']);
                        $idmodule = (int) htmlspecialchars($etudiant['md']);
                        $idprof = (int) htmlspecialchars($etudiant['pr']);
                        require_once('../controllers/ControllerNote.php');
                        $obj = new ControllerNote;
                        $res = $obj->insertNoteV($note, $idprof, $idmodule, $idetud);
                        
                        if (!$res) {
                            $success = false;
                        }
                    } else {
                        $success = false; // If any key is missing, mark success as false
                    }
                }
            }if ($success) {
                $_SESSION['message'] = "INSERTION DES NOTES AVEC SUCCES";
                $_SESSION['message_type'] = "success";
                $_SESSION['inserer_note'] = true;
              
              } else {
                $_SESSION['message'] = "There was an error submitting the notes.";
                $_SESSION['message_type'] = "error";
              }
            header("location:../views/coordinateur/listetudiant.php");
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
            $_SESSION['listesEtudiant']=$test1->getEtubyNiv($idniveau,$idProf,$idmod);
            if(empty($_SESSION['listesEtudiant'])){
                $_SESSION['listesEtudiant']=$test1->getEtud($idniveau);
            }
            // var_dump($_SESSION['listesEtudiant']);
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
                    header("location:../views/prof/ListeEtu.php");
                    exit();
                    // $_SESSION['inserer_note'] = true;
                } else {
                    $_SESSION['message'] = "No student data received.";
                    $_SESSION['message_type'] = "error";
                }

                // require_once '../controllers/GetEtudiant.php';
                // $test1=new Etudiant;
                // $_SESSION['listesEtudiant']=$test1->getEtubyNiv($idniveau);
}
// CHEF DEPARTEMENT 
 if (isset($_GET['modsp'])){
    session_start();
    $_SESSION['idMod']=$_GET['modsp'];
    $mdid=$_GET['modsp'];
    require_once '../controllers/ControllerSpecialite.php';
    $obj=new ControllerSpecialite;
    $_SESSION['specilities']=$obj->GetAll();
    
    require_once '../controllers/ControllerModules.php';
    $obj1=new ControllerModules;
    $_SESSION['nomMod']=$obj1->GetbyIDMod($mdid);

    header("location:../views/chef_dep/modifier.php");
    exit();
 }

 if (isset($_POST['modifSp'])){
    session_start();
    $nomMod = $_POST['nomMod'];
var_dump($nomMod);
    // Ensure $nomMod is a string
    if (is_array($nomMod)) {
        // Handle array case: decide how to convert it to a string
        // For example, take the first element or join the array elements
        $nomMod = implode(", ", $nomMod);
    } else {
        // Cast $nomMod to a string to ensure it's a string type
        $nomMod = (string)$nomMod;
    }

    $idMods = intval($_SESSION['idMod']);
    $selectedSp = intval($_POST['selectsp']);
    require_once '../controllers/ControllerModules.php';
    $obj1 = new ControllerModules();
    echo "<br><br>";
    $rowsUpdated = $obj1->updateNomIdSP($idMods, $selectedSp, $nomMod);
    $_SESSION['nomMod'] = $rowsUpdated;
    // var_dump($_SESSION['nomMod']);
    
    header("location:routing.php?action=Gestiondemodule");
    exit();
}

     


    
        
