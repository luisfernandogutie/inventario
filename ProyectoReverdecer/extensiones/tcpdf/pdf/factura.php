<?php
// requiero controladores de ventas
require_once "../../../controladores/controlador.ventas.php";
require_once "../../../modelos/modelo.ventas.php";
// requiero controladores y modelos de clientes
require_once "../../../controladores/controlador.clientes.php";
require_once "../../../modelos/modelo.clientes.php";
// requiero controladores y modelos de empelados
require_once "../../../controladores/controlador.empleados.php";
require_once "../../../modelos/modelo.empleados.php";
// requiero controladores y modelos de los productos
require_once "../../../controladores/controlador.productos.php";
require_once "../../../modelos/modelo.productos.php";
// requerimos la clase tcpdf
require_once "tcpdf_include.php";
// Calse para recibir el numero de la factura
class imprimirFactura{
// Traer la información de la venta
public $codigo;
public function traerImpresionFactura(){
$item = "codigoVenta";
$valor =$this->codigo;
$respuestaVenta=ControladorVentas::ctrMostrarVentas($item,$valor);
// traer información de la factura
$FechaCompra=substr($respuestaVenta["FechaCompra"],0);
$Productos=json_decode($respuestaVenta["Productos"],true);
$Impuesto=number_format($respuestaVenta["Impuesto"],2);
$Neto=number_format($respuestaVenta["Neto"],2);
$Total=number_format($respuestaVenta["Total"],2);
// traer información del vendedor
$itemEmpleado="IdEmpleado";
$valorEmpleado=$respuestaVenta["IdEmpleado"];
$respuestaEmpleado=ControladorEmpleados::ctrMostrarEmpleados($itemEmpleado,$valorEmpleado);
// traer información del cliente
$itemCliente="IdCliente";
$valorCliente=$respuestaVenta["IdCliente"];
$respuestaCliente=ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);
// Requerimos información de los productos

// creación del archivo pdf tamaño carta
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Opción para tener varias páginas en el documento pdf
$pdf->startPageGroup();
// adicionar una nueva página
$pdf->AddPage();
// Creación del primer bloque
$bloque1 = <<<EOF
    <table>
        <tr>
            <td style="width:150px;"><h1>Nombre tienda</h1></td>
            <td style="width: 140px;">
                <div style="font-size:8.5px; text-aling:rigth;line-heigth:15px;">
                    <br>
                    Nit: 000000-0
                    <br>
                    Dirección: Callle ## B ###
                </div>
            </td>
            <td style="width: 140px;">
                <div style="font-size:8.5px; text-aling:rigth;line-heigth:15px;">
                    <br>
                    Telefono: 1234567
                    <br>
                    Correo: correo@host.com
                </div>
            </td>
            <td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>$valor</td>
        </tr>
    </table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');

// Creación del segundo bloque

$bloque2 = <<<EOF
    <table>
        <tr>
            <td style="width:540px"><img src="images/back.jpg"></td>
        </tr>
    </table>
    <table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:390px">
				Cliente: $respuestaCliente[Nombre]
			</td>
			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
				Fecha: $FechaCompra
			</td>
		</tr>
        <tr>
			<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaEmpleado[Nombre]</td>
		</tr>
		<tr>
		    <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>
		</tr>
    </table>
EOF;
$pdf->writeHTML($bloque2,false,false,false,false,'');
// Creación del tercer bloque
$bloque3 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
		    <td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
		    <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		    <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($bloque3,false,false,false,false,'');

// Creación del bloque cuatro

foreach($Productos as $key => $item){
$itemProducto="idProducto";
$valorProducto=$item["idProducto"];
$orden=null;
$respuestaProducto=ControladorProductos::ctrMostrarProductos($itemProducto,$valorProducto,$orden);
$valorUnitario = number_format($respuestaProducto["PrecioVenta"], 2);
$precioTotal = number_format($item["total"], 2);

$bloque4 = <<< EOF
<table style="font-size:10px; padding:5px 10px;">
    <tr>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
            $item[nombre]
        </td>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
            $item[cantidad]
        </td>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
            $valorUnitario
        </td>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
            $precioTotal
        </td>
        
</tr>

</table>
EOF;
$pdf->writeHTML($bloque4,false,false,false,false,'');
}
// Creación del bloque cinco por fuera del ciclo foreach
$bloque5 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>
			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>
		</tr>
		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Neto:
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $Neto
			</td>
		</tr>
		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $Impuesto
			</td>
		</tr>

		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $Total
			</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');

ob_end_clean();
// salida del archivo
$pdf->Output('factura.pdf','D');
}
}
// Capturar la variable get para traer toda la información de la venta
$factura = new imprimirFactura();
$factura->codigo=$_GET["codigo"];
$factura->traerImpresionFactura();

?>