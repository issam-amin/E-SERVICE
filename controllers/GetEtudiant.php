<?php
// session_start();
require_once '../models/Etudiant.php';
class GetEtudiant
{
    private $etud ;
    public function __construct()
    {
        $this->etud = new Etudiant();
    }
    public function GetEtudiant()
    {
        
        $resultat=$this->etud->GetAll();
        return $resultat;
        
    }
    public function GetEtudiantByfiliere($idfiliere)
    {
        $resultat= $this->etud->GetEtudiantByfiliere($idfiliere);
        return $resultat;
    }
}

