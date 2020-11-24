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
        $model = new EnrollmentModel();
        try {
            require_once 'libs/Utility.php';
            $utility = new Utility();

            $filter = array(
                'filter' => FILTER_CALLBACK,
                'options' => function ($input) {
                    $filtered = filter_var($input, FILTER_SANITIZE_STRING);
                    return $filtered ? $filtered : null;
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
            $repeating_matters_original = array();
            if ($student['repeating_matters'] !== null) {
                $repeating_matters_original = $student['repeating_matters'];
                $student['repeating_matters'] = join(', ', $student['repeating_matters']);
            }

            //tranform date
            $birthdate_original = $student['birthdate'];
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
            
            //save files
            $utility->saveFile('cedula', $student['card']);
            $utility->saveFile('titulo_sexto', $student['card']);
            $utility->saveFile('nota_nivel_anterior_sexto', $student['card']);
            $utility->saveFile('nota_nivel_anterior_septimo', $student['card']);
            $utility->saveFile('nota_nivel_anterior_octavo', $student['card']);
            $utility->saveFile('nota_nivel_anterior_noveno', $student['card']);
            $utility->saveFile('nota_nivel_anterior_decimo', $student['card']);
            $utility->saveFile('titulo_noveno', $student['card']);
            $utility->saveFile('carta_sexualidad', $student['card']);
            $utility->saveFile('carta_etica', $student['card']);
            
            //enrroll
            $id_enroll = $model->enroll($student, $id_section, $parent);
            date_default_timezone_set('America/Costa_Rica');
            $from = new DateTime(date_format(date_create_from_format('Y-m-d', $student['birthdate']), 'Y-m-d'));
            $to = new DateTime('today');
            $age = $from->diff($to)->y;
            $months = $from->diff($to)->m;

            $sectionModel = new SectionModel();
            $section = $sectionModel->getById($id_section);

            $districtModel = new DistrictModel();
            $district = $districtModel->getById($student['id_district']);

            $workshop789 = ($section['degree'] != 11 && $section['degree'] != 10) ? $section['workshops'] : '';
            $workshop11 = ($section['degree'] == 11) ? $section['workshops'] : '';

            $cursosPreferidos = array((($section['degree'] != 10) ? $section['workshops'] : ''));
            $Estudiante = array(
                'id' => "0",
                'card' => $student['card'],
                'name' => $student['name'],
                'first_lastname' => $student['first_lastname'],
                'second_lastname' => $student['second_lastname'],
                'birthdate' => $birthdate_original,
                "age" => $age,
                "months" => $months,
                'gender' => substr($student['gender'], 0, 1),
                'nationality' => $student['nationality'],
                'personal_phone' => $student['personal_phone'],
                'other_phone' => (isset($student['other_phone'])) ? $student['other_phone'] : '',
                'mep_mail' => $student['mep_mail'] . ((isset($student['other_mail']))? '/' . $student['other_mail'] : ''),
                'other_mail' => (isset($student['other_mail'])) ? $student['other_mail'] : '',
                'direction' => $student['direction'],
                'contact_name' => $student['contact_name'],
                'contact_phone' => $student['contact_phone'],
                "suffering" => (isset($student['suffering'])) ? $student['suffering'] : '',
                "id_adecuacy" => (isset($student['id_adequacy'])) ? true : false,
                "district" => $district['name'],
                "workshop11" => $workshop11,
                "workshop789" => $workshop789,
                "parent" => array(
                    "card" => (isset($parent['card_parent'])) ? $parent['card_parent'] : '',
                    "full_name" => (isset($parent['full_name_parent'])) ? $parent['full_name_parent'] : '',
                    "ocupation" => (isset($parent['ocupation_parent'])) ? $parent['ocupation_parent'] : '',
                    "work_place" => (isset($parent['work_place_parent'])) ? $parent['work_place_parent'] : '',
                    "phone" => (isset($parent['phone_parent'])) ? $parent['phone_parent'] : ''),
                "enrollment" => array(
                    "id" => str_pad($id_enroll, 4, '0', STR_PAD_LEFT),
                    "section" => $section['name'],
                    "_date" => date_format($to, 'd/m/Y'),
                    "year" => date_format($to, 'Y'),
                    "degree" => $section['degree'])
            );

            $utility->createVaucher($Estudiante, $cursosPreferidos, $repeating_matters_original);

            $fromMessage = "Colegio Nocturno de Pococí";
            $subjectMessage = "Comprobante de Matrícula No " . str_pad($id_enroll, 4, '0', STR_PAD_LEFT);
            $bodyMessage = "Estimad" . (($student['gender'] == 'MASCULINO') ? "o " : "a ") .
                    $student['name'] . " " . $student['first_lastname'] . " " . $student['second_lastname'] . ", " .
                    "el Colegio Nocturno de Pococí le agradece concedernos la responsabilidad de su formación académica en el próximo " .
                    "curso lectivo 2021 en nuestra institución.\nAcá le remitimos el comprobante de matrícula en línea y debe presentarse " .
                    "en el Colegio y entregar este documento firmado, así como los documentos originales para hacer oficial la matrícula en el Colegio.\n" .
                    "Usted puede hacer entrega estos documentos cuando pueda llevarlos físicamente al Colegio.\nSaludos atentos,\nColegio Nocturno de Pococí.";

            if (isset($student['mep_mail'])) {
                $mail = $student['mep_mail'];
                $comprobante_direction = 'report_files/' . $student['card'] . '/comprobante.pdf';
                $utility->sendGmailMail($mail, $fromMessage, $subjectMessage, $bodyMessage, array('public/files/Requisitos.jpeg', $comprobante_direction));
            }
            if (isset($student['other_mail'])) {
                $mail = $student['other_mail'];
                $comprobante_direction = 'report_files/' . $student['card'] . '/comprobante.pdf';
                $utility->sendGmailMail($mail, $fromMessage, $subjectMessage, $bodyMessage, array('public/files/Requisitos.jpeg', $comprobante_direction));
            }
            
            $model->commit();
            echo 'Matrícula exitosa';
        } catch (Exception $e) {
            $model->rollBack();
            echo $e->getMessage();
        }
    }

}
