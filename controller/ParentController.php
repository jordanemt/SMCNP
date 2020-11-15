<?php

class ParentController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Parent/';
    }

    public function getByCard() {
        require_once 'model/ParentModel.php';
        $model = new ParentModel();

        $card = filter_input(INPUT_POST, 'card');
        echo json_encode($model->getByCard($card));
    }

}
