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
            
            //enrroll
//            $model = new EnrollmentModel();
//            $model->enroll($student, $id_section, $parent);
            
            //save files
            $this->saveFile('cedula', $student['card']);
            $this->saveFile('titulo_sexto', $student['card']);
            $this->saveFile('nota_nivel_anterior', $student['card']);
            $this->saveFile('titulo_noveno', $student['card']);
            $this->saveFile('carta_sexualidad', $student['card']);
            $this->saveFile('carta_etica', $student['card']);
            
            //gen vaucher
            require 'libs/Utilities/GeneradorPDF.php';
            $generador = new GenerarPDF();
            
//            $cursosPreferidos=array("Informática","Biología");
//            $cursosReprobados=array("Español","Ética");
//            $Estudiante=array(
//                'id'=>"0",
//                'card' => $student['card'],
//                'name' => $student['name'],
//                'first_lastname' => $student['first_lastname'],
//                'second_lastname' => $student['second_lastname'],
//                'birthdate' => $student['birthdate'],
//                "age"=>"17",
//                "months"=>"0",
//                'gender' => "M",
//                'nationality' => $student['nationality'],
//                'personal_phone' => $student['personal_phone'],
//                'other_phone' => $student['other_phone'],
//                'mep_mail' => $student['mep_mail'],
//                'other_mail' => $student['other_mail'],
//                'direction' => $student['direction'],
//                'contact_name' => $student['contact_name'],
//                'contact_phone' => $student['contact_phone'],
//                "suffering"=> $student['suffering'],
//                "id_adecuacy"=> $student['id_adequacy'],
//                "parent"=>array("card"=> $parent['card_parent'],"full_name"=>$parent['full_name_parent'],"ocupation"=>$parent['ocupation_parent'],"work_place"=>$parent['work_place_parent'],"phone"=>$parent['phone_parent']),
//                "enrollment"=>array("section"=>"7-1","_date"=>"20/10/2020","year"=>"2020","degree"=>"7")
//            );
            
            $cursosPreferidos = array("Informática", "Biología");
            $cursosReprobados = array("Español", "Ética");
            $Estudiante = array(
                'id' => "70000000",
                'card' => "7-0260-0723",
                'name' => "Justin",
                'first_lastname' => "Villalobos",
                'second_lastname' => "Espinoza",
                'birthdate' => "01/11/2021",
                "age" => "17",
                "months" => "0",
                'gender' => "M",
                'nationality' => "Costarricense",
                'personal_phone' => "88888888",
                'other_phone' => "88888888",
                'mep_mail' => "correo@correo.com",
                'other_mail' => "correo@correo.com",
                'direction' => "Direccion de la direccion",
                'contact_name' => "Daniela",
                'contact_phone' => "888888",
                "suffering"=>"Diabetes",
                "id_adecuacy"=>"0",
                "parent"=>array("card"=>"70000001","full_name"=>"Juan V V","ocupation"=>"Delegado","work_place"=>"Colono","phone"=>"8888888"),
                "enrollment"=>array("section"=>"A","_date"=>"20/10/2020","year"=>"2020","degree"=>"7")
            );
            
            $generador->initMethod($Estudiante, $cursosPreferidos, $cursosReprobados);
            
            require 'libs/Gmail.php';
            $gmail = new Gmail();
//            $gmail->sendMessage('jordanea02@gmail.com', 'Sistema de Matrícula', 'Colegio Nocturno de Pococí', 'Body', '', array('files/REQUISITOS PARA MATRICULA-2021.pdf'));
            
            echo 'Matrícula exitosa';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function saveFile($file_form_name, $folder_name) {
        if (isset($_FILES[$file_form_name])) {
            $file_name = $_FILES[$file_form_name]['name'];
            $file_tmp = $_FILES[$file_form_name]['tmp_name'];
            $file_size = $_FILES[$file_form_name]['size'];
            $file_error = $_FILES[$file_form_name]['error'];

            $file_ext = explode('.', $file_name);
            $file_actual_ext = strtolower(end($file_ext));

            $allowed = array('pdf', 'docx', 'png', 'jpg', 'jpeg');
            if (in_array($file_actual_ext, $allowed)) {
                if ($file_error === 0) {
                    if ($file_size < 500000) {
                        $folder_destination = 'report_files/' . $folder_name;
                        if (!file_exists($folder_destination)) {
                            mkdir($folder_destination, 0777, true);
                        }
                        $file_new_name = $file_form_name . '.' . $file_actual_ext;
                        $file_destination = $folder_destination . '/' . $file_new_name;
                        move_uploaded_file($file_tmp, $file_destination);
                    }
                }
            }
        }
    }

}
