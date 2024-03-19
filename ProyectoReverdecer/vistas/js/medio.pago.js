$(document).on("click",".btnEditarMedioPago",function(){
    var idTpago = $(this).attr("idTpago");
    var datos = new FormData();
    datos.append("idTpago", idTpago);
    $.ajax({
        url: "ajax/medio.pago.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData:false,
        dataType:"json",
        success:function(respuesta){
            $("#EditaridTpago").val(respuesta["idTpago"]);
            $("#Editardescripcion").val(respuesta["descripcion"]);
            // Impresión de los valores actuales de la tabla para realizar actualizaciones en un solo campo
            $("#descripcionActual").val(respuesta["descripcion"]);
        }
    });
    
    
})

// ELIMINAR MEDIO DE PAGO

$(document).on("click",".btnEliminarMedioPago",function(){
    swal({
        title:'¿Desea eliminar el medio de pago?',
        type: 'warning',
        showCancelButton:true,
        confirButtonColor:'#3085d6',
        cancelButtonColor: '#d33',
        cancelButttonText: 'Cancelar',
        confirmButtonText: 'Eliminar medio de pago'
    }).then((result)=>{

        var idTpago=$(this).attr("idTpago");
        if(result.value){
            window.location = "index.php?ruta=gestionar-medio-pago&idTpago="+idTpago;
        }

    })

})