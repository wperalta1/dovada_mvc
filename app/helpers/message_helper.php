<?php
session_start();
// Función para mostrar mensaje / notificación de la operación que acaba de realizar el usuario
// MODO DE USO
//  -En controller:
        // 1. notificar('usuariosAltaExito', 'Se ha registrado exitosamente el nuevo usuario.', 'danger');
        // 2. redirect('usuarios/login');
//  - En view:
        // notificar('usuariosAltaExito');

// ESTRUCTURA:
// msg = usuariosAltaSuccess
// descripcion = Se ha creado exitosamente una nueva cuenta de usuario
// tipo = success / danger / warning / info, etc

function notificar($msg = '', $descripcion = '', $tipo = 'info'){
    if(!empty($msg)){
        if(!empty($descripcion) && empty($_SESSION[$msg])){
            if(!empty($_SESSION[$msg])){
                unset($_SESSION[$msg]);
            }

            if(!empty($_SESSION[$msg . '_class'])){
                unset($_SESSION[$msg . '_class']);
            }

            $_SESSION[$msg] = $descripcion;
            $_SESSION[$msg . '_class'] = 'alert alert-' . $tipo;
        }elseif(empty($descripcion) && !empty($_SESSION[$msg])){
            $tipo = !empty($_SESSION[$msg . '_class']) ? $_SESSION[$msg . '_class'] : '';
            echo '<div class="'. $tipo .'" id="msg-flash">'. $_SESSION[$msg] .'</div>';
            unset($_SESSION[$msg]);
            unset($_SESSION[$msg . '_class']);
        }
    }
}