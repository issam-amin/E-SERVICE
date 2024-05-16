<?php
require_once '../models/Prof.php';
class ControllerProf{
    private $prof;
    public function __construct(){
        $this->prof = new Prof();
    }
    public function getprofbyfiliere($idfiliere){
        return $this->prof->getprofbyfiliere($idfiliere);
    }
    public function getprofbyuser($iduser){
        return $this->prof->getprofbyuser($iduser);
    }
}
