<?php

// Parámetros de la base de datos
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'dovada_mvc');

// Dirección root de app - Esto devuelve root folder\app
define('APPROOT', dirname(dirname(__FILE__)));

// Dirección root de URL - Esto devuelve http://localhost/dovada_mvc
define('URLROOT', 'http://localhost/dovada_mvc');

define('ORDENANZAS_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/dovada_mvc/public/ordenanzasDigitales/');

// Nombre de la aplicación
define('SITENAME', 'Dovada MVC');

// Autor
define('AUTHOR_NAME', '<a href="https://wperalta.com.ar">Waldemar Peralta</a>');

// Correo
define('AUTHOR_EMAIL', 'Correo: waldeperalta1@gmail.com');

// Teléfono
define('AUTHOR_PHONE', 'Tel.: 0358 154 379609');

// Versión de la app
define('APP_VERSION', 'v1.0.0');
