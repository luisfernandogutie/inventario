<?php 
    require_once "../controladores/controlador.cargos.php";
    require_once "../modelos/modelo.cargos.php";
    class ajaxCargos{
        #Editar Cargo
        public $idCargo;

        public function ajaxEditarCargo(){

            $item= "idCargo";
            $valor = $this->idCargo;
            $respuesta= ControladorCargos::ctrMostrarCargos($item,$valor);
            echo json_encode($respuesta);
        }


    }
    
    if(isset($_POST["idCargo"])){
        $editar = new ajaxCargos();
        $editar-> idCargo = $_POST["idCargo"];
        $editar->ajaxEditarCargo();
    }
    