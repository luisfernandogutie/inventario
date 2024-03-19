<?php 
    require_once "../../controladores/controlador.productos.php";
    require_once "../../modelos/modelo.productos.php";
    require_once "../../controladores/controlador.categorias.php";
    require_once "../../modelos/modelo.categorias.php";
    require_once "../../controladores/controlador.proveedores.php";
    require_once "../../modelos/modelo.proveedores.php";
    

    $descargarInventario= new ControladorProductos();
    $descargarInventario->ctrDescargarReporteInventario();
?> 