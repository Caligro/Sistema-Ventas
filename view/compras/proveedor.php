<?php 
     session_start();  
     if(!isset($_SESSION['U_idRol']) && !isset($_SESSION['U_idVendedor']))
     {
       if($_SESSION['U_idRol']!=2){
         header("Location:../login.php");   
       }
     }
     else
     {
       date_default_timezone_set('America/Lima');
     }
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISTEMA | Ventas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../assets/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="../../assets/css/_all-skins.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="../../assets/css/dataTables.bootstrap.min.css">
   <!-- Main style -->
  <link rel="stylesheet" href="../../assets/css/min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- top menu -->
     <?php 
      require('../menus/topNavigation.php');
     ?>
    <!-- /top menu -->
  </header>

  <!-- Columna vertical -->
  <aside class="main-sidebar">
    <section class="sidebar">

      <!-- top menu -->
      <?php 
        require('../menus/topMenu.php');
      ?>
      <!-- /top menu -->
      
      <!-- sidebar menu -->
      <?php 
        require('../menus/sideMenu.php');
      ?>
      <!-- /sidebar menu -->
    </section>
  </aside>

  <!-- ***** Contenido de la página *****-->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Proveedor
        <small>Página</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Compras</a></li>
        <li class="active">Proveedor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-xs-12" id="scrollToHere">
      <!-- Box de registro de Proveedor -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Registra y actualiza los proveedores</h3>

          <div class="box-tools pull-right">
            
              <button href="#contrae" type="button" class="btn btn-info btn-sm"  data-toggle="collapse"
                        title="Collapse">
                  <i class="fa fa-circle-o"></i></button>
          </div>
        </div>
        <div id="contrae" class="collapse  collapse2">
        
            <div class="box-body">
            <form class="form-horizontal">  
                <div class="form-group">
                  <label for="txtRazonSocial" class="col-sm-2 control-label">Razón social: </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="txtRazonSocial" placeholder="razon social">
                  </div>
                </div> 
                <div class="form-group">
                  <label for="txtRuc" class="col-sm-2 control-label">RUC: </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="txtRuc" placeholder="ruc">
                  </div>
                </div>   
            </form>
            </div>
            <div class="box-footer">
                <button type="button"  class="btn btn-info btn-md" id="btnRegistrar">Registrar</button>
                <button type="button"  class="btn btn-success btn-md" id="btnEditar">Guardar cambios</button>
                <button type="button"  class="btn btn-danger btn-md" id="btnCancelar">Cancelar</button>
            </div>   
            
        </div>
      </div>
      <!-- /.box de registro de Proveedor -->
</div>
<div class="col-xs-12">
       <!-- Box de listado de Proveedor -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de proveedores</h3>

          <div class="box-tools pull-right">
            
              <button href="#contraeLista" type="button" class="btn btn-info btn-sm"  data-toggle="collapse"
                        title="Collapse">
                  <i class="fa fa-circle-o"></i></button>
          </div>
        </div>
        <div id="contraeLista" class="collapse in">
            <div class="box-body">
                
            <table id="datatable-Proveedor" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nº</th>
                  <th>Proveedor</th>
                  <th>RUC</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="bodytable-Proveedor">
                 
                </tbody>
              </table>

            </div>
            <div class="box-footer">
                <!--<button href="#contrae" style="background-color:#3498DB" data-toggle="collapse" type="button" class="btn btn-info btn-sm" id="btnRegistrar">REGISTRAR</button>-->
            </div>   
        </div>
      </div>
      <!-- /.box de listado de Proveedor -->
      </div>
</div>
    </section>
    
    <!-- /.content -->
  </div>
  <!-- ***** Fin del contenido de la página *****-->

  <!-- footer content -->
  <?php 
    require('../menus/footerContent.php');
  ?>
  <!-- /footer content -->

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script type="text/javascript" src="../../assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../assets/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../assets/js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../assets/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../assets/js/demo.js"></script>
<!-- DataTables -->
<script src="../../assets/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/dataTables.bootstrap.min.js"></script>
<!-- Capa JS -->
<script src="../js/compras/proveedor.js"></script>

</body>
</html>
