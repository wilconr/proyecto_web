  <?php
  include '../extend/header.php';
  $id = htmlentities($_GET['id']);

  $select = $conexion->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
  $select->bind_param('i',$id);
  $select->execute();
  $resultado = $select->get_result();

  if ($f = $resultado->fetch_assoc())
  {

  }

  ?>

    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Creacion de clientes</span>
            <form class="form" action="up_cliente.php" method="post" autocomplete=off >
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <div class="input-field">
                <input type="text" name="nombre" value="<?php echo $f['nombre_cliente'] ?>" title="Solo letras" pattern="[A-Z/s ]+"  id="Nombre" onblur="may(this.value, this.id)"  >
                <label for="nombre">Nombre</label>
              </div>
              <div class="input-field">
                <input type="text" name="direccion" value="<?php echo $f['dir_cliente'] ?>" id="Direccion" onblur="may(this.value, this.id)"  >
                <label for="direccion">Dirección</label>
              </div>
              <div class="input-field">
                <input type="text" name="telefono" value="<?php echo $f['tel_cliente'] ?>" id="Telefono"  >
                <label for="telefono">Telefono</label>
              </div>
              <div class="input-field">
                <input type="email" name="correo" value="<?php echo $f['correo_cliente'] ?>" id="Correo"   >
                <label for="Correo">Correo</label>
              </div>
              <button type="submit" class="btn" >Actualizar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  <?php
  $select->close();
  $conexion->close();
  include '../extend/scripts.php';
  ?>

</body>
</html>
