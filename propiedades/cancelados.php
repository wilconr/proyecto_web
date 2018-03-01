<?php
include '../extend/header.php';


$select = $conexion->prepare("SELECT propiedad_inv,consecutivo_inv,nombre_cliente,calle_num_inv,barrio_sector_inv,departamento_dep,municipio_mun,precio_inv,forma_pago_inv,asesor_cliente,tipo_inmueble_inv,operacion_inv,mapa_inv,foto_principal_inv FROM inventario WHERE estatus_inv = 'CANCELADO' ");



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
        <span class="card-title">Propiedades</span>
        <table>
          <thead>
            <tr class="cabecera">
              <th>Vista</th>
              <th>Num</th>
              <th>Cliente</th>
              <th>Propiedad</th>
              <th>Precio</th>
              <th>Forma de Pago</th>
              <th>Asesor</th>
              <th>Tipo</th>
              <th>Operacion</th>
              <th class="center" colspan="2">Opciones</th>
            </tr>
          </thead>
          <?php
          $select->execute();
          $resultado = $select->get_result();
          while ($f =$resultado->fetch_assoc()) {?>
            <tr>
              <td><button data-target="Mod1" id="Mod" value="<?php echo $f['propiedad_inv'] ?>" class="btn-floating modal-trigger teal darken-2"><i class="material-icons">visibility</i></button></td>
              <td><?php echo $f['consecutivo_inv'] ?></td>
              <td><?php echo $f['nombre_cliente'] ?></td>
              <td><?php echo $f['calle_num_inv'].' '.$f['barrio_sector_inv'].' '.$f['municipio_mun'].' ,'.$f['departamento_dep'] ?></td>
              <td><?php echo "$".number_format($f['precio_inv'],2); ?></td>
              <td><?php echo $f['forma_pago_inv'] ?></td>
              <td><?php echo $f['asesor_cliente'] ?></td>
              <td><?php echo $f['tipo_inmueble_inv'] ?></td>
              <td><?php echo $f['operacion_inv'] ?></td>
              <td><a href="cancelar_propiedad.php?id=<?php echo $f['propiedad_inv'] ?>&accion=ACTIVO" class="btn-floating light-green accent-4"><i class="material-icons">done</i></a></td>
              <td>
                <a href="#" class="btn-floating red" onclick="
                swal({
                  title: 'Esta seguro que desea eliminar la propiedad?',
                  text: 'Si la elimina no podra recuperarla',
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, eliminarla!'
                  }).then(function(){
                    location.href = 'eliminar_propiedad.php?id=<?php echo $f['propiedad_inv'] ?>&foto=<?php echo $f['foto_principal_inv'] ?>';
                })
                "><i class="material-icons">delete</i></a>
              </td>
            </tr>
          <?php }
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

</body>
</html>
