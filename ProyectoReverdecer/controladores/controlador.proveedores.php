<?php
    class ControladorProveedores{

        static public function ctrMostrarProveedores($item,$valor){
            $tabla="proveedor";
            $respuesta = ModeloProveedores::mdlMostrarProveeodres($tabla,$item,$valor);
            return $respuesta;
        }

        static public function ctrCrearProveedor(){
            if(isset($_POST["IdProveedor"])){
                if(preg_match('/^[0-9]+$/', $_POST["IdProveedor"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Nombre"]) &&
                    
                preg_match('/^[0-9]+$/', $_POST["Telefono"])){  
                    $tabla="proveedor";
                        #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                    $datos=array("IdProveedor"=>$_POST["IdProveedor"],
                                "Nombre"=>$_POST["Nombre"],
                                "Telefono"=>$_POST["Telefono"],
                                "EmailProveedor"=>$_POST["EmailProveedor"],
                                "EstadoProveedor"=>$_POST["EstadoProveedor"]);
                    $respuesta=ModeloProveedores::mdlRegistrarProveedor($tabla,$datos);
                        
                        if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El proveedor ha sido agregado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'gestionar-proveedores';
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
                            window.location= 'gestionar-proveedores';
                        }
                      });</script>";

                }
            }
        }
    
        static public function ctrEditarProveedor(){
            if(isset($_POST["EditarIdProveedor"])){
                if(preg_match('/^[0-9]+$/', $_POST["EditarIdProveedor"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarNombre"]) &&
                    
                preg_match('/^[0-9]+$/', $_POST["EditarTelefono"])){
                    if((!$_POST["EditarIdProveedor"]=="") &&
                        (!$_POST["EditarNombre"]=="") &&
                        (!$_POST["EditarTelefono"]=="") &&
                        (!$_POST["EditarEmailProveedor"]=="") &&
                        (!$_POST["EditarEstadoProveedor"]=="")) {
                            $tabla="proveedor";
                                #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                            $datos=array("IdProveedor"=>$_POST["EditarIdProveedor"],
                                        "Nombre"=>$_POST["EditarNombre"],
                                        "Telefono"=>$_POST["EditarTelefono"],
                                        "EmailProveedor"=>$_POST["EditarEmailProveedor"],
                                        "EstadoProveedor"=>$_POST["EditarEstadoProveedor"]);
                            $actualizacion=$_POST["IdProveedorActual"];
                    }else{
                            $tabla="proveedor";
                            #Asignación de datos enviados por el metodo pos a un array para almacenarlos en la base de datos    
                            $datos=array("IdProveedor"=>$_POST["IdProveedorActual"],
                                        "Nombre"=>$_POST["NombreProveedorActual"],
                                        "Telefono"=>$_POST["TelefonoActual"],
                                        "EmailProveedor"=>$_POST["EmailProveedorActual"],
                                        "EstadoProveedor"=>$_POST["EstadoProveedorActual"]);
                            $actualizacion=$_POST["IdProveedorActual"];

                    }
                    $respuesta=ModeloProveedores::mdlActualizarProveedor($tabla,$datos,$actualizacion);
                        
                    if($respuesta=="ok"){
                        echo"<script> swal({
                            title: '¡OK!',
                            text: 'El proveedor ha sido actualizado correctamente',
                            type: 'success'
    
                        }).then((result)=>{
                            if(result.value){
                                window.location= 'gestionar-proveedores';
                            }
                        });</script>";
                    }

                }
                else{
                    echo"<script> swal({
                        title: '¡ERROR!',
                        text: 'Los datos que esta ingresando contienen caracteres no permitidos, por favor verifiquelos',
                        type: 'error'
    
                    }).then((result)=>{
                        if(result.value){
                            window.location= 'gestionar-proveedores';
                        }
                      });</script>";
    
                }
            }

        }

        static public function ctrBorrarProveedor(){
            if(isset($_GET["IdProveedor"])){
                $tabla="proveedor";
                $datos= $_GET["IdProveedor"];
                $respuesta=ModeloProveedores::mdlEliminarProveedor($tabla,$datos);
                if($respuesta=="ok"){
                    echo"<script> swal({
                        title: '¡OK!',
                        text: 'El proveedor se ha Eliminado correctamente',
                        type: 'success'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'gestionar-proveedores';
                        }
                      });</script>";
                    }    
            }
        }
    }
