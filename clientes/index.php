<?php include '../extend/header.php'; ?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Creacion de clientes</span>
        <form class="form" action="ins_clientes.php" method="post" autocomplete=off >
          <div class="input-field">
            <input type="text" name="nombre"  title="Solo letras" pattern="[A-Z/s ]+"  id="Nombre" onblur="may(this.value, this.id)"  >
            <label for="Nombre">Nombre</label>
          </div>
          <div class="input-field">
            <input type="text" name="direccion"    id="Direccion" onblur="may(this.value, this.id)"  >
            <label for="direccion">Dirección</label>
          </div>
          <div class="input-field">
            <input type="text" name="telefono"   id="Telefono"  >
            <label for="Telefono">Telefono</label>
          </div>
          <div class="input-field">
            <input type="email" name="correo"   id="Correo"   >
            <label for="Correo">Correo</label>
          </div>
          <button type="submit" class="btn" >Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <nav class="blue-grey darken-3" >
      <div class="nav-wrapper">
        <div class="input-field">
          <input type="search"   id="Buscar" autocomplete="off"  >
          <label for="buscar"><i class="material-icons" >search</i></label>
          <i class="material-icons" >close</i>
        </div>
      </div>
    </nav>
  </div>
</div>

<?php
if ($_SESSION['nivel'] == 'ADMINISTRADOR')
{
  $select = $conexion->prepare("SELECT * FROM clientes");
}
else
{
  $select = $conexion->prepare("SELECT * FROM clientes WHERE asesor_cliente = ?");
  $select->bind_param('s', $_SESSION['nombre']);
}
$select->execute();
$resultado = $select->get_result();
$row = mysqli_num_rows($resultado);
?>

<div class="row">
  <div class="col s12">
      <div class="card">
          <div class="card-content">
            <span class="card-title">Clientes (<?php echo $row ?>)</span>
            <table>
              <thead>
                <tr class="cabecera">
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Asesor</th>
                <th class="center">Nuevo</th>
                <th class="center">Editar</th>
                <th class="center">Eliminar</th>
                </tr>
              </thead>
              <?php while ($f = $resultado->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $f['nombre_cliente'] ?></td>
                  <td><?php echo $f['dir_cliente'] ?></td>
                  <td><?php echo $f['tel_cliente'] ?></td>
                  <td><?php echo $f['correo_cliente'] ?></td>
                  <td><?php echo $f['asesor_cliente'] ?></td>
                  <td class="center"s><a href="../propiedades/alta_propiedades.php?id=<?php echo $f['id_cliente'] ?>&nombre=<?php echo $f['nombre_cliente'] ?>" class="btn-floating green"><i class="material-icons">add</i></a></td>
                  <td class="center"><a href="editar_cliente.php?id=<?php echo $f['id_cliente'] ?>" class="btn-floating blue"><i class="material-icons">create</i></a></td>
                  <td class="center">
                    <a href="#" class="btn-floating red" onclick="
                    swal({
                      title: 'Esta seguro que desea eliminar al cliente?',
                      text: 'Al eliminarlo no podra recuperarlo!',
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, Eliminarlo!'
                      }).then(function(){
                        location.href = 'eliminar_cliente.php?id=<?php echo $f['id_cliente'] ?>';
                    })
                    "><i class="material-icons">delete</i></a>
                  </td>
                </tr>
              <?php
                }
                $select->close();
                $conexion->close();
              ?>
            </table>
          </div>
      </div>
  </div>
</div>

<?php include '../extend/scripts.php'; ?>

</body>
</html>
