 
<?php 
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tienda Reverdecer Inventario</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- morris -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
  
  <!-- Icono de la pestaña -->

  <link rel="icon" href="vistas/img/sistema/logo_small_icon_only_inverted.png">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/dataTables.net-bs/css/responsive.bootstrap.min.css">
  <!-- date Range picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- javascript -->
  <!-- Chart.js -->
  <script src="vistas/bower_components/chart.js/Chart.js"></script>
  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="vistas/dist/js/demo.js"></script>
   <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- Diseño responsivo datatables -->
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <!-- Sweetalert2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>
  <!-- input mask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- date range picker -->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!--jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>
  <!-- morris  -->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
<!-- Site wrapper -->


  <?php
    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"]=="ok"){

      echo '<div class="wrapper">';
        include "modulos/cabezote.php";
        include "modulos/menu.php";
        if(isset($_GET["ruta"])){
          if($_GET["ruta"]=="inicio" || 
            $_GET["ruta"]=="registrar-ventas" ||
            $_GET["ruta"]=="reportes-ventas" ||           
            $_GET["ruta"]=="gestionar-inventarios" ||
            $_GET["ruta"]=="gestionar-empleados"  ||
            $_GET["ruta"]=="gestionar-clientes" ||
            $_GET["ruta"]=="gestionar-proveedores" ||
            $_GET["ruta"]=="auditorias" ||
            $_GET["ruta"]=="cargos" || 
            $_GET["ruta"]=="salir"||
            $_GET["ruta"]=="gestionar-categorias" || 
            $_GET["ruta"]=="gestionar-medio-pago" || 
            $_GET["ruta"]=="crear-venta" ||
            $_GET["ruta"]=="editar-venta")
            {
              include "modulos/".$_GET["ruta"].".php";
            }else{
              include "modulos/404.php";

          }
        }else{
            include "modulos/inicio.php";

        }
          include "modulos/piepagina.php";
        echo '</div>';
    }else{
      include "modulos/login.php";

    }
  ?>

  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/cargos.js"></script>
  <script src="vistas/js/empleados.js"></script>
  <script src="vistas/js/clientes.js"></script>
  <script src="vistas/js/proveedores.js"></script>
  <script src="vistas/js/categorias.js"></script>
  <script src="vistas/js/inventarios.js"></script>
  <script src="vistas/js/medio.pago.js"></script>
  <script src="vistas/js/ventas.js"></script>
  <script src="vistas/js/reportes.js"></script>
</body>
</html>
