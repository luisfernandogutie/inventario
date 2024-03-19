<?php
    class ControladorClientes{
        // Método para mostrar los datos de los clientes
        static public function ctrMostrarClientes($item,$valor){
            $tabla="cliente";
            $respuesta = ModeloClientes::MdlMostrarClientes($tabla,$item,$valor);
            return $respuesta;
        }

        // Método para registrar clientes
        static public function ctrCrearCliente(){
            if(isset($_POST["IdCliente"]))
            {
                if(preg_match('/^[0-9]+$/', $_POST["IdCliente"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Nombre"]) &&
                
                preg_match('/^[0-9]+$/', $_POST["Telefono"])){

                    $tabla="cliente";
                        #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                        $datos=array("IdCliente"=>$_POST["IdCliente"],
                                    "Nombre"=>$_POST["Nombre"],
                                    "Telefono"=>$_POST["Telefono"],
                                    "Direccion"=>$_POST["Direccion"],
                                    "Email"=>$_POST["Email"],
                                    "EstadoCliente"=>$_POST["EstadoCliente"]);

                        $respuesta=ModeloClientes::mdlIngresarCliente($tabla,$datos);
                        
                        if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El cliente ha sido agregado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'gestionar-clientes';
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
                            window.location= 'gestionar-clientes';
                        }
                      });</script>";
                }

            }

        }
        
        static public function ctrEditarCliente(){
            if(isset($_POST["EditarIdCliente"]))
            {
                if(preg_match('/^[0-9]+$/', $_POST["EditarIdCliente"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarNombre"]) &&
                
                preg_match('/^[0-9]+$/', $_POST["EditarTelefono"])){

                    if((!$_POST["EditarIdCliente"]=="") || 
                            (!$_POST["EditarNombre"]=="") ||
                            (!$_POST["EditarTelefono"]=="") ||
                            (!$_POST["EditarDireccion"]=="") ||
                            (!$_POST["EditarEmail"]=="") ||
                            (!$_POST["EditarEstadoCliente"]=="")) {
                                $tabla="cliente";
                                #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                                $datos=array("IdCliente"=>$_POST["EditarIdCliente"],
                                            "Nombre"=>$_POST["EditarNombre"],
                                            "Telefono"=>$_POST["EditarTelefono"],
                                            "Direccion"=>$_POST["EditarDireccion"],
                                            "Email"=>$_POST["EditarEmail"],
                                            "EstadoCliente"=>$_POST["EditarEstadoCliente"]);
                                 $actualizacion=$_POST["IdClienteActual"];            
                                
                                

                            }else {
                                $tabla="cliente";
                                #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                                $datos=array("IdCliente"=>$_POST["IdClienteActual"],
                                            "Nombre"=>$_POST["NombreActual"],
                                            "Telefono"=>$_POST["TelefonoActual"],
                                            "Direccion"=>$_POST["DireccionActual"],
                                            "Email"=>$_POST["EmailActual"],
                                            "EstadoCliente"=>$_POST["EstadoClienteActual"]);
                                 $actualizacion=$_POST["IdClienteActual"]; 
                   
                            }
                            $respuesta=ModeloClientes::mdlActualizarCliente($tabla,$datos,$actualizacion);
                            
                            if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El cliente ha sido agregado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'gestionar-clientes';
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
                                window.location= 'gestionar-clientes';
                            }
                        });</script>";
                    }

            
            }
        }

        static public function ctrBorrarCliente(){
            if(isset($_GET["IdCliente"])){
                $tabla="cliente";
                $datos= $_GET["IdCliente"];
                $respuesta=ModeloClientes::mdlEliminarCliente($tabla,$datos);
                if($respuesta=="ok"){
                    echo"<script> swal({
                        title: '¡OK!',
                        text: 'El cliente se ha eliminado correctamente',
                        type: 'success'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'gestionar-clientes';
                        }
                      });</script>";
                    }    
            }    
        }
    }