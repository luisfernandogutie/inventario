<?php 
    require_once "../controladores/controlador.productos.php";
    require_once "../modelos/modelo.productos.php";

    class ajaxProductos{
        public $idProducto;

        public $traerProductos;
        
        public function ajaxEditarProducto(){

            if($this -> traerProductos == "ok"){
                $item=null;
                $valor = null;
                $orden = "idProducto";
                $respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
                echo json_encode($respuesta);
            }else{
                $item="idProducto";
                $valor = $this->idProducto;
                $orden = "idProducto";
                $respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
                echo json_encode($respuesta);

            }

        }
    }

    if(isset($_POST["idProducto"])){
        $editar = new ajaxProductos();
        $editar->idProducto = $_POST["idProducto"];
        $editar->ajaxEditarProducto();
    }


    if(isset($_POST["traerProductos"])){
        $traerProductos = new ajaxProductos();
        $traerProductos->traerProductos = $_POST["traerProductos"];
        $traerProductos->ajaxEditarProducto();
    }
