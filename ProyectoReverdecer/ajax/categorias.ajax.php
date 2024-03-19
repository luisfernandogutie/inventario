<?php 
    require_once "../controladores/controlador.categorias.php";
    require_once "../modelos/modelo.categorias.php";
    class ajaxCategorias{
        #Editar Categoria
        public $IdCategoria;

        public function ajaxEditarCategoria(){

            $item= "IdCategoria";
            $valor = $this->IdCategoria;
            $respuesta= ControladorCategorias::ctrMostrarCategorias($item,$valor);
            echo json_encode($respuesta);
        }


    }
    
    if(isset($_POST["IdCategoria"])){
        $editar = new ajaxCategorias();
        $editar-> IdCategoria = $_POST["IdCategoria"];
        $editar->ajaxEditarCategoria();
    }