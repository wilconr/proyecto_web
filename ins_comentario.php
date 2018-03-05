<?php
include 'admin/conexion/conexion_web.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $nombre = htmlentities($_POST['nombre']);
  $telefono = htmlentities($_POST['telefono']);
  $correo = htmlentities($_POST['correo']);
  $mensaje = htmlentities($_POST['mensaje']);
  $idPropiedad = htmlentities($_POST['idpropiedad']);
  $estatus = "NUEVO";
  $id = '';

  $insert = $conexion->prepare("INSERT INTO comentarios VALUES(?,?,?,?,?,?,?)");
  $insert->bind_param("issssss",$id, $idPropiedad, $nombre, $telefono, $correo, $mensaje,$estatus);

  if ($insert->execute())
  {
    echo "<lable style='color:green;'>Su mensaje ha sido enviado con exito</label>";
  }
  else
  {
    echo "<lable style='color:red;'>Su mensaje no pudo ser enviado</label>";
  }

  $insert->close();
  $conexion->close();
}
else
{
  echo "<lable style='color:red;'>Utilice el formulario</label>";
}


 ?>
