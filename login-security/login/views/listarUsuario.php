<?php
include_once '../controller/ABMUsuario.php'; // Incluye el controlador de usuarios

$abmUsuario = new ABMUsuario();
$usuarios = $abmUsuario->buscar(null); // Busca todos los usuarios
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Listado de Usuarios</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Usuario</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($usuarios) > 0): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario->getId(); ?></td>
                            <td><?php echo $usuario->getNombreUsuario(); ?></td>
                            <td><?php echo $usuario->getEmail(); ?></td>
                            <td><?php echo ($usuario->getDeshabilitado()) ? 'Deshabilitado' : 'Activo'; ?></td>
                            <td>
                                <!-- Botón para actualizar datos del usuario -->
                                <a href="../accion/actualizarLogin.php?id=<?php echo $usuario->getId(); ?>" class="btn btn-primary btn-sm">Actualizar</a>
                                
                                <!-- Botón para eliminar (borrado lógico) del usuario -->
                                <a href="../accion/eliminarLogin.php?id=<?php echo $usuario->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron usuarios registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
