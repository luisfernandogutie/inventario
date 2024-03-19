<?php

if($_SESSION["Cargo"] != 1){

  echo"<script> swal({
    title: '¡ERROR!',
    text: 'Rol no autorizado para estar en este modúlo',
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
        Gestionar medios de pago
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Gestión medios de pago</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMedioPago">
            <i class="fa fa-plus-circle"></i>
            <span> Agregar nuevo medio de pago</span>
          </button>
        </div>
        <!-- Tabla de medio de pago -->
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th style="width: 10px;">código</th>
                <th>Descripción</th>
                <th> Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $item=null;
                $valor=null; 
                $pagos = ControladorPagos::ctrMostrarPagos($item,$valor);
                foreach($pagos as $key => $value){
                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["idTpago"].'</td>
                          <td>'.$value["descripcion"].'</td>
                          <td>
                            <div class="btn btn-group">
                              <button class="btn btn-warning btnEditarMedioPago" idTpago="'.$value["idTpago"].'" data-toggle="modal" data-target="#modalEditarMedioPago">
                               <i class="fa fa-pencil" > Editar</i>
                              </button>
                            </div>
                            <div class="btn btn-group">
                              <button class="btn btn-danger btnEliminarMedioPago" idTpago="'.$value["idTpago"].'">
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
<div id="modalAgregarMedioPago" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-dollar">  Registrar nuevo medio de pago </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Código del cmedio de pago</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="number" name="idTpago" id="idTpago" class="form-control input-lg" placeholder="Ingrese el código del medio de pago" required><br>
                
                  </div> 
                  <br>
                  <label >Nombre del medio de pago</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input type="text" name="descripcion" id="descripcion" class="form-control input-lg" placeholder="Ingrese el nombre del medio de pago" required><br>
                
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
            $crearMedioPago = new  ControladorPagos();
            $crearMedioPago -> ctrCrearMedioPago();
          ?>
        </form>
    </div>
  </div>
</div>
 <!-- modal de Editar medio de pago -->
 <div id="modalEditarMedioPago" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:orange ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-dolar">  Editar el medio de pago</i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Código del medio de pago</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="number" id="EditaridTpago" name="EditaridTpago" class="form-control input-lg" value="" readonly><br>
                  </div> 
                  <br>
                  <label >Nombre del medio de pago</label>
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input type="text" id="Editardescripcion" name="Editardescripcion" class="form-control input-lg" value="" required><br>
                    <!-- este input oculto, almacenrá la información del cargo que no se vay a actualizar para enviarla a la base de datos -->
                    <input type="hidden" id="descripcionActual" name="descripcionActual">
                  </div> 
                  
              </div>            
              </div>
          </div>
          <!-- Pie del modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger fa-pull-rigth" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-warning fa-pull-left"><i class="fa fa-check"></i> Actualizar datos</button>  
          </div>
          <!-- editar el medio de pago -->
          <?php
            $editarMedioPago= new ControladorPagos();
            $editarMedioPago->crtEditarMedioPago(); 
          ?> 
        </form>
    </div>
  </div>
</div>
<!-- Borrar medio de pago -->

<?php 
  $borrarMedioPago= new ControladorPagos();
  $borrarMedioPago->ctrBorrarMediPago();
?>