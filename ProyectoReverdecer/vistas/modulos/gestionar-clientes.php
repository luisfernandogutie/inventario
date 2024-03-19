<div class="content-wrapper">
    <section class="content-header">
      <h1 class="text-primary">
        Gestión de clientes
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Gestionar clientes</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
            <i class="fa fa-plus-circle"></i>
            <span> Agregar nuevo cliente</span>
          </button>
        </div>
        <!-- Tabla cleintes -->
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive  tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th style="width:10px;">Identificación</th>
                <th style="width: 40px;">Nombre completo</th>
                <th style="width:40px;">Teléfono</th>
                <th>Dirección</th>
                <th>Email</th>
                <th style="width:10px;">Estado Actual</th>
                <th> Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Llamado de los datos de los clientes -->
            <?php
              $item=null;
              $valor=null; 
              $clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
              foreach($clientes as $key => $value){
                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["IdCliente"].'</td>
                        <td>'.$value["Nombre"].'</td>
                        <td>'.$value["Telefono"].'</td>
                        <td>'.$value["Direccion"].'</td>
                        <td>'.$value["Email"].'</td>';
                        if($value["EstadoCliente"]!=0){
                          echo '<td><button class="btn btn-success bnt-xs" disabled>Avtivado</button></td>';
                        }else{
                          echo '<td><button class="btn btn-danger bnt-xs" disabled>Desavtivado</button></td>';
                        }
                        echo '<td>
                          <div class="btn btn-group">
                            <button class="btn btn-warning btnEditarCliente" IdCliente="'.$value["IdCliente"].'" data-toggle="modal" data-target="#modalEditarCliente">
                             <i class="fa fa-pencil" > Editar</i>
                            </button>
                          </div>';
                        if($_SESSION["Cargo"]==1){
                          echo '<div class="btn btn-group">
                                  <button class="btn btn-danger btnEliminarCliente" IdCliente="'.$value["IdCliente"].'">
                                    <i class="fa fa-trash-o"> Eliminar</i>
                                  </button>
                                </div>';
                        }          
                        echo  '</td>
                      </tr>';
                }
            ?>
          </tbody>
          </table>
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
                    <input type="text" name="IdCliente" id="IdClienteValidar" class="form-control input-lg" placeholder="Ingrese la identificación del cliente" required><br>
                
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

<!-- modal editar cliente -->

<div id="modalEditarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-user">  Actualizar cliente </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Identificación del cliente</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" name="EditarIdCliente" id="EditarIdCliente"  class="form-control input-lg" value="" required><br>
                    <input class="hidden" name="IdClienteActual" id="IdClienteActual">
                  </div> 
                  <br>
                  <label >Nombre completo del cliente</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa  fa-font"></i></span>
                    <input type="text" name="EditarNombre" id="EditarNombre" class="form-control input-lg" value="" required><br>
                    <input class="hidden" name="NombreActual" id="NombreActual">
                  </div>
                  <br>
                  <label >Número de contacto del cliente</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" name="EditarTelefono" id="EditarTelefono" class="form-control input-lg" value="" required><br>
                    <input class="hidden" name="TelefonoActual" id="TelefonoActual">
                  </div>  
                  <br>
                  <label >Dirección del cliente</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class=" fa fa-home"></i></span>
                    <input type="text" name="EditarDireccion" id="EditarDireccion" class="form-control input-lg" value="" required><br>
                    <input class="hidden" name="DireccionActual" id="DireccionActual">
                  </div> 
                  <br>
                  <label >Email</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="mail" name="EditarEmail" id="EditarEmail" class="form-control input-lg" id="" required><br>
                    <input class="hidden" name="EmailActual" id="EmailActual">
                  </div>
                  <br>
                  <label >Estado actual del cliente</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                    <select class="form-control input-lg" name="EditarEstadoCliente" id="EditarEstadoCliente">
                      <option value="">Selecionr el estado</option>
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    </select><br>
                    <input class="hidden" name="EstadoClienteActual" id="EstadoClienteActual">
                  </div> 

              </div>            
              </div>
          </div>
          <!-- Pie del modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger fa-pull-rigth" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-warning fa-pull-left"><i class="fa fa-check"></i> Guardar cambios</button>  
          </div>
          <!-- Crear el cliente -->
          <?php
            $editarCliente = new  ControladorClientes();
            $editarCliente -> ctrEditarCliente();
          ?>
        </form>
    </div>
  </div>
</div>
<?php 
  $borrarCliente = new ControladorClientes();
  $borrarCliente =ControladorClientes::ctrBorrarCliente();
?>

