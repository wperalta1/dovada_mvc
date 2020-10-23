<?php

// Esta función se encarga de verificar si el usuario inició sesión o no para prevenir accesos no autorizados
function usuarioLogueado(){
    if(isset($_SESSION['usrId'])){
        return true;
    }else{
        return false;
    }
}
