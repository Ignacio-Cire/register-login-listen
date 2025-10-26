

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío inmediato del formulario

    // Captura los datos del formulario
    const formData = new FormData(this);

    // Envía la solicitud de login al servidor para verificar el CAPTCHA y los datos
    fetch('./action/verificarLogin.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes('Inicio de sesión exitoso')) { // Mensaje de éxito del servidor
            // Muestra la alerta de confirmación de Recordarme
            const rememberUser = confirm("¿Desea que recordemos su usuario para futuras sesiones?");
            
            if (rememberUser) {
                // Agrega el campo 'remember_me' y vuelve a enviar el formulario
                formData.append('remember_me', '1');
                fetch('./action/verificarLogin.php', {
                    method: 'POST',
                    body: formData
                });
            }
            alert(data); // Mensaje de bienvenida del servidor
        } else {
            alert(data); // Mensaje de error en caso de fallo
        }
    });
});
