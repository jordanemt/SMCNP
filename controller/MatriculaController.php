<?php

class MatriculaController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Matricula/';
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }

}