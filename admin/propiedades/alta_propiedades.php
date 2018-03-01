<?php
include '../extend/header.php';
$id = $conexion->real_escape_string(htmlentities($_GET['id']));
$nombre = $conexion->real_escape_string(htmlentities($_GET['nombre']));
?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Ingreso de propiedad de: <?php echo $nombre ?> </span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS GENERALES</b></h5>
        <form  action="ins_propiedad.php" method="post" autocomplete="off" >
          <!--AJAX AQUI -->
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
              <input type="hidden" name="idcliente" value="<?php echo $id ?>">
              <input type="hidden" name="nombrecliente" value="<?php echo $nombre ?>">

            <div class="input-field">
              <input type="number" name="precio"  id="Precio" step='0.01' required  >
              <label for="Precio">Precio</label>
            </div>
            <div class="input-field">
              <input type="text" name="barriosector"  id="BarrioSector" required onblur="may(this.value, this.id)" >
              <label for="BarrioSector">Barrio/Sector</label>
            </div>

          </div> <!--Termina Primer columna -->
          <div class="col s6">

            <div class="input-field">
              <input type="text" name="callenum"   id="CalleNum" onblur="may(this.value, this.id)" required  >
              <label for="CalleNum">Calle y numero</label>
            </div>
            <div class="input-field">
              <input type="number" name="numeroint"  id="NumeroInt"  >
              <label for="NumInt">Numero interior</label>
            </div>

          </div><!-- TerminaSegunda columna -->
        </div>


        <h5 align="center"><b>CARACTERISTICAS</b></h5>
        <div class="row">
          <div class="col s6">

            <div class="input-field">
              <input type="number" name="m2t"   id="M2t"  >
              <label for="M2t">Metros cuadrados de terreno</label>
            </div>
            <div class="input-field">
              <input type="number" name="baños"   id="Baños"  >
              <label for="Baños">Baños</label>
            </div>
            <div class="input-field">
              <input type="number" name="plantas"   id="Plantas"  >
              <label for="Plantas">Plantas</label>
            </div>
            <div class="input-field">
              <textarea name="caracteristicas" rows="8" cols="80" id="Caracteristicas" onblur="may(this.value, this.id)" class="materialize-textarea"></textarea>
              <label for="Caracteristicas">Otras caracteristicas</label>
            </div>

          </div><!--Termina Primer columna -->

          <div class="col s6">

            <div class="input-field">
              <input type="number" name="m2c"   id="M2c"  >
              <label for="M2c">Metros cuadrados de construccion</label>
            </div>
            <div class="input-field">
              <input type="number" name="cuartos"   id="Cuartos"  >
              <label for="Cuartos">Cuartos</label>
            </div>
            <div class="input-field">
              <input type="number" name="garajes"   id="Garajes"  >
              <label for="Garajes">Garajes</label>
            </div>
            <div class="input-field">
              <textarea name="observaciones" rows="8" cols="80" id="Observaciones" onblur="may(this.value, this.id)" class="materialize-textarea"></textarea>
              <label for="Observaciones">Observaciones</label>
            </div>

          </div><!-- TerminaSegunda columna -->
        </div>


        <h5 align="center"><b>DATOS DE VENTA</b></h5>
        <div class="row">
          <div class="col s6">

            <div class="input-field">
              <input type="text" name="formapago"  id="FormaPago" onblur="may(this.value, this.id)" required pattern="[A-Z\s ]+"  >
              <label for="FormaPago">Forma de pago</label>
            </div>

              <?php if ($_SESSION['nivel'] == 'ADMINISTRADOR'): ?>
                <select class="" name="asesor" required>
                  <option value="" disabled selected>ESCOJE UN ASESOR</option>
                  <?php
                    $select = $conexion->prepare("SELECT nombre_usuario FROM usuarios WHERE bloqueo_usuario = 1");
                    $select->execute();
                    $resultado = $select->get_result();

                    while ($f = $resultado->fetch_assoc())
                    {
                  ?>

                  <option value="<?php echo $f['nombre_usuario'] ?>"><?php echo $f['nombre_usuario'] ?></option>

                  <?php
                    }
                    $select->close();
                    $conexion->close();
                  ?>
                </select>
                  <?php else: ?>
                    <input type="text" readonly name="asesor" value="<?php echo $_SESSION['nombre'] ?>">
              <?php endif; ?>

            <select name="tipoinmueble" required >
              <option value="" disabled selected  >ELIGE EL TIPO DE INMUEBLE</option>
              <option value="CASA">CASA</option>
              <option value="TERRENO">TERRENO</option>
              <option value="LOCAL">LOCAL</option>
              <option value="DEPARTAMENTO">DEPARTAMENTO</option>
            </select>

          </div><!-- Termina Primera columna -->

          <div class="col s6">

            <div class="input-field">
              <!-- Se inicializa-->
              <input type="date" class="datepicker" name="fecharegistro" id="FechaRegistro" required >
              <label for="FechaRegistro">Fecha de registro</label>
            </div>

            <div class="input-field">
              <textarea name="comentarioweb" rows="8" cols="80" id="ComentarioWeb" onblur="may(this.value, this.id)" class="materialize-textarea"></textarea>
              <label for="ComentarioWeb">Comentario para los clientes en la web</label>
            </div>

            <select name="operacion" required  >
              <option value="" disabled selected  >ELIGE LA OPERACION</option>
              <option value="VENTA">VENTA</option>
              <option value="RENTA">RENTA</option>
              <option value="TRASPASO">TRASPASO</option>
              <option value="OCUPADO">OCUPADO</option>
            </select>

          </div><!-- Termina Segunda columna -->
        </div>
        <center>
        <button type="submit" class="btn">Guardar</button>
        </center>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../extend/scripts.php'; ?>
<script src="../js/departamentos.js"></script>
</body>
</html>
