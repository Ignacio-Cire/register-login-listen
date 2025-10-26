<?php
include_once './estructura/nav.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro con reCAPTCHA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/3.2.0/sha256.min.js"></script>

    
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-body">
                <h3 class="text-center mb-4">Registro</h3>
                <form id="miFormulario" action="./action/verificarRegistro.php"  method="POST">
                    <!-- Campo de Nombre de Usuario -->
                    <div class="form-group">
                        <label for="nombreUsuario"></label>
                        <input type="text" class="form-control" name="nombreUsuario" placeholder="Ingrese su nombre de usuario" required>
                    </div>
                    <!-- Campo de Email -->
                    <div class="form-group">
                        <label for="email"></label>
                        <input type="email" class="form-control" name="email" placeholder="Ingrese su email" required>
                    </div>
                    <!-- Campo de Clave -->
                    <div class="form-group">
                        <label for="password"></label>
                        <input type="password" class="form-control" name="password" placeholder="Ingrese su clave" required>
                    </div>
                    <!-- reCAPTCHA -->
                    <div class="form-group text-center">
                        <div class="g-recaptcha" data-sitekey="6LdbfOkrAAAAAKHw6cmJ4I2SkZksZ_gzU264PEwu"></div>
                    </div>
                    <!-- Botón de Registro -->
                    <button type="submit" class="btn btn-primary btn-block mt-4">Registrarse</button>
                    <!-- Enlace a Iniciar Sesión -->
                    <p class="text-center mt-3">
                        ¿Ya tienes cuenta? <a href="login.php">Inicia Sesión</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <?php
include_once './estructura/footer.php';
?>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="./utils/hashPassword.js"></script>  -->
</body>
</html>
