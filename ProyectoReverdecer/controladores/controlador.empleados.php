<?php
    class ControladorEmpleados{

        // metodo para el ingreso de usuarios Login

        static public function ctrIngresoEmpleado(){
            if(isset($_POST["usuario"])){
                if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) && 
                preg_match('/^[0-9]+$/', $_POST["password"])){
                    $tabla="empleado";
                    $item="Usuario";
                    $valor = $_POST["usuario"];
                    $respuesta = ModeloEmpleados::MdlMostrarEmpleados($tabla,$item,$valor);
                    
                    if(is_array($respuesta)){
                        if($respuesta["Usuario"]==$_POST["usuario"] && $respuesta["Contrasena"]==$_POST["password"]){
                             #creación de variables de sesion para ver que usuario esta logueado
                            $_SESSION["iniciarSesion"] = "ok";
                            $_SESSION["IdEmpleado"] = $respuesta["IdEmpleado"];
                            $_SESSION["Nombre"] = $respuesta["Nombre"];
                            $_SESSION["Telefono"] = $respuesta["Telefono"];
                            //Variable de sesion para los cargos
                            $item="idCargo";
                            $respuestaCargo=ControladorCargos::ctrMostrarCargos($item,$respuesta["Cargo_idCargo"]);
                            $_SESSION["nombreCargo"]=$respuestaCargo["Nombre"];
                            $_SESSION["Cargo"] = $respuesta["Cargo_idCargo"];
                            $_SESSION["Usuario"] = $respuesta["Usuario"];
                            $_SESSION["Contrasena"] = $respuesta["Contrasena"];
                            
                            
                            echo '<script>
                                    window.location = "inicio";
                                </script>';
                        }else{
                            echo '<br><div class="alert alert-warning">
                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                    <p>Error, el usuario o la contraseña ingresado no son correctos</p>
                                </div>';
    
                        }
                    }else{
                        echo '<br><div class="alert alert-danger">
                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                    <p>Los datos ingresados no existen en el sistema</p>
                                </div>';
    
                    }

                }
            }
        }

        // método para listar empleados

        static public function ctrMostrarEmpleados($item,$valor){
            $tabla="empleado";
            $respuesta = ModeloEmpleados::MdlMostrarEmpleados($tabla,$item,$valor);
            return $respuesta;
        }

        // Metodo Crear empleado

        static public function ctrCrearEmpleado(){
            if(isset($_POST["IdEmpleado"])){
                if(preg_match('/^[0-9]+$/', $_POST["IdEmpleado"]) &&
			        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Nombre"]) &&
                    
                    preg_match('/^[0-9]+$/', $_POST["Telefono"]) && 
                    preg_match('/^[0-9]+$/', $_POST["Cargo_idCargo"]) && 
                    preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Usuario"]) && 
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["Contrasena"])){

                        $tabla="empleado";
                        #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                        $datos=array("IdEmpleado"=>$_POST["IdEmpleado"],
                                    "Nombre"=>$_POST["Nombre"],
                                    "Telefono"=>$_POST["Telefono"],
                                    "Cargo_idCargo"=>$_POST["Cargo_idCargo"],
                                    "Usuario"=>$_POST["Usuario"],
                                    "Contrasena"=>$_POST["Contrasena"]);

                        $respuesta=ModeloEmpleados::mdlIngresarEmpleado($tabla,$datos);
                        
                        if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El empleado ha sigo agregado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'gestionar-empleados';
                                }
                              });</script>";
                        }

                    }else{

                        echo"<script> swal({
                            title: '¡ERROR!',
                            text: 'Los datos que esta ingresando contienen caracteres no permitidos, por favor verifiquelos',
                            type: 'error'

                        }).then((result)=>{
                            if(result.value){
                                window.location= 'gestionar-empleados';
                            }
                          });</script>";
                    }

            }
        }

        // Metodo para Editar empleados

        static public function ctrEditarEmpleado(){
            if(isset($_POST["EditarIdEmpleado"])){
                if(preg_match('/^[0-9]+$/', $_POST["EditarIdEmpleado"]) &&
			        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarNombre"]) &&
                    
                    preg_match('/^[0-9]+$/', $_POST["EditarTelefono"]) && 
                    preg_match('/^[0-9]+$/', $_POST["EditarCargo_idCargo"]) && 
                    preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarUsuario"]) && 
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["EditarContrasena"])){
                        if((!$_POST["EditarIdEmpleado"]=="") &&
                            (!$_POST["EditarNombre"]=="") &&
                            (!$_POST["EditarTelefono"]=="") &&
                            (!$_POST["EditarCargo_idCargo"]=="") &&
                            (!$_POST["EditarUsuario"]=="")&&
                            (!$_POST["EditarContrasena"]=="")) {
                                
                                
                                $tabla="empleado";
                                #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                                $datos=array("IdEmpleado"=>$_POST["EditarIdEmpleado"],
                                            "Nombre"=>$_POST["EditarNombre"],
                                            "Telefono"=>$_POST["EditarTelefono"],
                                            "Cargo_idCargo"=>$_POST["EditarCargo_idCargo"],
                                            "Usuario"=>$_POST["EditarUsuario"],
                                            "Contrasena"=>$_POST["EditarContrasena"]);
                                $actualizacion=$_POST["IdEmpleadoActual"];
                        }else{
                            $tabla="empleado";
                            #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                            $datos=array("IdEmpleado"=>$_POST["IdEmpleadoActual"],
                                        "Nombre"=>$_POST["NombreActual"],
                                        "Telefono"=>$_POST["TelefonoActual"],
                                        "Cargo_idCargo"=>$_POST["Cargo_idCargoActual"],
                                        "Usuario"=>$_POST["UsuarioActual"],
                                        "Contrasena"=>$_POST["ContrasenaActual"]);
                            $actualizacion=$_POST["IdEmpleadoActual"];
                        }
                        

                        $respuesta=ModeloEmpleados::mdlActualizarEmpleado($tabla,$datos,$actualizacion);
                        
                        if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El empleado ha sido actualizado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'gestionar-empleados';
                                }
                              });</script>";
                        }

                    }else{

                        echo"<script> swal({
                            title: '¡ERROR!',
                            text: 'Los datos que esta ingresando contienen caracteres no permitidos, por favor verifiquelos',
                            type: 'error'

                        }).then((result)=>{
                            if(result.value){
                                window.location= 'gestionar-empleados';
                            }
                          });</script>";
                    }

            }
        }

        static public function ctrBorrarEmpleado(){
            if(isset($_GET["IdEmpleado"])){
                $tabla="empleado";
                $datos= $_GET["IdEmpleado"];
                $respuesta=ModeloEmpleados::mdlEliminarEmpleado($tabla,$datos);
                if($respuesta=="ok"){
                    echo"<script> swal({
                        title: '¡OK!',
                        text: 'El empleado se ha Eliminado correctamente',
                        type: 'success'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'gestionar-empleados';
                        }
                      });</script>";
                    }    
            }        
        }

        
       
    }