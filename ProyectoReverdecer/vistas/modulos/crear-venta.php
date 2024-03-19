<div class="content-wrapper">
    <section class="content-header">
      <h1 class="text-primary">
        Registrar ventas
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="registrar-ventas">Gestionar ventas</a></li>
        <li><a class="active" href="#">Crear venta</a></li>
      </ol>
    </section> 
    <section class="content">
      <div class="row">
         <!-- Formulario -->
        <div class="col-lg-5 col-xs-12" >
          <div class="box box-success">
            <div class="box-header with-border"></div>
            <form role="form" method="POST" class="formularioVenta">
              <div class="box-body">
                  <div class="box">
                    <!-- Empleado -->
                    <label>Empleado</label>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedro" value="<?php echo $_SESSION["Nombre"];?>" readonly required>
                        <input type="hidden" id="IdEmpleado" name="IdEmpleado" value="<?php echo $_SESSION["IdEmpleado"]; ?>">
                      </div>
                    </div>
                    <!-- Codigo venta -->
                    <label>Código de venta</label>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <!-- creación del codigo de venta -->
                        <?php 
                          $item=null;
                          $valor=null;
                          $ventas=ControladorVentas::ctrMostrarVentas($item,$valor);
                          if(!$ventas){
                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="1" readonly required>';
                          }else{
                            foreach($ventas as $key => $value){
                              
                            }
                            $codigo=$value["codigoVenta"]+1;
                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly required>';
                          }
                        ?>
                        
                      </div>
                    </div>
                    <!-- Cliente -->
                    <label>Cliente</label>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <select type="text" class="form-control" id="nuevoCliente" name="nuevoCliente" required>
                          <option value="">Seleccionar cliente</option>
                          <?php
                            $item=null;
                            $valor=null;
                            $clientes=ControladorClientes::ctrMostrarClientes($item,$valor);
                            foreach($clientes as $key => $value){
                              echo '<option value="'.$value["IdCliente"].'">'.$value["Nombre"].'</option>';
                            }
                          ?>
                        </select>
                        <span class="input-group-addon"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarCliente">Agregar cliente</button></span>
                      </div>
                    </div>
                    <!-- Producto -->
                    <label>Agregar producto</label>
                    <div class="form-group row nuevoProducto">
                      
                    </div>
                    <input type="hidden" id="listarProductos" name="listarProductos">

                    <!-- Boton para agregar producto en pantallas pequeñas -->
                    <button type="button" class="btn btn-primary hidden-lg btnAgregarProducto">Agregar producto</button>
                    <hr>
                    <div class="row">
                      <div class="col-xs-8 pull-right">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Impuesto</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td style="width: 50%;">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                  <input class="form-control" type="number" name="nuevoImpuestoVenta" id="nuevoImpuestoVenta" min="0" required>
                                  <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto">
                                  <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto">
                                </div>
                              </td>
                              <td style="width: 50%;">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                  <input class="form-control" type="text" name="nuevoTotalVenta" total="" id="nuevoTotalVenta"required>
                                  <input type="hidden" name="totalVenta" id="totalVenta">
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <hr>
                    <!-- Método de pago -->
                    <label>Método de pago</label>
                    <div class="form-group row">
                      <div class="col-xs-6" style="padding-right: 0px;">
                        <div class="input-group">
                          <select class="form-control metodoPago" name="metodoPago" id="metodoPago" required>
                            <option value="Seleccion">Seleccione el método de pago</option>
                            <?php
                            $item=null;
                            $valor=null;
                            $mPago=ControladorPagos::ctrMostrarPagos($item,$valor);
                            foreach($mPago as $key => $value){
                              echo '<option value="'.$value["idTpago"].'">'.$value["descripcion"].'</option>';
                            }
                          ?>
                          </select>
                        </div>
                      </div>
                      <div class="cajasMetodoPago">

                      </div>
                    </div> 
                    <br>                   
                  </div>              
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Guardar Venta</button>
              </div>
            </form>
            <?php 
              $registrarVenta= new ControladorVentas();
              $registrarVenta->ctrCrearVenta();
            ?> 
          </div>
        </div>
        <!-- Tabla de los productos -->
        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
            <div class="box box-warning">
              <div class="box-header with-border"></div>
              <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas tablaVentas">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Código</th>
                      <th>Nombre</th>
                      <th>Stock</th>
                      <th>Valor</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $item=null;
                    $valor=null;
                    $orden="idProducto";
                    $productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
                    foreach($productos as $key => $value){
                        echo '<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$value["idProducto"].'</td>
                                <td>'.$value["Nombre"].'</td>';
                                if($value["CantSistema"]>=100){
                                  echo '<td><button class="btn btn-success">'.$value["CantSistema"].'</button></td>';
                                }elseif(($value["CantSistema"]>=50) && ($value["CantSistema"]<=99)){
                                  echo '<td><button class="btn btn-warning">'.$value["CantSistema"].'</button></td>';
                                }else{
                                  echo '<td><button class="btn btn-danger">'.$value["CantSistema"].'</button></td>';
                                }
                        echo    '<td>'.$value["PrecioVenta"].'</td>
                                <td>
                                  <div class="btn btn-group">
                                    <button class="btn btn-primary agregarProducto recuperarBoton" idProducto="'.$value["idProducto"].'">
                                    <i class="fa fa-plus-circle" > Agregar</i>
                                    </button>
                                  </div>          
                                </td>
                              </tr>';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
    </section>  
</div> 

  <!-- modal agregar cliente -->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-user">  Registrar nuevo cliente </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Identificación del cliente</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" name="IdCliente" class="form-control input-lg" placeholder="Ingrese la identificación del cliente" required><br>
                
                  </div> 
                  <br>
                  <label >Nombre completo del cliente</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa  fa-font"></i></span>
                    <input type="text" name="Nombre" class="form-control input-lg" placeholder="Ingrese completo del cliente" required><br>
                
                  </div>
                  <br>
                  <label >Número de contacto del cliente</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" name="Telefono" class="form-control input-lg" placeholder="Ingrese número teléfonico del cliente" required><br>
                
                  </div>  
                  <br>
                  <label >Dirección del cliente</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class=" fa fa-home"></i></span>
                    <input type="text" name="Direccion" class="form-control input-lg" placeholder="Ingrese la dirección del cliente" required><br>
                
                  </div> 
                  <br>
                  <label >Email</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="mail" name="Email" class="form-control input-lg" placeholder="Ingrese el email del cliente" required><br>
                
                  </div>
                  <br>
                  <label >Estado actual del cliente</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                    <select class="form-control input-lg" name="EstadoCliente" id="EditarEstadoCliente">
                      <option value="">Selecionr el estado</option>
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    </select><br>        
                  </div> 

              </div>            
              </div>
          </div>
          <!-- Pie del modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger fa-pull-rigth" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-success fa-pull-left"><i class="fa fa-check"></i> Registrar</button>  
          </div>
          <!-- Crear el cliente -->
          <?php
            $crearCliente = new  ControladorClientes();
            $crearCliente -> ctrCrearCliente();
          ?>
        </form>
    </div>
  </div>
</div>