$(document).on("click",".btnEditarCategoria",function(){
    var IdCategoria = $(this).attr("IdCategoria");
    var datos = new FormData();
    datos.append("IdCategoria", IdCategoria);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData:false,
        dataType:"json",
        success:function(respuesta){
            console.log(respuesta);
            $("#IdCategoria").val(respuesta["IdCategoria"]);
            $("#EditarCategoria").val(respuesta["NombreCategoria"]);
           
            
        }
    });
    
    
})

$(".btnEliminarCategoria").click(function(){
    swal({
        title:'¿Desea eliminar la categoría?',
        type: 'warning',
        showCancelButton:true,
        confirButtonColor:'#3085d6',
        cancelButtonColor: '#d33',
        cancelButttonText: 'Cancelar',
        confirmButtonText: 'Eliminar categoría'
    }).then((result)=>{

        var IdCategoria=$(this).attr("IdCategoria");
        if(result.value){
            window.location = "index.php?ruta=gestionar-categorias&IdCategoria="+IdCategoria;
        }

    })
})