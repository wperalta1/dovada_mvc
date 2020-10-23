<?php

// Controllers -> plural

class Usuarios extends Controller {
    public function __construct(){
        // Acá se cargan los models
        // Cuando se quiere interactuar con la base de datos, se debe crear un model en app/models, e inicializarlo acá
        // Ejemplo donde se carga el model de Usuario: $this->usuarioModel = $this->model('Usuario');
        $this->usuarioModel = $this->model('Usuario');
    }

    public function register(){
        // Verificar si se recibió un POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Procesamiento del form

            // Recibo la información enviada a través del form
            $data = [
                'nombre' => trim($_POST['txtNombre']),
                'email' => trim($_POST['txtEmail']),
                'username' => trim($_POST['txtUsername']),
                'password' => trim($_POST['txtPassword']),
                'confirmPassword' => trim($_POST['txtConfirmPassword']),
                'nameError' => '',
                'emailError' => '',
                'usernameError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            // Validación
            if(empty($data['nombre'])){
                $data['nombreError'] = 'Por favor ingrese su nombre y apellido.';
            }

            if(empty($data['email'])){
                $data['emailError'] = 'Por favor ingrese su dirección de correo electrónico.';
            }

            if(empty($data['username'])){
                $data['usernameError'] = 'Por favor ingrese un nombre de usuario.';
            }else{ // Si el usuario ingresó un username
                // Verificar si el username ingresado ya está en uso
                if($this->usuarioModel->verificarUsuario($data['username'])){
                    $data['usernameError'] = 'Este nombre de usuario ya está en uso.';
                }
            }

            // Validación de password
            if(empty($data['password'])){
                $data['passwordError'] = 'Por favor ingrese una contraseña.';
            }else if(strlen($data['password']) < 6){
                $data['passwordError'] = 'La contraseña debe tener al menos 6 caracteres.';
            }

            // Validación de confirm password
            if(empty($data['confirmPassword'])){
                $data['confirmPasswordError'] = 'Por favor confirme su contraseña.';
            }else{
                if($data['password'] != $data['confirmPassword']){ // Si password y confirmPassword no son iguales
                    $data['confirmPasswordError'] = 'Las contraseñas no coinciden.';
                }
            }

            // If there are no errors
            if(empty($data['nombreError']) && empty($data['emailError']) && empty($data['usernameError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])){
                // Hasheo de la contraseña e inserción en la base de datos

                //Password hashing
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Inserto el nuevo usuario en la base datos, y verifico si salió todo bien
                if($this->usuarioModel->alta($data)){
                    notificar('usuariosAltaExito', 'Se ha registrado exitosamente el nuevo usuario.', 'success');
                    redirect('usuarios/login');
                }else{
                    die('error al insertar');
                }
            } else{
                // Si hay errores, cargar la view de Register de nuevo con información sobre los errores
                $this->view('usuarios/register', $data);
            }

        }else{
            $data = [
                'nombre' => '',
                'email' => '',
                'username' => '',
                'password' => '',
                'confirmPassword' => '',
                'nameError' => '',
                'emailError' => '',
                'usernameError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            // Cargar la view de Register
            $this->view('usuarios/register', $data); // No poner .php
        }
    }

    public function login(){
        // Verificar si se recibió un POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Procesamiento del form

            // Recibo la información enviada a través del form
            $data = [
                'username' => trim($_POST['txtUsername']),
                'password' => trim($_POST['txtPassword']),
                'usernameError' => '',
                'passwordError' => ''
            ];

            // Validación
            if(empty($data['username'])){
                $data['usernameError'] = 'Por favor ingrese su nombre de usuario.';
            }

            if(empty($data['password'])){
                $data['passwordError'] = 'Por favor ingrese su contraseña.';
            }

            // Verificar si existe el usuario
            if($this->usuarioModel->verificarUsuario($data['username'])){
                // Si el usuario existe, verificar si la contraseña es correcta y loguear el usuario
                $sesionIniciada = $this->usuarioModel->login($data['username'], $data['password']);

                if($sesionIniciada){ // Si las credenciales del usuario son correctas
                    // Almaceno la información del usuario en variables $_SESSION para usar en otras páginas
                    $_SESSION['usrId'] = $sesionIniciada['usrId'];
                    $_SESSION['usrUsername'] = $sesionIniciada['usrUsername'];
                    $_SESSION['usrNombre'] = $sesionIniciada['usrNombre'];
                    $_SESSION['usrEmail'] = $sesionIniciada['usrEmail'];

                    // Redirecciono a la view de Listado de Ordenanzas
                    redirect('ordenanzas');
                }else{ // Si la contraseña del usuario es incorrecta
                    $data['passwordError'] = 'La contraseña es incorrecta.';
                    $this->view('usuarios/login', $data);
                }
            }else{
                // Si el usuario no exise
                $data['usernameError'] = 'El usuario es incorrecto.';
            }

            // Verificar si hay errores
            if(empty($data['usernameError']) && empty($data['passwordError'])){
                // Si no hay errores
                die('success');
            } else{
                // Si hay errores, cargar la view de Login con información sobre los errores
                $this->view('usuarios/login', $data);
            }
        }else{ // Si no se recibió un POST
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];

            // Cargar la view de Login
            $this->view('usuarios/login', $data); // No poner .php
        }
    }

    public function logout(){
        // Elimino todas las variables $_SESSION del usuario
        unset($_SESSION['usrId']);
        unset($_SESSION['usrUsername']);
        unset($_SESSION['usrNombre']);
        unset($_SESSION['usrEmail']);

        // Elimino la sesión
        session_destroy();

        // Redirecciono a la view de Login
        redirect('usuarios/login');
    }
}