<?php
include 'admin/conexion/conexion_web.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  foreach ($_POST as $campo => $valor)
  {
    $variable = "$" . $campo . "='" . htmlentities($valor) . "';";
    eval($variable);
  }

  $header = "MIME-vERSION 1.0 \r\n";
  $header .= "Content-Type: text/html; charset=iso-8859-1 \r\n";
  $header .= "From: {$nombre} < {$correo} > \r\n";
  $mail = mail("qwerty.870403@gmail.com", $asunto, $mensaje, $header);

  if ($mail)
  {
    echo "<lable style='color:green;'>Su mensaje ha sido enviado con exito</label>";
  }
  else
  {
    echo "<lable style='color:red;'>Su mensaje no pudo ser enviado</label>";
  }
  $conexion->close();
}
else
{
  echo "<lable style='color:red;'>Utilice el formulario</label>";
}
?>
