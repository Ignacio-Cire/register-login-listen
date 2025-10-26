<?php

class UsuarioRol extends BaseDatos {
    private $idUsuario;
    private $idRol;
    private $mensajeOperacion;

    public function __construct() {
        parent::__construct();
        $this->idUsuario = null;
        $this->idRol = null;
        $this->mensajeOperacion = "";
    }

    // Métodos de seteo
    public function setear($idUsuario, $idRol) {
        $this->setIdUsuario($idUsuario);
        $this->setIdRol($idRol);
    }

    // Getters y Setters
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($valor) {
        $this->idUsuario = $valor;
    }   

    public function getIdRol() {
        return $this->idRol;
    }

    public function setIdRol($valor) {
        $this->idRol = $valor;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($valor) {
        $this->mensajeOperacion = $valor;
    }

    // Método para insertar una relación usuario-rol
    public function insertar() {
        $resp = false;
        $sql = "INSERT INTO usuariorol (idUsuario, idRol) VALUES ('".$this->getIdUsuario()."', '".$this->getIdRol()."')";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError());
            }
        }
        return $resp;
    }

    // Método para eliminar una relación usuario-rol
    public function eliminar() {
        $resp = false;
        $sql = "DELETE FROM usuariorol WHERE idUsuario = ".$this->getIdUsuario()." AND idRol = ".$this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError());
            }
        }
        return $resp;
    }

    // Método para obtener el rol de un usuario
    public function seleccionar() {
        $sql = "SELECT * FROM usuariorol WHERE idUsuario = ".$this->getIdUsuario();
        if ($this->Iniciar()) {
            $resultado = $this->Ejecutar($sql);
            if ($resultado) {
                $fila = $resultado->fetch_assoc();
                if ($fila) {
                    $this->setear($fila['idUsuario'], $fila['idRol']);
                    return true;
                }
            } else {
                $this->setMensajeOperacion($this->getError());
            }
        }
        return false;
    }
}
