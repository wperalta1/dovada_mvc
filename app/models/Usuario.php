<?php

class Usuario { // No es necesario poner extends Database
    private $db;

    // Inicializo una nueva instancia de la clase Database
    public function __construct(){
        $this->db = new Database;
    }

    public function verificarUsuario($username){
        // Preparo la sentencia
        $this->db->query('SELECT * FROM usuarios WHERE usrUsername = :username');

        // Asigno los parámetros
        $this->db->bind(':username', $username);

        // Ejecuto la sentencia y recibo 1 sola fila
        $result = $this->db->getSingleRow();
        
        if($result){ // Si pude encontrar un usuario con ese username en la base de datos
            return true; // Devuelvo true
        }else{
            return false; // Si no existe un usuario con ese username devuelvo false
        }
    }

    public function login($username, $password){
        $this->db->query('SELECT * FROM usuarios WHERE usrUsername = :username');
        $this->db->bind(':username', $username);

        $result = $this->db->getSingleRow();

        
        if($result){ // Si existe en la base de datos un usuario con este username
            // Almaceno la password hasheada que está en la base de datos
            $hashedPassword = $result['usrPassword'];

            // Verifico si las dos passwords son iguales
            if(password_verify($password, $hashedPassword)){
                // Si son iguales, devuelvo la información del usuario
                return $result;
            }else{
                // Si las contraseñas no son iguales
                return false;
            }
        }else{ // Si el usuario no existe en la base de datos
            return false;
        }
    }

    public function alta($data){
        $this->db->query('INSERT INTO usuarios (usrNombre, usrEmail, usrUsername, usrPassword) VALUES (:nombre, :email, :username, :password)');

        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);

        $result = $this->db->execute();

        if($result){
            return true;
        }else{
            return false;
        }
    }
}