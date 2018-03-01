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

  $mapa = $callenum . " " . $municipio . "," . $nombreDep ;

  $update = $conexion->prepare("UPDATE inventario SET departamento_dep = ?, municipio_mun = ?, precio_inv = ?, barrio_sector_inv = ?, calle_num_inv = ?, numero_int_inv = ?, m2t_inv = ?, baño_inv = ?, plantas_inv = ?, caracteristicas_inv = ?, m2c_inv = ?, cuartos_inv = ?, garajes_inv = ?, observaciones_inv = ?, forma_pago_inv = ?, asesor_cliente = ?, tipo_inmueble_inv = ?, fecha_registro_inv = ?, comentario_web_inv = ?, operacion_inv = ?, mapa_inv = ?  WHERE propiedad_inv = ?");
  $update->bind_param('ssdssiiiisiiisssssssss',$nombreDep,$municipio,$precio,$barriosector,$callenum,$numeroint,$m2t,$baños,$plantas,$caracteristicas,$m2c,$cuartos,$garajes,$observaciones,$formapago,$asesor,$tipoinmueble,$fecharegistro,$comentarioweb,$operacion,$mapa,$id);

  if ($update->execute())
  {
    header('location:../extend/alerta.php?msj=Propiedad editada&c=prop&p=in&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=Propiedad no pudo ser editada&c=prop&p=in&t=error');
  }

  $update->close();
  $conexion->close();

}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}

?>
