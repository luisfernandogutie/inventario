//  SI VIENE LA VARIABLE DE LOCALSTORAGE CPN EL METODO GET
if(localStorage.getItem("capturarRango")!=null){
    $("#daterange-btn span").html(localStorage.getItem("capturarRango"));
}else{
    $("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de Fecha');
}


// AGREGAR PRODUCTOS ALA VENTA
$(".tablaVentas tbody").on("click","button.agregarProducto", function(){
    var idProducto = $(this).attr("idProducto");
    

    // Remuevo las clases btn-primary y agregarProducto del botón
    $(this).removeClass("btn-primary agregarProducto");
    //  Agrego una nueva Clase al botón
    $(this).addClass("btn-secondary");

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
           

            var Nombre = respuesta["Nombre"];
            var Stock = respuesta["CantSistema"];;
            var Precio = respuesta["PrecioVenta"];
            // Evitar agregar producto cuando el stock este en 0
            if(Stock==0){
                swal({
                    title: Nombre+" no tiene existencia en el inventario",
                    type: "error",
                    confirmButtonText:"Cerrar"
                });
                $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

                return;

            }

            $(".nuevoProducto").append(
                '<div class="row" style="padding:5px 15px;">'+
                    '<div class="col-xs-6" style="padding-right:0px;">'+
                        '<div class="input-group">'+
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
                            '<input type="text" class="form-control nuevoNombreProducto" id="agregarProducto" name="agregarProducto" idProducto="'+idProducto+'" value="'+Nombre+'" readonly required>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-xs-3 ">'+
                        '<input class="form-control nuevaCantidadProducto" stockActualizado="'+(Number(Stock)-1)+'" type="number" min="1"  value="1" stock="'+Stock+'" name="nuevaCantidadProducto"  required>'+
                    '</div>'+
                    '<div class="col-xs-3 precioProducto"  style="padding-left: 0px;">'+
                        '<div class="input-group">'+
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                            '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+Precio+'" name="nuevoPrecioProducto" value="'+Precio+'" readonly required>'+
                        '</div>'+
                    '</div>'+
                '</div>'
            )
            // Sumar total de precios
            sumarTotalPrecios();
            agregarImpuesto();
            listarProductos();
             // Formato de Precios
            
             $(".nuevoPrecioProducto").number(true,2);
        }
    });

});

// CUANDO CARGUE LA TABLA CADA VEZ QUE SE NAVEGUE EN ELLA, LA PAGINACIÓN O BUSQUEDA
$(".tablaVentas").on("draw.dt",function(){
   
    if(localStorage.getItem("quitarProducto")!=null){
        var listaidProducto=JSON.parse(localStorage.getItem("quitarProducto"));
        for(var i = 0; i<listaidProducto.length; i++){
            $("button.recuperarBoton[idProducto='"+listaidProducto[i]["idProducto"]+"']").removeClass("btn-secondary");
            $("button.recuperarBoton[idProducto='"+listaidProducto[i]["idProducto"]+"']").addClass("btn-primary agregarProducto");
        }
    }
})


// QUITAR PRODUCTO DE LA LISTA Y RECUPERAR EL BOTON  

var idQuitarProducto = [];
localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click","button.quitarProducto", function(){

    $(this).parent().parent().parent().parent().remove();
    
    // Capturamos el id del productos pra poder poner disponiv¡ble el boton de agrgar poprducto
    var idProducto = $(this).attr("idProducto");

    // Almacenar en el localStorage el id del producto que vamos a quitar

    if(localStorage.getItem("quitarProducto") == null){
        idQuitarProducto = [];
    }else{
        
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
    }

    idQuitarProducto.push({"idProducto":idProducto});

    localStorage.setItem("quitarProducto",JSON.stringify(idQuitarProducto));

    
    $("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass("btn-secondary");

    $("button.recuperarBoton[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

    if($(".nuevoProducto").children().length == 0){
        
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoTotalVenta").attr("total",0);
        $("#nuevoImpuestoVenta").val(0);
    
    }else{
         // Sumar total de precios
     sumarTotalPrecios();
     agregarImpuesto();
     listarProductos();
    }
    
});

//  AGREGAR PRODUCTOS DESDE DISPOSITIVOS CON PANTALLA PEQUEÑA

