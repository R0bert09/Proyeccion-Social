document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const confirmarContrasenaInput = document.getElementById('confirmarContrasena');

    const form = document.querySelector('form'); 

    form.addEventListener('submit', function (event) {
        if (passwordInput.value !== confirmarContrasenaInput.value) {
            event.preventDefault(); 
            alert('Las contraseñas no coinciden');
            confirmarContrasenaInput.classList.add('is-invalid'); 
        } else {
            confirmarContrasenaInput.classList.remove('is-invalid'); 
        }
    });
});
