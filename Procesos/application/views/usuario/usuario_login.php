<h1 class="titulo">Gestión de Procesos</h1>
  <div class="login-page">
    <div class="form">
      <div class="login-form">
      <input type="text" maxlength="45" id="usuario" class="campoRegistro" placeholder="Usuario"/>
        <input type="password" id="passw" maxlength="40" class="campoRegistro" placeholder="Contraseña"/>
        <button onclick="loginUsuario()">Iniciar Sesión</button>
        <p class="message"><a href="#" id="btnRegistroUsuario" >Crear una Cuenta</a></p>
      </div>
    </div>
</div>

  <script type="text/javascript">
    var ruta="<?php echo site_url();?>";
  </script>
  <script type="text/javascript" src="recursos/js/usuario.js"></script>