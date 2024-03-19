<?php 
    require_once "conexion.php";
    class ModeloProveedores{
        static public function mdlMostrarProveeodres($tabla,$item,$valor){
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
            
            $stmt = null;
        }

        static public function mdlRegistrarProveedor($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (IdProveedor,Nombre,Telefono,EmailProveedor,EstadoProveedor)
                                                    VALUES (:IdProveedor,:Nombre,:Telefono,:EmailProveedor,:EstadoProveedor)");
            $stmt->bindParam(":IdProveedor", $datos["IdProveedor"],PDO::PARAM_STR);
            $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":Telefono", $datos["Telefono"],PDO::PARAM_STR);
            $stmt->bindParam(":EmailProveedor", $datos["EmailProveedor"],PDO::PARAM_STR);
            $stmt->bindParam(":EstadoProveedor", $datos["EstadoProveedor"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }

        static public function mdlActualizarProveedor($tabla,$datos,$actualizacion){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET IdProveedor=:IdProveedor, 
                                                    Nombre=:Nombre, 
                                                    Telefono=:Telefono, 
                                                    EmailProveedor=:EmailProveedor,
                                                    EstadoProveedor=:EstadoProveedor 
                                                    WHERE IdProveedor=:IdProveedorActual");
            $stmt->bindParam(":IdProveedor", $datos["IdProveedor"],PDO::PARAM_STR);
            $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":Telefono", $datos["Telefono"],PDO::PARAM_STR);
            $stmt->bindParam(":EmailProveedor", $datos["EmailProveedor"],PDO::PARAM_STR);
            $stmt->bindParam(":EstadoProveedor", $datos["EstadoProveedor"],PDO::PARAM_STR);
            $stmt->bindParam(":IdProveedorActual", $actualizacion,PDO::PARAM_STR);

            if($stmt->execute()){
            return "ok";
            }else{
            return "error";
            }

            return $stmt->fetch();
            $stmt=null;

        }

        static public function mdlEliminarProveedor($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE IdProveedor=:IdProveedor");
            $stmt->bindParam(":IdProveedor", $datos,PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;

        }



    }