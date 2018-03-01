<?php
include '../conexion/conexion.php';

$departamento = htmlentities($_POST['departamento']);

?>

<select id="Municipio" name="municipio" required>
  <option value="" disabled selected>ESCOJE UN MUNICIPIO</option>
  <?php
    $selectMun = $conexion->prepare("SELECT * FROM municipios WHERE id_dep = ?");
    $selectMun->bind_param('i',$departamento);
    $selectMun->execute();
    $resultadoMun = $selectMun->get_result();

    while ($fMun = $resultadoMun->fetch_assoc())
    {
    ?>

    <option value="<?php echo $fMun['municipio_mun'] ?>"><?php echo $fMun['municipio_mun'] ?></option>

    <?php
      }
      $selectMun->close();
      $conexion->close();
    ?>
</select>

<script>
  $('select').material_select();
</script>
