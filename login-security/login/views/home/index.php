
<?php
include_once '../estructura/nav.php';
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Proyecto CAPTCHA</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4 text-center" style="width: 400px;">
            <h3 class="mb-4">Bienvenido</h3>
            <p>Por favor, selecciona una opción:</p>

            <!-- Enlace a la página de login -->
            <a href="../login.php" class="btn btn-primary btn-block mb-3">Iniciar Sesión</a>

            <!-- Enlace a la página de registro -->
            <a href="../registro.php" class="btn btn-secondary btn-block">Registrarse</a>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
