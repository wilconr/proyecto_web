<nav class="black">
  <a href="#" data-activates="menu" class="button-collpase"><i class="material-icons">menu</i></a>
</nav>
<ul id="menu" class="side-nav fixed">
  <li>
    <div class="userView">
      <div class="background">
        <img src="https://t3.ftcdn.net/jpg/01/42/27/88/240_F_142278822_nNCrHV9TozDpIvl5kVi0rxjRjuBZCdPq.jpg" alt="">
      </div>
      <a href="../perfil/index.php"><img src="../usuarios/<?php echo $_SESSION['foto'] ?>" class="circle"></a>
      <a href="../perfil/perfil.php"class="white-text"><?php echo $_SESSION['nombre'] ?></a>
      <a href="#"class="white-text"><?php echo $_SESSION['correo'] ?></a>
    </div>
  </li>
  <li><a href="../inicio"><i class="material-icons">home</i>INICIO</a></li>
  <li><div class="divider"></div></li>
  <li><a href="../usuarios"><i class="material-icons">contacts</i>USUARIOS</a></li>
  <li><div class="divider"></div></li>
  <li><a href="../clientes"><i class="material-icons">contact_phone</i>CLIENTES</a></li>
  <li><div class="divider"></div></li>
  <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons">work</i>PROPIEDADES<i class="material-icons right">arrow_drop_down</i></a></li>
  <li><div class="divider"></div></li>
  <li><a href="../login/salir.php"><i class="material-icons">power_settings_new</i>SALIR</a></li>
  <li><div class="divider"></div></li>
</ul>

<ul id="dropdown1" class="dropdown-content">
  <li><a href="../propiedades/index.php">GENERAL</a></li>
  <li><a href="../propiedades/index.php?ope=VENTA">VENTA</a></li>
  <li><a href="../propiedades/index.php?ope=RENTA">RENTA</a></li>
  <li><a href="../propiedades/index.php?ope=TRASPASO">TRASPASO</a></li>
  <li><a href="../propiedades/index.php?ope=OCUPADO">OCUPADO</a></li>
  <li><a href="../propiedades/cancelados.php">CANCELADOS</a></li>
</ul>
