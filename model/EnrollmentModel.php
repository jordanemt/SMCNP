<?php

class EnrollmentModel {

    protected $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
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
            $queryEnrollment->closeCursor();
            
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
        } catch (Exception $e) {
            $this->db->rollBack();
            return 'error';
        }
    }

}
