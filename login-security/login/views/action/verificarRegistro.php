<?php
// 1. INICIAR SESIÓN 
session_start();

// 2. INCLUIR LAS CLASES
require_once '../../models/conector/BaseDatos.php';
require_once '../../models/Usuario.php';




// 3. VERIFICAR RECAPTCHA (¡Importante!)
// Esto es necesario porque lo tienes en tu formulario.
if (isset($_POST['g-recaptcha-response'])) {
    $secret = "6LdbfOkrAAAAAI_jykoYr2XNDclhDaGNfF-v40-i"; // 
    $response = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];
    
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $data = file_get_contents($url);
    $row = json_decode($data, true);

    if (!$row['success']) {
        // El reCAPTCHA falló
        $_SESSION['mensaje_error'] = 'Verificación de reCAPTCHA fallida. Inténtalo de nuevo.';
        header('Location: ../registro.php'); // Devuelve al usuario al formulario
        exit();
    }
} else {
    $_SESSION['mensaje_error'] = 'Por favor, completa el reCAPTCHA.';
    header('Location: ../registro.php'); // Devuelve al usuario
    exit();
}

// 4. CAPTURAR DATOS DEL POST .
// Las variables $username, $email, $password no existen mágicamente.
// Debes obtenerlas del array $_POST.
if (isset($_POST['nombreUsuario']) && isset($_POST['email']) && isset($_POST['password'])) {

    $username = $_POST['nombreUsuario']; // El 'name' de tu input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // --- El resto del código ---

    $baseDatos = new BaseDatos();
    
    // (PASSWORD_DEFAULT es más moderno y seguro que MD5)
    $usuario = new Usuario($username, $email, password_hash($password, PASSWORD_DEFAULT)); 

    if ($baseDatos->Iniciar()) {
        
        // 5. LLAMADA A INSERTAR (Ajustado)
        // Tu clase Usuario extiende BaseDatos (según tu constructor),
        // así que no necesitas pasar $baseDatos como parámetro.
        // El método insertar() ya tiene acceso a la conexión.
        if ($usuario->insertar()) { 
            
            $_SESSION['mensaje'] = 'Registro exitoso. Puedes iniciar sesión ahora.';
            header('Location: ../login.php');
            exit();
        } else {
            // Error más específico
            echo 'Error al registrar el usuario: ' . $usuario->getMensajeOperacion();
        }
    } else {
        echo 'Error en la conexión a la base de datos.';
    }

    exit();

} else {
    echo 'Error: Faltan datos del formulario.';
    exit();
}
?>