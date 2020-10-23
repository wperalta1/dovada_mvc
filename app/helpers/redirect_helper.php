<?php

// Función para redireccionar a otra view
function redirect($page){
    header('location: ' . URLROOT . '/' . $page);
    exit();
}