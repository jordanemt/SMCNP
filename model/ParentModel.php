<?php

class ParentModel {

    protected $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function getByCard($card) {
        $query = $this->db->prepare("CALL sp_read_parent_by_card (?)");
        $query->bindParam(1, $card);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        if (!empty($result)) {
            return $result[0];
        }
    }

}
