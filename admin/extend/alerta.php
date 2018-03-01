<?php include '../conexion/conexion.php' ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="..\css\sweetalert2.min.css">
    <title>Proyecto</title>
  </head>
  <body>

    <?php

    $mensaje = htmlentities($_GET['msj']);
    $carpeta = htmlentities($_GET['c']);
    $pagina = htmlentities($_GET['p']);
    $tipo = htmlentities($_GET['t']);

    switch ($carpeta) {
      case 'us':
        $carpeta = '../usuarios/';
        break;
      case 'home':
        $carpeta = '../inicio/';
        break;
      case 'salir':
        $carpeta = '../';
        break;
      case 'pe':
        $carpeta = '../perfil/';
        break;
      case 'cli':
        $carpeta = '../clientes/';
        break;
      case 'prop':
        $carpeta = '../propiedades/';
        break;
    }

    switch ($pagina) {
      case 'in':
        $pagina = 'index.php';
        break;
      case 'home':
        $pagina = 'index.php';
        break;
      case 'salir':
        $pagina = '';
        break;
      case 'perfil':
        $pagina = 'perfil.php';
        break;
      case 'img':
        $pagina = 'imagenes.php';
        break;
      case 'can':
        $pagina = 'cancelados.php';
        break;
      case 'sl':
        $pagina = 'slider.php';
        break;
    }

    if (isset($_GET['id']))
    {
      $id = htmlentities($_GET['id']);
      $direccion = $carpeta.$pagina.'?id='.$id;
    }
    else
    {
      $direccion = $carpeta.$pagina;
    }

    if ($tipo == "error")
    {
      $titulo = "Oppss...";
    }
    else
    {
      $titulo = "Buen trabajo!";
    }

    ?>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/sweetalert2.min.js"></script>

    <script>

      swal({
        title: '<?php echo $titulo ?>',
        text: '<?php echo $mensaje ?>',
        type: '<?php echo $tipo ?>',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
      }).then(function()
      {
        location.href = '<?php echo $direccion ?>';
      });

      $(document).click(function()
      {
        location.href = '<?php echo $direccion ?>';
      });

      $(document).keyup(function(e)
      {
        if (e.which == 27)
        {
          location.href = '<?php echo $direccion ?>';
        }
      });

    </script>

  </body>
</html>
<?php $conexion->close(); ?>
