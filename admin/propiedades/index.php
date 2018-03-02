<?php
include '../extend/header.php';
if (isset($_GET['ope'])) {
  $operacion = $conexion->real_escape_string(htmlentities($_GET['ope']));

  $select = $conexion->prepare("SELECT propiedad_inv,consecutivo_inv,nombre_cliente,calle_num_inv,barrio_sector_inv,departamento_dep,municipio_mun,precio_inv,forma_pago_inv,asesor_cliente,tipo_inmueble_inv,operacion_inv,mapa_inv,marcado_inv FROM inventario WHERE estatus_inv = 'ACTIVO' AND operacion_inv = ? ");
  $select->bind_param('s',$operacion);
}
else
{
  $select = $conexion->prepare("SELECT propiedad_inv,consecutivo_inv,nombre_cliente,calle_num_inv,barrio_sector_inv,departamento_dep,municipio_mun,precio_inv,forma_pago_inv,asesor_cliente,tipo_inmueble_inv,operacion_inv,mapa_inv,marcado_inv FROM inventario WHERE estatus_inv = 'ACTIVO' ");
  //ARREGLAR ESTA PARTE PARA QUE EL ODAL FUNCIONE BIEN , VER VIDEO 82 DONDE SE HICIERON CAMBIOS QUE ALTERARON EL FUNCIONAMINETO DEL MODAL
}

?>

<br>

<div class="row">
  <div class="col s12">
    <nav class="blue-grey darken-3">
      <div class="nav-wrapper">
        <div class="input-field">
          <input type="search" id="Buscar" autocomplete="off">
          <label for="Buscar"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </div>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <form action="excel.php" method="post" target="_blank" id="Exportar">
          <span class="card-title">Propiedades
            <button class="btn-floating green botonExcel"><i class="material-icons">grid_on</i></button>
            <input type="hidden" name="datos" id="Datos">
          </span>
        </form>

        <table class="excel" border="1">
          <thead>
            <tr class="cabecera">
              <th class="borrar">Vista</th>
              <th>Num</th>
              <th></th>
              <th>Cliente</th>
              <th>Propiedad</th>
              <th>Precio</th>
              <th>Forma de Pago</th>
              <th>Asesor</th>
              <th>Tipo</th>
              <th>Operacion</th>
              <th class="center borrar" colspan="5">Opciones</th>
            </tr>
          </thead>
          <?php
            $select->execute();
            $resultado = $select->get_result();
            while ($f =$resultado->fetch_assoc())
            {
          ?>
            <tr>
              <td class="borrar"><button data-target="Mod1" id="Mod" value="<?php echo $f['propiedad_inv'] ?>" class="btn-floating modal-trigger teal darken-2"><i class="material-icons">visibility</i></button></td>
              <td>
                <?php if ($f['marcado_inv'] == ''): ?>
                  <a href="marcado.php?id=<?php echo $f['propiedad_inv'] ?>&marcado=SI"><i class="small grey-text material-icons">grade</i></a>
                <?php else: ?>
                  <a href="marcado.php?id=<?php echo $f['propiedad_inv'] ?>&marcado="><i class="small green-text material-icons">grade</i></a>
                <?php endif; ?>
              </td>
              <td><?php echo $f['consecutivo_inv'] ?></td>
              <td><?php echo $f['nombre_cliente'] ?></td>
              <td><?php echo $f['calle_num_inv'].' '.$f['barrio_sector_inv'].' '.$f['municipio_mun'].', '.$f['departamento_dep'] ?></td>
              <td><?php echo "$".number_format($f['precio_inv'],2); ?></td>
              <td><?php echo $f['forma_pago_inv'] ?></td>
              <td><?php echo $f['asesor_cliente'] ?></td>
              <td><?php echo $f['tipo_inmueble_inv'] ?></td>
              <td><?php echo $f['operacion_inv'] ?></td>
              <td class="borrar"><a href="imagenes.php?id=<?php echo $f['propiedad_inv'] ?>" class="btn-floating blue darken-4"><i class="material-icons">image</i></a></td>
              <td class="borrar"><a href="mapa.php?mapa=<?php echo $f['mapa_inv'] ?>" target="_blank" class="btn-floating orange darken-3"><i class="material-icons">room</i></a></td>
              <td class="borrar"><a href="pdf.php?id=<?php echo $f['propiedad_inv'] ?>" class="btn-floating green darken-3"><i class="material-icons">picture_as_pdf</i></a></td>
              <td class="borrar"><a href="editar_propiedad.php?id=<?php echo $f['propiedad_inv'] ?>" class="btn-floating indigo darken-1"><i class="material-icons">create</i></a></td>
              <td class="borrar">
                <a href="#" class="btn-floating red" onclick="
                swal({
                  title: 'Esta seguro que desea cancelar la propiedad?',
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, cancelarla!'
                  }).then(function(){
                    location.href = 'cancelar_propiedad.php?id=<?php echo $f['propiedad_inv'] ?>&accion=CANCELADO';
                })
                "><i class="material-icons">clear</i></a>
              </td>
            </tr>
          <?php
          }
          $select->close();
          $conexion->close();
          ?>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="Mod1" class="modal">
  <div class="modal-content">
    <h4>INFORMACION</h4>
    <div id="ResMod">

    </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn">CERRAR</a>
  </div>
</div>

<?php include '../extend/scripts.php'; ?>

<script>

  $('.modal').modal();

  $('#Mod').click(function()
  {
    $.get('modal.php',
    {
      id:$('#Mod').val(),

      beforeSend: function()
      {
        $('#ResMod').html("Espere un momento por favor...");
      }
    }, function(respuesta)
    {
      $('#ResMod').html(respuesta);
    });
  });

</script>

<script>
  $('.botonExcel').click(function()
  {
    $('.borrar').remove();
    $('#Datos').val($("<div>").append($('.excel').eq(0).clone()).html());
    $('#Exportar').submit();
    setInterval(function(){location.reload();},3000);
  });
</script>

</body>
</html>
