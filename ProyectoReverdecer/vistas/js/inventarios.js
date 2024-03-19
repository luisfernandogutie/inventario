// Agregar el precio de compra
$("#PrecioUnitario").change(function(){
    // Capturar le valor solo si el checke esta activo
    if($(".porcentaje").prop("checked")){
        var Porcentaje = $(".nuevoPorcentaje").val();
        
        // Valor recomendado de venta segun porcena¡taje ingresado

        var PrecioVenta =Number(($("#PrecioUnitario").val()*Porcentaje/100)) + Number($("#PrecioUnitario").val());
        
        // asignación del precio de venta dependiendo del porcentaje seleccionado de ganancia

        $("#PrecioVenta").val(PrecioVenta);
        // Precio venta solo será de lectura si el checbox esta seleccionado
        $("#PrecioVenta").prop("readonly",true);
    }
})

// Si cambia el porcentaje durante el registro

$(".EditarnuevoPorcentaje").change(function(){
    
    // Capturar le valor solo si el checke esta activo
    if($(".porcentaje").prop("checked")){
        var Porcentaje = $(".EditarnuevoPorcentaje").val();
        

        // Valor recomendado de venta segun porcena¡taje ingresado

        var PrecioVenta =Number(($("#PrecioUnitario").val()*Porcentaje/100)) + Number($("#PrecioUnitario").val());
        
        // asignación del precio de venta dependiendo del porcentaje seleccionado de ganancia

        $("#PrecioVenta").val(PrecioVenta);
        // Precio venta solo será de lectura si el checbox esta seleccionado
        $("#PrecioVenta").prop("readonly",true);
    }
})

// Para ingresar el precio de venta manualmente
$(".porcentaje").on("ifUnchecked",function(){
    $("#PrecioVenta").prop("readonly",false);
})
// Si vuelve a seleccionar usar procentaje:
$(".porcentaje").on("ifChecked",function(){
    $("#PrecioVenta").prop("readonly",true);
})

// MODAL DE ACTUALIZAR PRODUCTO

$("#EditarPrecioUnitario").change(function(){
    // Capturar le valor solo si el checke esta activo
    if($(".porcentaje").prop("checked")){
        var Porcentaje = $(".EditarnuevoPorcentaje").val();
        
        // Valor recomendado de venta segun porcena¡taje ingresado

        var EditarPrecioVenta =Number(($("#EditarPrecioUnitario").val()*Porcentaje/100)) + Number($("#EditarPrecioUnitario").val());
        
        // asignación del precio de venta dependiendo del porcentaje seleccionado de ganancia

        $("#EditarPrecioVenta").val(EditarPrecioVenta);
        // Precio venta solo será de lectura si el checbox esta seleccionado
        $("#EditarPrecioVenta").prop("readonly",true);
    }
})

// Si cambia el porcentaje durante el registro

$(".EditarnuevoPorcentaje").change(function(){
    
    // Capturar le valor solo si el checke esta activo
    if($(".porcentaje").prop("checked")){
        var Porcentaje = $(".EditarnuevoPorcentaje").val();
        ;

        // Valor recomendado de venta segun porcena¡taje ingresado

        var EditarPrecioVenta =Number(($("#EditarPrecioUnitario").val()*Porcentaje/100)) + Number($("#EditarPrecioUnitario").val());
        
        // asignación del precio de venta dependiendo del porcentaje seleccionado de ganancia

        $("#EditarPrecioVenta").val(EditarPrecioVenta);
        // Precio venta solo será de lectura si el checbox esta seleccionado
        $("#EditarPrecioVenta").prop("readonly",true);
    }
})

// Para ingresar el precio de venta manualmente
$(".porcentaje").on("ifUnchecked",function(){
    $("#EditarPrecioVenta").prop("readonly",false);
})
// Si vuelve a seleccionar usar procentaje:
$(".porcentaje").on("ifChecked",function(){
    $("#EditarPrecioVenta").prop("readonly",true);
})

// LLAMADO DE LOS DATOS PARA LA ACTUALIZACIÓN DE LA INFORMACIÓN

$(document).on("click",".btnEditarProducto",function(){

    var idProducto= $(this).attr("idProducto");
    var datos = new FormData();
    datos.append("idProducto",idProducto);
    $.ajax({
        url: "ajax/inventarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            $("#EditaridProducto").val(respuesta["idProducto"]);
            $("#EditarProveedor_IdProveedor").val(respuesta["Proveedor_IdProveedor"]);
            $("#EditarNombre").val(respuesta["Nombre"]);
            $("#EditarPrecioUnitario").val(respuesta["PrecioUnitario"]);
            $("#EditarPrecioVenta").val(respuesta["PrecioVenta"]);
            $("#EditarCantSistema").val(respuesta["CantSistema"]);
            $("#EditarFechaVencimiento").val(respuesta["FechaVencimiento"]);
            $("#EditarNumeroLote").val(respuesta["NumeroLote"]);
            $("#EditarCategoria_IdCatedoria").val(respuesta["Categoria_IdCatedoria"]);
            // Almacenamiento de datos actuales para la actualización
            $("#idProductoActual").val(respuesta["idProducto"]);
            $("#EditarProveedor_IdProveedorActual").val(respuesta["Proveedor_IdProveedor"]);
            $("#NombreActual").val(respuesta["Nombre"]);
            $("#PrecioUnitarioActual").val(respuesta["PrecioUnitario"]);
            $("#PrecioVentaActual").val(respuesta["PrecioVenta"]);
            $("#CantSistemaActual").val(respuesta["CantSistema"]);
            $("#FechaVencimientoActual").val(respuesta["FechaVencimiento"]);
            $("#NumeroLoteActual").val(respuesta["NumeroLote"]);
            $("#Categoria_IdCatedoriaActual").val(respuesta["Categoria_IdCatedoria"]);

        }
    });

})

//  ELIMINAR PRODUCTOS

$(document).on("click",".btnEliminarProducto",function(){
    swal({
        title:'¿Desea eliminar el producto?',
        type: 'warning',
        showCancelButton:true,
        confirButtonColor:'#3085d6',
        cancelButtonColor: '#d33',
        cancelButttonText: 'Cancelar',
        confirmButtonText: 'Eliminar producto'
    }).then((result)=>{

        var idProducto=$(this).attr("idProducto");
        if(result.value){
            window.location = "index.php?ruta=gestionar-inventarios&idProducto="+idProducto;
        }

    })

})