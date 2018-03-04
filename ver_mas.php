<?php include 'admin/conexion/conexion_web.php';
$id = htmlentities($_GET['id']);
$sel = $conexion->prepare("SELECT * FROM inventario WHERE propiedad_inv = ? ");
$sel->bind_param('s', $id);
$sel->execute();
$res = $sel->get_result();
if ($f =$res->fetch_assoc())
{

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="admin/css/materialize.min.css">
  <link rel="stylesheet" href="admin/css/materialize-icon.css">
  <link rel="stylesheet" href="admin/css/sweetalert2.min.css">
  <link rel="stylesheet" href="admin/css/mover_menu.css">
  <title>Ver Mas</title>
</head>
<body class="blue-grey lighten-5">
<nav class="red" >
  <a href="#" class="brand-logo center">Logo</a>
</nav>

<div class="container">
  <div class="row">
  <div class="col s12">
    <h5 class="header"><?php echo $f['tipo_inmueble_inv'] ?> EN <?php echo $f['operacion_inv'] ?> PRECIO <?php echo '$'.number_format($f['precio_inv'],2) ?></h5>
    <div class="card horizontal">
      <div class="card-image">
        <img src="admin/propiedades/<?php echo $f['foto_principal_inv'] ?>">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <p><b>UBICACION:</b> <?php echo $f['mapa_inv'] ?></p>
          <p><b>DESCRIPCION:</b> <?php echo $f['comentario_web_inv'] ?></p>
          <p><b>CUARTOS:</b> <?php echo $f['cuartos_inv'] ?></p>
          <p><b>BAÑOS:</b> <?php echo $f['baño_inv'] ?></p>
          <p><b>GARAJES:</b> <?php echo $f['garajes_inv'] ?></p>
          <p><b>PLANTAS:</b> <?php echo $f['plantas_inv'] ?></p>
          <div class="row">
            <br>
            <div class="col s4">
              <?php
                $asesor = $f['asesor_cliente'];
                $sel_ase = $conexion->prepare("SELECT correo_usuario, foto_usuario FROM usuarios WHERE nombre_usuario = ? ");
                $sel_ase->bind_param('s', $asesor);
                $sel_ase->execute();
                $res_ase = $sel_ase->get_result();
                if ($f_ase =$res_ase->fetch_assoc())
                {

                }
               ?>
               <img src="admin/usuarios/<?php echo $f_ase['foto_usuario'] ?>" width="100" class="circle">
            </div>
            <div class="col s8">
              <p><b>ASESOR: </b><?php echo $asesor ?></p>
              <p><b>CORREO: </b><?php echo $f_ase['correo_usuario'] ?></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
   </div>

   <div class="row">
     <div class="col s12">
       <div class="card">
         <div class="card-content">
           <div class="row">

           <?php
             $sel_img = $conexion->prepare("SELECT * FROM imagenes WHERE id_propiedad = ? ");
             $sel_img->bind_param('s', $id);
             $sel_img->execute();
             $res_img = $sel_img->get_result();
             while ($f_img =$res_img->fetch_assoc())
             {
            ?>
            <div class="col s3">
              <img src="admin/propiedades/<?php echo $f_img['ruta_img'] ?>" width="200" class="materialboxed">
            </div>
            <?php
              }
            ?>

          </div>
         </div>
       </div>
     </div>
   </div>

   <div class="row">
     <div class="col s12">
       <div class="card">
         <div class="card-content">
           <span class="card-title">UBICACION</span>
           <div class="row">
             <div class="col s6">
               <iframe src="admin/propiedades/mapa.php?mapa=<?php echo $f['mapa_inv'] ?>" width="100%" height="500" frameborder="0" class="z-depth-4"></iframe>
             </div>
             <div class="col s6">
                 <div class="input-field">
                   <input type="text" name="nombre" pattern="[A-Za-z/s ]+"  title=""  id="Nombre" required >
                   <label for="nombre">Nombre:</label>
                 </div>
                 <div class="input-field">
                   <input type="text" name="telefono"   title=""  id="Telefono"  >
                   <label for="telefono">Telefono:</label>
                 </div>
                 <div class="input-field">
                   <input type="email" name="correo"   title=""  id="Correo" required  >
                   <label for="correo">Correo:</label>
                 </div>
                 <div class="input-field">
                   <textarea name="mensaje" rows="8" cols="80" id="Mensaje" onblur="may(this.value, this.id)" class="materialize-textarea"></textarea>
                   <label for="">Mensaje:</label>
                   <input type="hidden" name="idpropiedad" id="IdPropiedad" value="<?php echo $id ?>">
                 </div>
                 <button type="button" class="btn" id="Enviar">Enviar</button>
                 <div class="resultado"></div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

</div>


<script src="admin/js/jquery-3.3.1.min.js"></script>
<script src="admin/js/materialize.min.js"></script>
<script>
  $('.materialboxed').materialbox();
  $('#Enviar').click(function()
  {
    $.post('ins_comentario.php',
    {
      nombre:$('#Nombre').val(),
      telefono:$('#Telefono').val(),
      correo:$('#Correo').val(),
      mensaje:$('#Mensaje').val(),
      idpropiedad:$('#IdPropiedad').val(),

      beforeSend: function()
      {
        $('.resultado').html("Espere un momento por favor...");
      }
    }, function(respuesta)
    {
      $('.resultado').html(respuesta);
    });
  });
</script>
</body>
</html>
