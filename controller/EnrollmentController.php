<?php

class EnrollmentController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Enrollment/';
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }

    public function enroll() {
        require_once 'model/EnrollmentModel.php';
        $enroll = new EnrollmentModel();
        
        //get student
        $id = filter_input(INPUT_POST, 'id');
        $card = filter_input(INPUT_POST, 'card');
        $name = filter_input(INPUT_POST, 'name');
        $first_lastname = filter_input(INPUT_POST, 'first_lastname');
        $second_lastname = filter_input(INPUT_POST, 'second_lastname');
        $birtdate = filter_input(INPUT_POST, 'birthdate');
        $gender = filter_input(INPUT_POST, 'gender');
        $nationality = filter_input(INPUT_POST, 'nationality');
        $personal_phone = filter_input(INPUT_POST, 'personal_phone');
        $other_phone = filter_input(INPUT_POST, 'other_phone');
        $mep_mail = filter_input(INPUT_POST, 'mep_mail');
        $other_mail = filter_input(INPUT_POST, 'other_mail');
        $id_district = filter_input(INPUT_POST, 'id_district');
        $direction = filter_input(INPUT_POST, 'direction');
        $suffering = filter_input(INPUT_POST, 'suffering');
        $id_adequacy = filter_input(INPUT_POST, 'id_adequacy');
        $is_imas_benefit = filter_input(INPUT_POST, 'is_imas_benefit');
        $is_teenage_father = filter_input(INPUT_POST, 'is_teenage_father');
        $is_working = filter_input(INPUT_POST, 'is_working');
        $is_sexual_matter = filter_input(INPUT_POST, 'is_sexual_matter');
        $is_ethics_matter = filter_input(INPUT_POST, 'is_ethics_matter');
        $contact_name = filter_input(INPUT_POST, 'contact_name');
        $contact_phone = filter_input(INPUT_POST, 'contact_phone');
        
        //parent data
        $id_parent = filter_input(INPUT_POST, 'id_parent');
        $card_parent = filter_input(INPUT_POST, 'card_parent');
        $full_name_parent = filter_input(INPUT_POST, 'full_name_parent');
        $nationality_parent = filter_input(INPUT_POST, 'nationality_parent');
        $ocupation_parent = filter_input(INPUT_POST, 'ocupation_parent');
        $work_place_parent = filter_input(INPUT_POST, 'work_place_parent');
        $phone_parent = filter_input(INPUT_POST, 'phone_parent');
        
        //enroll data
        $id_section = filter_input(INPUT_POST, 'id_section');
        $_date = date('Y-m-d H:i:s');
        $filter = array(
            'repeating_matters' => array(
                'flags'  => FILTER_REQUIRE_ARRAY
            )
        );
        $repeating_matters_list = filter_input_array(INPUT_POST, $filter)['repeating_matters'];

        //save as string in data persistence
        $repeating_matters = null;
        if($repeating_matters_list != null) {
            foreach ($repeating_matters_list as $matter) {
                if ($repeating_matters == null) {
                    $repeating_matters = "";
                }
                if($matter != end($repeating_matters_list)) {
                    $repeating_matters .= $matter . ', ';
                } else {
                    $repeating_matters .= $matter;
                }
            }
        }
        
        //service data
        $filter = array(
            'id_service' => array(
                'flags'  => FILTER_REQUIRE_ARRAY
            )
        );
        $id_service_list = filter_input_array(INPUT_POST, $filter)['id_service'];//save as mn relation in data persistance
        $id_route = filter_input(INPUT_POST, 'id_route');
        
        echo $enroll->enroll(
                $id, $card, $name, $first_lastname, $second_lastname, $birtdate,
                $gender, $nationality, $personal_phone, $other_phone, $mep_mail, 
                $other_mail, $id_district, $direction, $suffering, $id_adequacy, 
                $is_imas_benefit, $is_teenage_father, $is_working, $is_sexual_matter, 
                $is_ethics_matter, $contact_name, $contact_phone,//student
                $id_parent, $card_parent, $full_name_parent, $nationality_parent, 
                $ocupation_parent, $work_place_parent, $phone_parent,//parent
                $id_section, $_date, $repeating_matters,//enroll
                $id_service_list, null);//service
//        echo $is_working;
    }

}
