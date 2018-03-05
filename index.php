<?php include 'admin/conexion/conexion_web.php'; ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="admin/css/materialize.min.css">
    <link rel="stylesheet" href="admin/css/materialize-icon.css">
    <link rel="stylesheet" href="admin/css/sweetalert2.min.css">
    <link rel="stylesheet" href="admin/css/mover_menu.css">
    <title>Sitio Web</title>
  </head>
  <body class="blue-grey lighten-4">
    <nav class="red">
      <a href="index.php" class="brand-logo center">Logo</a>
    </nav>

    <div class="slider">
      <ul class="slides">
        <?php
          $select = $conexion->prepare("SELECT * FROM slider");
          $select->execute();
          $resultado = $select->get_result();
          while($f = $resultado->fetch_assoc())
          {
        ?>
        <li>
          <img src="admin/inicio/<?php echo $f['ruta_slider'] ?>">
          <div class="caption center-align">
            <h3>Empresa</h3>
            <h5 class="light grey-text text-lighten-3">Slogan de la empresa</h5>
          </div>
        </li>
        <?php
          }
          $select->close();
        ?>
      </ul>
    </div>

    <div class="row">
      <?php
        $selectMarc = $conexion->prepare("SELECT foto_principal_inv, precio_inv, municipio_mun, departamento_dep, barrio_sector_inv, propiedad_inv FROM inventario WHERE marcado_inv = 'SI'");

        $selectMarc->execute();
        $resultadoMarc = $selectMarc->get_result();

        while ($fMarc = $resultadoMarc->fetch_assoc())
        {
      ?>
      <div class="col s12 m6 l3">
        <div class="card">
            <div class="card-image">
              <img src="admin/propiedades/<?php echo $fMarc['foto_principal_inv'] ?>">
              <span class="card-title"><?php echo '$'.number_format($fMarc['precio_inv'],2) ?></span>
            </div>
            <div class="card-content">
              <p><?php echo $fMarc['barrio_sector_inv'].' '.$fMarc['municipio_mun'].', '.$fMarc['departamento_dep']; ?></p>
            </div>
            <div class="card-action">
              <a href="ver_mas.php?id=<?php echo $fMarc['propiedad_inv'] ?>">Ver mas...</a>
            </div>
          </div>
      </div>
      <?php
        }
        $selectMarc->close();
      ?>
    </div>

    <div class="row">
      <div class="col s12">
          <div class="card">
              <div class="card-content">
                <span class="card-title">Buscador de inmuebles</span>
                <form action="buscar.php" method="post">
                  <div class="row">
                    <div class="col s6">
                      <select id="Departamento" name="departamento" required>
                        <option value="" disabled selected>ESCOJE UN DEPARTAMENTO</option>
                        <?php
                          $selectDep = $conexion->prepare("SELECT * FROM departamentos");
                          $selectDep->execute();
                          $resultadoDep = $selectDep->get_result();

                          while ($fDep = $resultadoDep->fetch_assoc())
                          {
                          ?>

                          <option value="<?php echo $fDep['id_dep'] ?>"><?php echo $fDep['departamento_dep'] ?></option>

                          <?php
                            }
                            $selectDep->close();
                          ?>
                      </select>
                    </div>
                    <div class="col s6">
                      <div class="resultadoDep"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s6">
                      <select name="operacion" required  >
                        <option value="" disabled selected  >ELIGE LA OPERACION</option>
                        <option value="VENTA">VENTA</option>
                        <option value="RENTA">RENTA</option>
                        <option value="TRASPASO">TRASPASO</option>
                        <option value="OCUPADO">OCUPADO</option>
                      </select>
                    </div>
                    <div class="col s6">
                      <select name="tipoinmueble" required >
                        <option value="" disabled selected  >ELIGE EL TIPO DE INMUEBLE</option>
                        <option value="CASA">CASA</option>
                        <option value="TERRENO">TERRENO</option>
                        <option value="LOCAL">LOCAL</option>
                        <option value="DEPARTAMENTO">DEPARTAMENTO</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col s6">
                      <div class="input-field">
                        <input type="number" name="rango1" title="" id="Rango1" required>
                        <label for="Rango1">Precio Minimo</label>
                      </div>
                    </div>
                    <div class="col s6">
                      <div class="input-field">
                        <input type="number" name="rango2" title="" id="Rango2" required>
                        <label for="Rango2">Precio Maximo</label>
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn">Buscar Inmueble</button>
                </form>
              </div>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col s12">
          <div class="card">
              <div class="card-content">
                <span class="card-title">CONTACTO</span>
                <div class="row">
                  <div class="col s6">
                    <iframe class="z-depth-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.1159786333474!2d-73.05650868597873!3d6.995619994946513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e6847083884a62f%3A0xa12ccda841caab61!2sSoluciones+%C3%A9+Ingenier%C3%ADa!5e0!3m2!1sen!2sco!4v1504758262565" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                  </div>
                  <div class="col s6">
                    <div class="input-field">
                      <input type="text" name="nombre" pattern="[A-Za-z/s ]+"  title=""  id="Nombre" required >
                      <label for="nombre">Nombre:</label>
                    </div>
                    <div class="input-field">
                      <input type="text" name="asunto"   title=""  id="Asunto"  >
                      <label for="Asunto">Asunto:</label>
                    </div>
                    <div class="input-field">
                      <input type="email" name="correo"   title=""  id="Correo" required  >
                      <label for="correo">Correo:</label>
                    </div>
                    <div class="input-field">
                      <textarea name="mensaje" rows="8" cols="80" id="Mensaje" onblur="may(this.value, this.id)" class="materialize-textarea"></textarea>
                      <label for="">Mensaje:</label>
                    </div>
                    <button type="button" class="btn" id="Enviar">Enviar</button>
                    <div class="resultado"></div>
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>

    <footer class="page-footer red ">
      <div class="container">
        <div class="row">
          <div class="col s12">
            <a style="text-align:center !important;" href="#">Copyright Soluciones é Ingenieria</a>
          </div>
        </div>
      </div>
    </footer>

    <script src="admin/js/jquery-3.3.1.min.js"></script>
    <script src="admin/js/materialize.min.js"></script>
    <script>
      $('.slider').slider();
      $('select').material_select();
      $('#Departamento').change(function()
      {
        $.post('admin/propiedades/ajax_muni.php',
        {
          departamento:$('#Departamento').val(),

          beforeSend: function()
          {
            $('.resultadoDep').html("Espere un momento por favor...");
          }
        }, function(respuesta)
        {
          $('.resultadoDep').html(respuesta);
        });
      });

      $('#Enviar').click(function()
      {
        $.post('email.php',
        {
          nombre:$('#Nombre').val(),
          asunto:$('#Asunto').val(),
          correo:$('#Correo').val(),
          mensaje:$('#Mensaje').val(),

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
