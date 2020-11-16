<?php
require_once 'libs/configuration.php';

if (USE_AUTHENTICATION == 1) {
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
            $_SERVER['PHP_AUTH_USER'] != USERNAME || $_SERVER['PHP_AUTH_PW'] != PASSWORD) {
        header('WWW-Authenticate: Basic');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Debe autenticar';
        exit;
    } else {
        try {
            require_once 'libs/Utility.php';
            $utility = new Utility();
            $utility->generateReport();
        } catch (Exception $e) {
            echo 'Error inesperado';
        }
    }
}