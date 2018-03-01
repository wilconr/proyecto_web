  <?php
  include '../extend/header.php';
  include '../extend/permiso.php';
  ?>

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Creacion de Usuario</span>
                    <form class="form" action="ins_usuarios.php" method="post" enctype="multipart/form-data">

                      <div class="input-field">
                        <input type="text" name="nick" required autofocus title="DEBE DE CONTENER ENTRE 8 Y 15 CARACTERES, SOLO LETRAS" pattern="[A-Za-z]{8,15}" id="Nick" onblur="may(this.value, this.id)">
                        <label for="nick">Nick:</label>
                      </div>

                      <div class="validacion"></div>

                      <div class="input-field">
                        <input type="password" name="clave1" title="CONTRASEÑA CON NUMEROS, LETRAS, MAYUSCULAS Y MINUSCULAS ENTRE 8 Y 15 CARACTERES" pattern="[A-Za-z0-9]{8,15}" id="Clave1" required>
                        <label for="clave1">Contraseña:</label>
                      </div>

                      <div class="input-field">
                        <input type="password" name="clave2" title="CONTRASEÑA CON NUMEROS, LETRAS, MAYUSCULAS Y MINUSCULAS ENTRE 8 Y 15 CARACTERES" pattern="[A-Za-z0-9]{8,15}" id="Clave2" required>
                        <label for="clave2">Verificar Contraseña:</label>
                      </div>

                      <select name="nivel" required>
                        <option value="" disabled selected>ELIGE UN NIVEL DE USUARIO</option>
                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                        <option value="ASESOR">ASESOR</option>
                      </select>

                      <div class="input-field">
                        <input type="text" name="nombre" title="NOMBRE DEL USUARIO" onblur="may(this.value, this.id)" pattern="[A-Z/s ]+" id="Nombre" required>
                        <label for="nombre">Nombre Completo del Usuario:</label>
                      </div>

                      <div class="input-field">
                        <input type="email" name="correo" title="Correo Electronico" id="Correo">
                        <label for="correo">Correo Electronico:</label>
                      </div>

                      <div class="file-field input-field">
                        <div class="btn">
                          <span>Foto:</span>
                          <input type="file" name="foto">
                        </div>
                        <div class="file-path-wrapper">
                          <input type="text" class="file-path validate">
                        </div>
                      </div>

                      <button type="submit" class="btn black" id="btn_guardar">Guardar<i class="material-icons">send</i></button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col s12">
        <nav class="blue-grey darken-3">
          <div class="nav-wrapper">
            <div class="input-field">
              <input type="search" id="Buscar" autocomplete="off">
              <label for="Buscar"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
            </div>
          </div>
        </nav>
      </div>
    </div>

    <?php
      $select = $conexion->query("SELECT * FROM usuarios");
      $row = mysqli_num_rows($select);
    ?>


    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Usuarios (<?php echo $row ?>)</span>
                    <table>
                      <thead>
                        <tr class="cabecera">
                        <th>Nick</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Nivel</th>
                        <th></th>
                        <th>Foto</th>
                        <th class="center">Bloqueo</th>
                        <th class="center">Eliminar</th>
                        </tr>
                      </thead>
                      <?php while ($f = $select->fetch_assoc()){ ?>
                        <tr>
                          <td><?php echo $f['nick_usuario'] ?></td>
                          <td><?php echo $f['nombre_usuario'] ?></td>
                          <td><?php echo $f['correo_usuario'] ?></td>
                          <td>
                            <form action="up_nivel.php" method="post">
                              <input type="hidden" name="id" value="<?php echo $f['id_usuario'] ?>">
                              <select name="nivel" required>
                                <option value="<?php echo $f['nivel_usuario'] ?>" disabled selected><?php echo $f['nivel_usuario'] ?></option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="ASESOR">ASESOR</option>
                              </select>
                          </td>
                          <td>
                              <button type="submit" class="btn-floating"><i class="material-icons">repeat</i></button>
                            </form>
                          </td>
                          <td><img src="<?php echo $f['foto_usuario'] ?>" width="50" class="circle"></td>
                          <td class="center">
                          <?php if ($f['bloqueo_usuario'] == 1): ?>
                            <a href="bloqueo_manual.php?us=<?php echo $f['id_usuario'] ?>&bl=<?php echo $f['bloqueo_usuario'] ?>"><i class="material-icons green-text">lock_open</i></a>
                          <?php else: ?>
                            <a href="bloqueo_manual.php?us=<?php echo $f['id_usuario'] ?>&bl=<?php echo $f['bloqueo_usuario'] ?>"><i class="material-icons red-text">lock_outline</i></a>
                          <?php endif; ?>
                          </td>
                          <td class="center">
                            <a href="#" class="btn-floating red " onclick="
                            swal({
                              title: 'Esta seguro que desea eliminar al usuario?',
                              text: 'Al eliminarlo no podra recuperarlo!',
                              type: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Si, Eliminarlo!'
                              }).then(function(){
                                location.href = 'eliminar_usuario.php?id=<?php echo $f['id_usuario'] ?>';
                            })
                            "><i class="material-icons">delete</i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include '../extend/scripts.php'; ?>

    <script src="../js/validacion.js"></script>

</body>
</html>
