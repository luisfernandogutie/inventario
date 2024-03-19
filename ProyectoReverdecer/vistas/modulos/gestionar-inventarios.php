<?php

if($_SESSION["Cargo"] != 1){

  echo"<script> swal({
    title: '¡ERROR!',
    text: 'Rol no autorizado para gestionar inventarios',
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
        Gestión de inventarios
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Gestionar inventarios</a></li>
      </ol>
    </section>
    <section class="content">
    <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
            <i class="fa fa-plus-circle"></i>
            <span> Agregar nuevo producto</span>
          </button>
          <div class="box-tools pull-right">
            <a href="vistas/modulos/descargar-inventario.php?inventario=inventario">
              <button class="btn btn-success" style="margin-top:5px;"> Descargar resportes de inventario</button>
            </a>
          </div>
        </div>
      <!-- tabla de productos -->
      <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablas tablaProductos">
            <thead>
              <tr>
                <th style="width:35px;">Codigo</th>
                <th style="width:100px;">proveedor</th>
                <th style="width:40px;">Nombre</th>
                <th style="width: 30px;">PrecioUnitario</th>
                <th style="width:10px;">Stock</th>
                <th style="width:30px;">PrecioVenta</th>
                <th style="width:40px;">FechaVen</th>
                <th style="width:10px;">Ventas</th>
                <th style="width:40px;">Núm Lote</th>
                <th style="width:50px;">Categoria</th>
                <th > Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Llamado de los datos de los productos -->
            <?php
              $item=null;
              $valor=null; 
              $orden="idProducto";
              $productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
              foreach($productos as $key => $value){
                  echo '<tr>';
                        $item="IdProveedor";
                        $valor=$value["Proveedor_IdProveedor"];
                        $proveedor=ControladorProveedores::ctrMostrarProveedores($item,$valor);
                  echo    '<td>'.$value["idProducto"].'</td>
                          <td>'.$proveedor["Nombre"].'</td>
                          <td>'.$value["Nombre"].'</td>
                          <td>'.$value["PrecioUnitario"].'</td>';
                        if($value["CantSistema"]>=100){
                          echo '<td><button class="btn btn-success">'.$value["CantSistema"].'</button></td>';
                        }elseif(($value["CantSistema"]>=50) && ($value["CantSistema"]<=99)){
                          echo '<td><button class="btn btn-warning">'.$value["CantSistema"].'</button></td>';
                        }else{
                          echo '<td><button class="btn btn-danger">'.$value["CantSistema"].'</button></td>';
                        }
                  echo    '<td>'.$value["PrecioVenta"].'</td>
                          <td>'.$value["FechaVencimiento"].'</td>
                          <td>'.$value["ventasActuales"].'</td>
                          <td>'.$value["NumeroLote"].'</td>';
                        $item="IdCategoria";
                        $valor=$value["Categoria_IdCatedoria"];
                        $categoria=ControladorCategorias::ctrMostrarCategorias($item,$valor);
                  echo  '<td>'.$categoria["NombreCategoria"].'</td>
                        <td>
                          <div class="btn btn-group">
                            <button class="btn btn-warning btnEditarProducto" idProducto="'.$value["idProducto"].'" data-toggle="modal" data-target="#modalEditarProducto">
                             <i class="fa fa-pencil" > Editar</i>
                            </button>
                          </div>
                          <div class="btn btn-group">
                            <button class="btn btn-danger btnEliminarProducto" idProducto="'.$value["idProducto"].'">
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
    </section>
  </div>

<!-- Modal Agregar Productos -->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#00c0ef ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-dropbox">  Registrar nuevo producto </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Código del producto</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="number" name="idProducto" id="idProducto" class="form-control input-lg" placeholder="código de barras del producto" required><br>
                  </div>
                  <br> 
                  <label >Proveedor</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <select type="text" name="Proveedor_IdProveedor" id="Proveedor_IdProveedor" class="form-control input-lg" required>
                      <option value="">Seleccionar Proveedor</option>
                      <!-- mostrar todos los nombres de los proveedores -->
                      <?php
                        $item=null;
                        $valor=null;
                        $proveedor=ControladorProveedores::ctrMostrarProveedores($item,$valor); 
                        foreach($proveedor as $key => $value){
                          echo '<option value="'.$value["IdProveedor"].'">'.$value["Nombre"].'</option>';
                        }
                      ?>
                        
                  </select><br>
                  </div>
                  <br>
                  <label >Nombre del produto</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    <input type="text" name="Nombre" id="Nombre" class="form-control input-lg" placeholder="nombre del producto" required><br>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-xs-12 col-sm-6">
                      <label >Precio de compra del producto por unidad</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input type="number" name="PrecioUnitario" id="PrecioUnitario" step="any" class="form-control input-lg" placeholder="precio de compra" required><br>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <label >Precio de venta para el producto</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input type="number" name="PrecioVenta" id="PrecioVenta" step="any" class="form-control input-lg" placeholder="precio de venta" required><br>
                      </div>
                      <br>
                    </div>
                    <br>
                    <!-- CHECKBOX PARA PORCENTAJE -->
                    <div class="col-xs-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>
                    </div>
                  </div>
                  <br>
                  <!-- ENTRADA PARA PORCENTAJE -->
                  <div class="col-xs-6" style="padding:0">
                    <div class="input-group">
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>
                  <br> 
                </div>
                <br>
                <label >Cantidad a ingresar en el sistema</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                    <input type="number" name="CantSistema" id="CantSistema" class="form-control input-lg" min="0" placeholder="cantidad en el sistema" required><br>
                </div>
                <br>
                <label >Fecha de vencimineto</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="FechaVencimiento" id="FechaVencimiento" class="form-control input-lg" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required><br>
                </div>
                  <br>
                <label >Número de lote</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                    <input type="text" name="NumeroLote" id="NumeroLote" class="form-control input-lg" placeholder="número de lote del producto" required><br>
                </div>
                <br>
                <label >Categoría del producto</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                    <select type="text" name="Categoria_IdCatedoria" id="Categoria_IdCatedoria" class="form-control input-lg"  required>
                      <option value="">Seleccionar la categoría del producto</option>
                        <!-- Mostrar las categorias en el select -->
                        <?php 
                           $item=null;
                           $valor=null;
                           $categoria=ControladorCategorias::ctrMostrarCategorias($item,$valor);
                           foreach($categoria as $key => $value){
                             echo '<option value="'.$value["IdCategoria"].'">'.$value["NombreCategoria"].'</option>';
                           }
                        ?>
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
          <!-- Crear el producto -->
          <?php
            $CrearProducto= new ControladorProductos();
            $CrearProducto->crtCrearProducto();
          ?> 
        </form>
    </div>
  </div>
</div>

<!-- Modal Actualizar Productos -->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" method="POST">
          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:orange ; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <i class="fa fa-dropbox">  Actualizar producto </i></h4>
          </div>
          <!-- Cuerpo del modal -->
          <div class="modal-body">
              <div class="box-body"> 
                <div class="form-group">
                  <label >Código del producto</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="number" name="EditaridProducto" id="EditaridProducto" class="form-control input-lg" placeholder="código de barras del producto" required><br>
                    <input type="hidden" name="idProductoActual" id="idProductoActual">
                  </div>
                  <br> 
                  <label >Proveedor</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="hidden" name="Proveedor_IdProveedorActual" id="Proveedor_IdProveedorActual">
                    <select type="text" name="EditarProveedor_IdProveedor" id="EditarProveedor_IdProveedor" class="form-control input-lg" required>
                      <option value="">Seleccionar Proveedor</option>
                      <!-- mostrar todos los nombres de los proveedores -->
                      <?php
                        $item=null;
                        $valor=null;
                        $proveedor=ControladorProveedores::ctrMostrarProveedores($item,$valor); 
                        foreach($proveedor as $key => $value){
                          echo '<option value="'.$value["IdProveedor"].'">'.$value["Nombre"].'</option>';
                        }
                      ?>
                        
                  </select><br>
                  </div>
                  <br>
                  <label >Nombre del produto</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    <input type="hidden" name="NombreActual" id="NombreActual">
                    <input type="text" name="EditarNombre" id="EditarNombre" class="form-control input-lg" placeholder="nombre del producto" required><br>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-xs-12 col-sm-6">
                      <label >Precio de compra del producto por unidad</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input type="hidden" id="PrecioUnitarioActual" name="PrecioUnitarioActual">
                        <input type="number" step="any" name="EditarPrecioUnitario" id="EditarPrecioUnitario" class="form-control input-lg" required><br>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <label >Precio de venta para el producto</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input type="hidden" id="PrecioVentaActual" name="PrecioVentaActual">
                        <input type="number" step="any" name="EditarPrecioVenta" id="EditarPrecioVenta" class="form-control input-lg" readonly required><br>
                      </div>
                      <br>
                    </div>
                    <br>
                    <!-- CHECKBOX PARA PORCENTAJE -->
                    <div class="col-xs-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>
                    </div>
                  </div>
                  <br>
                  <!-- ENTRADA PARA PORCENTAJE -->
                  <div class="col-xs-6" style="padding:0">
                    <div class="input-group">
                      <input type="number" class="form-control input-lg EditarnuevoPorcentaje" min="0" value="40" required>
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>
                  <br> 
                </div>
                <br>
                <label >Cantidad a ingresar en el sistema</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                    <input type="hidden" id="CantSistemaActual" name="CantSistemaActual">
                    <input type="number" name="EditarCantSistema" id="EditarCantSistema" class="form-control input-lg" min="0" placeholder="cantidad en el sistema" required><br>
                </div>
                <br>
                <label >Fecha de vencimineto</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="hidden" id="FechaVencimientoActual" name="FechaVencimientoActual">
                    <input type="text" name="EditarFechaVencimiento" id="EditarFechaVencimiento" class="form-control input-lg" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required><br>
                </div>
                  <br>
                <label >Número de lote</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                    <input type="hidden" id="NumeroLoteActual" name="NumeroLoteActual">
                    <input type="text" name="EditarNumeroLote" id="EditarNumeroLote" class="form-control input-lg" placeholder="número de lote del producto" required><br>
                </div>
                <br>
                <label >Categoría del producto</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                    <input type="hidden" name="Categoria_IdCatedoriaActual" id="Categoria_IdCatedoriaActual">
                    <select type="text" name="EditarCategoria_IdCatedoria" id="EditarCategoria_IdCatedoria" class="form-control input-lg"  required>
                      <option value="">Seleccionar la categoría del producto</option>
                        <!-- Mostrar las categorias en el select -->
                        <?php 
                           $item=null;
                           $valor=null;
                           $categoria=ControladorCategorias::ctrMostrarCategorias($item,$valor);
                           foreach($categoria as $key => $value){
                             echo '<option value="'.$value["IdCategoria"].'">'.$value["NombreCategoria"].'</option>';
                           }
                        ?>
                  </select><br>
                </div>
            </div>            
            </div>
        </div>
          <!-- Pie del modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger fa-pull-rigth" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-warning fa-pull-left"><i class="fa fa-check"></i> Guardar cambios</button>  
          </div>
          <!-- Actualizar el producto -->
          <?php
            $editarProducto= new ControladorProductos();
            $editarProducto->ctrEditarProducto();
            
          ?>
        </form>
    </div>
  </div>
</div>
<?php 
  $borrarProducto= new ControladorProductos();
  $borrarProducto->ctrBorrarProducto();
?>