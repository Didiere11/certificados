<?php 
    if  (!isset($_SESSION)){
      session_start();
      $corr = "";
    }
    $corr = isset($_SESSION["correo"])?$_SESSION["correo"]:"";
    $img = isset($_SESSION["imagen"])?$_SESSION["imagen"]:"";
    $idSess = session_id();
?>
<header>
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="../Menu/">Menus</a></li>
  <li><a href="../Rol/">Rol</a></li>
  <li><a href="../Usuario/">Usuario</a></li>
  <li><a href="../Stat/">Status</a></li>
  <li class="divider"></li>
  <li><a href="../Perfil/">Perfil</a></li>
</ul>
<ul id="dropdown2" class="dropdown-content">
  <li><a href="../Chart/graficacarr.php">Carrera</a></li>
  <li><a href="../Chart/grafico.php">Status</a></li>
</ul>
<nav class="indigo darken-4">
  <div class="nav-wrapper">
  
    <a href="../Home/" class="brand-logo">  <img src="../imagenes/icono.png" length="45" Width="45"> Certificados </a>
    <ul class="right hide-on-med-and-down">
      <!-- <li><a href="../TypeDevice/">Tipo Dispositivo</a></li>-->
      <!-- <li><a href="../chart/">Graficar</a></li> -->
      <li><a href="../Reportes/">Certificados</a></li>
      <li><a href="../Carrera/">Carreras</a></li>
      <!-- Dropdown Trigger -->
      <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Graficas<i class="material-icons right">arrow_drop_down</i></a></li>
      <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Administración<i class="material-icons right">arrow_drop_down</i></a></li>
      <?php
          if ($corr == "")
             echo "<li><a href='../Acceso/''>Iniciar sesión</a></li>";
          else
             echo "<li><a href='../Acceso/destruir.php''>$corr(Cerrar)</a></li>";
      ?>
    </ul>
  </div>
</nav>

  <ul id="slide-out" class="sidenav">
    <li><div class="user-view">
      <div class="background">
          <img src='../Imagenes/office.jpg'>
      </div>
      <?php
           if ($img == "")
              echo "<a href='#user'><img class='circle' src='../Imagenes/Tecnm.png'></a>";
           else
              echo "<a href='#user'><img class='circle' src='$img'></a>";
           echo "<a href='#name'><span class='black-text name'>TECNM</span></a>
           <a href='#email'><span class='black-text email'>$corr</span></a>";
        ?>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Sistemas y Computación</a></li>
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">JavaScript</a></li>
  </ul>
  <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        
</header>

