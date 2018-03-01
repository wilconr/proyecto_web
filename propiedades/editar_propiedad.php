<?php
include '../extend/header.php';
$id = $conexion->real_escape_string(htmlentities($_GET['id']));
$select_propiedad = $conexion->prepare("SELECT * FROM inventario WHERE propiedad_inv = ? ");
$select_propiedad->bind_param('s', $id);
$select_propiedad->execute();
$resultado_propiedad = $select_propiedad->get_result();
if ($f_propiedad =$resultado_propiedad->fetch_assoc())
{

}
?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Editar propiedad de: <?php echo $f_propiedad['nombre_cliente'] ?> </span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS GENERALES</b></h5>
        <form  action="up_propiedad.php" method="post" autocomplete="off" >
          <div class="row">
            <div class="col s6">
              <select id="Departamento" name="departamento" required>

                <?php
                  $selectDep = $conexion->prepare("SELECT id_dep FROM departamentos WHERE departamento_dep = ?");
                  $selectDep->bind_param('i',$f_propiedad['departamento_dep']);
                  $selectDep->execute();
                  $resultadoDep = $selectDep->get_result();
                  if ($f_Dep = $resultadoDep->fetch_assoc())
                  {

                  }
                ?>
                <option value="<?php echo $f_Dep['id_dep'] ?>"><?php echo $f_propiedad['departamento_dep'] ?></option>
                <?php
                  $select_departamento = $conexion->prepare("SELECT * FROM departamentos ");
                  $select_departamento->execute();
                  $resultado_departamento = $select_departamento->get_result();
                  while ($f_departamento = $resultado_departamento->fetch_assoc())
                  {
                ?>
                  <option value="<?php echo $f_departamento['id_dep'] ?>"><?php echo $f_departamento['departamento_dep']?></option>
                <?php
                  }
                  $select_departamento->close();
                ?>
              </select>
            </div>

            <div class="col s6">
              <div class="resultadoDep">
                <input type="text" name="municipio" value="<?php echo $f_propiedad['municipio_mun'] ?>" readonly="">
              </div>
            </div>

          </div>

        <div class="row">
          <div class="col s6">
              <input type="hidden" name="id" value="<?php echo $id ?>">

            <div class="input-field">
              <input type="number" name="precio"  id="Precio" step='0.01' required value="<?php echo $f_propiedad['precio_inv'] ?>" >
              <label for="Precio">Precio</label>
            </div>
            <div class="input-field">
              <input type="text" name="barriosector"  id="BarrioSector" required onblur="may(this.value, this.id)" value="<?php echo $f_propiedad['barrio_sector_inv'] ?>" >
              <label for="BarrioSector">barrio/sector</label>
            </div>

          </div> <!--Termina Primer columna -->
          <div class="col s6">

            <div class="input-field">
              <input type="text" name="callenum"   id="CalleNum" onblur="may(this.value, this.id)" required value="<?php echo $f_propiedad['calle_num_inv'] ?>" >
              <label for="CalleNum">Calle y numero</label>
            </div>
            <div class="input-field">
              <input type="number" name="numeroint"  id="NumeroInt" value="<?php echo $f_propiedad['numero_int_inv'] ?>" >
              <label for="NumInt">Numero interior</label>
            </div>

          </div><!-- TerminaSegunda columna -->
        </div>


        <h5 align="center"><b>CARACTERISTICAS</b></h5>
        <div class="row">
          <div class="col s6">

            <div class="input-field">
              <input type="number" name="m2t"   id="M2t" value="<?php echo $f_propiedad['m2t_inv'] ?>" >
              <label for="M2t">Metros cuadrados de terreno</label>
            </div>
            <div class="input-field">
              <input type="number" name="baños"   id="Baños" value="<?php echo $f_propiedad['baño_inv'] ?>" >
              <label for="Baños">Baños</label>
            </div>
            <div class="input-field">
              <input type="number" name="plantas"   id="Plantas" value="<?php echo $f_propiedad['plantas_inv'] ?>"  >
              <label for="Plantas">Plantas</label>
            </div>
            <div class="input-field">
              <textarea name="caracteristicas" rows="8" cols="80" id="Caracteristicas" onblur="may(this.value, this.id)" class="materialize-textarea"><?php echo $f_propiedad['caracteristicas_inv'] ?></textarea>
              <label for="Caracteristicas">Otras caracteristicas</label>
            </div>

          </div><!--Termina Primer columna -->

          <div class="col s6">

            <div class="input-field">
              <input type="number" name="m2c"   id="M2c"  value="<?php echo $f_propiedad['m2c_inv'] ?>">
              <label for="M2c">Metros cuadrados de construccion</label>
            </div>
            <div class="input-field">
              <input type="number" name="cuartos"   id="Cuartos" value="<?php echo $f_propiedad['cuartos_inv'] ?>" >
              <label for="Cuartos">Cuartos</label>
            </div>
            <div class="input-field">
              <input type="number" name="garajes"   id="Garajes" value="<?php echo $f_propiedad['garajes_inv'] ?>" >
              <label for="Garajes">Garajes</label>
            </div>
            <div class="input-field">
              <textarea name="observaciones" rows="8" cols="80" id="Observaciones" onblur="may(this.value, this.id)" class="materialize-textarea"><?php echo $f_propiedad['observaciones_inv'] ?></textarea>
              <label for="Observaciones">Observaciones</label>
            </div>

          </div><!-- TerminaSegunda columna -->
        </div>


        <h5 align="center"><b>DATOS DE VENTA</b></h5>
        <div class="row">
          <div class="col s6">

            <div class="input-field">
              <input type="text" name="formapago"  id="FormaPago" onblur="may(this.value, this.id)" required pattern="[A-Z\s ]+" value="<?php echo $f_propiedad['forma_pago_inv'] ?>" >
              <label for="FormaPago">Forma de pago</label>
            </div>



              <?php if ($_SESSION['nivel']  == 'ADMINISTRADOR'): ?>
                <select class="" name="asesor" required="">
                  <option value="<?php echo $f_propiedad['asesor_cliente'] ?>"><?php echo $f_propiedad['asesor_cliente'] ?></option>
                  <?php
                  $select = $conexion->prepare("SELECT nombre_usuario FROM usuarios WHERE bloqueo_usuario = 1 ");
                  $select->execute();
                  $resultado = $select->get_result();
                  while ($f =$resultado->fetch_assoc())
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
                  <input type="text" readonly name="asesor" value="<?php echo $f_propiedad['asesor_cliente'] ?>">
              <?php endif; ?>

            <select name="tipoinmueble" required >
              <option value="<?php echo $f_propiedad['tipo_inmueble_inv'] ?>"><?php echo $f_propiedad['tipo_inmueble_inv'] ?></option>
              <option value="CASA">CASA</option>
              <option value="TERRENO">TERRENO</option>
              <option value="LOCAL">LOCAL</option>
              <option value="DEPARTAMENTO">DEPARTAMENTO</option>
            </select>

          </div><!-- Termina Primera columna -->

          <div class="col s6">

            <div class="input-field">
              <!-- Se inicializa-->
              <input type="date" class="datepicker" name="fecharegistro" id="FechaRegistro" required value="<?php echo $f_propiedad['fecha_registro_inv'] ?>" >
              <label for="FechaRegistro">Fecha de registro</label>
            </div>

            <div class="input-field">
              <textarea name="comentarioweb" rows="8" cols="80" id="ComentarioWeb" onblur="may(this.value, this.id)" class="materialize-textarea"><?php echo $f_propiedad['comentario_web_inv'] ?></textarea>
              <label for="ComentarioWeb">Comentario para los clientes en la web</label>
            </div>

            <select name="operacion" required  >
              <option value="<?php echo $f_propiedad['operacion_inv'] ?>"><?php echo $f_propiedad['operacion_inv'] ?></option>
              <option value="VENTA">VENTA</option>
              <option value="RENTA">RENTA</option>
              <option value="TRASPASO">TRASPASO</option>
              <option value="OCUPADO">OCUPADO</option>
            </select>

          </div><!-- Termina Segunda columna -->
        </div>
        <center>
        <button type="submit" class="btn">Actualizar</button>
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
