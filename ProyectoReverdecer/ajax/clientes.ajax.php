<?php 
    include_once "../controladores/controlador.clientes.php";
    include_once "../modelos/modelo.clientes.php";

    class ajaxClientes
    {
        // Editar clientes
        public $IdCliente;

        public function ajaxEditarCliente(){

            $item="IdCliente";
            $valor = $this->IdCliente;
            $respuesta =  ControladorClientes::ctrMostrarClientes($item,$valor);
            echo json_encode($respuesta);

        }

        public function ajaxValidarCliente(){
            $item="IdCliente";
            $valor=$this->IdCliente;
            $respuesta=ControladorClientes::ctrMostrarClientes($item,$valor);
            echo json_encode($respuesta);
        }


    }

    if(isset($_POST["IdCliente"])){
        $editar = new ajaxClientes();
        $editar-> IdCliente = $_POST["IdCliente"];
        $editar->ajaxEditarCliente();
    }

    if(isset($_POST["IdClienteValidar"])){
        $validarCliente = new ajaxClientes();
        $validarCliente->IdCliente=$_POST["IdClienteValidar"];
        $validarCliente->ajaxValidarCliente();
    }