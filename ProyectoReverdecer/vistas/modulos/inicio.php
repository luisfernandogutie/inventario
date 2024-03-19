<?php 

?>

<div class="content-wrapper">
    <section class="content-header">
      <h1 class="text-primary">
        Página principal
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a class="active" href="#">Tablero</a></li>
      </ol>
    </section>

   
    <section class="content">
      <div class="box">
        <div class="box-header">
        <div class="col-lg-12">
            <?php
        
              if($_SESSION["Cargo"] ==1){
          
                include "inicio/cajasSuperiores.php";
                
              }
            ?>  
        </div> 
        <br>
        <div class="col-lg-12">
              <?php 
                if($_SESSION["Cargo"] ==1){
          
                  include "inicio/productosRecientes.php";
                  
                }
              ?>
        </div>
        <div class="col-lg-12">
            <?php
              if($_SESSION["Cargo"] != 1){
                  echo '<div class="box box-success">
                            <div class="box-header">
                              <h1>Bienvenid@ ' .$_SESSION["Nombre"].'</h1>
                            </div>
                        </div>';
              }
            ?>
        </div>
      </div>
    </div>
    </section>
    <!-- /.content -->
  </div>