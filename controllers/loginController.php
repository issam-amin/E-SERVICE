<?php
// session_start();
require_once '../models/Users.php';

class loginController
{

    private $usermodel;

    public function __construct()
    {
        $this->usermodel = new Users();
    }
    public function login($email, $password)
    {

            $tab = $this->usermodel->GetUser($email, $password);
            if ($tab) {
                $_SESSION['IdUser'] = $tab['IdUser'];
                $_SESSION['Nom'] = $tab['Nom'];
                $_SESSION['Idrole'] = $tab['Idrole'];
                $_SESSION['Prenom'] = $tab['Prenom'];
                // $_SESSION['Idfiliere'] = $tab['Idfiliere'];
                $_SESSION['autoriser']=true;
                if ($tab['Idrole'] == 1) {
                    header('location: ../views/etudiant/interface_etu.php');
                    exit();
                }
                else if ($tab['Idrole'] == 2) {
                    header('location: ../views/prof/interface_prof.php');
                    exit();
                }
                else if ($tab['Idrole'] == 3) {
                    header('location: ../views/coordinateur/interface_coor.php');
                    exit();
                }
                else if ($tab['Idrole'] == 4) {
                    header('location: ../views/chef_dep/interface_chef_dep.php');
                    exit();
                }
            }

    }


 }
class Getelement
{
    private $usermodel;

    public function __construct()
    {
        $this->usermodel = new Users();
    }
    public function Getelement($element)
    {
        $tab = $this->usermodel->getElementById($element);
        return $tab;
    }
 
}


