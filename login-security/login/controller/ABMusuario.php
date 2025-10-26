<?php

class ABMUsuario
{
    // Método principal para manejar altas, bajas y modificaciones
    public function abm($datosUsuario)
    {
        $resp = false; // Inicializa la respuesta como falsa

        // Verifica si la acción es 'editar', si es así, llama al método `modificacion`
        if ($datosUsuario['accion'] == 'editar') {
            if ($this->modificacion($datosUsuario)) {
                $resp = true; // Cambia la respuesta a verdadera si la modificación es exitosa
            }
        }

        // Verifica si la acción es 'borrar', si es así, llama al método `baja`
        if ($datosUsuario['accion'] == 'borrar') {
            if ($this->baja($datosUsuario)) {
                $resp = true; // Cambia la respuesta a verdadera si la baja es exitosa
            }
        }

        // Verifica si la acción es 'nuevo', si es así, llama al método `alta`
        if ($datosUsuario['accion'] == 'nuevo') {
            if ($this->alta($datosUsuario)) {
                $resp = true; // Cambia la respuesta a verdadera si la alta es exitosa
            }
        }

        return $resp; // Devuelve el resultado de la operación
    }

    /**
     * Carga un objeto de la clase `Usuario` con los datos recibidos como parámetro
     * @param array $param
     * @return Usuario|null Devuelve un objeto Usuario o null si no se cumplen las condiciones
     */
    private function cargarObjeto($param)
    {
        $obj = null; // Inicializa el objeto como null

        // Verifica si existen las claves 'id', 'nombreUsuario', 'email', y 'password' en el array $param
        if (array_key_exists('id', $param) && array_key_exists('nombreUsuario', $param) &&
            array_key_exists('email', $param) && array_key_exists('password', $param)) {

            // Crea un nuevo objeto Usuario
            $obj = new Usuario();
            $obj->setear($param['id'], $param['nombreUsuario'], $param['email'], $param['password']); // Establece sus valores
        }
        return $obj; // Devuelve el objeto cargado o null si no se cargó
    }

    /**
     * Método para dar de alta un nuevo usuario en la base de datos
     * @param array $param
     * @return boolean Devuelve true si el alta fue exitosa, de lo contrario false
     */
    public function alta($param)
    {
        $resp = false;
        $param['id'] = null;
        $objTabla = $this->cargarObjeto($param);

        if ($objTabla != null) {
            echo "Objeto Usuario creado correctamente"; // Depuración
            if ($objTabla->insertar()) {
                $resp = true;
                echo "Inserción exitosa desde ABMUsuario"; // Depuración
            } else {
                echo "Fallo en la inserción desde ABMUsuario"; // Depuración
            }
        } else {
            echo "No se pudo crear el objeto Usuario"; // Depuración
        }
        return $resp;
    }

    /**
     * Permite eliminar un usuario de la base de datos
     * @param array $param
     * @return boolean Devuelve true si la eliminación fue exitosa, de lo contrario false
     */
    public function baja($param)
    {
        $resp = false; // Inicializa la respuesta como falsa

        // Verifica si están seteados los campos claves (id)
        if (isset($param['id'])) {
            $objTabla = new Usuario(); // Crea un nuevo objeto Usuario
            $objTabla->setear($param['id'], null, null, null); // Establece el id en el objeto

            // Si el objeto se creó correctamente y se elimina, devuelve true
            if ($objTabla != null && $objTabla->eliminar()) {
                $resp = true; // Cambia la respuesta a verdadera
            }
        }
        return $resp; // Devuelve true si la baja fue exitosa, de lo contrario false
    }

    /**
     * Permite modificar un usuario en la base de datos
     * @param array $param
     * @return boolean Devuelve true si la modificación fue exitosa, de lo contrario false
     */
    public function modificacion($param)
    {
        $resp = false; // Inicializa la respuesta como falsa

        // Verifica si están seteados los campos claves (id)
        if (isset($param['id'])) {
            $objTabla = $this->cargarObjeto($param); // Carga el objeto Usuario con los datos del array $param

            // Si el objeto se creó correctamente y se modifica, devuelve true
            if ($objTabla != null && $objTabla->modificar()) {
                $resp = true; // Cambia la respuesta a verdadera
            }
        }
        return $resp; // Devuelve true si la modificación fue exitosa, de lo contrario false
    }

    public function obtenerPorEmail($db, $email)
    {

        try {
            // Se define la consulta SQL para seleccionar todos los datos del usuario cuyo email coincida.
            $query = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";

            // Se prepara la consulta para prevenir inyecciones SQL y mejorar el rendimiento.
            $stmt = $db->prepare($query);

            // Se asocia el parámetro `:email` de la consulta con el valor de `$email` recibido en el método.
            $stmt->bindParam(':email', $email);

            // Ejecuta la consulta en la base de datos.
            $stmt->execute();

            // Obtiene el resultado de la consulta como un array asociativo.
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si no se encontró un usuario, devuelve `null`.
            if ($usuario === false) {
                return null;
            }

            // Si se encontró un usuario, lo devuelve como resultado.
            return $usuario;

        } catch (PDOException $e) {
            // Si ocurre un error en la base de datos, muestra un mensaje de error.
            echo "Error al obtener el usuario por email: " . $e->getMessage();

            // Devuelve `null` en caso de error.
            return null;
        }
    }

    /**
     * Permite buscar usuarios en la base de datos según criterios
     * @param array $param
     * @return array Devuelve un arreglo con los usuarios que coinciden con los criterios de búsqueda
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario =" . $param['idusuario'];
            }

            if (isset($param['usnombre'])) {
                $where .= " and usnombre ='" . $param['usnombre'] . "'";
            }

            if (isset($param['usmail'])) {
                $where .= " and usmail ='" . $param['usmail'] . "'";
            }

            if (isset($param['uspass'])) {
                $where .= " and uspass ='" . $param['uspass'] . "'";
            }

            if (isset($param['usdeshabilitado'])) {
                $where .= " and usdeshabilitado ='" . $param['usdeshabilitado'] . "'";
            }

        }
        $obj = new Usuario();
        $arreglo = $obj->listar($where);
        //echo "Van ".count($arreglo);
        return $arreglo;
    }
}
