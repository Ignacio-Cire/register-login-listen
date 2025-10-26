



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Actualizar Usuario</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="actualizarLogin.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">

            <div class="form-group">
                <label for="nombreUsuario">Nombre de Usuario</label>
                <input type="text" name="nombreUsuario" class="form-control" value="<?php echo $usuario->getNombreUsuario(); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $usuario->getEmail(); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Deja en blanco si no deseas cambiarla">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="../Vista/listarUsuario.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>