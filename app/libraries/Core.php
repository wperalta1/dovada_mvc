<?php

/*
 * Clase núcleo de la app
 * Crea URLs y carga el controller principal
 * FORMATO DE URLs: ejemplo.com/controller/method/params
 */ 

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        $url = $this->getUrl();

        // === Procesar el primer valor de la URL ===
            // Verificar si el primer valor de la URL (que debería ser el controller) existe en app/controllers
            if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                // Si el primer valor existe, almacenarlo como currentController
                $this->currentController = ucwords($url[0]);
                
                // Eliminar el primer valor de la URL
                unset($url[0]);
            }
            // Cargar el controller que fue enviado por la URL
            require_once '../app/controllers/' . $this->currentController . '.php';

            // Instanciar el controller
            // Si se envió 'ejemplo.com/ordenanzas' a la url, esta línea de código va a ser $ordenanzas = new Ordenanzas
            $this->currentController = new $this->currentController;
        // === /Procesar el primer valor de la url ===

        // === Procesar el segundo valor de la URL ===
            // Verificar si existe un segundo valor dentro de la URL
            if(isset($url[1])){
                // Verificar si el método existe dentro del controller
                if(method_exists($this->currentController, $url[1])){
                    // Si el método existe, almacenarlo como currentMethod
                    $this->currentMethod = $url[1];

                    // Eliminar el segundo valor de la URL
                    unset($url[1]);
                }
            }
        // === /Procesar el segundo valor de la URL ===

        // === Obtener todos los valores restantes de la URL ===
            // Si la URL tiene más parámetros, se van a almacenar en la propiedad params[], de otra forma params[] se va a quedar vacío
            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        // === /Obtener todos los valores restantes de la URL ===
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            // Remover todos los '/' del final de la url (por ej. ordenanzas/)
            $url = rtrim($_GET['url'], '/');

            // Eliminar caracteres que no funcionan con URLs
            $url = filter_var($url, FILTER_SANITIZE_URL);

            // Separar todos los valores de la URL y ponerlos dentro de un array (Ejemplo: ordenanzas/edit/1)
            $url = explode('/', $url);

            return $url;
        }
    }
}