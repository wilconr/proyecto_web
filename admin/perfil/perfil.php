  <?php include '../extend/header.php'; ?>

    <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <h1>Editar Perfil</h1>
            </div>
            <div class="card-tabs">
              <ul class="tabs tabs-fixed-width">
                <li class="tab"><a href="#datos" class="active">Datos</a></li>
                <li class="tab"><a href="#clave">Contraseña</a></li>
              </ul>
            </div>
            <div class="card-content grey lighten-4">
              <div id="datos">
                <form class="form" action="up_perfil.php" method="post" enctype="multipart/form-data">

                  <div class="input-field">
                    <input type="text" name="nombre" title="NOMBRE DEL USUARIO" onblur="may(this.value, this.id)" pattern="[A-Z/s ]+" id="Nombre" value="<?php echo $_SESSION['nombre'] ?>" required>
                    <label for="nombre">Nombre Completo del Usuario:</label>
                  </div>

                  <div class="input-field">
                    <input type="email" name="correo" title="Correo Electronico" id="Correo" value="<?php echo $_SESSION['correo'] ?>">
                    <label for="correo">Correo Electronico:</label>
                  </div>

                  <button type="submit" class="btn black">Actualizar<i class="material-icons">send</i></button>

                </form>
              </div>
              <div id="clave">
                <form class="form" action="up_clave.php" method="post" enctype="multipart/form-data">

                  <div class="input-field">
                    <input type="password" name="clave1" title="CONTRASEÑA CON NUMEROS, LETRAS, MAYUSCULAS Y MINUSCULAS ENTRE 8 Y 15 CARACTERES" pattern="[A-Za-z0-9]{8,15}" id="Clave1" required>
                    <label for="clave1">Contraseña:</label>
                  </div>

                  <div class="input-field">
                    <input type="password" name="clave2" title="CONTRASEÑA CON NUMEROS, LETRAS, MAYUSCULAS Y MINUSCULAS ENTRE 8 Y 15 CARACTERES" pattern="[A-Za-z0-9]{8,15}" id="Clave2" required>
                    <label for="clave2">Verificar Contraseña:</label>
                  </div>

                  <button type="submit" class="btn black" id="btn_guardar">Actualizar<i class="material-icons">send</i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>

  <?php include '../extend/scripts.php'; ?>
  <script src="../js/validacion.js"></script>
</body>
</html>
