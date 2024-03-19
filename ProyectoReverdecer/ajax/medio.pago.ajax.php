<?php 
    require_once "../controladores/controlador.medio.pago.php";
    require_once "../modelos/modelo.medio.pago.php";
    class ajaxPagos{
        #Editar Medio de pago
        public $idTpago;

        public function ajaxEditarMediopago(){

            $item= "idTpago";
            $valor = $this->idTpago;
            $respuesta= ControladorPagos::ctrMostrarPagos($item,$valor);
            echo json_encode($respuesta);
        }


    }
    
    if(isset($_POST["idTpago"])){
        $editar = new ajaxPagos();
        $editar-> idTpago = $_POST["idTpago"];
        $editar->ajaxEditarMediopago();
    }