var numProducto=0;
// $(".tablas").on("click",".bntImprimirFactura",function(){
$(".tablas").on("click",".btnAgregarProducto",function(){
    numProducto++;
    var datos= new FormData();
    datos.append("traerProductos","ok");
    $.ajax({
        
        url: "ajax/inventarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            $(".nuevoProducto").append(
                '<div class="row" style="padding:5px 15px;">'+
                    '<div class="col-xs-6" style="padding-right:0px;">'+
                        '<div class="input-group">'+
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto=""><i class="fa fa-times"></i></button></span>'+
                            '<select class="form-control nuevoNombreProducto" id="producto'+numProducto+'" idProducto="" name="nuevoNombreProducto" required>'+
                                '<option>Seleccione el producto</option>'+                
                            '</select>"'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-xs-3 cantidadProducto">'+
                        '<input class="form-control nuevaCantidadProducto" stockActualizado="" type="number" min="1"  value="1" stock="" name="nuevaCantidadProducto"  required>'+
                    '</div>'+
                    '<div class="col-xs-3 precioProducto"  style="padding-left: 0px;">'+
                        '<div class="input-group">'+
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                            '<input class="form-control nuevoPrecioProducto" precioReal type="text" name="nuevoPrecioProducto" value="" readonly required>'+
                        '</div>'+
                    '</div>'+
                '</div>'
            );
            // Agregar productos al select
            respuesta.forEach(funcionForEach);
            function funcionForEach(item,index){

                if(item.CantSistema!=0){
                    $("#producto"+numProducto).append(
                        '<option idProducto="'+item.idProducto+'" value="'+item.idProducto+'">'+item.Nombre+'</option>'
                    );
                }
                
            }
            // Sumar total de precios
            sumarTotalPrecios();
            agregarImpuesto();
            
            // Formato de Precios
            $(".nuevoPrecioProducto").number(true,2);
        }
          
    })
})

// SELECCIONAR PRODUCTO

$(".formularioVenta").on("change","select.nuevoNombreProducto", function(){
    var idProducto = $(this).val()
    var nuevoPrecioProducto=$(this).parent().parent().parent().children(".precioProducto").children().children(".nuevoPrecioProducto");
    var nuevaCantidadProducto=$(this).parent().parent().parent().children(".cantidadProducto").children(".nuevaCantidadProducto");
    
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
           
            $(nuevaCantidadProducto).attr("stock",respuesta["CantSistema"]);
            $(nuevaCantidadProducto).attr("stockActualizado",Number(respuesta["CantSistema"])-1);
            $(nuevoPrecioProducto).val(respuesta["PrecioVenta"]);
            $(nuevoPrecioProducto).attr("precioReal",respuesta["PrecioVenta"]);

            listarProductos();
        }
    });
})

//  MODIFICAR LA CANTIDAD

$(".formularioVenta").on("change","input.nuevaCantidadProducto", function(){

    var precio = $(this).parent().parent().children(".precioProducto").children().children(".nuevoPrecioProducto"); 
    var precioFinal = $(this).val()*precio.attr("precioReal");
    precio.val(precioFinal);
    
    var nuevoStock= Number($(this).attr("stock")) - Number($(this).val());

    $(this).attr("stockActualizado", nuevoStock);

    
    // Si la cantidad de compra es superior a la exsitencia en el stock
    if(Number($(this).val()) > Number($(this).attr("stock"))){
        swal({
            title:"no tiene suficiente existencia en el inventario",
            text: " Solo hay "+ $(this).attr("stock")+ " Unidades",
            type: "warning",
            confirmButtonText:"Cerrar"
        });
        $(this).val(1);
        var precioFinal =$(this).val()*precio.attr("precioReal");
        precio.val(precioFinal);
        sumarTotalPrecios();
        agregarImpuesto();
        listarProductos();

        return;
    }
    // Sumar total de precios
    sumarTotalPrecios();
    agregarImpuesto();
    listarProductos();


})

// SUMAR TODOS LOS PRECIOS

function sumarTotalPrecios(){
    var precioItem= $(".nuevoPrecioProducto");
    var arraySumaPrecio=[];
    for(var i = 0; i < precioItem.length; i++){
        arraySumaPrecio.push(Number($(precioItem[i]).val()));
           
    }
    function sumarArrayPrecios(total,numero){
        return Number(total) + Number(numero); 
    }
    var sumaTotalPrecio=arraySumaPrecio.reduce(sumarArrayPrecios);

    $("#nuevoTotalVenta").val(sumaTotalPrecio);
    $("#totalVenta").val(sumaTotalPrecio);
    $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);
}

// AGREGAR IMPUESTO A LA VENTA

function agregarImpuesto(){
    var impuesto =$("#nuevoImpuestoVenta").val();

    var precioTotal = $("#nuevoTotalVenta").attr("total");

    var precioImpuesto = Number(precioTotal* impuesto/100);

    var totalConImpuesto = Number(precioImpuesto)+ Number(precioTotal);

    $("#nuevoTotalVenta").val(totalConImpuesto);
    $("#totalVenta").val(totalConImpuesto);
    $("#nuevoPrecioImpuesto").val(precioImpuesto);
    $("#nuevoPrecioNeto").val(precioTotal);
    

}

$("#nuevoImpuestoVenta").change(function(){
    agregarImpuesto();
})
// Agregar formato de number a total a pagar
$("#nuevoTotalVenta").number(true, 2);

//  SELECCIONAR EL METODO DE PAGO

