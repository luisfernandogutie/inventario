<?php

if($_SESSION["Cargo"] != 1){

  echo"<script> swal({
    title: '¡ERROR!',
    text: 'Rol no autorizado para generar reportes',
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
        Reportes de ventas
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Reportes de ventas</a></li>
      </ol>
    </section>

    
    <section class="content">

      
      <div class="box">
        <div class="box-header with-border">
          <div class="input-group">
            <button type="button" class="btn btn-default" id="daterange-btn2">
              <span >
                <i class="fa fa-calendar"></i> Rango de Fecha
              </span>
              <i class="fa fa-caret-down"></i>
            </button>
          </div>
          
          <div class="box-tools pull-right">
            <?php 
              if(isset($_GET["fechaInicial"])){
                echo '<a href="vistas/modulos/descargar-reporte.php?reporte=repote&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';
              }else{
                echo '<a href="vistas/modulos/descargar-reporte.php?reporte=repote">';
              }
             
            ?>
                      <button class="btn btn-success" style="margin-top:5px;"> Descargar resportes
                      </button>
                    </a>
            
          </div>
            
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <?php 
                include "reportes/grafico-venta.php";
              ?>
            </div>
            <div class="col-md-6 col-xs-12">
            <?php 
                include "reportes/productos-mas-vendidos.php";
              ?>
            </div>
            <div class="col-md-6 col-xs-12">
            <?php 
                include "reportes/mejoresClientes.php";
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>