<?php 
    class ControladorPagos{
        static public function ctrMostrarPagos($item,$valor){
            $tabla="tpago";
            $respuesta = ModeloPagos::MdlMostrarPagos($tabla,$item,$valor);
            return $respuesta;
        }

        static public function ctrCrearMedioPago(){
            if(isset($_POST["idTpago"])){
                if(preg_match('/^[0-9]+$/', $_POST["idTpago"]) && 
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

                    $tabla="tpago";
                        #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                    $datos=array("idTpago"=>$_POST["idTpago"],"descripcion"=>$_POST["descripcion"]);

                    $respuesta=ModeloPagos::mdlIngresarPago($tabla,$datos);
                        
                    if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El medio de pago ha sido agregado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'gestionar-medio-pago';
                                }
                              });</script>";
                    }
                }else{
                    echo"<script> swal({
                        title: '¡ERROR!',
                        text: los datos ingresados no deben tener caracteres especiales',
                        type: 'error'
    
                        }).then((result)=>{
                            if(result.value){
                            window.location= 'gestionar-medio-pago';
                        }
                    });</script>";
                }
            }
        


       
        }

        static public function crtEditarMedioPago(){
            if(isset($_POST["EditaridTpago"])){
                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Editardescripcion"])){
                    $tabla="tpago";
                        #Asignación de datos enviados por el metodo pos a un rray para almacenarlos en la base de datos    
                     $datos=array("idTpago"=>$_POST["EditaridTpago"],"descripcion"=>$_POST["Editardescripcion"]);

                    $respuesta=ModeloPagos::mdlActualizarPago($tabla,$datos);
                        
                    if($respuesta=="ok"){
                            echo"<script> swal({
                                title: '¡OK!',
                                text: 'El medio de pago ha sido actualizado correctamente',
                                type: 'success'
    
                            }).then((result)=>{
                                if(result.value){
                                    window.location= 'gestionar-medio-pago';
                                }
                              });</script>";
                    }
                }else{
                    echo"<script> swal({
                        title: '¡ERROR!',
                        text: los datos ingresados no deben tener caracteres especiales',
                        type: 'error'
    
                        }).then((result)=>{
                            if(result.value){
                            window.location= 'gestionar-medio-pago';
                        }
                    });</script>";
                }
            }
        }

        static public function ctrBorrarMediPago(){
            if(isset($_GET["idTpago"])){
                $tabla="tpago";
                $datos= $_GET["idTpago"];
                $respuesta=ModeloPagos::mdlEliminarMedioPago($tabla,$datos);
                if($respuesta=="ok"){
                    echo"<script> swal({
                        title: '¡OK!',
                        text: 'El medio de pago se ha Eliminado correctamente',
                        type: 'success'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'gestionar-medio-pago';
                        }
                      });</script>";
                    }    
            }
        }
    
}