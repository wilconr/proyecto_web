<?php

  include '../conexion/conexion.php';
  $nick = $conexion->real_escape_string($_POST['nick']);
  $select = $conexion->query("SELECT id_usuario FROM usuarios WHERE nick_usuario='$nick'");
  $row = mysqli_num_rows($select);

  if ($row != 0)
  {
    echo "<label style='color:red;'>El nombre de usuario ya existe</label>";
  }
  else
  {
    echo "<label style='color:green;'>El nombre de usuario esta disponible</label>";
  }

  $conexion->close();

?>
