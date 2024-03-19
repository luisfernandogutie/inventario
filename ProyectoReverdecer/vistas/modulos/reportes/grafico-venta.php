<?php 
    error_reporting(0);
    if(isset($_GET["fechaInicial"])){
        $fechaInicial=$_GET["fechaInicial"];
        $fechaFinal=$_GET["fechaFinal"];
    }else{
        $fechaInicial=null;
        $fechaFinal=null;
    } 
    $arrayFechas = array();
    $arrayVentas = array();
    $sumaPagosMes = array();
    $ventas = ControladorVentas::ctrMostrarRangoFechasVentas($fechaInicial,$fechaFinal);
    foreach($ventas as $key => $value){
        #Capturamos sólo el año y el mes
        $fecha = substr($value["FechaCompra"],0,7);

        #Introducir las fechas en arrayFechas
        array_push($arrayFechas, $fecha);

        #Capturamos las ventas
        $arrayVentas = array($fecha => $value["Total"]);

        #Sumamos los pagos que ocurrieron el mismo mes
        foreach ($arrayVentas as $key => $value) {
            
            $sumaPagosMes[$key] += $value;
        }

    }
    $noRepetirFechas = array_unique($arrayFechas);
     
?>

<!-- grafico de ventas -->

<div class="box box-solid bg-teal-gradient ">
    <!-- #112869 -->
    <div class="box-header" style="background-color:#337ab7;">
        <i class="fa fa-th"></i>
        <h3 class="box-title">Grafico de ventas</h3>
    </div>
    <div class="box-body border-radius-none nuevoGraficoVentas" style="background-color:#337ab7;">
        <div class="chart" id="line-chart-ventas" style="height: 250px;"></div>
    </div>
</div>

<script>
    var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [
    <?php
        if($noRepetirFechas != null){
            foreach($noRepetirFechas as $key){
                echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },";
            }
            echo "{y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";
        }else{
        echo "{ y: '0', ventas: '0' }";
        }
    ?>
    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
  });
</script>