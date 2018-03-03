<?php include 'admin/conexion/conexion_web.php'; ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="admin/css/materialize.min.css">
    <link rel="stylesheet" href="admin/css/materialize-icon.css">
    <link rel="stylesheet" href="admin/css/sweetalert2.min.css">
    <link rel="stylesheet" href="admin/css/mover_menu.css">
    <title>Sitio Web</title>
  </head>
  <body class="blue-grey lighten-4">
    <nav class="red">
      <a href="#" class="brand-logo center">Logo</a>
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
    </script>
  </body>
</html>
