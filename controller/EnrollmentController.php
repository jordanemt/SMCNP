<?php
require_once 'model/EnrollmentModel.php';
require_once 'model/DistrictModel.php';
require_once 'model/AdequacyModel.php';
require_once 'model/SectionModel.php';
require_once 'model/ServiceModel.php';
require_once 'model/RouteModel.php';
require_once 'model/StudentModel.php';

class EnrollmentController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Enrollment/';
    }

    public function index() {
        $districtModel = new DistrictModel();
        $adequacyModel = new AdequacyModel();
        $sectionModel = new SectionModel();
        $serviceModel = new ServiceModel();
        $routeModel = new RouteModel();
        
        $vars['district_list'] = $districtModel->getAll();
        $vars['adequacy_list'] = $adequacyModel->getAll();
        
        $section_list = $sectionModel->getAll();
        $vars['degree7'] = array();
        $vars['degree8'] = array();
        $vars['degree9'] = array();
        $vars['degree10'] = array();
        $vars['degree11'] = array();
        foreach ($section_list as $section) {
            array_push($vars['degree' . $section['degree']], $section);
        }
        
        $vars['service_list'] = $serviceModel->getAll();
        $vars['route_list'] = $routeModel->getAll();
        
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }
    
    public function enroll() {
        try {
            $filter = array(
                'filter' => FILTER_CALLBACK, 
                'options' => function ($input) {
                $filtered = filter_var($input, FILTER_SANITIZE_STRING);
                return $filtered ? $filtered: null; 
            });
            
            $filterStudent = array(
                'id' => $filter,
                'card' => $filter,
                'name' => $filter,
                'first_lastname' => $filter,
                'second_lastname' => $filter,
                'birthdate' => $filter,
                'gender' => $filter,
                'nationality' => $filter,
                'personal_phone' => $filter,
                'other_phone' => $filter,
                'mep_mail' => $filter,
                'other_mail' => $filter,
                'id_district' => $filter,
                'direction' => $filter,
                'suffering' => $filter,
                'id_adequacy' => $filter,
                'is_imas_benefit' => $filter,
                'is_working' => $filter,
                'is_sexual_matter' => $filter,
                'is_ethics_matter' => $filter,
                'is_teenage_father' => $filter,
                'contact_name' => $filter,
                'contact_phone' => $filter,
                'repeating_matters' => $filter,
                'id_service' => $filter,
                'id_route' => $filter
            );
            $student = filter_input_array(INPUT_POST, $filterStudent);
            
            //concat repeating matters
            if ($student['repeating_matters'] !== null) {
                $student['repeating_matters'] = join(', ', $student['repeating_matters']);
            }
            
            //tranform date
            $student['birthdate'] = date_format(date_create_from_format('d/m/Y', $student['birthdate']), 'Y-m-d');
            
            $id_section = filter_input(INPUT_POST, 'id_section');
            
            $filterParent = array(
                'id_parent' => $filter,
                'card_parent' => $filter,
                'full_name_parent' => $filter,
                'nationality_parent' => $filter,
                'ocupation_parent' => $filter,
                'work_place_parent' => $filter,
                'phone_parent' => $filter
            );
            $parent = filter_input_array(INPUT_POST, $filterParent);
            
            if ($student['id'] !== null) {
                $studentModel = new StudentModel();
                $studentModel->checkEnrollment($student['id']);
            }
            
            $model = new EnrollmentModel();
            $model->enroll($student, $id_section, $parent);
            echo 'Matrícula exitosa';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
