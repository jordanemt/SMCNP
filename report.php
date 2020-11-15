<?php

define('USE_AUTHENTICATION', 1);
define('USERNAME', 'admin');
define('PASSWORD', 'Cnp1974*');

if (USE_AUTHENTICATION == 1) {
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
            $_SERVER['PHP_AUTH_USER'] != USERNAME || $_SERVER['PHP_AUTH_PW'] != PASSWORD) {
        header('WWW-Authenticate: Basic');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    } else {
        require_once 'libs/configuration.php';
        require_once 'libs/Utility.php';
        require_once 'model/StudentModel.php';
        
        $studentModel = new StudentModel();
        $data = $studentModel->getStudentEnrollment();
        
        $utility = new Utility();
        $utility->generateReport($data);
    }
}