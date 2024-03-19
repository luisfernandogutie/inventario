<?php
   class ControladorProductos{

      static public function ctrMostrarProductos($item,$valor,$orden){
            $tabla="producto";
            
            $respuesta = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
            return $respuesta;
        }
        // Registrar Productos
      static public function crtCrearProducto(){
         if(isset($_POST["idProducto"])){
                // validaciones de los campos para los productos
            if(preg_match('/^[0-9]+$/', $_POST["idProducto"]) &&
                    preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Nombre"]) &&
                    preg_match('/^[0-9,.]+$/', $_POST["PrecioUnitario"]) &&
                    preg_match('/^[0-9,.]+$/', $_POST["PrecioVenta"]) &&
                    preg_match('/^[0-9]+$/', $_POST["CantSistema"]) &&  
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["NumeroLote"])){
                        $tabla="producto";
                        $datos=array("idProducto"=>$_POST["idProducto"],
                                    "Proveedor_IdProveedor"=>$_POST["Proveedor_IdProveedor"],
                                    "Nombre"=>$_POST["Nombre"],
                                    "PrecioUnitario"=>$_POST["PrecioUnitario"],
                                    "CantSistema"=>$_POST["CantSistema"],
                                    "PrecioVenta"=>$_POST["PrecioVenta"],
                                    "FechaVencimiento"=>$_POST["FechaVencimiento"],
                                    "NumeroLote"=>$_POST["NumeroLote"],
                                    "Categoria_IdCatedoria"=>$_POST["Categoria_IdCatedoria"]);
                        // Envio de datos al modelo
                        $respuesta=ModeloProductos::mdlIngresarProducto($tabla,$datos);
                        if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El producto ha sido agregado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'gestionar-inventarios';
                                }
                              });</script>";
                        }
                  }else{
                        echo"<script> swal({
                            title: '¡ERROR!',
                            text: 'Los datos que intenta enviar a la base de datos contiene caracteres no validos',
                            type: 'error'
    
                        }).then((result)=>{
                            if(result.value){
                                window.location= 'gestionar-inventarios';
                            }
                          });</script>";
                  }
         }
      }

        // EDITAR PRODUCTOS
      static public function ctrEditarProducto(){


            
				if(isset($_POST["EditaridProducto"])){
                // validaciones de los campos para los productos
               if(preg_match('/^[0-9]+$/', $_POST["EditaridProducto"]) &&
                  preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarNombre"]) &&
                  preg_match('/^[0-9,.]+$/', $_POST["EditarPrecioUnitario"]) &&
                  preg_match('/^[0-9,.]+$/', $_POST["EditarPrecioVenta"]) &&
                  preg_match('/^[0-9]+$/', $_POST["EditarCantSistema"]) && 
                  preg_match('/^[a-zA-Z0-9]+$/', $_POST["EditarNumeroLote"])){
                      
							if((!$_POST["EditaridProducto"]=="") ||
                        (!$_POST["EditarProveedor_IdProveedor"]=="") ||                        (!$_POST["EditarNombre"]=="") && 
                        (!$_POST["EditarPrecioUnitario"]=="") ||
                        (!$_POST["EditarCantSistema"]=="") ||
                        (!$_POST["EditarPrecioVenta"]=="") || 
                        (!$_POST["EditarFechaVencimiento"]=="") || 
                        (!$_POST["EditarNumeroLote"]=="") || 
                        (!$_POST["EditarCategoria_IdCatedoria"]=="")){


							$tabla="producto";
                            $datos=array("idProducto"=>$_POST["EditaridProducto"],
                                    "Proveedor_IdProveedor"=>$_POST["EditarProveedor_IdProveedor"],
                                    "Nombre"=>$_POST["EditarNombre"],
                                    "PrecioUnitario"=>$_POST["EditarPrecioUnitario"],
                                    "CantSistema"=>$_POST["EditarCantSistema"],
                                    "PrecioVenta"=>$_POST["EditarPrecioVenta"],
                                    "FechaVencimiento"=>$_POST["EditarFechaVencimiento"],
                                    "NumeroLote"=>$_POST["EditarNumeroLote"],
                                    "Categoria_IdCatedoria"=>$_POST["EditarCategoria_IdCatedoria"]);
									
									$actualizacion=$_POST["idProductoActual"];
                        }else{
									
									$tabla="producto";
                           $datos=array("idProducto"=>$_POST["idProductoActual"],
                                    "Proveedor_IdProveedor"=>$_POST["Proveedor_IdProveedorActual"],
                                    "Nombre"=>$_POST["NombreActual"],
                                    "PrecioUnitario"=>$_POST["PrecioUnitarioActual"],
                                    "CantSistema"=>$_POST["CantSistemaActual"],
                                    "PrecioVenta"=>$_POST["PrecioVentaActual"],
                                    "FechaVencimiento"=>$_POST["FechaVencimientoActual"],
                                    "NumeroLote"=>$_POST["NumeroLoteActual"],
                                    "Categoria_IdCatedoria"=>$_POST["Categoria_IdCatedoriaActual"]);
                        	$actualizacion=$_POST["idProductoActual"];
                        }
                        
                        // Envio de datos al modelo
                        $respuesta=ModeloProductos::mdlActualizarProducto($tabla,$datos,$actualizacion);
                        
								if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El producto ha sido actualizado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'gestionar-inventarios';
                                }
                              });</script>";
                        }
                	}else{
                    		echo"<script> swal({
                            title: '¡ERROR!',
                            text: 'Los datos que intenta enviar a la base de datos contiene caracteres no validos',
                            type: 'error'
    
                        	}).then((result)=>{
                            	if(result.value){
                                window.location= 'gestionar-inventarios';
                            	}
                          	});</script>";
                	}
						 	
            }
        }

        static public function ctrBorrarProducto(){
            if(isset($_GET["idProducto"])){
                $tabla="producto";
                $datos= $_GET["idProducto"];
                $respuesta=ModeloProductos::mdlEliminarProducto($tabla,$datos);
                if($respuesta=="ok"){
                    echo"<script> swal({
                        title: '¡OK!',
                        text: 'El producto se ha Eliminado correctamente',
                        type: 'success'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'gestionar-inventarios';
                        }
                      });</script>";
                }
            }
        }

        // Sumar todas las ventas

        static public function ctrMostrarSumaVentas($tabla,$item){
            $respuesta=ModeloProductos::mdlSumarVentasPRoductos($tabla,$item);
            return $respuesta;
        }

        static public function ctrDescargarReporteInventario(){
            if(isset($_GET["inventario"])){
                
                $tabla="producto";
                $item=null;
                $valor=null;
                $orden="ventasActuales";    
                $productos=ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
            
                // Archivo excel.

                $Name = $_GET["inventario"].".xls";


                header('Expires: 0');
                header('Cache-control: private');
                header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
                header("Cache-Control: cache, must-revalidate"); 
                header('Content-Description: File Transfer');
                header('Last-Modified: '.date('D, d M Y H:i:s'));
                header("Pragma: public"); 
                header('Content-Disposition:; filename="'.$Name.'"');
                header("Content-Transfer-Encoding: binary");
    
                echo utf8_decode("<table border='0'> 
    
                        <tr> 
                            <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
                            <td style='font-weight:bold; border:1px solid #eee;'>PROVEEDOR</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>NOMBRE</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>PRECIO_UNITARIO</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>STOCK</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>VENTAS</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>PRECIO_VENTA</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>FECHA_VEN</td>		
                            <td style='font-weight:bold; border:1px solid #eee;'>NUMERO LOTE</td	
                            <td style='font-weight:bold; border:1px solid #eee;'>CATEGORÍA</td>		
                        </tr>");
    
                foreach ($productos as $row => $item){
    
                    $proveedor = ControladorProveedores::ctrMostrarProveedores("IdProveedor", $item["Proveedor_IdProveedor"]);
                    $categoria = ControladorCategorias::ctrMostrarCategorias("IdCategoria", $item["Categoria_IdCatedoria"]);
    
                    echo utf8_decode("<tr>
                            <td style='border:1px solid #eee;'>".$item["idProducto"]."</td> 
                            <td style='border:1px solid #eee;'>".$proveedor["Nombre"]."</td>
                            <td style='border:1px solid #eee;'>".$item["Nombre"]."</td>           
                            <td style='border:1px solid #eee;'>$ ".number_format($item["PrecioUnitario"],2)."</td>
                            <td style='border:1px solid #eee;'>".$item["CantSistema"]."</td>	
                            <td style='border:1px solid #eee;'>".$item["ventasActuales"]."</td>
                            <td style='border:1px solid #eee;'>$ ".number_format($item["PrecioVenta"],2)."</td>
                            <td style='border:1px solid #eee;'>".$item["FechaVencimiento"]."</td>
                            <td style='border:1px solid #eee;'>".$item["NumeroLote"]."</td>
                            <td style='border:1px solid #eee;'>".$categoria["NombreCategoria"]."</td>		
                         </tr>");

                   
    
                }
                echo "</table>";
            }
        }
    }
   
   
   
   
   
    
    
    

