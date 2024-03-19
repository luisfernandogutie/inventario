
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-primary">
        Gestión de proveedores
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Gestionar proveedores</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
            <i class="fa fa-plus-circle"></i>
            <span> Agregar nuevo proveedor</span>
          </button>
        </div>

      <!-- tabla de proveedores -->

      <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive  tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th style="width:10px;">Identificación</th>
                <th>Nombre completo</th>
                <th>Teléfono</th>
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
              $proveedores = ControladorProveedores::ctrMostrarProveedores($item,$valor);
              foreach($proveedores as $key => $value){
                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["IdProveedor"].'</td>
                        <td>'.$value["Nombre"].'</td>
                        <td>'.$value["Telefono"].'</td>
                        <td>'.$value["EmailProveedor"].'</td>';
                        if($value["EstadoProveedor"]!=0){
                          echo '<td><button class="btn btn-success bnt-xs " disabled>Activado</button></td>';
                        }else{
                          echo '<td><button class="btn btn-danger bnt-xs btnActivar" disabled>Desactivado</button></td>';
                        }
                        echo '<td>
                          <div class="btn btn-group">
                            <button class="btn btn-warning btnEditarProveedor" IdProveedor="'.$value["IdProveedor"].'" data-toggle="modal" data-target="#modalEditarProveedor">
                             <i class="fa fa-pencil" > Editar</i>
                            </button>
                          </div>';
                        if($_SESSION["Cargo"]==1){
                          echo '<div class="btn btn-group">
                                  <button class="btn btn-danger btnEliminarProveedor" IdProveedor="'.$value["IdProveedor"].'">
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
        </div> 
    </div>
      
    </section>
   
  </div>

  <!-- Modal agregar proveedor -->

  <div id="modalAgregarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-user-circle">  Registrar nuevo proveedor </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Identificación o Nit del proveedor</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" name="IdProveedor" id="IdProveedorValidar" class="form-control input-lg" placeholder="Ingrese el nit o la identificación del proveedor" required><br>
                
                  </div> 
                  <br>
                  <label >Nombre completo del proveedor</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa  fa-font"></i></span>
                    <input type="text" name="Nombre" class="form-control input-lg" placeholder="Ingrese completo del proveedor" required><br>
                
                  </div>
                  <br>
                  <label >Número de contacto del proveedor</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" name="Telefono" class="form-control input-lg" placeholder="Ingrese número teléfonico del cliente" required><br>
                
                  </div> 
                  <br>
                  <label >Email</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="mail" name="EmailProveedor" class="form-control input-lg" placeholder="Ingrese el email del proveedor" required><br>
                
                  </div>
                  <br>
                  <label >Estado actual del proveedor</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                    <select class="form-control input-lg" name="EstadoProveedor" id="EstadoProveedor">
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
            $crearProveedor=new ControladorProveedores();
            $crearProveedor -> ctrCrearProveedor();
          ?>
        </form>
    </div>
  </div>
</div>

<!-- modal editar proveedoores -->

<div id="modalEditarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-user-circle">  Actualizar proveedor </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Identificación o Nit del proveedor</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" name="EditarIdProveedor" id="EditarIdProveedor" class="form-control input-lg" placeholder="Ingrese el nit o la identificación del proveedor" required><br>
                    <input type="hidden" name="IdProveedorActual" id="IdProveedorActual">
                  </div> 
                  <br>
                  <label >Nombre completo del proveedor</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa  fa-font"></i></span>
                    <input type="text" name="EditarNombre"  id="EditarNombre" class="form-control input-lg" placeholder="Ingrese completo del proveedor" required><br>
                    <input type="hidden" name="NombreProveedorActual" id="NombreProveedorActual">
                  </div>
                  <br>
                  <label >Número de contacto del proveedor</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" name="EditarTelefono"  id="EditarTelefono" class="form-control input-lg" placeholder="Ingrese número teléfonico del cliente" required><br>
                    <input type="hidden" name="TelefonoActual" id="TelefonoActual">
                  </div> 
                  <br>
                  <label >Email</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="mail" name="EditarEmailProveedor" id="EditarEmailProveedor" class="form-control input-lg" placeholder="Ingrese el email del proveedor" required><br>
                    <input type="hidden" name="EmailProveedorActual" id="EmailProveedorActual">
                  </div>
                  <br>
                  <label >Estado actual del proveedor</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                    <select class="form-control input-lg" name="EditarEstadoProveedor" id="EditarEstadoProveedor">
                      <option value="">Selecionr el estado</option>
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    </select><br>
                    <input type="hidden" name="EstadoProveedorActual" id="EstadoProveedorActual">        
                  </div> 

              </div>            
              </div>
          </div>
          <!-- Pie del modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger fa-pull-rigth" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-warning fa-pull-left"><i class="fa fa-check"></i> Guardar cambios</button>  
          </div>
          <!-- editar el cliente -->
        <?php
            $editarProveedor= new ControladorProveedores();
            $editarProveedor->ctrEditarProveedor();
          ?>
        </form>
    </div>
  </div>
</div>
<?php 
  $borrarProveedor= new ControladorProveedores();
  $borrarProveedor -> ctrBorrarProveedor();
?>
