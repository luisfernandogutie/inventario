<?php
	// importacion de los controladores 
	require_once "controladores/controlador.plantilla.php";
	require_once "controladores/controlador.cargos.php";
	require_once "controladores/controlador.clientes.php";
	require_once "controladores/controlador.empleados.php";
	require_once "controladores/controlador.proveedores.php";
	require_once "controladores/controlador.productos.php";
	require_once "controladores/controlador.ventas.php";
	require_once "controladores/controlador.categorias.php";
	require_once "controladores/controlador.medio.pago.php";
	// llamado de los modelos 
	require_once "modelos/modelo.cargos.php";
	require_once "modelos/modelo.clientes.php";
	require_once "modelos/modelo.productos.php";
	require_once "modelos/modelo.proveedores.php";
	require_once "modelos/modelo.ventas.php";
	require_once "modelos/modelo.empleados.php";
	require_once "modelos/modelo.categorias.php";
	require_once "modelos/modelo.medio.pago.php";




	$plantilla = new ControladorPlantilla();
	$plantilla -> CtrPlantilla();