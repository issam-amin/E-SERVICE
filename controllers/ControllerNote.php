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
}