<?php

if($_SESSION["Cargo"] != 1){

  echo"<script> swal({
    title: '¡ERROR!',
    text: 'Rol no autorizado para gestionar categorías',
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
        Gestionar categorías
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Gestión de categorías</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
            <i class="fa fa-plus-circle"></i>
            <span> Agregar nueva categoría</span>
          </button>
        </div>
        <!-- Tabla de categoria -->
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive  tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th style="width:10px;">Id Categoría</th>
                <th>Nombre categoria</th>
                <th> Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Llamado de los datos de los clientes -->
            <?php
              $item=null;
              $valor=null; 
              $categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
              foreach($categorias as $key => $value){
                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["IdCategoria"].'</td>
                        <td>'.$value["NombreCategoria"].'</td>
                        <td>
                          <div class="btn btn-group">
                            <button class="btn btn-warning btnEditarCategoria" IdCategoria="'.$value["IdCategoria"].'" data-toggle="modal" data-target="#modalEditarCategoria">
                             <i class="fa fa-pencil" > Editar</i>
                            </button>
                          </div>
                          <div class="btn btn-group">
                            <button class="btn btn-danger btnEliminarCategoria" IdCategoria="'.$value["IdCategoria"].'">
                               <i class="fa fa-trash-o"> Eliminar</i>
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
    </section>
  </div>
  
  
<!-- modal de registro de categorias -->
<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-bars">  Registrar nueva categoria </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                  <label >Nombre de la categoria</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-font"></i></span>
                    <input type="text" name="NombreCategoria" class="form-control input-lg" placeholder="Ingrese el nombre de la categoria" required><br>
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
            $crearCategoria = new ControladorCategorias();
            $crearCategoria->ctrCrearCategoria();
          ?>
        </form>
    </div>
  </div>
</div>

<!-- modal editar categorias -->
<div id="modalEditarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST" enctype="multipart/form-data">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-bars">  Actualizar categoria </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                  <label >Nombre de la categoria</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-font"></i></span>
                    <input type="text" name="EditarCategoria" id="EditarCategoria" class="form-control input-lg" required><br>
                    <input type="hidden" name="IdCategoria" id="IdCategoria">
                  </div> 
              </div>            
          </div>
          <!-- Pie del modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger fa-pull-rigth" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-warning fa-pull-left"><i class="fa fa-check"></i> Guardar cambios</button>  
          </div>
          <!-- Crear el categoria-->
          <?php
            $editarCategoria = new ControladorCategorias();
            $editarCategoria-> ctrEditarCategorias();
          ?>
        </form>
    </div>
  </div>
</div>
<!-- Eliminar categorias -->
<?php 
  $borrarCategoria=new ControladorCategorias();
  $borrarCategoria->ctrBorrarCategorias();
?>
