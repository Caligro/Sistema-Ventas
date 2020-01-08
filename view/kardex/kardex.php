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
    <!-- Select2 -->
    <link rel="stylesheet" href="../../assets/css/select2.min.css">
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
        Kardex
        <small>Página</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Kardex</a></li>
        <li class="active">Kardex</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
         <div class="col-xs-12" id="scrollToHere">
  
        </div>
<div class="col-xs-12">
       <!-- Box de listado de Kardex -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Movimientos por producto</h3>

          <div class="box-tools pull-right">
            
              <button href="#contraeLista" type="button" class="btn btn-info btn-sm"  data-toggle="collapse"
                        title="Collapse">
                  <i class="fa fa-circle-o"></i></button>
          </div>
        </div>
        <div id="contraeLista" class="collapse in">
            <div class="box-body">
                
            <form class="form-horizontal">  
                <div class="form-group">
                <label class="col-sm-1 control-label">Producto: </label>
                    <div class="col-sm-2">
                       <select id="cboProducto"  class="form-control select2" style="width:100%;">

                     </select>
                    </div>
                  <label for="fechaInicial" class="col-sm-1 control-label">FechaInicial:</label>
                       <div class="col-sm-2">
                       <input type="date" id="fechaInicial" class="form-control col-md-7 col-xs-12" value="<?php echo date("Y-m-d");?>"/>

                       </div>
                    <label for="fechaFinal" class="col-sm-1 control-label">FechaFinal:</label>
                       <div class="col-sm-2">
                       <input type="date" id="fechaFinal" class="form-control col-md-7 col-xs-12" value="<?php echo date("Y-m-d");?>"/>

                       </div>
                   
                  <button type="button"  style="margin-left:15px;" class="btn btn-info btn-md" id="btnBuscar">Buscar</button>
                  <button type="button"  style="margin-left:15px;" class="btn btn-warning btn-md" id="btnImprimir">Imprimir</button>
                </div> 
                
            <form>


            <table id="datatable-Kardex" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nº</th>
                  <th style="width:20%">Tipo Movimiento</th>
                  <th>Fecha</th>
                  <th>Cantidad</th>
                  <th>Stock</th>
                </tr>
                </thead>
                <tbody id="bodytable-Kardex">
                 
                </tbody>
              </table>

            </div>
            <div class="box-footer">
                <!--<button href="#contrae" style="background-color:#3498DB" data-toggle="collapse" type="button" class="btn btn-info btn-sm" id="btnRegistrar">REGISTRAR</button>-->
            </div>   
        </div>
      </div>
      <!-- /.box de listado de Kardex -->
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
<!-- jsPDF -->
<script src="../../assets/js/jsPDF-1.3.2/dist/jspdf.debug.js"></script>
<!-- Capa JS -->
<script src="../js/kardex/kardex.js"></script>
<!-- Select2 -->
<script src="../../assets/js/select2.full.min.js"></script>

</body>
</html>
