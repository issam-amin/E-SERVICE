<?php
require_once '../models/Note.php';
class ControllerNote{
    private $note;
    public function __construct()
    {
        $this->note = new Note();
    }
    public function cooruserfilier($iduser){
        $result = $this->note->cooruserfilier($iduser);
        return $result;
    }
    public function getmodbyidprof($idprof){
        $result = $this->note->getmodbyidprof($idprof);
        return $result;
    }
    public function insertNote($value, $idprof, $idmodule, $idetud){
        $result = $this->note->insertNote($value, $idprof, $idmodule, $idetud);
        return $result;
    }
    public function getnote($idmodule, $idprof){
        $result = $this->note->getnote($idmodule, $idprof) ;
        return $result;
    }
    public function getnoteetu($idmodule, $idprof){
        $result = $this->note-> getnoteetu($idmodule, $idprof) ;
        return $result;
    }
    public function  updatenote($value,$idetu,$idmod,$idprof){
        $result = $this->note->updatenote($value,$idetu,$idmod,$idprof);
        return $result;
    }
    public function  GetNoteEtus($idetu){
        $result = $this->note->GetNoteEtus($idetu);
        return $result;
    }
    // inserer apres valider 
    public function NoteV($idverif, $idprof, $idmodule, $idetud){
        $result = $this->note-> NoteV($idverif, $idprof, $idmodule, $idetud);
        return $result;
    }
    
}