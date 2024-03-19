// Editar proveedor

$(document).on("click",".btnEditarProveedor",function(){
    var IdProveedor =$(this).attr("IdProveedor");
    var datos=new FormData();
    datos.append("IdProveedor",IdProveedor);
    $.ajax({
        url: "ajax/proveedores.ajax.php",
        method: "POST",
        data: datos,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){
            $("#EditarIdProveedor").val(respuesta["IdProveedor"]);
            $("#EditarNombre").val(respuesta["Nombre"]);
            $("#EditarTelefono").val(respuesta["Telefono"]);
            $("#EditarEmailProveedor").val(respuesta["EmailProveedor"]);
           

            $("#IdProveedorActual").val(respuesta["IdProveedor"]);
            $("#NombreProveedorActual").val(respuesta["Nombre"]);
            $("#TelefonoActual").val(respuesta["Telefono"]);
            $("#EmailProveedorActual").val(respuesta["EmailProveedor"]);
            

        }

    })


})

// Eliminar Empleado

$(document).on("click",".btnEliminarProveedor",function(){
    swal({
        title:'¿Desea eliminar el proveedor?',
        type: 'warning',
        showCancelButton:true,
        confirButtonColor:'#3085d6',
        cancelButtonColor: '#d33',
        cancelButttonText: 'Cancelar',
        confirmButtonText: 'Eliminar proveedor'
    }).then((result)=>{

        var IdProveedor=$(this).attr("IdProveedor");
        if(result.value){
            window.location = "index.php?ruta=gestionar-proveedores&IdProveedor="+IdProveedor;
        }

    })

})



$("#IdProveedorValidar").change(function(){

    $(".alert").remove();
    var IdProveedorValidar = $(this).val();

    var datos = new FormData();
    datos.append("IdProveedorValidar",IdProveedorValidar);
    $.ajax({
        url: "ajax/proveedores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
           if(respuesta){
               $("#IdProveedorValidar").parent().after('<div class="alert alert-warning">Este proveedor ya está registrado</div>');
               $("#IdProveedorValidar").val("");
            }

        }
    }); 

})

