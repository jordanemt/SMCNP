<?php

class StudentController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Student/';
    }

    public function getByCard() {
        require_once 'model/StudentModel.php';
        $model = new StudentModel();

        $card = filter_input(INPUT_POST, 'card');
        echo json_encode($model->getByCard($card));
    }

}
