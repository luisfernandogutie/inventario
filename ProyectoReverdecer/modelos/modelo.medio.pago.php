<?php 
    require_once "conexion.php";
    class ModeloPagos{
        
        static public function MdlMostrarPagos($tabla,$item,$valor){
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

        static public function mdlIngresarPago($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idTpago,descripcion) VALUES (:idTpago,:descripcion)");
            $stmt->bindParam(":idTpago", $datos["idTpago"],PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;

        }

        static public function mdlActualizarPago($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion=:descripcion WHERE idTpago=:idTpago");
            $stmt->bindParam(":idTpago", $datos["idTpago"],PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }
        
        static public function mdlEliminarMedioPago($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idTpago=:idTpago");
            $stmt->bindParam(":idTpago", $datos,PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }
    }