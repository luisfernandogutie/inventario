<?php
    class ControladorCargos{

        // Método para registrar Cargos
        static public function ctrCrearCargo(){
            if(isset($_POST["IdCargo"]) && isset($_POST["NombreCargo"])){
                if(preg_match('/^[0-9]+$/', $_POST["IdCargo"]) &&
			        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["NombreCargo"])){
                        
                        $tabla="cargo";
                        #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                        $datos=array("IdCargo"=>$_POST["IdCargo"],"Nombre"=>$_POST["NombreCargo"]);

                        $respuesta=ModeloCargos::mdlIngresarCargo($tabla,$datos);
                        
                        if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El cargo ha sido agregado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'cargos';
                                }
                              });</script>";
                        }
                    }else{
                        echo"<script> swal({
                            title: '¡ERROR!',
                            text: 'El nombre del cargo no debe de tener caracteres especiales',
                            type: 'error'

                        }).then((result)=>{
                            if(result.value){
                                window.location= 'cargos';
                            }
                          });</script>";

                    }
            }

        }

        # Método para mostrar los datos de los cargos y llenar el datatable

        static public function ctrMostrarCargos($item,$valor){
            $tabla="cargo";
            $respuesta = ModeloCargos::MdlMostrarCargos($tabla,$item,$valor);
            return $respuesta;
        }

        # Mètodo para editar los datos de un cargo

        static public function ctrEditarCArgo(){
            if(isset($_POST["EditarIdCargo"])){
                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarNombreCargo"])){
                    $tabla = "cargo";
                    // Validación, si el nombre viene vacio o si se modifica
                    if(!$_POST["EditarNombreCargo"]==""){
                        $datos=array("IdCargo"=>$_POST["EditarIdCargo"],"Nombre"=>$_POST["EditarNombreCargo"]);
                    }else{
                        $datos=array("IdCargo"=>$_POST["EditarIdCargo"],"Nombre"=>$_POST["NombreCargoActual"]);
                    }
                    $respuesta=ModeloCargos::mdlActualizarCargo($tabla,$datos);
                    if($respuesta=="ok"){
                        echo"<script> swal({
                            title: '¡OK!',
                            text: 'El cargo ha sido Actualizado correctamente',
                            type: 'success'

                        }).then((result)=>{
                            if(result.value){
                                window.location= 'cargos';
                            }
                          });</script>";
                    }
                        
                }else{
                    echo"<script> swal({
                        title: '¡ERROR!',
                        text: 'El nombre del cargo no debe de tener caracteres especiales',
                        type: 'error'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'cargos';
                        }
                      });</script>";

                }
                    

                    
            }
        }

        // Borrar Cargo

        static public function ctrBorrarCargo(){
            if(isset($_GET["idCargo"])){
                $tabla="cargo";
                $datos= $_GET["idCargo"];
                $respuesta=ModeloCargos::mdlEliminarCargo($tabla,$datos);
                if($respuesta=="ok"){
                    echo"<script> swal({
                        title: '¡OK!',
                        text: 'El cargo se ha Eliminado correctamente',
                        type: 'success'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'cargos';
                        }
                      });</script>";
                }
            }
        }
    }