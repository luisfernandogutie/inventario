<?php 
    require_once "../controladores/controlador.proveedores.php";
    require_once "../modelos/modelo.proveedores.php";

    class ajaxProveedores
    {
        public $IdProveedor;
        
        public function ajaxEditarProveedor(){
            $item="IdProveedor";
            $valor = $this->IdProveedor;
            $respuesta = ControladorProveedores::ctrMostrarProveedores($item,$valor);
            echo json_encode($respuesta);

        }

        public function ajaxValidarProveedor(){
            $item="IdProveedor";
            $valor=$this->IdProveedor;
            $respuesta=ControladorProveedores::ctrMostrarProveedores($item,$valor);
            echo json_encode($respuesta);
        }


    }

    if(isset($_POST["IdProveedor"])){
        $editar = new ajaxProveedores();
        $editar->IdProveedor = $_POST["IdProveedor"];
        $editar->ajaxEditarProveedor();
    }
    
    if(isset($_POST["IdProveedorValidar"])){
        $validarProveedor = new ajaxProveedores();
        $validarProveedor->IdProveedor=$_POST["IdProveedorValidar"];
        $validarProveedor->ajaxValidarProveedor();
    }

