<?php 
    require_once "conexion.php";

    class ModeloVentas{
        // MOSTRAR VENTAS
        static public function MdlMostrarVentas($tabla,$item,$valor){
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

        static public function mdlRegistrarVenta($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigoVenta,IdCliente,IdEmpleado,Productos,Impuesto,Neto,Total,MetodoPago)
            VALUES (:codigoVenta,:IdCliente,:IdEmpleado,:Productos,:Impuesto,:Neto,:Total,:MetodoPago)");
            
            $stmt->bindParam(":codigoVenta", $datos["codigoVenta"],PDO::PARAM_STR);
            $stmt->bindParam(":IdCliente", $datos["IdCliente"],PDO::PARAM_STR);
            $stmt->bindParam(":IdEmpleado", $datos["IdEmpleado"],PDO::PARAM_STR);
            $stmt->bindParam(":Productos", $datos["Productos"],PDO::PARAM_STR);
            $stmt->bindParam(":Impuesto", $datos["Impuesto"],PDO::PARAM_STR);
            $stmt->bindParam(":Neto", $datos["Neto"],PDO::PARAM_STR);
            $stmt->bindParam(":Total", $datos["Total"],PDO::PARAM_STR);
            $stmt->bindParam(":MetodoPago", $datos["MetodoPago"],PDO::PARAM_STR);
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }

        static public function mdlEliminarVenta($tabla,$datos){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigoVenta=:codigoVenta");
            $stmt->bindParam(":codigoVenta", $datos,PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
        }

        static public function MdlMostrarRangoFechasVentas($tabla,$fechaInicial,$fechaFinal){
            if($fechaInicial == null){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                $stmt->execute();
                return $stmt->fetchAll();
                
            }else if($fechaInicial==$fechaFinal){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE FechaCompra LIKE '%$fechaFinal%'");
                // $stmt->bindParam(":FechaCompra",$fechaFinal,PDO::PARAM_STR);
                // $stmt->bindParam(":FechaCompra",$fechaInicial,PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
            }else{
                $fechaActual = new DateTime();
			    $fechaActual ->add(new DateInterval("P1D"));
			    $fechaActualMasUno = $fechaActual->format("Y-m-d");
                
			    $fechaFinal2 = new DateTime($fechaFinal);
			    $fechaFinal2 ->add(new DateInterval("P1D"));
			    $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
			    if($fechaFinalMasUno == $fechaActualMasUno){
				    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE FechaCompra BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
			    }else{
				    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE FechaCompra BETWEEN '$fechaInicial' AND '$fechaFinal'");
			    }
			    $stmt -> execute();
			    return $stmt -> fetchAll();
            }
        }

        static public function mdlSumaTotalVentas($tabla){
            $stmt = Conexion::conectar()->prepare("SELECT SUM(Neto) as total FROM $tabla");
		    $stmt -> execute();
		    return $stmt -> fetch();
		    $stmt = null;
        }
    }