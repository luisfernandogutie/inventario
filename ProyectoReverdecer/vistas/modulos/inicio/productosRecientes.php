<?php

$item = null;
$valor = null;
$orden = "IdProducto";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

 ?>


<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Productos agregados recientemente</h3>

   

      

    </div>

  </div>
  
  <div class="box-body">

    <ul class="products-list product-list-in-box">

    <?php

    for($i = 0; $i < 10; $i++){

      echo '<li class="item">

        <div class="product-info">

          <a href="" class="product-title">

            '.$productos[$i]["Nombre"].'

            <span class="label label-info  pull-right">$'.$productos[$i]["PrecioVenta"].'</span>

          </a>
    
       </div>

      </li>';

    }

    ?>

    </ul>

  </div>

  <div class="box-footer text-center">

    <a href="gestionar-inventarios" class="uppercase">Ver todos los productos</a>
  
  </div>

</div>
