<?php
    require_once "conexion.php";
    Class ModeloEmpleados{
        // mostrar usuarios

        static public function MdlMostrarEmpleados($tabla,$item,$valor){
            
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

        // metodo para registrar empleados

        static public function mdlIngresarEmpleado($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (IdEmpleado,Nombre,Telefono,Cargo_idCargo,Usuario,Contrasena)
                                                    VALUES (:IdEmpleado,:Nombre,:Telefono,:Cargo_idCargo,:Usuario,:Contrasena)");
            $stmt->bindParam(":IdEmpleado", $datos["IdEmpleado"],PDO::PARAM_STR);
            $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":Telefono", $datos["Telefono"],PDO::PARAM_STR);
            $stmt->bindParam(":Cargo_idCargo", $datos["Cargo_idCargo"],PDO::PARAM_STR);
            $stmt->bindParam(":Usuario", $datos["Usuario"],PDO::PARAM_STR);
            $stmt->bindParam(":Contrasena", $datos["Contrasena"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;

        }
        // Método de actualizar enmpleados
        static public function mdlActualizarEmpleado($tabla,$datos,$actualizacion){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET IdEmpleado=:IdEmpleado, 
                                                    Nombre=:Nombre, 
                                                    Telefono=:Telefono, 
                                                    Cargo_idCargo=:Cargo_idCargo,
                                                    Usuario=:Usuario,
                                                    Contrasena=:Contrasena
                                                    WHERE IdEmpleado=:IdEmpleadoActual");
            $stmt->bindParam(":IdEmpleado", $datos["IdEmpleado"],PDO::PARAM_STR);
            $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":Telefono", $datos["Telefono"],PDO::PARAM_STR);
            $stmt->bindParam(":Cargo_idCargo", $datos["Cargo_idCargo"],PDO::PARAM_STR);
            $stmt->bindParam(":Usuario", $datos["Usuario"],PDO::PARAM_STR);
            $stmt->bindParam(":Contrasena", $datos["Contrasena"],PDO::PARAM_STR);
            $stmt->bindParam(":IdEmpleadoActual", $actualizacion,PDO::PARAM_STR);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;

        }

        static public function mdlEliminarEmpleado($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE IdEmpleado=:IdEmpleado");
            $stmt->bindParam(":IdEmpleado", $datos,PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }

    }
