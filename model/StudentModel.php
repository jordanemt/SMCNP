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
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        if (!empty($result)) return $result[0];
    }
    
    public function getAllServiceNameById($id) {
        $query = $this->db->prepare("CALL sp_read_all_service_by_student_id (?)");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        if (!empty($result)) return $result;
    }

    public function getStudentEnrollment() {
        $query = $this->db->prepare("CALL sp_read_student_enrollment ()");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

}
