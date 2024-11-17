document.addEventListener('DOMContentLoaded', function () {
  const passwordInput = document.querySelector('#password');
  const confirmarContrasenaInput = document.querySelector('#confirmarContrasena');
  const form = document.querySelector('form');

  form.addEventListener('submit', function (event) {
      // Verificar si las contraseñas coinciden
      if (passwordInput.value !== confirmarContrasenaInput.value) {
          event.preventDefault(); // Evitar el envío del formulario
          alert('Las contraseñas no coinciden. Por favor, verifica e intenta nuevamente.');
          confirmarContrasenaInput.classList.add('is-invalid');
          confirmarContrasenaInput.value = ''; // Limpiar el campo
          confirmarContrasenaInput.focus(); // Enfocar el campo
      } else {
          confirmarContrasenaInput.classList.remove('is-invalid');
          
          // Mostrar el toast de éxito
          const toastSuccess = new bootstrap.Toast(document.getElementById('toastSuccess'));
          toastSuccess.show();
      }
  });

  // Mostrar/Ocultar contraseñas
  const botonesMostrar = document.querySelectorAll('[data-campo]');
  botonesMostrar.forEach(boton => {
      boton.addEventListener('click', function () {
          const campo = document.getElementById(this.dataset.campo);
          const icono = document.getElementById(this.dataset.icono);
          if (campo.type === 'password') {
              campo.type = 'text';
              icono.classList.remove('bi-eye-slash');
              icono.classList.add('bi-eye');
          } else {
              campo.type = 'password';
              icono.classList.remove('bi-eye');
              icono.classList.add('bi-eye-slash');
          }
      });
  });
});


  // Inicializar toasts al cargar la página
  const toastElList = [].slice.call(document.querySelectorAll('.toast'));
  const toastList = toastElList.map(function (toastEl) {
      return new bootstrap.Toast(toastEl, {
          animation: true,
          autohide: true,
          delay: 5000
      });
  });

  // Mostrar los toasts secuencialmente
  toastList.forEach(function (toast, index) {
      setTimeout(function () {
          toast.show();
      }, index * 300); // Retraso de 300ms entre cada toast
  });

  // Agregar animación de salida
  toastElList.forEach(function (toastEl) {
      toastEl.addEventListener('hide.bs.toast', function () {
          this.style.animation = 'fadeOutRight 0.5s';
      });
  });
