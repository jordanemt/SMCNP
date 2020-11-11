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
            $ocupation_parent, $work_place_parent, $phone, //parent_data
            $id_section, $_date, $repeating_matters, //enroll_data
            $id_service, $id_route//student_service_data
    ) {
        try {
            $this->db->beginTransaction();
            
            if ($id_parent == 0) {
                $queryParent = $this->db->prepare('CALL sp_create_parent (' .
                        $card_parent . $full_name_parent . $nationality_parent .
                        $ocupation_parent . $work_place_parent . $phone .
                        ')');
                $queryParent->execute();
//                $id_parent = $query->fetchAll()[0]['id'];
                $queryParent->closeCursor();
            } else {
                $queryParent = $this->db->prepare('CALL sp_update_parent (' .
                        $id_parent . $full_name_parent . $nationality_parent .
                        $ocupation_parent . $work_place_parent . $phone .
                        ')');
                $queryParent->execute();
                $queryParent->closeCursor();
            }

            if ($id == 0) {
                $queryStudent = $this->db->prepare('CALL sp_create_student (' .
                        $card . $name . $first_lastname . $second_lastname . $birtdate . $gender .
                        $nationality . $personal_phone . $other_phone . $mep_mail . $other_mail .
                        $id_district . $direction . $suffering . $id_adequacy . $is_imas_benefit .
                        $is_teenage_father . $is_working . $is_sexual_matter . $is_ethics_matter .
                        $contact_name . $contact_phone . $id_parent .
                        ')');
                $queryStudent->execute();
//                $id = $query->fetchAll()[0]['id'];
                $queryStudent->closeCursor();
            } else {
                $query = $this->db->prepare('CALL sp_update_student (' .
                        $id . $name . $first_lastname . $second_lastname . $birtdate . $gender .
                        $nationality . $personal_phone . $other_phone . $mep_mail . $other_mail .
                        $id_district . $direction . $suffering . $id_adequacy . $is_imas_benefit .
                        $is_teenage_father . $is_working . $is_sexual_matter . $is_ethics_matter .
                        $contact_name . $contact_phone . $id_parent .
                        ')');
                $query->execute();
                $query->closeCursor();
            }
            
            $queryEnrollment = $this->db->prepare('CALL sp_create_enrollment (' .
                        $id_section . $_date . $repeating_matters .
                        ')');
            $queryEnrollment->execute();
            $queryEnrollment->closeCursor();
            
            $queryService = $this->db->prepare('CALL sp_create_enrollment (' .
                        $id . $id_service . $id_route .
                        ')');
            $queryService->execute();
            $queryService->closeCursor();

            $this->db->commit();
        } catch (mysqli_sql_exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

}
