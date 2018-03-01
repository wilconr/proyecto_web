<?php
include '../conexion/conexion.php';
if (!isset($_SESSION['nick']))
{
  header('location:../');
}
?>

  <!DOCTYPE html>
  <html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-compatible" content="ie-edge">
      <link rel="stylesheet" href="../css/materialize.min.css">
      <link rel="stylesheet" href="../css/materialize-icon.css">
      <link rel="stylesheet" href="../css/sweetalert2.min.css">
      <link rel="stylesheet" href="../css/mover_menu.css">
      <title>Proyecto</title>
    </head>
    <body class="grey lighten-3">
      <main>

<?php
if ($_SESSION['nivel'] == 'ADMINISTRADOR')
{
  include 'menu_admin.php';
}
else
{
  include 'menu_asesor.php';
}

?>
