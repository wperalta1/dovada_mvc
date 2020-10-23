<?php

// Este es el controller que se carga por defecto, y controla qué views se cargan
// Controllers -> plural

class Pages extends Controller {
    public function __construct(){
    }

    public function index(){ // Este es el método que se carga por defecto
        if(usuarioLogueado()){
            redirect('ordenanzas');
        }

        // Estructura para pasar datos a la view
        $data = [
            'title' => SITENAME,
            'description' => 'Esta es una aplicación CRUD para gestionar la carga de ordenanzas digitales, utilizando una framework MVC simple.'
        ];

        $this->view('pages/index', $data);
    }

    public function about(){
        $data = [
            'title' => 'Acerca de ' . SITENAME,
            'description' => 'CRUD APP diseñada con la estructura MVC, desarrollada por: <b>' . AUTHOR_NAME . '</b>'
        ];

        $this->view('pages/about', $data);
    }
}