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
    // prof
    public function getEtubyNiv($idniv)
    {
        
        $resultat=$this->etud->getEtubyNiv($idniv);
        return $resultat;
        
    }
    //coord
    public function getEtud($idniv)
    {
        
        $resultat=$this->etud->getEtud($idniv);
        return $resultat;
        
    }
   

}

$test=new GetEtudiant;
$lol=$test->getEtubyNiv(6);
 var_dump($lol);

