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
                $_SESSION['nom'] = $tab['nom'];
                $_SESSION['prenom'] = $tab['prenom'];
                $_SESSION['autoriser']=true;
                if ($tab['role_id'] == 1) {
                    header('location: ../views/etudiant/interface_etu.php');
                    exit();
                }
                else if ($tab['role_id'] == 2) {
                    header('location: ../views/prof/interface_prof.php');
                    exit();
                }
                else if ($tab['role_id'] == 3) {
                    header('location: ../views/coordinateur/interface_coor.php');
                    exit();
                }
                else if ($tab['role_id'] == 4) {
                    header('location: ../views/chef_dep/interface_chef_dep.php');
                    exit();
                }
            }

    }



}

