<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Almacén</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../almacen/marca.php"><i class="fa fa-circle-o"></i> Marca</a></li>
            <li><a href="../almacen/producto.php"><i class="fa fa-circle-o"></i> Producto</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-truck"></i> <span>Compras</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../compras/proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
            <li><a href="../compras/compraProveedor.php"><i class="fa fa-circle-o"></i> Realizar compra</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../ventas/cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
            <li><a href="../ventas/ventaCliente.php"><i class="fa fa-circle-o"></i> Realizar Ventas</a></li>
          </ul>
        </li>
        <li class="header">Listar</li>
        <!--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Flujo de Caja</span></a></li>
        
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Pedidos</span></a></li>-->

        <li><a href="../listar/listarVC.php"><i class="fa fa-circle-o text-info"></i> <span>Ventas y compras</span></a></li>
     
        <li class="header">REPORTES</li>
        <!--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Flujo de Caja</span></a></li>
        
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Pedidos</span></a></li>-->

        <li><a href="../kardex/kardex.php"><i class="fa fa-circle-o text-yellow"></i> <span>Kardex</span></a></li>


        <?php 
    
    
        if($_SESSION['U_idRol']==1){
        require('../menus/sideMenuAdministrador.php');
      }
     
    
 ?>

        
      </ul>
    