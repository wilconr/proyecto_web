<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  foreach ($_POST as $campo => $valor)
  {
    $variable = "$" . $campo . "='" . htmlentities($valor) . "';";
    eval($variable);
  }

  $header = "MIME-vERSION 1.0 \r\n";
  $header .= "Content-Type: text/html; charset=iso-8859-1 \r\n";
  $header .= "From: {$asesor} < {$correo} > \r\n";
  $mail = mail($correo, $asunto, $mensaje, $header);

  if ($mail)
  {
    $update = $conexion->prepare("UPDATE comentarios SET estatus_com = 'RESUELTO' WHERE id_com = ?");
    $update->bind_param('i',$idCom);
    $update->execute();
    $update->close();
    header('location:../extend/alerta.php?msj=Mensaje enviado con exito&c=home&p=home&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=Mensaje no pudo ser enviado&c=home&p=home&t=error');
  }

  $conexion->close();
}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=home&p=home&t=error');
}
?>
