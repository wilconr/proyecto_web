<?php
include 'admin/conexion/conexion_web.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $idDep = htmlentities($_POST['departamento']);
  $municipio = htmlentities($_POST['municipio']);
  $operacion = htmlentities($_POST['operacion']);
  $tipoInmueble = htmlentities($_POST['tipoinmueble']);
  $rango1 = htmlentities($_POST['rango1']);
  $rango2 = htmlentities($_POST['rango2']);

  $selectDep = $conexion->prepare("SELECT departamento_dep FROM departamentos WHERE id_dep = ?");
  $selectDep->bind_param('i',$idDep);
  $selectDep->execute();
  $resultadoDep = $selectDep->get_result();

  if ($fDep = $resultadoDep->fetch_assoc())
  {
    $nomDep = $fDep['departamento_dep'];
  }

  $selectMarc = $conexion->prepare("SELECT foto_principal_inv, precio_inv, municipio_mun, departamento_dep, barrio_sector_inv, propiedad_inv FROM inventario WHERE departamento_dep = ? AND municipio_mun = ? AND operacion_inv = ? AND tipo_inmueble_inv = ? AND precio_inv BETWEEN ? AND ?");
  $selectMarc->bind_param('ssssdd',$nomDep, $municipio, $operacion, $tipoInmueble, $rango1, $rango2);
  $selectMarc->execute();
  $resultadoMarc = $selectMarc->get_result();

}
else
{
  header('location:index.php');
  exit;
}
?>

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
  <body class="blue-grey lighten-4">
    <nav class="red">
      <a href="index.php" class="brand-logo center">Logo</a>
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

    <div class="row">
      <?php
        while ($fMarc = $resultadoMarc->fetch_assoc())
        {
      ?>
      <div class="col s12 m6 l3">
        <div class="card">
            <div class="card-image">
              <img src="admin/propiedades/<?php echo $fMarc['foto_principal_inv'] ?>">
              <span class="card-title"><?php echo '$'.number_format($fMarc['precio_inv'],2) ?></span>
            </div>
            <div class="card-content">
              <p><?php echo $fMarc['barrio_sector_inv'].' '.$fMarc['municipio_mun'].', '.$fMarc['departamento_dep']; ?></p>
            </div>
            <div class="card-action">
              <a href="ver_mas.php?id=<?php echo $fMarc['propiedad_inv'] ?>">Ver mas...</a>
            </div>
          </div>
      </div>
      <?php
        }
        $selectMarc->close();
      ?>
    </div>

    <script src="admin/js/jquery-3.3.1.min.js"></script>
    <script src="admin/js/materialize.min.js"></script>
    <script>
      $('.slider').slider();
    </script>
  </body>
</html>
