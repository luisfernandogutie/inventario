
<?php
    require_once "../../controladores/controlador.clientes.php";
    require_once "../../controladores/controlador.empleados.php";
    require_once "../../controladores/controlador.ventas.php";
    require_once "../../controladores/controlador.productos.php";
    require_once "../../controladores/controlador.medio.pago.php";
    require_once "../../modelos/modelo.clientes.php";
    require_once "../../modelos/modelo.empleados.php";
    require_once "../../modelos/modelo.ventas.php";
    require_once "../../modelos/modelo.productos.php";
    require_once "../../modelos/modelo.medio.pago.php";
    

    $descargarReporte= new ControladorVentas();
    $descargarReporte->ctrDescargarReporte();



?>