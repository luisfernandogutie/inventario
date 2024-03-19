<?php 
    require_once "conexion.php";
    class ModeloClientes{

        static public function MdlMostrarClientes($tabla,$item,$valor){
            
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

        //  registro de los clientes

        static public function mdlIngresarCliente($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (IdCliente,Nombre,Telefono,Direccion,Email,EstadoCliente)
                                                    VALUES (:IdCliente,:Nombre,:Telefono,:Direccion,:Email,:EstadoCliente)");
            $stmt->bindParam(":IdCliente", $datos["IdCliente"],PDO::PARAM_STR);
            $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":Telefono", $datos["Telefono"],PDO::PARAM_STR);
            $stmt->bindParam(":Direccion", $datos["Direccion"],PDO::PARAM_STR);
            $stmt->bindParam(":Email", $datos["Email"],PDO::PARAM_STR);
            $stmt->bindParam(":EstadoCliente", $datos["EstadoCliente"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;

        }

        // Actualizar clientes

        static public function mdlActualizarCliente($tabla,$datos,$actualizacion){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET IdCliente=:IdCliente, 
                                                    Nombre=:Nombre, 
                                                    Telefono=:Telefono, 
                                                    Direccion=:Direccion,
                                                    Email=:Email,
                                                    EstadoCliente=:EstadoCliente 
                                                    WHERE IdCliente=:IdClienteActual");
            $stmt->bindParam(":IdCliente", $datos["IdCliente"],PDO::PARAM_STR);
            $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":Telefono", $datos["Telefono"],PDO::PARAM_STR);
            $stmt->bindParam(":Direccion", $datos["Direccion"],PDO::PARAM_STR);
            $stmt->bindParam(":Email", $datos["Email"],PDO::PARAM_STR);
            $stmt->bindParam(":EstadoCliente", $datos["EstadoCliente"],PDO::PARAM_STR);
            $stmt->bindParam(":IdClienteActual", $actualizacion,PDO::PARAM_STR);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }

        static public function mdlEliminarCliente($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE IdCliente=:IdCliente");
            $stmt->bindParam(":IdCliente", $datos,PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }
    }