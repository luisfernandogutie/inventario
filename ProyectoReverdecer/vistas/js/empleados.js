// Editar empleados
$(document).on("click",".btnEditarEmpleado",function(){
    var IdEmpleado = $(this).attr("IdEmpleado");
    var datos = new FormData();
    datos.append("IdEmpleado",IdEmpleado);
    $.ajax({
        url: "ajax/empleados.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            $("#EditarIdEmpleado").val(respuesta["IdEmpleado"]);
            $("#EditarNombre").val(respuesta["Nombre"]);
            $("#EditarTelefono").val(respuesta["Telefono"]);
            $("#EditarCargo_idCargo").val(respuesta["Cargo_idCargo"]);
            $("#EditarUsuario").val(respuesta["Usuario"]);
            $("#EditarContrasena").val(respuesta["Contrasena"]);
            // Almacenamiento de datos actuales para la actualización
            $("#IdEmpleadoActual").val(respuesta["IdEmpleado"]);
            $("#NombreActual").val(respuesta["Nombre"]);
            $("#TelefonoActual").val(respuesta["Telefono"]);
            $("#Cargo_idCargoActual").val(respuesta["Cargo_idCargo"]);
            $("#UsuarioActual").val(respuesta["Usuario"]);
            $("#ContrasenaActual").val(respuesta["Contrasena"]);

        }
    }); 
    
})

// Eliminar Empleado

$(document).on("click",".btnEliminarEmpleado",function(){
    swal({
        title:'¿Desea eliminar el empleado?',
        type: 'warning',
        showCancelButton:true,
        confirButtonColor:'#3085d6',
        cancelButtonColor: '#d33',
        cancelButttonText: 'Cancelar',
        confirmButtonText: 'Eliminar empleado'
    }).then((result)=>{

        var IdEmpleado=$(this).attr("IdEmpleado");
        if(result.value){
            window.location = "index.php?ruta=gestionar-empleados&IdEmpleado="+IdEmpleado;
        }

    })

})

// Verificar usuario repetido

$("#Usuario").change(function(){

    $(".alert").remove();
    var Usuario = $(this).val();

    var datos = new FormData();
    datos.append("Usuario",Usuario);
    $.ajax({
        url: "ajax/empleados.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
           if(respuesta){
               $("#Usuario").parent().after('<div class="alert alert-warning">Esta nombre de usuario ya esta en uso, por favor ingrese otro</div>');
               $("#Usuario").val("");
            }

        }
    }); 

})

// Verificar si el usuario ya esya registrado

// Verificar usuario repetido

$("#IdEmpleadoValidar").change(function(){

    $(".alert").remove();
    var IdEmpleado = $(this).val();

    var datos = new FormData();
    datos.append("IdEmpleado",IdEmpleado);
    $.ajax({
        url: "ajax/empleados.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
           if(respuesta){
               $("#IdEmpleadoValidar").parent().after('<div class="alert alert-warning">Este usuario ya está registrado</div>');
               $("#IdEmpleadoValidar").val("");
            }

        }
    }); 

})
