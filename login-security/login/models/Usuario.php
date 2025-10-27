<?php

class Usuario extends BaseDatos
{
    private $id;
    private $nombreUsuario;
    private $password;
    private $email;
    private $mensajeoperacion;

 
    public function __construct($nombreUsuario = "", $email = "", $password = "") {
        parent::__construct();
        $this->id = "";
        $this->nombreUsuario = $nombreUsuario;
        $this->email = $email;
        $this->password = $password;
        $this->mensajeoperacion = "";
    }

    public function setear($id, $nombreUsuario, $password, $email)
    {
        $this->setId($id);
        $this->setNombreUsuario($nombreUsuario);
        $this->setPassword($password);
        $this->setEmail($email);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($valor)
    {
        $this->id = $valor;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($valor)
    {
        $this->nombreUsuario = $valor;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($valor)
    {
        $this->password = $valor;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($valor)
    {
        $this->email = $valor;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }
    

    public function setMensajeOperacion($valor)
    {
        $this->mensajeoperacion = $valor;
    }

    public function insertar()
    {
        $resp = false;
        // La consulta SQL ahora usa "placeholders" (?)
        $sql = "INSERT INTO usuario (nombreUsuario, email, password) VALUES (?, ?, ?)";
    
        if ($this->Iniciar()) {
            // 1. Preparamos la consulta
            $stmt = $this->prepare($sql);
    
            // 2. Vinculamos los valores de forma segura
            $nombre = $this->getNombreUsuario();
            $email = $this->getEmail();
            $pass = $this->getPassword(); // Esta ya debe venir "hasheada"

            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $pass);
    
            // 3. Ejecutamos la consulta
            if ($stmt->execute()) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->errorInfo()[2]); // Captura el error de PDO
            }
        } else {
            $this->setMensajeOperacion("No se pudo iniciar la conexión");
        }
        return $resp;
    }




    //modificar usuario
   
public function modificar()
    {
        $resp = false;
        $sql = "UPDATE usuario SET nombreUsuario = ?, password = ?, email = ? WHERE id = ?";
        
        if ($this->Iniciar()) {
            $stmt = $this->prepare($sql);
            
            $nombre = $this->getNombreUsuario();
            $pass = $this->getPassword();
            $email = $this->getEmail();
            $id = $this->getId();

            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $pass);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $id);

            if ($stmt->execute()) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->errorInfo()[2]);
            }
        }
        return $resp;
    }




    /**
     * Busca en la base de datos y devuelve un arreglo de objetos Usuario.
     * 
     */
    public function listar($where = "1=1")
    {
        $arregloUsuarios = array();
        
        // No seleccionamos la contraseña por seguridad
        $sql = "SELECT id, nombreUsuario, email FROM usuario WHERE " . $where;

        if ($this->Iniciar()) {
            
            // 1. Ejecutamos la consulta. 
            // Tu método Ejecutar() llama a EjecutarSelect() y guarda el resultado.
            // Devuelve la cantidad de filas.
            $cantidad = $this->Ejecutar($sql);

            if ($cantidad > 0) {
                
                // 2. Iteramos sobre los resultados guardados
                // Tu método Registro() va entregando fila por fila
                while ($fila = $this->Registro()) {
                    
                    // 3. Creamos un objeto Usuario por cada fila
                    $obj = new Usuario();

                    // 4. Seteamos los datos usando los setters
                    $obj->setId($fila['id']);
                    $obj->setNombreUsuario($fila['nombreUsuario']);
                    $obj->setEmail($fila['email']);
                    
                    // 5. Agregamos el objeto al arreglo
                    array_push($arregloUsuarios, $obj);
                }
            }
        }

        
        return $arregloUsuarios;
    }



    //eliminar usuario
public function eliminar()
    {
        $resp = false;
        $sql = "DELETE FROM usuario WHERE id = ?";
        
        if ($this->Iniciar()) {
            $stmt = $this->prepare($sql);
            
            $id = $this->getId();
            $stmt->bindParam(1, $id);

            if ($stmt->execute()) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->errorInfo()[2]);
            }
        }
        return $resp;
    }
}
