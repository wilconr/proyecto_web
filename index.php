<?php include 'admin/conexion/conexion_web.php'; ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="admin/css/materialize.min.css">
    <link rel="stylesheet" href="admin/css/materialize-icon.css">
    <link rel="stylesheet" href="admin/css/sweetalert2.min.css">
    <link rel="stylesheet" href="admin/css/mover_menu.css">
    <title>Sitio Web</title>
  </head>
  <body>
    <nav class="red">

    </nav>

    <div class="slider">
      <ul class="slides">
        <?php
          $select = $conexion->prepare("SELECT * FROM slider");
          $select->execute();
          $resultado = $select->get_result();
          while($f = $resultado->fetch_assoc())
          {
        ?>
        <li>
          <img src="admin/inicio/<?php echo $f['ruta_slider'] ?>">
          <div class="caption center-align">
            <h3>Empresa</h3>
            <h5 class="light grey-text text-lighten-3">Slogan de la empresa</h5>
          </div>
        </li>
        <?php
          }
          $select->close();
        ?>
      </ul>
    </div>

    <script src="admin/js/jquery-3.3.1.min.js"></script>
    <script src="admin/js/materialize.min.js"></script>
    <script> $('.slider').slider(); </script>
  </body>
</html>
