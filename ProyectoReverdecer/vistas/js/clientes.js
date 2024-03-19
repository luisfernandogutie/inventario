$(document).on("click",".btnEditarCliente",function(){
    var IdCliente = $(this).attr("IdCliente");
    var datos = new FormData();

    datos.append("IdCliente", IdCliente);
    console.log("IdCliente",IdCliente);
    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
           $("#EditarIdCliente").val(respuesta["IdCliente"]);
           $("#EditarNombre").val(respuesta["Nombre"]);
           $("#EditarTelefono").val(respuesta["Telefono"]);
           $("#EditarDireccion").val(respuesta["Direccion"]);
           $("#EditarEmail").val(respuesta["Email"]);
           $("#EditarEstadoCliente").val(respuesta["EstadoCliente"]);

           $("#IdClienteActual").val(respuesta["IdCliente"]);
           $("#NombreActual").val(respuesta["Nombre"]);
           $("#TelefonoActual").val(respuesta["Telefono"]);
           $("#DireccionActual").val(respuesta["Direccion"]);
           $("#EmailActual").val(respuesta["Email"]);
           $("#EstadoClienteActual").val(respuesta["EstadoCliente"]);   
        }
    });
})

$(document).on("click",".btnEliminarCliente",function(){
    swal({
        title:'¿Desea eliminar el cliente?',
        type: 'warning',
        showCancelButton:true,
        confirButtonColor:'#3085d6',
        cancelButtonColor: '#d33',
        cancelButttonText: 'Cancelar',
        confirmButtonText: 'Eliminar cliente'
    }).then((result)=>{

        var IdCliente=$(this).attr("IdCliente");
        if(result.value){
            window.location = "index.php?ruta=gestionar-clientes&IdCliente="+IdCliente;
        }

    })

})

$("#IdClienteValidar").change(function(){

    $(".alert").remove();
    var IdCliente = $(this).val();

    var datos = new FormData();
    datos.append("IdCliente",IdCliente);
    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
           if(respuesta){
               $("#IdClienteValidar").parent().after('<div class="alert alert-warning">Este cliente ya está registrado</div>');
               $("#IdClienteValidar").val("");
            }

        }
    }); 

})