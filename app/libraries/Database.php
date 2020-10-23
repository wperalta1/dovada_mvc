<?php

/*
 *  Clase Database que utiliza PDO
 *  Se encarga de:
 *      -Conectarse a la base de datos
 *      -Ejecutar sentencias parametrizadas
 *      -Vincular variables parametrizadas
 *      -Devolver rows y results
 */

class Database {
    private $host = DB_HOST;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $dbName = DB_NAME;

    private $dbHandler;
    private $stmt;
    private $error;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        
        $options = array(
            // Mantiene la conexión, mejora el rendimiento al chequear si ya hay una conexión a la base de datos
            PDO::ATTR_PERSISTENT => true,

            // Modos de error: silent, warning, exception
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Crear instancia PDO
        try{
            $this->dbHandler = new PDO($dsn, $this->username, $this->password, $options);
        }catch(PDOException $e){
            // Almacenar el mensaje de error de la excepción en el atributo $error
            $this->error = $e->getMessage();

            // Mostrar el error
            echo $this->error;
        }
    }

    // Esta función recibe una sentencia SQL, y la prepara
    public function query($sql){
        $this->stmt = $this->dbHandler->prepare($sql);
    }


    // Esta función se encarga de vincular variables parametrizadas con la sentencia SQL
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Ejecutar la sentencia preparada
    public function execute(){
        return $this->stmt->execute();
    }

    // Traer todos los rows como array asociativo
    public function getAllRows(){
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Traer sólo 1 row como array asociativo
    public function getSingleRow(){
        $this->execute();
        return $this->stmt->fetch();
    }

    // Obtener la cantidad de rows que devolvió la query
    public function recordCount(){
        return $this->stmt->rowCount();
    }
}