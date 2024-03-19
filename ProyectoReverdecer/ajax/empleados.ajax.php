<?php 
    require_once "../controladores/controlador.empleados.php";
    require_once "../modelos/modelo.empleados.php";

    class ajaxEmpleados
    {
        public $IdEmpleado;
        
        public function ajaxEditarEmpleado(){
            $item="IdEmpleado";
            $valor = $this->IdEmpleado;
            $respuesta = ControladorEmpleados::ctrMostrarEmpleados($item,$valor);
            echo json_encode($respuesta);

        }

        // Validacion de existencia de nombre de usuario
        public $Usuario;
        public function ajaxValidarUsuario(){
            $item="Usuario";
            $valor=$this->Usuario;
            $respuesta=ControladorEmpleados::ctrMostrarEmpleados($item,$valor);
            echo json_encode($respuesta);
        }

        public function ajaxValidarEmpleado(){
            $item="IdEmpleado";
            $valor=$this->IdEmpleado;
            $respuesta=ControladorEmpleados::ctrMostrarEmpleados($item,$valor);
            echo json_encode($respuesta);
        }
    }

    if(isset($_POST["IdEmpleado"])){
        $editar = new ajaxEmpleados();
        $editar->IdEmpleado = $_POST["IdEmpleado"];
        $editar->ajaxEditarEmpleado();
    }
    //  Validación de existencia
    if(isset($_POST["Usuario"])){
        $validarNombre = new ajaxEmpleados();
        $validarNombre->Usuario=$_POST["Usuario"];
        $validarNombre->ajaxValidarUsuario();

    }
    
    // existencia de usuarios

    if(isset($_POST["IdEmpleadoValidar"])){
        $validarEmpleado = new ajaxEmpleados();
        $validarEmpleado->IdEmpleado=$_POST["IdEmpleadoValidar"];
        $validarEmpleado->ajaxValidarEmpleado();
    }