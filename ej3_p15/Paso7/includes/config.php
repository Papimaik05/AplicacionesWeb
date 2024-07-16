<?php 

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');



define('BD_HOST', 'localhost');
define('BD_NAME', 'ejercicio3');
define('BD_USER', 'ejercicio3');
define('BD_PASS', 'ejercicio3');


spl_autoload_register(function ($class) { // LO he sacado de lo que nos proporcionas https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
    
    $prefix = 'es\\ucm\\fdi\\aw\\'; //prefijo 
    $base_dir = __DIR__ . '/'; //base del directorio 

    //Comprobamos si la clase tiene el prefijo 

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        //Si no lo tiene nos movemos a otra
        return;
    }
    
    // Tener el nombre de la clase
    $relative_class = substr($class, $len);
    
    // Cambia el nombre del directorio por el de la clase
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    // Si existe el archivo,lo requiere
    if (file_exists($file)) {
        require $file;
    }
});

$app = es\ucm\fdi\aw\Aplicacion::getInstance();
$app->init(['host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS]);

register_shutdown_function([$app, 'shutdown']);
?>