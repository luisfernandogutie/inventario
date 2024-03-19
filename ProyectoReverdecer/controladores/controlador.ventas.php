<?php
    class ControladorVentas{

        // MOSTRAR VENTAS
        static public function ctrMostrarVentas($item,$valor){
            $tabla="venta";
            $respuesta = ModeloVentas::MdlMostrarVentas($tabla,$item,$valor);
            return $respuesta;
        }
        static public function ctrCrearVenta(){
            if(isset($_POST["nuevaVenta"])){
                // Actualizar productos
                $intermedio=0;
                $listaProducto= json_decode($_POST["listarProductos"], true);
                foreach($listaProducto as $key => $value){
                    $tablaProductos="producto";
                    $item="IdProducto";
                    $valor=$value["idProducto"];
                    $orden=null;
                    $traerProducto=ModeloProductos::mdlMostrarProductos($tablaProductos,$item,$valor,$orden);
                    $valor1a=$value["stock"];
                    $actualizarStock=ModeloProductos::mdlActualizarStockProducto($tablaProductos,$valor1a,$valor);
                    $ventaProducto=$value["cantidad"];
                    if($traerProducto["ventasActuales"]==number_format(0)){
                        $actualizarVentasProductos=ModeloProductos::mdlActualizarVentasProducto($tablaProductos,$ventaProducto,$valor);
                    }else{
                        $intermedio=number_format($traerProducto["ventasActuales"]) + number_format($ventaProducto);
                        $actualizarVentasProductos=ModeloProductos::mdlActualizarVentasProducto($tablaProductos,$intermedio,$valor);
                        
                    } 
                    
                }

                // GUARDAR LA VENTA
                $tabla="venta";
                $datos=array(
                    "codigoVenta"=>$_POST["nuevaVenta"],
                    "IdCliente"=>$_POST["nuevoCliente"],
                    "IdEmpleado"=>$_POST["IdEmpleado"],
                    "Productos"=> $_POST["listarProductos"],
                    "Impuesto"=>$_POST["nuevoPrecioImpuesto"],
                    "Neto"=>$_POST["nuevoPrecioNeto"],
                    "Total"=>$_POST["totalVenta"],
                    "MetodoPago"=>$_POST["metodoPago"]
                );

                $respuesta=ModeloVentas::mdlRegistrarVenta($tabla,$datos);

                if($respuesta=="ok"){
                    echo"<script> swal({
                        title: '¡OK!',
                        text: 'La venta ha sido registrada correctamente',
                        type: 'success'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'crear-venta';
                        }
                    });</script>";
                }

            }
        }

        static public function ctrEliminarVenta(){
            if(isset($_GET["codigoVenta"])){
                $item="codigoVenta";
                $valorVanta=$_GET["codigoVenta"];
                $traerVenta = ControladorVentas::ctrMostrarVentas($item,$valorVanta);
                
                $mostrarProductos = json_decode($traerVenta["Productos"],true);
                
                // var_dump($mostrarProductos);

                // restablecer la cantidad en el inventario de los productos

                foreach($mostrarProductos as $key => $value){
                    $tabla="producto";
                    $itemProducto="idProducto";
                    $valorProducto=$value["idProducto"];
                    $orden=null;
                    $actualizarProducto=ControladorProductos::ctrMostrarProductos($itemProducto,$valorProducto,$orden);
                    // var_dump($actualizarProducto);
                    $stockActualizado=number_format($actualizarProducto["CantSistema"])+number_format($value["cantidad"]);
                    $actualizarStock= ModeloProductos::mdlActualizarStockProducto($tabla,$stockActualizado,$valorProducto);
                    $restaProducto=number_format($actualizarProducto["ventasActuales"])- number_format($value["cantidad"]);
                    if($restaProducto<number_format(0)){
                        $restaProducto=number_format(0);
                        $actualizarVentasProductos=ModeloProductos::mdlActualizarVentasProducto($tabla,$restaProducto,$valorProducto);
                    }else{
                        $actualizarVentasProductos=ModeloProductos::mdlActualizarVentasProducto($tabla,$restaProducto,$valorProducto);        
                    }
                    
                    
                }

                //  Eliminación de la venta

                $tablaVenta="venta";
                $datos= $_GET["codigoVenta"];
                $respuesta=ModeloVentas::mdlEliminarVenta($tablaVenta,$datos);
                if($respuesta=="ok"){
                    echo"<script> swal({
                        title: '¡OK!',
                        text: 'la venta se se ha eliminado correctamente',
                        type: 'success'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'registrar-ventas';
                        }
                      });</script>";
                    }
            }
        }
        // rango de fechas
        static public function ctrMostrarRangoFechasVentas($fechaInicial,$fechaFinal){
            $tabla="venta";
            $respuesta = ModeloVentas::MdlMostrarRangoFechasVentas($tabla,$fechaInicial,$fechaFinal);
            return $respuesta;
        }

        static public function ctrDescargarReporte(){
            if(isset($_GET["reporte"])){
                $tabla="venta";

                if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){
                    $ventas=ModeloVentas::MdlMostrarRangoFechasVentas($tabla,$_GET["fechaInicial"],$_GET["fechaFinal"]);
                }else{
                    $item=null;
                    $valor=null;
                    $ventas=ModeloVentas::MdlMostrarVentas($tabla,$item,$valor);
                }

                // Archivo excel.

                $Name = $_GET["reporte"].".xls";


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
                        <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
                        <td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
                        <td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
                        <td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
                        </tr>");
    
                foreach ($ventas as $row => $item){
    
                    $cliente = ControladorClientes::ctrMostrarClientes("IdCliente", $item["IdCliente"]);
                    $vendedor = ControladorEmpleados::ctrMostrarEmpleados("IdEmpleado", $item["IdEmpleado"]);
    
                 echo utf8_decode("<tr>
                             <td style='border:1px solid #eee;'>".$item["codigoVenta"]."</td> 
                             <td style='border:1px solid #eee;'>".$cliente["Nombre"]."</td>
                             <td style='border:1px solid #eee;'>".$vendedor["Nombre"]."</td>
                             <td style='border:1px solid #eee;'>");
    
                     $productos =  json_decode($item["Productos"], true);
    
                     foreach ($productos as $key => $valueProductos) {
                             
                             echo utf8_decode($valueProductos["cantidad"]."<br>");
                         }
    
                     echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
    
                     foreach ($productos as $key => $valueProductos) {
                             
                         echo utf8_decode($valueProductos["nombre"]."<br>");
                     
                     }
    
                     echo utf8_decode("</td>
                        <td style='border:1px solid #eee;'>$ ".number_format($item["Impuesto"],2)."</td>
                        <td style='border:1px solid #eee;'>$ ".number_format($item["Neto"],2)."</td>	
                        <td style='border:1px solid #eee;'>$ ".number_format($item["Total"],2)."</td>
                        <td style='border:1px solid #eee;'>".$item["MetodoPago"]."</td>
                        <td style='border:1px solid #eee;'>".substr($item["FechaCompra"],0,10)."</td>		
                         </tr>");
    
    
                }
    
    
                echo "</table>";
    
            }
    
        }

        static public function ctrSumaTotalVentas(){
            $tabla = "venta";

		    $respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		    return $respuesta;

        }


    }