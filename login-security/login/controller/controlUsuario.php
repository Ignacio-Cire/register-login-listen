<?php

class ControlUsuario {
    private $abmUsuario;

    public function __construct() {
        $this->abmUsuario = new ABMUsuario(); // Instancia de la clase ABMUsuario
    }

    public function gestionarUsuario($datosUsuario) {
        // Verifica la acción y delega la operación a la clase ABMUsuario
        if ($datosUsuario['accion'] == 'nuevo' || $datosUsuario['accion'] == 'editar' || $datosUsuario['accion'] == 'borrar') {
            $resultado = $this->abmUsuario->abm($datosUsuario);
            return $resultado;
        } else if ($datosUsuario['accion'] == 'buscar') {
            $resultado = $this->abmUsuario->buscar($datosUsuario);
            return $resultado;
        }
        return false; // Si la acción no es reconocida, devuelve false
    }
}

?>
