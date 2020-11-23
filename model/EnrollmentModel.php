<?php

class EnrollmentModel {

    protected $db;
    private $transactionActive;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
        $this->transactionActive = false;
    }

    public function enroll($student, $id_section, $parent) {
        try {
            $this->db->beginTransaction();
            $this->transactionActive = true;
            
            //insert_udpate parent
            $id_parent = null;
            if ($parent['id_parent'] === null && $parent['card_parent'] !== null) {
                $queryParent = $this->db->prepare("CALL sp_create_parent (?,?,?,?,?,?)");
                $queryParent->bindParam(1, $parent['card_parent']);
                $queryParent->bindParam(2, $parent['full_name_parent']);
                $queryParent->bindParam(3, $parent['nationality_parent']);
                $queryParent->bindParam(4, $parent['ocupation_parent']);
                $queryParent->bindParam(5, $parent['work_place_parent']);
                $queryParent->bindParam(6, $parent['phone_parent']);
                $queryParent->execute();
                $id_parent = $queryParent->fetchAll()[0]['id'];
                $queryParent->closeCursor();
            } else if ($parent['card_parent'] !== null) {
                $queryParent = $this->db->prepare("CALL sp_update_parent (?,?,?,?,?,?)");
                $queryParent->bindParam(1, $parent['id_parent']);
                $queryParent->bindParam(2, $parent['full_name_parent']);
                $queryParent->bindParam(3, $parent['nationality_parent']);
                $queryParent->bindParam(4, $parent['ocupation_parent']);
                $queryParent->bindParam(5, $parent['work_place_parent']);
                $queryParent->bindParam(6, $parent['phone_parent']);
                $queryParent->execute();
                $id_parent = $parent['id_parent'];
                $queryParent->closeCursor();
            }
            
            //insert_udpate student
            if ($student['id'] === null) {
                $queryStudent = $this->db->prepare("CALL sp_create_student ("
                        . "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $queryStudent->bindParam(1, $student['card']);
                $queryStudent->bindParam(2, $student['name']);
                $queryStudent->bindParam(3, $student['first_lastname']);
                $queryStudent->bindParam(4, $student['second_lastname']);
                $queryStudent->bindParam(5, $student['birthdate']);
                $queryStudent->bindParam(6, $student['gender']);
                $queryStudent->bindParam(7, $student['nationality']);
                $queryStudent->bindParam(8, $student['personal_phone']);
                $queryStudent->bindParam(9, $student['other_phone']);
                $queryStudent->bindParam(10, $student['mep_mail']);
                $queryStudent->bindParam(11, $student['other_mail']);
                $queryStudent->bindParam(12, $student['id_district']);
                $queryStudent->bindParam(13, $student['direction']);
                $queryStudent->bindParam(14, $student['suffering']);
                $queryStudent->bindParam(15, $student['id_adequacy']);
                $queryStudent->bindParam(16, $student['is_imas_benefit']);
                $queryStudent->bindParam(17, $student['is_teenage_father']);
                $queryStudent->bindParam(18, $student['is_working']);
                $queryStudent->bindParam(19, $student['is_sexual_matter']);
                $queryStudent->bindParam(20, $student['is_ethics_matter']);
                $queryStudent->bindParam(21, $student['contact_name']);
                $queryStudent->bindParam(22, $student['contact_phone']);
                $queryStudent->bindParam(23, $student['id_route']);
                $queryStudent->bindParam(24, $id_parent);
                $queryStudent->execute();
                $student['id'] = $queryStudent->fetchAll()[0]['id'];
                $queryStudent->closeCursor();
            } else {
                $queryStudent = $this->db->prepare("CALL sp_update_student ("
                        . "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $queryStudent->bindParam(1, $student['id']);
                $queryStudent->bindParam(2, $student['name']);
                $queryStudent->bindParam(3, $student['first_lastname']);
                $queryStudent->bindParam(4, $student['second_lastname']);
                $queryStudent->bindParam(5, $student['birthdate']);
                $queryStudent->bindParam(6, $student['gender']);
                $queryStudent->bindParam(7, $student['nationality']);
                $queryStudent->bindParam(8, $student['personal_phone']);
                $queryStudent->bindParam(9, $student['other_phone']);
                $queryStudent->bindParam(10, $student['mep_mail']);
                $queryStudent->bindParam(11, $student['other_mail']);
                $queryStudent->bindParam(12, $student['id_district']);
                $queryStudent->bindParam(13, $student['direction']);
                $queryStudent->bindParam(14, $student['suffering']);
                $queryStudent->bindParam(15, $student['id_adequacy']);
                $queryStudent->bindParam(16, $student['is_imas_benefit']);
                $queryStudent->bindParam(17, $student['is_teenage_father']);
                $queryStudent->bindParam(18, $student['is_working']);
                $queryStudent->bindParam(19, $student['is_sexual_matter']);
                $queryStudent->bindParam(20, $student['is_ethics_matter']);
                $queryStudent->bindParam(21, $student['contact_name']);
                $queryStudent->bindParam(22, $student['contact_phone']);
                $queryStudent->bindParam(23, $student['id_route']);
                $queryStudent->bindParam(24, $id_parent);
                $queryStudent->execute();
                $queryStudent->closeCursor();
            }
            
            date_default_timezone_set('America/Costa_Rica');
            $_date = date('Y-m-j');
            $queryEnrollment = $this->db->prepare("CALL sp_create_enrollment (?,?,?,?)");
            $queryEnrollment->bindParam(1, $student['id']);
            $queryEnrollment->bindParam(2, $id_section);
            $queryEnrollment->bindParam(3, $_date);
            $queryEnrollment->bindParam(4, $student['repeating_matters']);
            $queryEnrollment->execute();
            $result = $queryEnrollment->fetchAll();
            if (!empty($result)) {
                $id_enrollment = $result[0]['id'];
            } else {
                throw new Exception('No se ha podido realizar la matrícula');
            }
            $queryEnrollment->closeCursor();
            
            $queryDeleteServices = $this->db->prepare("CALL sp_delete_student_service_by_student_id (?)");
            $queryDeleteServices->bindParam(1, $student['id']);
            $queryDeleteServices->execute();
            $queryDeleteServices->closeCursor();
            
            if ($student['id_service'] !== null) {
                foreach ($student['id_service'] as $id_service) {
                    $queryService = $this->db->prepare("CALL sp_create_student_service (?,?)");
                    $queryService->bindParam(1, $student['id']);
                    $queryService->bindParam(2, $id_service);
                    $queryService->execute();
                    $queryService->closeCursor();
                }
            }
            
//            $this->db->commit();
            return $id_enrollment;
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->transactionActive = false;
            throw $e;
        }
    }
    
    public function commit() {
        if ($this->transactionActive) $this->db->commit();
    }
    
     public function rollBack() {
        if ($this->transactionActive) $this->db->rollBack();
    }

}
