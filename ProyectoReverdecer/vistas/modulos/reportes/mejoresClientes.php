<?php
	$item=null;
	$valor=null;
	$ventas=ControladorVentas::ctrMostrarVentas($item,$valor);
	$clientes=ControladorClientes::ctrMostrarClientes($item,$valor);

	$arrayClientes = array();
	$arraylistaClientes = array();	
	foreach ($ventas as $key => $valueVentas) {
		foreach ($clientes as $key => $valueClientes) {
		  if($valueClientes["IdCliente"] == $valueVentas["IdCliente"]){
			  #Capturamos los vendedores en un array
			  array_push($arrayClientes, $valueClientes["Nombre"]);
			  #Capturamos las nombres y los valores netos en un mismo array
			  $arraylistaClientes = array($valueClientes["Nombre"] => $valueVentas["Neto"]);
			   #Sumamos los netos de cada vendedor
			  foreach ($arraylistaClientes as $key => $value) {
				  $sumaTotalClientes[$key] += $value;
			   }
		  	}
		}
	}
	#Evitamos repetir nombre
	$noRepetirNombres = array_unique($arrayClientes);
?>
<div class="box box-success">
	<div class="box-header with-border">
    	<h3 class="box-title">Mejores clientes</h3>
  	</div>
  	<div class="box-body">
		<div class="chart-responsive">
			<div class="chart" id="bar-chart1" style="height: 300px;"></div>
		</div>
  	</div>
</div>
<script>
	
	//BAR CHART
	var bar = new Morris.Bar({
		element: 'bar-chart1',
		resize: true,
		data: [
		<?php
			foreach($noRepetirNombres as $value){
			echo "{y: '".$value."', a: '".$sumaTotalClientes[$value]."'},";
			}
		?>
		],
		barColors: ['#0af'],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['ventas'],
		preUnits: '$',
		hideHover: 'auto'
	});


</script>