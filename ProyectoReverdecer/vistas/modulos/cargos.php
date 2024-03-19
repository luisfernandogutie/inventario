<?php

if($_SESSION["Cargo"] != 1){

  echo"<script> swal({
    title: '¡ERROR!',
    text: 'Rol no autorizado para gestionar cargos de empleados',
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
    <section class="content-header">
      <h1 class="text-primary">
        Gestionar cargos
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Gestión cargos</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCargo">
            <i class="fa fa-plus-circle"></i>
            <span> Agregar nuevo Cargo</span>
          </button>
        </div>
        <!-- Tabla de Cargo -->
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th style="width: 10px;">Id cargo</th>
                <th>Nombre cargo</th>
                <th> Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $item=null;
                $valor=null; 
                $cargos = ControladorCargos::ctrMostrarCargos($item,$valor);
                foreach($cargos as $key => $value){
                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["idCargo"].'</td>
                          <td>'.$value["Nombre"].'</td>
                          <td>
                            <div class="btn btn-group">
                              <button class="btn btn-warning btnEditarCargo" idCargo="'.$value["idCargo"].'" data-toggle="modal" data-target="#modalEditarCargo">
                               <i class="fa fa-pencil" > Editar</i>
                              </button>
                            </div>
                            <div class="btn btn-group">
                              <button class="btn btn-danger btnEliminarCargo" idCargo="'.$value["idCargo"].'">
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

  <!-- modal de registro de cargo -->
<div id="modalAgregarCargo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-black-tie">  Registrar nuevo cargo </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Código del cargo</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="number" name="IdCargo" class="form-control input-lg" placeholder="Ingrese el código del cargo" required><br>
                
                  </div> 
                  <br>
                  <label >Nombre del cargo</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
                    <input type="text" name="NombreCargo" class="form-control input-lg" placeholder="Ingrese el nombre del cargo" required><br>
                
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
            $crearCargo = new  ControladorCargos();
            $crearCargo -> ctrCrearCargo();
          ?>
        </form>
    </div>
  </div>
</div>
 <!-- modal de Editar cargo -->
 <div id="modalEditarCargo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-black-tie">  Editar cargo </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Código del cargo</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="number" id="EditarIdCargo" name="EditarIdCargo" class="form-control input-lg" value="" readonly><br>
                    <!-- este input oculto, almacenrá la información del cargo que no se vay a actualizar para enviarla a la base de datos -->
                    <input type="hidden" id="IdCargoActual" name="IdCargoActual">
                  </div> 
                  <br>
                  <label >Nombre del cargo</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
                    <input type="text" id="EditarNombreCargo" name="EditarNombreCargo" class="form-control input-lg" value="" required><br>
                    <!-- este input oculto, almacenrá la información del cargo que no se vay a actualizar para enviarla a la base de datos -->
                    <input type="hidden" id="NombreCargoActual" name="NombreCargoActual">
                  </div> 
                  
              </div>            
              </div>
          </div>
          <!-- Pie del modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger fa-pull-rigth" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-warning fa-pull-left"><i class="fa fa-check"></i> Actualizar datos</button>  
          </div>
          <!-- editar el cargo -->
          <?php
            $editarCargo = new  ControladorCargos();
            $editarCargo -> ctrEditarCargo();
          ?>
        </form>
    </div>
  </div>
</div>
<!-- aqui se ejecuta el metodo de borrar cargo -->
<?php 
  $borrarCargo = new ControladorCargos();
  $borrarCargo->ctrBorrarCargo();
?>