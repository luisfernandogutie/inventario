<?php
    class ControladorCategorias{
        static public function ctrMostrarCategorias($item,$valor){
            $tabla="categoria";
            $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla,$item,$valor);
            return $respuesta;
        }

        static public function ctrCrearCategoria(){
            if(isset($_POST["NombreCategoria"])){
                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["NombreCategoria"])){
                    $tabla="categoria";
                    $datos=array("NombreCategoria"=>$_POST["NombreCategoria"]);
                    $respuesta=ModeloCategorias::mdlIngresarCategoria($tabla,$datos);
                    if($respuesta=="ok"){
                        echo"<script> swal({
                            title: '¡OK!',
                            text: 'La categoria ha sido agregado correctamente',
                            type: 'success'

                        }).then((result)=>{
                            if(result.value){
                                window.location= 'gestionar-categorias';
                            }
                          });</script>";
                    }
                }else{

                    echo"<script> swal({
                        title: '¡ERROR!',
                        text: 'El nombre de la categoria no debe de tener caracteres especiales',
                        type: 'error'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'gestionar-categorias';
                        }
                      });</script>";
                }
            }
        }

        static public function ctrEditarCategorias(){
            if(isset($_POST["EditarCategoria"])){
                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarCategoria"])){
                    $tabla="categoria";   
                    $datos=array("NombreCategoria"=>$_POST["EditarCategoria"],
                                "IdCategoria"=>$_POST["IdCategoria"]);
                
                    $respuesta=ModeloCategorias::mdlActualizarCategoria($tabla,$datos);
                    if($respuesta=="ok"){ 
                        echo"<script> swal({
                            title: '¡OK!',
                            text: 'La categoria ha sido actualizada correctamente',
                            type: 'success'

                        }).then((result)=>{
                            if(result.value){
                                window.location= 'gestionar-categorias';
                            }
                        });</script>";
                    }       
                }else{

                    echo"<script> swal({
                        title: '¡ERROR!',
                        text: 'El nombre de la categoria no debe de tener caracteres especiales',
                        type: 'error'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'gestionar-categorias';
                        }
                    });</script>";
            
                }
            }
        }

        static public function ctrBorrarCategorias(){
            if(isset($_GET["IdCategoria"])){
                $tabla="categoria";
                $datos= $_GET["IdCategoria"];
                $respuesta=ModeloCategorias::mdlEliminarCategoria($tabla,$datos);
                if($respuesta=="ok"){
                    echo"<script> swal({
                        title: '¡OK!',
                        text: 'La categoría se ha Eliminado correctamente',
                        type: 'success'

                    }).then((result)=>{
                        if(result.value){
                            window.location= 'gestionar-categorias';
                        }
                      });</script>";
                }
            }
        }
    }