<?php

class Ordenanza {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getOrdenanzas(){
        $this->db->query('SELECT * FROM ordenanzas JOIN usuarios ON ordenanzas.ordIdUsuario = usuarios.usrId ORDER BY ordenanzas.ordId DESC');
        $result = $this->db->getAllRows();

        return $result;
    }

    public function getOrdenanza($ordId){
        $this->db->query('SELECT * FROM ordenanzas WHERE ordId = :ordId');
        $this->db->bind(':ordId', $ordId);
        $result = $this->db->getSingleRow();
        return $result;
    }

    public function altaOrdenanza($nroOrdenanza, $year, $descripcion, $fileRuta, $nombrePdf, $usrId){
        $this->db->query('INSERT INTO ordenanzas (ordIdUsuario, ordNro, ordAño, ordDescripcion, ordRuta, ordNombrePdf) VALUES (:usrId, :nroOrdenanza, :year, :descripcion, :fileRuta, :nombrePdf)');

        //Vincular variables parametrizadas
        $this->db->bind(':usrId', $usrId);
        $this->db->bind(':nroOrdenanza', $nroOrdenanza);
        $this->db->bind(':year', $year);
        $this->db->bind(':descripcion', $descripcion);
        $this->db->bind(':fileRuta', $fileRuta);
        $this->db->bind(':nombrePdf', $nombrePdf);

        $result = $this->db->execute();

        if($result){
            return true;
        }else{
            return false;
        }
    }
}