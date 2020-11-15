<?php

class SectionModel {

    protected $db;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }
    
    public function getAll() {
        $query = $this->db->prepare("CALL sp_read_all_section ()");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }
    
}