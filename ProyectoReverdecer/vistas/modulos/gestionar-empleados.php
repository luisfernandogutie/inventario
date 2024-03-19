<?php

if($_SESSION["Cargo"] != 1){

  echo"<script> swal({
    title: '¡ERROR!',
    text: 'Rol no autorizado para gestionar empelados',
    type: 'error'

  }).then((result)=>{
      if(result.value){
        window.location= 'inicio';
      }
    });</script>";
  

  return;

}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-primary">
        Gestión de empleados
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Gestionar empleados</a></li>
      </ol>
    </section>


    <section class="content">
      
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">
            <i class="fa fa-plus-circle"></i>
            <span> Agregar nuevo empleado</span>
          </button>
        </div>
      

      <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th style="width:40px;">Identificación</th>
                <th>Nombre completo</th>
                <th>Teléfono</th>
                <th>Cargo</th>
                <th>Usuario</th>
                <th> Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $item=null;
                $valor=null; 
                $empleados = ControladorEmpleados::ctrMostrarEmpleados($item,$valor);
                foreach($empleados as $key => $value){
                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["IdEmpleado"].'</td>
                          <td>'.$value["Nombre"].'</td>
                          <td>'.$value["Telefono"].'</td>';
                        $item="idCargo";
                        $valor=$value["Cargo_idCargo"];
                        $Cargo=ControladorCargos::ctrMostrarCargos($item,$valor);
                  echo    '<td>'.$Cargo["Nombre"].'</td>
                          <td>'.$value["Usuario"].'</td>
                          <td>
                            <div class="btn btn-group">
                              <button class="btn btn-warning btnEditarEmpleado" IdEmpleado="'.$value["IdEmpleado"].'" data-toggle="modal" data-target="#modalEditarEmpleado">
                               <i class="fa fa-pencil" > Editar</i>
                              </button>
                            </div>
                            <div class="btn btn-group">
                              <button class="btn btn-danger btnEliminarEmpleado" IdEmpleado="'.$value["IdEmpleado"].'">
                               <i class="fa fa-trash-o"> Eliminar</i>
                              </button>
                            </div>            
                          </div>
                          </td>
                        </tr>';
                }
              ?>
            </tbody>

          </table>  

        </div>
      </div>
    </section>
  </div>
     
    </section>
</div>
  <!-- modal agregar empleado -->

<div id="modalAgregarEmpleado" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-users">  Registrar nuevo empleado </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Identificación del empleado</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" name="IdEmpleado" id="IdEmpleadoValidar" class="form-control input-lg" placeholder="Ingrese la identificación del empleado" required><br>
                
                  </div> 
                  <br>
                  <label >Nombre completo del empleado</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa  fa-font"></i></span>
                    <input type="text" name="Nombre" class="form-control input-lg" placeholder="Ingrese completo del empleado" required><br>
                
                  </div>
                  <br>
                  <label >Número de contacto</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" name="Telefono" class="form-control input-lg" placeholder="Ingrese número teléfonico del empleado" required><br>
                
                  </div>  
                  <br>
                  
                  <label >Cargo del empleado</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class=" fa fa-black-tie"></i></span>
                    <select type="text" name="Cargo_idCargo" class="form-control input-lg" placeholder="Ingrese el cargo del empleado" required>
                      <option value="">Seleccione el cargo</option>
                      <?php 
                        $item=null;
                        $valor=null;
                        $Cargo=ControladorCargos::ctrMostrarCargos($item,$valor);
                        foreach($Cargo as $key => $value){
                          echo '<option value="'.$value["idCargo"].'">'.$value["Nombre"].'</option>';
                        }
                      ?>
                    </select><br>
                
                  </div> 

                  <br>
                  <label >Usuario</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                    <input type="text" name="Usuario" id ="Usuario" class="form-control input-lg" placeholder="Ingrese el usuario del empleado" required><br>
                
                  </div> 
                  <br>
                  <label >Contraseña</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="Contrasena" class="form-control input-lg" placeholder="Ingrese la contraseña del empleado" required><br>
                
                  </div> 

              </div>            
              </div>
          </div>
          <!-- Pie del modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger fa-pull-rigth" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-success fa-pull-left"><i class="fa fa-check"></i> Registrar</button>  
          </div>
          <!-- Crear el cargo -->
          <?php
            $crearEmpleado = new  ControladorEmpleados();
            $crearEmpleado -> ctrCrearEmpleado();
          ?>
        </form>
    </div>
  </div>
</div>

<!-- modal Editar empleado -->

<div id="modalEditarEmpleado" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-users">  Actualizar empleado </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Identificación del empleado</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" name="EditarIdEmpleado" id="EditarIdEmpleado" class="form-control input-lg" value="" required><br>
                    <input type="hidden" id="IdEmpleadoActual" name="IdEmpleadoActual"></input>
                  </div> 
                  <br>
                  <label >Nombre completo del empleado</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa  fa-font"></i></span>
                    <input type="text" name="EditarNombre" id="EditarNombre" class="form-control input-lg" value="" required><br>
                    <input type="hidden" id="NombreActual" name="NombreActual"></input>
                  </div>
                  <br>
                  <label >Número de contacto</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" name="EditarTelefono" id="EditarTelefono" class="form-control input-lg" value="" required><br>
                    <input type="hidden" id="TelefonoActual" name="TelefonoActual"></input>
                  </div>  
                  <br>
                  <label >Cargo del empleado</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class=" fa fa-black-tie"></i></span>
                    <select type="text" name="EditarCargo_idCargo" id="Cargo_idCargoActual" class="form-control input-lg"  required>
                      <option value="">Seleccione el cargo</option>
                      <?php 
                        $item=null;
                        $valor=null;
                        $Cargo=ControladorCargos::ctrMostrarCargos($item,$valor);
                        foreach($Cargo as $key => $value){
                          echo '<option value="'.$value["idCargo"].'">'.$value["Nombre"].'</option>';
                        }
                      ?>
                    </select>
                    <input type="hidden" id="Cargo_idCargoActual" name="Cargo_idCargoActual"></input><br>
                  </div>
                  <br>
                  <label >Usuario</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                    <input type="text" name="EditarUsuario" id="EditarUsuario" class="form-control input-lg" value="" required><br>
                    <input type="hidden" id="UsuarioActual" name="UsuarioActual"></input>
                  </div> 
                  <br>
                  <label >Contraseña</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="EditarContrasena" id="EditarContrasena" class="form-control input-lg" value="" required><br>
                    <input type="hidden" id="ContrasenaActual" name="ContrasenaActual"></input>
                  </div> 

              </div>            
              </div>
          </div>
          <!-- Pie del modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger fa-pull-rigth" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-warning fa-pull-left"><i class="fa fa-check"></i> Guardar cambios</button>  
          </div>
          <!-- editar el empleado -->
          <?php
            $editarEmpleado = new ControladorEmpleados();
            $editarEmpleado -> ctrEditarEmpleado();
          ?>
        </form>
    </div>
  </div>
</div>
<!-- aqui se ejecuta el metodo de borrar empleados -->
<?php 
  $borrarEmpleado = new ControladorEmpleados();
  $borrarEmpleado-> ctrBorrarEmpleado();
?>