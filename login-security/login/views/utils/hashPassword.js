
// Espera a que el documento HTML esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function() {

    // Obtiene el formulario por su ID
    const formulario = document.getElementById('miFormulario');

    // Escucha el evento 'submit' en el formulario
    formulario.addEventListener('submit', function(event) {

        // Evita el envío del formulario para procesarlo antes
        event.preventDefault();

        // Obtiene el valor del campo de contraseña
        const passwordInput = formulario.querySelector('input[name="password"]');
        const password = passwordInput.value;

        // Aplica hash SHA-256 a la contraseña para mayor seguridad
        const shaObj = new jsSHA("SHA-256", "TEXT");
        shaObj.update(password);
        const hashedPassword = shaObj.getHash("HEX");

        // Sustituye el valor del campo de contraseña con el hash
        passwordInput.value = hashedPassword;

        // Ahora que la contraseña está hasheada, se envía el formulario
        formulario.submit();
    });
});
