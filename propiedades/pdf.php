<?php
include '../conexion/conexion.php';
$id = $conexion->real_escape_string(htmlentities($_GET['id']));
$select = $conexion->prepare("SELECT * FROM inventario WHERE propiedad_inv = ? ");
$select->bind_param('s', $id);
$select->execute();
$resultado = $select->get_result();
if ($f = $resultado->fetch_assoc()) {
}
ob_start();
?>


<h3 align="right"><b><?php echo "$". number_format($f['precio_inv'], 2); ?></b></h3>
 <table width="100%" cellpadding="3" border="1">
   <tr>
     <td colspan="4"><b>Datos generales</b></td>
   </tr>
   <tr>
     <td>Cliente</td>
     <td><?php echo $f['nombre_cliente'] ?></td>
     <td>Num.</td>
     <td><?php echo $f['consecutivo_inv'] ?></td>
   </tr>
   <tr>
     <td>Calle y numero</td>
     <td><?php echo $f['calle_num_inv']?></td>
     <td>Barrio / Sector</td>
     <td><?php echo $f['barrio_sector_inv'] ?></td>
   </tr>
   <tr>
     <td>Numero int.</td>
     <td><?php echo $f['numero_int_inv']?></td>
     <td>Departamento</td>
     <td><?php echo $f['departamento_dep'] ?></td>
   </tr>
   <tr>
     <td>Municipio</td>
     <td><?php echo $f['municipio_mun']?></td>
     <td colspan="2"></td>
   </tr>
   <tr>
     <td colspan="4" class="center" ><b>Caracteristicas</b></td>
   </tr>
   <tr>
     <td>M2 Terreno.</td>
     <td><?php echo $f['m2t_inv']?></td>
     <td>M2 Construccion</td>
     <td><?php echo $f['m2c_inv'] ?></td>
   </tr>
   <tr>
     <td>Baños</td>
     <td><?php echo $f['baño_inv']?></td>
     <td>Plantas</td>
     <td><?php echo $f['plantas_inv'] ?></td>
   </tr>
   <tr>
     <td>Recamaras</td>
     <td><?php echo $f['cuartos_inv']?></td>
     <td>Cocheras</td>
     <td><?php echo $f['garajes_inv'] ?></td>
   </tr>
   <tr>
     <td>Caracteristicas</td>
     <td><?php echo $f['caracteristicas_inv']?></td>
     <td>Observaciones</td>
     <td><?php echo $f['observaciones_inv'] ?></td>
   </tr>
   <tr>
     <td colspan="4" class="center" ><b>Datos de venta</b></td>
   </tr>
   <tr>
     <td>Forma de pago</td>
     <td><?php echo $f['forma_pago_inv']?></td>
     <td>Asesor</td>
     <td><?php echo $f['asesor_cliente'] ?></td>
   </tr>
   <tr>
     <td>Tipo de inmueble</td>
     <td><?php echo $f['tipo_inmueble_inv']?></td>
     <td>Fecha de registro</td>
     <td><?php echo date('d-m-Y', strtotime($f['fecha_registro_inv'])) ?></td>
   </tr>
   <tr>
     <td>Comentario web</td>
     <td><?php echo $f['comentario_web_inv']?></td>
     <td>Operacion</td>
     <td><?php echo $f['operacion_inv'] ?></td>
   </tr>

 </table>

<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(ob_get_clean());
$dompdf->setPaper('letter','portrait');
$dompdf->render();
$dompdf->stream('reporte');
?>
