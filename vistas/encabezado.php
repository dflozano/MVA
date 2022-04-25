<?php
    include 'conexión.php'; 
 //-----------------------traer nombre del usuario que tiene la seccion-------------------------------------------------------------

  $usuarioen= $_SESSION['usuario'];//OBTIENE EL DATO DE LA SECCION INICIADA DATOS TARIDOS DE LA BITACORA
  
  $sqlen="SELECT CodigoRol, Usuario FROM tbl_usuario where  Usuario='$usuarioen'";
//  $resultadoen=$conn->query($sqlen);//guarda la consulta
//  $rowen=$resultadoen->fetch_assoc();//arreglo asociativo
//  $rolen=($rowen['CodigoRol']);  // variable con el rol del usuario
 
  $sqlusu="SELECT CodigoUsuario FROM tbl_usuario where Usuario='$usuarioen'";
  $valorusu= mysqli_query ($conn,$sqlusu);
  $valorusu= mysqli_fetch_array ($valorusu);
  $codigousu=$valorusu[0];



if (isset($_POST['CerrarS'])){
  if ($_POST['CerrarS']){
        echo '<script>
        window.location="../vistas/login.php";
        </script>';
        $CodObjeto=18;
        $accion='Salir';
        $descrip='Salida del Sistema.';
        bitacora($CodObjeto,$accion,$descrip);
  }
}

?>
  <!-- /.navbar -->

  <!-- Main SIDEBAR Container------------------------------------------------------------------------------------------------------ -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../vistas/principalusuarios.php" class="brand-link">
      <img src="dist/img/minuta.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MVA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="../vistas/perfil.php?CodigoUsuario=<?php echo $codigousu?>" class="d-block"> <?php  echo $usuarioen;?></a><!--Nombre del usuario logiado-->
        </div>
      </div>

  
 <form class="" action="" method="POST">

      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library ===========================================-->
          <li class="nav-item menu-open"  >
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Menú
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <?php // if($rolen=="1"){?>   <!-- ROL 1 ADMIN SI ES ADMIN ACCESO COMPLETO AL MENU -->
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right  nav-icon"></i>
                  <p>Personas</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../personas/tablapersonas.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tabla de Personas</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right   nav-icon"></i>
                  <p>Pedido</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../pedido/tablapedidos.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pedido de Minutas</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../pedido/tablapedidosProducto.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Restaurante</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right  nav-icon"></i>
                  <p>Eventos</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../eventos/eventos_cata.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Catálago de Eventos</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../eventos/eventos_eventosdetallados.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pedidos de Eventos</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Producto</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../producto/catalogominutas.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Catálago de Minutas</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../producto/cata_productoRestaurante.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Catálago de Restaurante</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../producto/eventos_producto.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Catálago de Producto Eventos</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Compras</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../compras/compras.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Compras</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Inventario</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../inventario/cata_producto.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Materia Prima</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../inventario/Inventario.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Inventario Existente</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../inventario/inventario_kardex.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kardex</p>
                    </a>
                  </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Administración</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../vistas/gestion_principal.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Gestión de Usuarios</p>
                    </a>
                  </ul>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../vistas/administracion.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Respaldo</p>
                    </a>
                  </ul>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../vistas/bitacora.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Bitácora</p>
                    </a>
                  </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Seguridad</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../vistas/gestion_permisos.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Permisos</p>
                    </a>
                  </ul>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../mantenimiento/mantenimiento.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mantenimiento</p>
                    </a>
                  </ul>
              </li>
               <!-- Sidebar Menu -->
              <li class="nav-item menu-switched off">
              <li class="nav-item menu-switched off">
              <input name='CerrarS' value="Cerrar Sesión" type="submit" class="btn btn-primary btn-lg btn-block">
              </li>
              </li>
            </ul>
          

            <?php//  } ?> <!-- ROL 1 ADMIN FIN------------------------------------------>

            <?php // if($rolen=="2"){?>  <!-- ROL 2 DEFAUL  ACCESO RESTRINGIDO A MANTENIMIENTO MENU 
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right  nav-icon"></i>
                  <p>Personas</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../personas/tablapersonas.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tabla de Personas</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right   nav-icon"></i>
                  <p>Pedido</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../pedido/catalogominutas.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Catálago de Minutas</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../pedido/tablapedidos.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pedido</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right  nav-icon"></i>
                  <p>Eventos</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../eventos/eventos_producto.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Catálago de Producto</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../eventos/eventos_cata.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Catálago de Eventos</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../eventos/eventos_nuevopaquete.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Formar Paquetes</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../eventos/eventos_eventosdetallados.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pedidos de Eventos</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Producto</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../producto/cata_producto.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Catalogo Producto</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Compras</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../compras/compras.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Compras</p>
                    </a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Inventario</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../inventario/Inventario.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Inventario Existente</p>
                    </a>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../inventario/inventario_kardex.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kardex</p>
                    </a>
                  </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Administración</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../vistas/gestion_principal.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Gestión de Usuarios</p>
                    </a>
                  </ul>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../vistas/administracion.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Respaldo</p>
                    </a>
                  </ul>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../vistas/bitacora.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Bitácora</p>
                    </a>
                  </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Seguridad</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../vistas/gestion_permisos.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Permisos</p>
                    </a>
                  </ul>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../mantenimiento/mantenimiento.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mantenimiento</p>
                    </a>
                  </ul>
              </li>
              <li class="nav-item menu-switched off">
              <input name='CerrarS' value="Cerrar Sesión" type="submit" class="btn btn-primary btn-lg btn-block">
              </li>
            </ul>-->
            <?php// } ?> 
            <!-- ROL 2 DEFAUL FIN-->

            <?php // if($rolen=="3"){?>  <!-- ROL 3 USUARIO ACCESO RESTRINGIDO A MANTENIMIENTO MENU 
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right  nav-icon"></i>
                  <p>Personas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right   nav-icon"></i>
                  <p>Pedido</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right  nav-icon"></i>
                  <p>Eventos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Producto</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Compras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="inventario.php" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Inventario</p>
                </a>
              </li>
              
              <li class="nav-item menu-switched off">
                <a href="login.php" class="nav-link ">
                <i class="nav-icon fa fa-power-off"></i>
                  <p>Cerrar Sesión</p>
                </a>
              </li>
            </ul>-->
            <?php // } ?> <!-- ROL 3 USUARIO FIN-->
          </li>
          
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
            </form>
