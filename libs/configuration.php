<?php

require 'libs/Config.php';
$config = Config::singleton();
$config->set('controllerFolder', 'controller/');
$config->set('modelFolder', 'model/');
$config->set('viewFolder', 'view/');

$config->set('dbhost', 'localhost');
$config->set('dbname', 'smcnp');
$config->set('dbuser', 'root');
$config->set('dbpass', '');

define('USE_AUTHENTICATION', 1);
define('USERNAME', 'admin');
define('PASSWORD', 'Cnp1974*');