  <?php
  include '../extend/header.php';
  $select = $conexion->prepare("SELECT propiedad_inv FROM inventario WHERE operacion_inv = ?");
  $select->bind_param('s',$operacion);
  ?>

    <div class="row">
      <div class="col s12 m6 l6">
        <div class="card">
          <div class="card-content cyan darken-3">
            <span class="card-title center"><b>VENTA</b></span>
          </div>
          <div class="card-content">
            <h2 align="center">
              <?php
                $operacion = 'VENTA' ;
                $select->execute();
                $resultadoVenta = $select->get_result();
                echo mysqli_num_rows($resultadoVenta);
              ?>
            </h2>
          </div>
          <div class="card-action">
            <a href="../propiedades/index.php?ope=VENTA">Ver Mas...</a>
          </div>
        </div>
    </div>

    <div class="row">
      <div class="col s12 m6 l6">
        <div class="card">
          <div class="card-content cyan darken-3">
            <span class="card-title center"><b>RENTA</b></span>
          </div>
          <div class="card-content">
            <h2 align="center">
              <?php
                $operacion = 'RENTA' ;
                $select->execute();
                $resultadoRenta = $select->get_result();
                echo mysqli_num_rows($resultadoRenta);
              ?>
            </h2>
          </div>
          <div class="card-action">
            <a href="../propiedades/index.php?ope=RENTA">Ver Mas...</a>
          </div>
        </div>
    </div>

    <div class="row">
      <div class="col s12 m6 l6">
        <div class="card">
          <div class="card-content cyan darken-3">
            <span class="card-title center"><b>TRASPASO</b></span>
          </div>
          <div class="card-content">
            <h2 align="center">
              <?php
                $operacion = 'TRASPASO' ;
                $select->execute();
                $resultadoTraspaso = $select->get_result();
                echo mysqli_num_rows($resultadoTraspaso);
              ?>
            </h2>
          </div>
          <div class="card-action">
            <a href="../propiedades/index.php?ope=TRASPASO">Ver Mas...</a>
          </div>
        </div>
    </div>

    <div class="row">
      <div class="col s12 m6 l6">
        <div class="card">
          <div class="card-content cyan darken-3">
            <span class="card-title center"><b>OCUPADO</b></span>
          </div>
          <div class="card-content">
            <h2 align="center">
              <?php
                $operacion = 'OCUPADO' ;
                $select->execute();
                $resultadoOcupado = $select->get_result();
                echo mysqli_num_rows($resultadoOcupado);
              ?>
            </h2>
          </div>
          <div class="card-action">
            <a href="../propiedades/index.php?ope=OCUPADO">Ver Mas...</a>
          </div>
        </div>
    </div>

  <div class="row">
    <div class="col s12">
      <div class="card cyan darken-3">
        <div class="card-content">
          <h4 align="center"><b>COMENTARIOS</b></h4>
        </div>
        <div class="card-tabs">
          <ul class="tabs tabs-fixed-width tabs-transparent">
            <li class="tab"><a class="active black-text" href="#Nuevos"><b>Nuevos</b></a></li>
            <li class="tab"><a class="black-text" href="#Resueltos"><b>Resueltos</b></a></li>
          </ul>
        </div>
        <div class="card-content grey lighten-5">
          <div id="Nuevos">
            <table>
             <th>Vista</th>
             <th>Solicitante</th>
             <th>Telefono</th>
             <th>Correo</th>
             <th>Mensaje</th>
             <?php
               $sel_com = $conexion->prepare("SELECT * FROM comentarios WHERE estatus_com = ? ");
               $sel_com->bind_param('s', $estatus);
               $estatus = 'NUEVO';
               $sel_com->execute();
               $res_nuevo = $sel_com->get_result();
               while ($fn =$res_nuevo->fetch_assoc())
               {
              ?>
             <tr>
               <td class="borrar"><button data-target="Mod1" id="Mod" value="<?php echo $fn['id_propiedad'] ?>" class="btn-floating modal-trigger teal darken-2"><i class="material-icons">visibility</i></button></td>
               <td><?php echo $fn['nombre_com'] ?></td>
               <td><?php echo $fn['tel_com'] ?></td>
               <td><a href="correo.php?correo=<?php echo $fn['correo_com'] ?>&nombre=<?php echo $fn['nombre_com'] ?>&id_comentario=<?php echo $fn['id_com'] ?>"><?php echo $fn['correo_com'] ?></a></td>
               <td><?php echo $fn['mensaje_com'] ?></td>
             </tr>
             <?php } ?>
            </table>
          </div>
          <div id="Resueltos">
            <table>
             <th>Vista</th>
             <th>Solicitante</th>
             <th>Telefono</th>
             <th>Correo</th>
             <th>Mensaje</th>
             <?php
               $estatus = 'RESUELTO';
               $sel_com->execute();
               $res_resuelto = $sel_com->get_result();
               while ($fr =$res_resuelto->fetch_assoc())
               {
              ?>
             <tr>
               <td class="borrar"><button data-target="Mod1" id="Mod" value="<?php echo $fr['id_propiedad'] ?>" class="btn-floating modal-trigger teal darken-2"><i class="material-icons">visibility</i></button></td>
               <td><?php echo $fr['nombre_com'] ?></td>
               <td><?php echo $fr['tel_com'] ?></td>
               <td><?php echo $fr['correo_com'] ?></td>
               <td><?php echo $fr['mensaje_com'] ?></td>
             </tr>
             <?php } ?>
            </table>
          </div>
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
      $.get('../propiedades/modal.php',
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
