<?php 
    require_once "conexion.php";
    class ModeloCargos{
        
        static public function mdlIngresarCargo($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (IdCargo,Nombre) VALUES (:IdCargo,:Nombre)");
            $stmt->bindParam(":IdCargo", $datos["IdCargo"],PDO::PARAM_STR);
            $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }  
        
        static public function MdlMostrarCargos($tabla,$item,$valor){
            
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

        static public function mdlActualizarCargo($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idCargo=:idCargo, Nombre=:Nombre WHERE idCargo=:idCargo");
            $stmt->bindParam(":idCargo", $datos["IdCargo"],PDO::PARAM_STR);
            $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }
        static public function mdlEliminarCargo($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idCargo=:idCargo");
            $stmt->bindParam(":idCargo", $datos,PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }


    }
