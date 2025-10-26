<?php
session_start();
include_once 'C:\xampp\htdocs\login-security\login\views\utils\funciones.php';
include_once '../../models/conector/BaseDatos.php';
include_once '../../controller/ABMusuario.php';

// Obtiene los datos enviados
$datos = datasubmitted();

if (!$datos) {
    echo 'No se recibieron datos. Por favor, intenta nuevamente.';
    exit;
}

if ($datos) {
    // Extrae los datos del formulario
    $email = $datos['email'];
    $password = $datos['password'];
    $captcha = $datos['g-recaptcha-response'];

    // Verifica si el CAPTCHA está presente
    if (!$captcha) {
        echo 'Por favor, verifica el CAPTCHA.';
        exit;
    }

    // Valida el CAPTCHA
    if (!validarCaptcha($captcha)) {
        echo 'Verificación CAPTCHA fallida. Inténtalo de nuevo.';
        exit;
    }

    // Crear una instancia de la base de datos
    $baseDatos = new BaseDatos();

    // Crear una instancia de Usuario
    $usuario = new ABMusuario();

    if ($baseDatos->Iniciar()) {
        // Llama a tu método para obtener el usuario por email
        $usuarioData = $usuario->obtenerPorEmail($baseDatos, $email); //

        if ($usuarioData) {
       
            if (password_verify($password, $usuarioData['password'])) { // Asegúrate de que el password esté en el array
                // Guarda la información del usuario en la sesión
                $_SESSION['usuario'] = $usuarioData['nombreUsuario']; // O cualquier otro campo que quieras guardar
                echo 'Inicio de sesión exitoso. Bienvenido, ' . $_SESSION['usuario'] . '.';
                header('Location: ../paginaSegura.php');
            } else {
                echo 'La contraseña es incorrecta. Inténtalo de nuevo.';
            }
        } else {
            echo 'No existe un usuario con ese email. Por favor, verifica e intenta nuevamente.';
        }
    } else {
        echo 'Error en la conexión a la base de datos.'; // Mensaje de error
    }

    exit();
}
