<?php
// Cargar config.php
require_once 'config/config.php';

// Load helper files
// Cargar los archivos con funciones helper
require_once 'helpers/redirect_helper.php';
require_once 'helpers/message_helper.php';
require_once 'helpers/login_helper.php';

// Autoloader para los archivos de libraries/
spl_autoload_register(function($className){
    require_once 'libraries/' . $className .'.php';
});