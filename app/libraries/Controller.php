<?php


/*
 * Este es el controller principal, todos los controladores dentro de la carpeta controllers/ van a heredar este controller
 * Se encarga de cargar los modelos y views
 */

class Controller {
    // Load model
    // Cargar model
    // Esta función permite cargar model e instanciarlo
    public function model($model){
        // Cargar el archivo del model
        require_once '../app/models/' . $model . '.php';

        // Instanciar el model
        return new $model();
    }

    // Cargar view
    public function view($view, $data = []){
        // Verificar si el archivo de la view existe
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            // Si el archivo de la view no existe
            die('View does not exist');
        }
    }
}