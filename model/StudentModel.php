<?php

class StudentModel {
    protected $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }
    
    public function getByCard($card) {
        $query = $this->db->prepare("CALL sp_read_student_by_card (?)");
        $query->bindParam(1, $card);
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }
}