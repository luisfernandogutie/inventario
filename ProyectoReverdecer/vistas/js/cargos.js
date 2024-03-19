/** Editar Cargo */
$(".btnEditarCargo").click(function(){
    var idCargo = $(this).attr("idCargo");
    var datos = new FormData();
    datos.append("idCargo", idCargo);
    $.ajax({
        url: "ajax/cargos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData:false,
        dataType:"json",
        success:function(respuesta){
            $("#EditarIdCargo").val(respuesta["idCargo"]);
            $("#EditarNombreCargo").val(respuesta["Nombre"]);
            // Impresión de los valores actuales de la tabla para realizar actualizaciones en un solo campo
            $("#IdCargoActual").val(respuesta["idCargo"]);
            $("#NombreCargoActual").val(respuesta["Nombre"]);
        }
    });
    
    
})
// Eliminar Cargo
$(".btnEliminarCargo").click(function(){
    swal({
        title:'¿Desea eliminar el Cargo?',
        type: 'warning',
        showCancelButton:true,
        confirButtonColor:'#3085d6',
        cancelButtonColor: '#d33',
        cancelButttonText: 'Cancelar',
        confirmButtonText: 'Eliminar cargo'
    }).then((result)=>{

        var idCargo=$(this).attr("idCargo");
        if(result.value){
            window.location = "index.php?ruta=cargos&idCargo="+idCargo;
        }

    })
})
