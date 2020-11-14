<?php

class EnrollmentModel {

    protected $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }
    
    public function getAllDistrict() {
        $query = $this->db->prepare("CALL sp_read_all_district ()");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }
    
    public function getAllAdequacy() {
        $query = $this->db->prepare("CALL sp_read_all_adequacy ()");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }
    
    public function getAllSection() {
        $query = $this->db->prepare("CALL sp_read_all_section ()");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }
    
    public function getAllService() {
        $query = $this->db->prepare("CALL sp_read_all_service ()");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }
    
    public function getAllRoute() {
        $query = $this->db->prepare("CALL sp_read_all_route ()");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }
    
    public function getStudentByCard($card) {
        $query = $this->db->prepare("CALL sp_read_student_by_card (?)");
        $query->bindParam(1, $card);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        if (!empty($result)) return $result[0];
    }
    
    public function getParentByCard($card) {
        $query = $this->db->prepare("CALL sp_read_parent_by_card (?)");
        $query->bindParam(1, $card);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        if (!empty($result)) return $result[0];
    }

    public function enroll(
            $id, $card, $name, $first_lastname, $second_lastname, $birtdate, $gender,
            $nationality, $personal_phone, $other_phone, $mep_mail, $other_mail,
            $id_district, $direction, $suffering, $id_adequacy, $is_imas_benefit,
            $is_teenage_father, $is_working, $is_sexual_matter, $is_ethics_matter,
            $contact_name, $contact_phone, //student_data
            $id_parent, $card_parent, $full_name_parent, $nationality_parent,
            $ocupation_parent, $work_place_parent, $phone_parent, //parent_data
            $id_section, $_date, $repeating_matters, //enroll_data
            $id_service_list, $id_route//student_service_data
    ) {
        try {
            $this->db->beginTransaction();
            
            //check student dont do enroll
            if ($id != "") {
                $query = $this->db->prepare("CALL sp_read_all_enrollment ()");
                $query->execute();
                $enrollment_list = $query->fetchAll();
                $query->closeCursor();
                foreach ($enrollment_list as $enroll) {
                    $year = date_format(date_create_from_format('Y-m-d', $enroll['_date']), "Y");
                    if ($year == date("Y") && $id == $enroll['id_student']) {
                        throw new Exception('Usted ya realizó una matricula');
                        die();
                    }
                }
            }
            
            //insert_udpate parent
            if ($id_parent == "" && $card_parent != "") {
                $queryParent = $this->db->prepare("CALL sp_create_parent (?,?,?,?,?,?)");
                $queryParent->bindParam(1, $card_parent);
                $queryParent->bindParam(2, $full_name_parent);
                $queryParent->bindParam(3, $nationality_parent);
                $queryParent->bindParam(4, $ocupation_parent);
                $queryParent->bindParam(5, $work_place_parent);
                $queryParent->bindParam(6, $phone_parent);
                $queryParent->execute();
                $id_parent = $queryParent->fetchAll()[0]['id'];
                $queryParent->closeCursor();
            } else if ($card_parent != "") {
                $queryParent = $this->db->prepare("CALL sp_update_parent (?,?,?,?,?,?)");
                $queryParent->bindParam(1, $id_parent);
                $queryParent->bindParam(2, $full_name_parent);
                $queryParent->bindParam(3, $nationality_parent);
                $queryParent->bindParam(4, $ocupation_parent);
                $queryParent->bindParam(5, $work_place_parent);
                $queryParent->bindParam(6, $phone_parent);
                $queryParent->execute();
                $queryParent->closeCursor();
            } else {
                $id_parent = null;
            }
            
//            insert_udpate student
            if ($id == "") {
                $queryStudent = $this->db->prepare("CALL sp_create_student ("
                        . "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $queryStudent->bindParam(1, $card);
                $queryStudent->bindParam(2, $name);
                $queryStudent->bindParam(3, $first_lastname);
                $queryStudent->bindParam(4, $second_lastname);
                $queryStudent->bindParam(5, $birtdate);
                $queryStudent->bindParam(6, $gender);
                $queryStudent->bindParam(7, $nationality);
                $queryStudent->bindParam(8, $personal_phone);
                $queryStudent->bindParam(9, $other_phone);
                $queryStudent->bindParam(10, $mep_mail);
                $queryStudent->bindParam(11, $other_mail);
                $queryStudent->bindParam(12, $id_district);
                $queryStudent->bindParam(13, $direction);
                $queryStudent->bindParam(14, $suffering);
                $queryStudent->bindParam(15, $id_adequacy);
                $queryStudent->bindParam(16, $is_imas_benefit);
                $queryStudent->bindParam(17, $is_teenage_father);
                $queryStudent->bindParam(18, $is_working);
                $queryStudent->bindParam(19, $is_sexual_matter);
                $queryStudent->bindParam(20, $is_ethics_matter);
                $queryStudent->bindParam(21, $contact_name);
                $queryStudent->bindParam(22, $contact_phone);
                $queryStudent->bindParam(23, $id_route);
                $queryStudent->bindParam(24, $id_parent);
                $queryStudent->execute();
                $id = $queryStudent->fetchAll()[0]['id'];
                $queryStudent->closeCursor();
            } else {
                $queryStudent = $this->db->prepare("CALL sp_update_student ("
                        . "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $queryStudent->bindParam(1, $id);
                $queryStudent->bindParam(2, $name);
                $queryStudent->bindParam(3, $first_lastname);
                $queryStudent->bindParam(4, $second_lastname);
                $queryStudent->bindParam(5, $birtdate);
                $queryStudent->bindParam(6, $gender);
                $queryStudent->bindParam(7, $nationality);
                $queryStudent->bindParam(8, $personal_phone);
                $queryStudent->bindParam(9, $other_phone);
                $queryStudent->bindParam(10, $mep_mail);
                $queryStudent->bindParam(11, $other_mail);
                $queryStudent->bindParam(12, $id_district);
                $queryStudent->bindParam(13, $direction);
                $queryStudent->bindParam(14, $suffering);
                $queryStudent->bindParam(15, $id_adequacy);
                $queryStudent->bindParam(16, $is_imas_benefit);
                $queryStudent->bindParam(17, $is_teenage_father);
                $queryStudent->bindParam(18, $is_working);
                $queryStudent->bindParam(19, $is_sexual_matter);
                $queryStudent->bindParam(20, $is_ethics_matter);
                $queryStudent->bindParam(21, $contact_name);
                $queryStudent->bindParam(22, $contact_phone);
                $queryStudent->bindParam(23, $id_route);
                $queryStudent->bindParam(24, $id_parent);
                $queryStudent->execute();
                $queryStudent->closeCursor();
            }
            
            $queryEnrollment = $this->db->prepare("CALL sp_create_enrollment (?,?,?,?)");
            $queryEnrollment->bindParam(1, $id);
            $queryEnrollment->bindParam(2, $id_section);
            $queryEnrollment->bindParam(3, $_date);
            $queryEnrollment->bindParam(4, $repeating_matters);
            $queryEnrollment->execute();
            $id_enrollment = $queryEnrollment->fetchAll()[0]['id'];
            $queryEnrollment->closeCursor();
            
            $queryDeleteServices = $this->db->prepare("CALL sp_delete_student_service_by_student_id (?)");
            $queryDeleteServices->bindParam(1, $id);
            $queryDeleteServices->execute();
            $queryDeleteServices->closeCursor();
            
            if ($id_service_list ==! null) {
                foreach ($id_service_list as $id_service) {
                    $queryService = $this->db->prepare("CALL sp_create_student_service (?,?)");
                    $queryService->bindParam(1, $id);
                    $queryService->bindParam(2, $id_service);
                    $queryService->execute();
                    $queryService->closeCursor();
                }
            }
            
            $this->db->commit();
            return $id_enrollment;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

}
