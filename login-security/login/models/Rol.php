<?php

class Rol extends BaseDatos {
    private $idRol;
    private $roDescripcion;
    private $mensajeOperacion;

    public function __construct() {
        parent::__construct();
        $this->idRol = null;
        $this->roDescripcion = "";
        $this->mensajeOperacion = "";
    }

    // Métodos de seteo
    public function setear($idRol, $roDescripcion) {
        $this->setIdRol($idRol);
        $this->setRoDescripcion($roDescripcion);
    }

    // Getters y Setters
    public function getIdRol() {
        return $this->idRol;
    }

    public function setIdRol($valor) {
        $this->idRol = $valor;
    }

    public function getRoDescripcion() {
        return $this->roDescripcion;
    }

    public function setRoDescripcion($valor) {
        $this->roDescripcion = $valor;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($valor) {
        $this->mensajeOperacion = $valor;
    }

    // Método para insertar un nuevo rol
    public function insertar() {
        $resp = false;
        $sql = "INSERT INTO rol (roDescripcion) VALUES ('".$this->getRoDescripcion()."')";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError());
            }
        }
        return $resp;
    }

    // Método para modificar un rol
    public function modificar() {
        $resp = false;
        $sql = "UPDATE rol SET roDescripcion = '".$this->getRoDescripcion()."' WHERE idRol = ".$this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError());
            }
        }
        return $resp;
    }

    // Método para eliminar un rol
    public function eliminar() {
        $resp = false;
        $sql = "DELETE FROM rol WHERE idRol = ".$this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError());
            }
        }
        return $resp;
    }
}
