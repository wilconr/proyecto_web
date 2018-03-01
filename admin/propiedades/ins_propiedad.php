<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  foreach ($_POST as $campo => $valor)
  {
    $variable = "$" . $campo . "='" . htmlentities($valor) . "';";
    eval($variable);
  }

  $select = $conexion->prepare("SELECT departamento_dep FROM departamentos WHERE id_dep = ?");
  $select->bind_param('i',$departamento);
  $select->execute();
  $resultado = $select->get_result();

  if ($f = $resultado->fetch_assoc())
  {
    $nombreDep = $f['departamento_dep'];
  }

  $id = sha1(rand(00000, 99999));
  $consecutivo = '';
  $fotoprincipal = 'casas/foto_principal.png';
  $mapa = $callenum." ".$municipio.", ".$nombreDep;
  $marcado = '';
  $estatus = 'ACTIVO';
  // las variables escritas en la consulta son los name del formulario alta_propiedades
  $insert = $conexion->prepare("INSERT INTO inventario VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert->bind_param('siisssdssiiiisiiisssssssssss',$id,$consecutivo,$idcliente,$nombreDep,$municipio,$nombrecliente,$precio,$barriosector,$callenum,$numeroint,$m2t,$baños,$plantas,$caracteristicas,$m2c,$cuartos,$garajes,$observaciones,$formapago,$asesor,$tipoinmueble,$fecharegistro,$comentarioweb,$operacion,$fotoprincipal,$mapa,$marcado,$estatus);

  if ($insert->execute())
  {
    header('location:../extend/alerta.php?msj=Propiedad guardada&c=prop&p=in&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=Propiedad no pudo ser guardada&c=cli&p=in&t=error');
  }
  $insert->close();
  $conexion->close();
}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}

?>