$("#metodoPago").change(function(){
    var metodo = $(this).val();
    if(metodo == 1){

        $(this).parent().parent().removeClass("col-xs-6");
        $(this).parent().parent().addClass("col-xs-4");

        $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            
            '<div class="col-xs-4">'+
           
                '<div class="input-group">'+
                    
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                    '<input type="text" class="form-control nuevoValorEfectivo" name="nuevoValorEfectivo" required>'+
                '</div>'+
            '</div>'+
            
            '<div class="col-xs-4 cambioEfectivo">'+
            
                '<div class="input-group">'+
                    
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                    '<input type="text" class="form-control nuevoCambioEfectivo" name="nuevoCamnbioEfectivo" readonly required>'+
                '</div>'+
            '</div>'
        )

        $(".nuevoValorEfectivo").number(true, 2);
        $(".nuevoCambioEfectivo").number(true, 2);
    }else{

        // $(this).parent().parent().removeClass("col-xs-4");
        // $(this).parent().parent().addClass("col-xs-6");
        // $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            
        //     '<div class="col-xs-6" style="padding-left: 0px;">'+
	    //         '<div class="input-group">'+
        //             '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+   
        // 	        '<input class="form-control" type="text" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" required>'+
        //         '</div>'+
        //     '</div>'
        // )
        swal({
            title:"Método de pago fuera de servicio",
            text: "Actualmente solo esta disponible el método de pago en efectivo",
            type: "warning",
            confirmButtonText:"Cerrar",
            }).then((result)=>{
                        if(result.value){
                            window.location= 'crear-venta';
                        }
        });
        
        
    }
})

//  CAMBIO DE VALOR EN EFECTIVO


$(".formularioVenta").on("change","input.nuevoValorEfectivo", function(){
    var efectivo = $(this).val();
    var cambio =Number(efectivo) - Number($("#nuevoTotalVenta").val());

    if(Number(efectivo) < Number($("#nuevoTotalVenta").val())){
        swal({
                title:"Dinero insuficiente",
                text: "Por favor verifique el valor del dinero que está recibiendo para la compra",
                type: "warning",
                confirmButtonText:"Cerrar"
            });
    }else{
        $(".nuevoCambioEfectivo").val(cambio);
    }

    
})

//  AGRUPAR TODOS LOS PRODUCTOS

function listarProductos(){
    var litarProductos=[];
    
    var nombre= $(".nuevoNombreProducto");
    var cantidad=$(".nuevaCantidadProducto");
    var precio=$(".nuevoPrecioProducto");
    
    for(var i=0; i< nombre.length; i++){
        litarProductos.push({   "idProducto":$(nombre[i]).attr("idProducto"),
                                "nombre":$(nombre[i]).val(),
                                "cantidad":$(cantidad[i]).val(),
                                "stock":$(cantidad[i]).attr("stockActualizado"),
                                "precio":$(precio[i]).attr("precioReal"),
                                "total":$(precio[i]).val()
        });
    }

    console.log("Productos",JSON.stringify(litarProductos));
    $("#listarProductos").val(JSON.stringify(litarProductos));

}

// ELIMINAR VENTA

$(".tablas").on("click",".btnEliminarVenta",function(){
    var codigoVenta = $(this).attr("codigoVenta");
    swal({
        title:'¿Desea eliminar la venta?',
        type: 'warning',
        showCancelButton:true,
        confirButtonColor:'#3085d6',
        cancelButtonColor: '#d33',
        cancelButttonText: 'Cancelar',
        confirmButtonText: 'Eliminar venta'
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=registrar-ventas&codigoVenta="+codigoVenta;
        }

    })

})

//  IMPRIMIR FACTURA
$(".tablas").on("click",".bntImprimirFactura",function(){
    var codigoVenta= $(this).attr("codigoVenta");
    window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta,"_blank");
})

// Formato de datarange 
$('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment(),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      var fechaIncial = start.format('YYYY-MM-DD');
      var fechaFinal = end.format('YYYY-MM-DD');
      var capturarRango=$("#daterange-btn span").html();
      localStorage.setItem("capturarRango",capturarRango);
      window.location= "index.php?ruta=registrar-ventas&fechaInicial="+fechaIncial+"&fechaFinal="+fechaFinal;
    }
)

// Cancelar busquedas por rango de fechas y recargar la página

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click",function(){
    localStorage.removeItem("capturarRango");
    localStorage.clear();
    window.location="registrar-ventas";
})
// capturar HOy
$(".daterangepicker.opensleft .ranges li").on("click",function(){
    var textoHoy = $(this).attr("data-range-key");
	if(textoHoy == "Hoy"){
		var d = new Date();
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var anio = d.getFullYear();
        if(mes < 10){
            var fechaInicial=anio+"-0"+mes+"-"+dia;
            var fechaFinal=anio+"-0"+mes+"-"+dia;
        }else if(dia <10){
            var fechaInicial=anio+"-"+mes+"-0"+dia;
            var fechaFinal=anio+"-"+mes+"-0"+dia;
        }else if(dia <10 && mes <10){
            var fechaInicial=anio+"-0"+mes+"-0"+dia;
            var fechaFinal=anio+"-0"+mes+"-0"+dia;
        }else{
            var fechaInicial = anio+'-'+mes+'-'+dia;
            var fechaFinal = anio+'-'+mes+'-'+dia;
        }
        
    	localStorage.setItem("capturarRango", "Hoy");
    	window.location = "index.php?ruta=registrar-ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}
})