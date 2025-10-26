<?php

class Session {

    public function __construct() {
        // Inicia la sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Inicia la sesión con un usuario y contraseña
     * @param $nombreUsuario
     * @param $psw
     * @return bool
     */
    public function iniciar($nombreUsuario,$psw){
        $resp = false;
        $obj = new ABMUsuario();
        $param['usnombre']=$nombreUsuario;
        $param['uspass']=$psw;
        $param['usdeshabilitado']='0000-00-00 00:00:00';

        $resultado = $obj->buscar($param);
        if(count($resultado) > 0){
            $usuario = $resultado[0];
            $_SESSION['idusuario']=$usuario->getidusuario();
            $resp = true;
        } else {
            $this->cerrar();
        }
        return $resp;
    }
    

    /**
     * Valida si la sesión actual tiene un usuario y contraseña válidos
     * @return bool
     */
    public function validar(){
        $resp = false;
        if($this->activa() && isset( $_SESSION['idusuario']))
            $resp=true;
        return $resp;
    }

    /**
     * Verifica si la sesión está activa
     * @return bool
     */
    public function activa(){
        $resp = false;
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                $resp = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                $resp = session_id() === '' ? FALSE : TRUE;
            }
        }
        return $resp;
    }

    /**
     * Devuelve el usuario logeado
     * @return mixed
     */
    public function getUsuario() {
        if ($this->validar()) {
            return $_SESSION['nombreUsuario'];
        }
        return null;
    }

    /**
     * Devuelve el rol del usuario logeado
     * @return mixed
     */
    public function getRol() {
        if ($this->validar()) {
            return $_SESSION['rol'];
        }
        return null;
    }

    /**
     * Cierra la sesión actual
     */
    public function cerrar(){
        $resp = true;
        session_destroy();
        //$_SESSION['idusuario']=null;
        return $resp;
    }
   

    
}
