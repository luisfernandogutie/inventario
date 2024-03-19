<div class="content-wrapper">
   
    <section class="content-header">
      <h1 class="text-primary">
        Gestionar ventas
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Gestionar venta</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box">
        <div class="box-header with-border">
          <a href="crear-venta">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
              <i class="fa fa-plus-circle"></i>
              <span> Registrar nueva venta</span>
            </button>
          </a>
          <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            <span >
              <i class="fa fa-calendar"></i> Rango de Fecha
            </span>
            <i class="fa fa-caret-down"></i>
          </button>
        </div>

        <div style="text-align: center;">
          <h2 class="text-primary">Ventas Recientes</h2>
        </div>

        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablas">
            <thead>
              <tr>
                <!-- <th style="width: 30px;">id</th> -->
                <th style="width: 30px;">Código Venta</th>
                <th >Cliente</th>
                <th >Empleado</th>
                <th style="width: 30px;">Impuesto</th>
                <th style="width: 30px;">Neto</th>
                <th style="width: 30px;">Total</th>
                <th style="width: 30px;">Forma de pago </style></th>
                <th  style="width: auto;">Fecha Compra</th>
                <th  style="width: auto;">Accciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Llamado de los datos de las ventas -->
            <?php
              if(isset($_GET["fechaInicial"])){
                $fechaInicial=$_GET["fechaInicial"];
                $fechaFinal=$_GET["fechaFinal"];
              }else{
                $fechaInicial=null;
                $fechaFinal=null;
              } 
              $ventas = ControladorVentas::ctrMostrarRangoFechasVentas($fechaInicial,$fechaFinal);
              foreach($ventas as $key => $value){
                  echo '<tr>
                        <!-- <td>'.$value["id"].'</td> --> 
                        <td>'.$value["codigoVenta"].'</td>';
                        $itemCliente="IdCliente";
                        $valorCliente=$value["IdCliente"];
                        $nombreCliente=ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);
                  
                  echo  '<td>'.$nombreCliente["Nombre"].'</td>';
                        
                        $itemEmpleado="IdEmpleado";
                        $valorEmpleado=$value["IdEmpleado"];
                        $nombreEmpleado=ControladorEmpleados::ctrMostrarEmpleados($itemEmpleado,$valorEmpleado);

                  echo  '<td>'.$nombreEmpleado["Nombre"].'</td>                   
                        <td>'.number_format($value["Impuesto"],2).'</td>
                        <td>'.number_format($value["Neto"],2).'</td>
                        <td>'.number_format($value["Total"],2).'</td>';
                        $itemMetodoPago="idTpago";
                        $valorMetodoPago=$value["MetodoPago"];
                        $nombreMetodoPago=ControladorPagos::ctrMostrarPagos($itemMetodoPago,$valorMetodoPago);

                  echo  '<td>'.$nombreMetodoPago["descripcion"].'</td>
                        <td>'.$value["FechaCompra"].'</td>
                        <td>
                          <div class="btn btn-group">
                            <button class="btn btn-info bntImprimirFactura" codigoVenta="'.$value["codigoVenta"].'">
                              <i class="fa fa-print" > Imprimir</i>
                            </button>
                          </div>';
                          if($_SESSION["Cargo"]==1){
                            echo    '<div class="btn btn-group btnEliminarVenta" codigoVenta="'.$value["codigoVenta"].'">
                                      <button class="btn btn-danger" >
                                        <i class="fa fa-trash-o"> Eliminar</i>
                                      </button>
                                    </div>'; 
                          }                       
                  echo '</td>
                      </tr>';
                }
            ?>
          </tbody>
          </table>
          <?php 
            $eliminarVenta= new ControladorVentas();
            $eliminarVenta ->ctrEliminarVenta();

          ?>
        </div> 
    </div>

    </section>
  </div>

 