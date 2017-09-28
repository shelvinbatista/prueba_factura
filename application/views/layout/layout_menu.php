<!--
  Tipo: Menu
  Descripcion: Codigo HTML para mostrar del menu del sistema desde que el usuario inicia sesion
-->
<?php
  switch ($this->session->userdata('tipo_usuario_prueba')) {
    case 'Empleado':
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= base_url();?>index.php/home">Facturas.com</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
          switch ($page) {
            case 'Productos':
        ?>
          <li class="active"><a href="<?= base_url();?>index.php/admin_productos">Productos <span class="sr-only">(current)</span></a></li>
          <li><a href="<?= base_url();?>index.php/realizar_factura">Facturas</a></li>
          <li><a href="<?= base_url();?>index.php/admin_usuarios">Usuarios</a></li>
        <?php
              break;
            case 'Facturas':
        ?>
          <li><a href="<?= base_url();?>index.php/admin_productos">Productos</a></li>
          <li class="active"><a href="<?= base_url();?>index.php/realizar_factura">Facturas <span class="sr-only">(current)</span></a></li>
          <li><a href="<?= base_url();?>index.php/admin_usuarios">Usuarios</a></li>
        <?php
              break;
            case 'Home':
        ?>
          <li><a href="<?= base_url();?>index.php/admin_productos">Productos</a></li>
          <li><a href="<?= base_url();?>index.php/realizar_factura">Facturas</span></a></li>
          <li><a href="<?= base_url();?>index.php/admin_usuarios">Usuarios</a></li>
        <?php
              break;
            case 'Perfil':
        ?>
          <li><a href="<?= base_url();?>index.php/admin_productos">Productos</a></li>
          <li><a href="<?= base_url();?>index.php/realizar_factura">Facturas</span></a></li>
          <li><a href="<?= base_url();?>index.php/admin_usuarios">Usuarios</a></li>
        <?php
              break;
            case 'Usuarios':
        ?>
          <li><a href="<?= base_url();?>index.php/admin_productos">Productos</a></li>
          <li><a href="<?= base_url();?>index.php/realizar_factura">Facturas</span></a></li>
          <li class="active"><a href="<?= base_url();?>index.php/admin_usuarios">Usuarios <span class="sr-only">(current)</span></a></li>
        <?php
              break;
          }
        ?>
        
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <?php
          if($page == "Perfil"){
        ?>
        <li class="active"><a href="<?= base_url();?>index.php/editar_perfil">Perfil <span class="sr-only">(current)</span></a></li>
        <?php
          }else{
        ?>
        <li><a href="<?= base_url();?>index.php/editar_perfil">Perfil</a></li>
        <?php
          }
        ?>
        <li><a href="<?= base_url();?>index.php/Services_usuarios/api_cerrar_sesion">Cerrar Sesión</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
      break;

      case "Cliente":
?>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= base_url();?>index.php/home">Facturas.com</a>
      </div>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <?php
          switch ($page) {            
            case 'Facturas':
        ?>
          <li class="active"><a href="<?= base_url();?>index.php/realizar_abonos">Facturas <span class="sr-only">(current)</span></a></li>
        <?php
              break;
            case 'Home':
        ?>
          <li><a href="<?= base_url();?>index.php/realizar_abonos">Facturas</a></li>
        <?php
              break;
            case 'Perfil':
        ?>
          <li><a href="<?= base_url();?>index.php/realizar_abonos">Facturas</a></li>
        <?php
              break;
          }
        ?>
          
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <?php
            if($page == "Perfil"){
          ?>
          <li class="active"><a href="<?= base_url();?>index.php/editar_perfil">Perfil <span class="sr-only">(current)</span></a></li>
          <?php
            }else{
          ?>
          <li><a href="<?= base_url();?>index.php/editar_perfil">Perfil</a></li>
          <?php
            }
          ?>
          <li><a href="<?= base_url();?>index.php/Services_usuarios/api_cerrar_sesion">Cerrar Sesión</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
<?php
        break;
  }
?>
