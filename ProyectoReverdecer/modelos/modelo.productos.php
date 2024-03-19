<?php 
require_once "conexion.php";
class ModeloProductos{
    // Mostrar Producto
    static public function mdlMostrarProductos($tabla,$item,$valor,$orden){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY idProducto ASC");
            $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  ORDER BY $orden DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // Registrar producto
    static public function mdlIngresarProducto($tabla,$datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idProducto,Proveedor_IdProveedor,Nombre,
        PrecioUnitario,CantSistema,PrecioVenta,FechaVencimiento,NumeroLote,Categoria_IdCatedoria)
        VALUES (:idProducto,:Proveedor_IdProveedor,:Nombre,:PrecioUnitario,:CantSistema,
        :PrecioVenta,:FechaVencimiento,:NumeroLote,:Categoria_IdCatedoria)");
        
        // Asignación de valores a los parametros
        $stmt->bindParam(":idProducto", $datos["idProducto"],PDO::PARAM_STR);
        $stmt->bindParam(":Proveedor_IdProveedor", $datos["Proveedor_IdProveedor"],PDO::PARAM_STR);
        $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":PrecioUnitario", $datos["PrecioUnitario"],PDO::PARAM_STR);
        $stmt->bindParam(":CantSistema", $datos["CantSistema"],PDO::PARAM_STR);
        $stmt->bindParam(":PrecioVenta", $datos["PrecioVenta"],PDO::PARAM_STR);
        $stmt->bindParam(":FechaVencimiento", $datos["FechaVencimiento"],PDO::PARAM_STR);
        $stmt->bindParam(":NumeroLote", $datos["NumeroLote"],PDO::PARAM_STR);
        $stmt->bindParam(":Categoria_IdCatedoria", $datos["Categoria_IdCatedoria"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;
    }

    // Actualizar Productos 

    static public function mdlActualizarProducto($tabla,$datos,$actualizacion){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idProducto=:idProducto, 
                                                    Proveedor_IdProveedor=:Proveedor_IdProveedor,
                                                    Nombre=:Nombre, 
                                                    PrecioUnitario=:PrecioUnitario, 
                                                    CantSistema=:CantSistema,
                                                    PrecioVenta=:PrecioVenta,
                                                    FechaVencimiento=:FechaVencimiento,
                                                    NumeroLote=:NumeroLote,
                                                    Categoria_IdCatedoria=:Categoria_IdCatedoria
                                                    WHERE idProducto=:idProductoActual");

        // Asignación de valores a los parametros
        $stmt->bindParam(":idProducto", $datos["idProducto"],PDO::PARAM_STR);
        $stmt->bindParam(":Proveedor_IdProveedor", $datos["Proveedor_IdProveedor"],PDO::PARAM_STR);
        $stmt->bindParam(":Nombre", $datos["Nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":PrecioUnitario", $datos["PrecioUnitario"],PDO::PARAM_STR);
        $stmt->bindParam(":CantSistema", $datos["CantSistema"],PDO::PARAM_STR);
        $stmt->bindParam(":PrecioVenta", $datos["PrecioVenta"],PDO::PARAM_STR);
        $stmt->bindParam(":FechaVencimiento", $datos["FechaVencimiento"],PDO::PARAM_STR);
        $stmt->bindParam(":NumeroLote", $datos["NumeroLote"],PDO::PARAM_STR);
        $stmt->bindParam(":Categoria_IdCatedoria", $datos["Categoria_IdCatedoria"],PDO::PARAM_STR);
        $stmt->bindParam(":idProductoActual",$actualizacion,PDO::PARAM_STR);
            
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        return $stmt->fetch();
        $stmt=null;
    }
    // EliminarProducto
    static public function mdlEliminarProducto($tabla,$datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idProducto=:idProducto");
            $stmt->bindParam(":idProducto", $datos,PDO::PARAM_STR);
            
            
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            return $stmt->fetch();
            $stmt=null;

    }

    //  actualizar Stock del prodcuto cada que hagan una venta

    static public function mdlActualizarStockProducto($tabla,$valor1,$valor2){
        $stmt=Conexion::conectar()->prepare("UPDATE $tabla SET CantSistema =:CantSistema WHERE idProducto=:idProducto");
        $stmt-> bindParam(":CantSistema",$valor1, PDO::PARAM_STR);
        $stmt-> bindParam(":idProducto",$valor2,PDO::PARAM_STR);
        
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt=null;
    }

    static public function mdlActualizarVentasProducto($tabla,$valor1,$valor2){
        $stmt=Conexion::conectar()->prepare("UPDATE $tabla SET ventasActuales =:ventasActuales WHERE idProducto=:idProducto");
        $stmt-> bindParam(":ventasActuales",$valor1, PDO::PARAM_STR);
        $stmt-> bindParam(":idProducto",$valor2,PDO::PARAM_STR);
        
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt=null;
    }

    // sumar ventas

    static public function mdlSumarVentasPRoductos($tabla,$item){
        $stmt=Conexion::conectar()->prepare("SELECT SUM($item) as Total FROM $tabla");
        $stmt->execute();
        return $stmt->fetch();

        $stmt=null;
    }

}