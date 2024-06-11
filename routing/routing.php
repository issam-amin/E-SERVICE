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
    // etudiant
    case 'NoteEtu':
        session_start();
// get etudiant
        require_once '../controllers/loginController.php';
        $obj1=new Getelement();
        $idetu=$obj1->GetIdEtu($_SESSION['IdUser']);
        // var_dump($idetu);
        require_once '../controllers/ControllerNote.php';
        $obj=new ControllerNote();
        $_SESSION['modSPEtu']=$obj->GetNoteEtus($idetu['IdEtudiant']);
        // var_dump($_SESSION['modSPEtu']);
        header("location:../views/etudiant/ConsulterNote.php");
        exit();

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


    case 'noteCoor':
        session_start();
        require_once '../controllers/loginController.php';
        $obj=new Getelement();
        $id=$_SESSION['IdUser'];
        $_SESSION['niveaux']=$obj->GetNivbyIdUs($id);
        var_dump($obj->GetNivbyIdUs($id));
        header("location:../views/coordinateur/listeniveaux.php");
        exit();

    case 'emploi':
        require_once '../controllers/loginController.php';
        $obj=new Getelement();
        $id=$_SESSION['IdUser'];
        $_SESSION['niveaux']=$obj->GetNivbyIdUs($id);
        // var_dump($obj->GetNivbyIdUs($id));
        header("location:../views/coordinateur/choisir-niveau.php");
        exit();



        
        // PROFESSEUR
        case 'Modulelist':
            require_once '../controllers/ControllerProf.php';
            $prof=new ControllerProf(); 
            $test=$prof->getprofbyuser($_SESSION['IdUser']);
            // var_dump($test['IdProf']);
            echo "<br>";
            // recuperation des modules du profs
            require_once '../controllers/ControllerNote.php';
            $test1 = new ControllerNote();
            $_SESSION['modules_Specifique_Prof']=$test1->getmodbyidprof($test['IdProf']);
            header("location:../views/prof/ConsulterListeModules.php");
            exit();

        case 'profNote':
            session_start();
            // recuperation de id  prof
            require_once '../controllers/ControllerProf.php';
            $prof=new ControllerProf(); 
            $test=$prof->getprofbyuser($_SESSION['IdUser']);
            // var_dump($test['IdProf']);
            echo "<br>";
            // recuperation des modules du profs
            require_once '../controllers/ControllerNote.php';
            $test1 = new ControllerNote();
            $_SESSION['modules_Specifique_Prof']=$test1->getmodbyidprof($test['IdProf']);           
            // var_dump($_SESSION['modules_Specifique_Prof']);
            echo "<br>";
            header("location:../views/prof/noteEtu.php");
            exit();

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
            // var_dump($_SESSION['mod1Etu']);
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
        if(isset($_GET['module1']) &&isset($_GET['prof1'])&&isset($_GET['niveau1'])){
            session_start();
            require_once '../controllers/ControllerModules.php';
            $test=new Modules();
            $idmod = intval($_GET['module1']);
            $idProf = intval($_GET['prof1']);
            $_SESSION['IdModule']=$_GET['module1'];
            $_SESSION['IdProf']=$_GET['prof1'];
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

        if (isset($_POST['validerVer'])) {
            session_start();
            $etudiants = null;
            if (isset($_SESSION['listesEtudiant'])) {
                $etudiants = $_POST['etudiants'];
                $_SESSION['etudiantsids'] = $_POST['etudiants'];
                $success = true;
            }
            foreach ($etudiants as $etudiant) {
                if($etudiant['validation'] == 1){
                    $success = false;
                    break;
                }
                // Ensure all keys are set before accessing them
               else {
                    if (isset($etudiant['id'], $etudiant['note'], $etudiant['md'], $etudiant['pr'], $etudiant['validation'])) {
                        $idetud = htmlspecialchars($etudiant['id']);
                        // $note = htmlspecialchars($etudiant['note']);
                        $idmodule = (int)htmlspecialchars($etudiant['md']);
                        $idprof = (int)htmlspecialchars($etudiant['pr']);
                        $idverif = 1;
                        var_dump($etudiant['validation']);
                        require_once('../controllers/ControllerNote.php');
                        $obj = new ControllerNote;
                        $res = $obj->NoteV($idverif, $idprof, $idmodule, $idetud);
                        var_dump($res);

                        if (!$res) {
                            $success = false;
                        }
                    }
                }
            }
            if ($success) {
                $_SESSION['message'] = "INSERTION DES NOTES AVEC SUCCES";
                $_SESSION['message_type'] = "success";
                $_SESSION['inserer_note'] = true;
                echo "<script type='text/javascript'>alert('INSERTION DES NOTES AVEC SUCCES'); window.location.href='../views/coordinateur/listeModNiv.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('NOTES DEJA VALIDES'); window.location.href='../views/coordinateur/listeModNiv.php';</script>";
            }
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
                    
                } else {
                    $_SESSION['message'] = "No student data received.";
                    $_SESSION['message_type'] = "error";
                }
            
                header("location:./routing.php?module=" . $idmodule ."&prof=" . $idprof ."");
                exit();
        }
        if (isset($_POST['Updatenote'])){
            session_start();     
            if (isset($_SESSION['listesEtudiant'])) {
                $etudiants = $_POST['etudiants'];
                $_SESSION['etudiantsids'] = $_POST['etudiants'];
                $success = true;
                // var_dump($_SESSION['listesEtudiant']);
                require_once('../controllers/ControllerNote.php');
                $obj = new ControllerNote;
        
                foreach ($etudiants as $id => $etudiant) {
                    $idetud = htmlspecialchars($etudiant['id']);
                    $note = htmlspecialchars($etudiant['note']);
                    $idmodule = (int)$_SESSION['IdModule'];
                    $idprof = (int)$_SESSION['IdProf'];
                    $res = $obj->updatenote($note, $idetud,$idmodule,$idprof);
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
                    header("location:./routing.php?module=" . $idmodule ."&prof=" . $idprof ."");
                    exit();
                
            } else {
                    $_SESSION['message'] = "No student data received.";
                    $_SESSION['message_type'] = "error";
                }

                    
    }
    if(isset($_GET['module2']) &&isset($_GET['prof2'])) {
        session_start();
        $_SESSION['modupload']=$_GET['module2'];
        $_SESSION['profpload']=$_GET['prof2'];
        header("location:../views/prof/UPLOAD.php");
        exit();
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        session_start();
        require_once '../controllers/ControllerFile.php';
        $filenames = $_FILES["file"]["name"];
        $filesize = $_FILES["file"]["size"];
        $filetype = $_FILES["file"]["type"];
        $modprof=$_SESSION['modupload'];
        $profid=$_SESSION['profpload'];
        $file = new ControllerFile();  
        $file->upload($filenames, $filesize, $filetype,$profid,$modprof);
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

     


    
        
