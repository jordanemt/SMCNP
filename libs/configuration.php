<?php
require 'libs/Config.php';

//frontcontroller_pattern
$config = Config::singleton();
$config->set('controllerFolder', 'controller/');
$config->set('modelFolder', 'model/');
$config->set('viewFolder', 'view/');

//pdo
$config->set('dbhost', 'localhost');
$config->set('dbname', 'smcnp');
$config->set('dbuser', 'root');
$config->set('dbpass', 'cdxPOI1209.ubr');

//gmail
$config->set('gmailUser', 'matriculaencnp@gmail.com');
$config->set('gmailPass', 'Cnp1974*');
$config->set('gmailHost', 'smtp.gmail.com');
$config->set('gmailPort', '587');
$config->set('gmailAuth', 'true');
$config->set('gmailSecure', 'tls');