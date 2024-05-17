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
    public function getEtubyNiv($idniv)
    {
        
        $resultat=$this->etud->getEtubyNiv($idniv);
        return $resultat;
        
    }

}
// if(isset($_GET['niveau'])){
// $test=new Etudiant;
// $lol=$test->getEtubyNiv($_GET['niveau']);
//  var_dump($lol);
// }

