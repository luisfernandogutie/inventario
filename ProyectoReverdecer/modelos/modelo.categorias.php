<?php
    include_once "conexion.php";
    class ModeloCategorias{
        
        static public function mdlMostrarCategorias($tabla,$item,$valor){ 
            if($item != null){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            }else{
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                $stmt->execute();
                return $stmt->fetchAll();
            }
        }

        static public function mdlIngresarCategoria($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (NombreCategoria) VALUES (:NombreCategoria)");
            
            $stmt->bindParam(":NombreCategoria", $datos["NombreCategoria"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }  

        static public function mdlActualizarCategoria($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("UPDATE  $tabla SET NombreCategoria=:NombreCategoria 
                                                    WHERE IdCategoria=:IdCategoria");
            
            $stmt->bindParam(":NombreCategoria", $datos["NombreCategoria"],PDO::PARAM_STR);
            $stmt->bindParam(":IdCategoria", $datos["IdCategoria"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }

        static public function mdlEliminarCategoria($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE IdCategoria=:IdCategoria");
            $stmt->bindParam(":IdCategoria", $datos,PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }
    }