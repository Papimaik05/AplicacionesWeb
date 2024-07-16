<?php 
require_once __DIR__.'/Aplicacion.php';

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');



define('BD_HOST', 'localhost');
define('BD_NAME', 'ejercicio3');
define('BD_USER', 'ejercicio3');
define('BD_PASS', 'ejercicio3');
$app = Aplicacion::getInstance();
$app->init(['host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS]);

register_shutdown_function([$app, 'shutdown']);
?>