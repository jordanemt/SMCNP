<?php

class MatriculaController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Matricula/';
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }

    public function enroll() {
        require_once 'model/EnrollmentModel.php';
        $enroll = new EnrollmentModel();
        echo 'success';
    }

}
