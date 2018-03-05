<?php
@session_start();
if (isset($_SESSION['nick']))
{
  header('location:inicio');
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/materialize-icon.css">
    <title>Proyecto</title>
  </head>
  <body class="grey lighten-2">
    <main>
      <div class="row">
        <div class="input-field col s12 center">
          <img src="img/logo.png" width="200" class="circle">
        </div>
      </div>
      <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card z-depth-5">
                    <div class="card-content">
                        <span class="card-title"><center>Inicio de sesion</center></span>
                        <form action="login/index.php" method="post" autocomplete="off">
                          <div class="input-field">
                            <i class="material-icons prefix">perm_identity</i>
                            <input type="text" name="usuario" id="Usuario" required pattern="[A-Za-z]{8,15}" autofocus>
                            <label for="Usuario">Usuario</label>
                          </div>
                          <div class="input-field">
                            <i class="material-icons prefix">vpn_key</i>
                            <input type="password" name="clave" id="Clave" required pattern="[A-Za-z0-9]{8,15}">
                            <label for="Clave">Contraseña</label>
                          </div>
                          <div class="input-field center">
                            <button type="submit" class="btn waves-effect waves-light">Acceder</button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </main>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
  </body>
</html>
