
  <h1 class="titulo">Registrar Usuario</h1>
  <div class="login-page">
    <div class="form">
      <div class="login-form">
      <input type="text" id="nombres" placeholder="Nombres" maxlength="55" class="campoRegistro"/>
      <input type="text" id="apellidos" placeholder="Apellidos" maxlength="55" class="campoRegistro"/>
      <input type="text" id="usuario" placeholder="Usuario" maxlength="45" class="campoRegistro"/>
      <input type="password" id="passw" placeholder="Contraseña" maxlength="40" class="campoRegistro"/>
      <input type="password" id="passw2" placeholder="Repetir Contraseña" maxlength="40" class="campoRegistro"/>
        <button onclick="registrarUsuario()">Registrar</button>
        <p class="message"><a href="#" onclick="mostrarLoginUsuario()">Volver al Inicio de Sesión</a></p>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var ruta="<?php echo site_url();?>";
  </script>
  <script type="text/javascript" src="recursos/js/usuario.js"></script>
