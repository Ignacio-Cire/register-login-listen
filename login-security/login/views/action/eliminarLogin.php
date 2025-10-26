<?php
include_once '../controller/ABMusuario.php'; // Incluye el controlador ABMUsuario

$abmUsuario = new ABMusuario();

// Llama a la función para obtener los datos enviados
$datos = datasubmitted(); 

if (isset($datos['id'])) {
    // Verifica si se proporcionó un ID
    $id = $datos['id'];

    // Prepara los datos para la baja lógica
    $datosUsuario = [
        'id' => $id,
        'accion' => 'borrar' // Acción de borrado
    ];

    $resultado = $abmUsuario->abm($datosUsuario); // Llama al método abm para realizar la baja lógica

    if ($resultado) {
        header('Location: ../Vista/listarUsuario.php?mensaje=eliminado'); // Redirige al listado si fue exitoso
        exit();
    } else {
        echo "Hubo un problema al eliminar el usuario";
    }
} else {
    echo "ID de usuario no proporcionado";
    exit();
}
?>
