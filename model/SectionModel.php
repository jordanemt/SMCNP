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
    
    public function getById($id) {
        $query = $this->db->prepare("SELECT* FROM section WHERE id = ?");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }
}