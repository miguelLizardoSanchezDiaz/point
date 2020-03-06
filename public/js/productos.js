$(document).ready(function() {

    $("#frm_nuevo").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            txt_codigo:{
                required:true
            },
            
            txt_id_categoria:{
                required:true,
                min:1,
                number:true
            },
            txt_codigo:{
                required:true,
            },
            txt_nombre:{
                required:true,
            },
            txt_stock_min:{
                required:true,
            },
            txt_stock_max:{
                required:true,
            },
            txt_precio_antes:{
                required:true,
            },
            txt_porc_dcto:{
                required:true,
            },
        },
        messages: {
            txt_codigo: "Ingrese código",
            txt_id_categoria: "Filtre Categoría",
            txt_codigo: "Ingrese un código",
            txt_nombre: "Ingrese un código",
            txt_stock_min: "Ingrese un código",
            txt_stock_max: "Ingrese un código",
            txt_precio_antes: "Ingrese un código",
            txt_porc_dcto: "Ingrese un código",
        }

    });


    $('#btn_grabar').click(function() {
        if($("#frm_nuevo").valid()){
            procesar_registro();
        }
        else{
            mensaje_danger('Datos no válidos, verifique campos obligatorios.');
        }
    });


});



var bondObjs = {};
var bondNames = [];
//USO DEL PLUGIN BOOTSTRAP AUTOCOMPLETE
$('#txt_categoria').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'data',
        displayKey: 'name',
        source: function (query,process) {
            $.ajax({
                url:ip+'/autocomplete/filtrarCategoria',
                type:'GET',
                data:'query=' + query,
                dataType:'JSON',
                async:'false',
                success: function (data) {
                    bondObjs = {};
                    bondNames = [];

                    $.each( data, function (i,item){
                        bondNames.push({id:item.id,name:item.name,codigo:item.codigo});
                        bondObjs[ item.id ] = item.id;
                        bondObjs[ item.name ] = item.name;
                        //bondObjs[ item.codigo ] = item.codigo;
                    });
                    process(bondNames);
                }
            });
        }
    }).on('typeahead:selected', function (even,datum) {
    $("#txt_id_categoria").val(bondObjs[datum.id]);
    
});

$('#txt_umedida').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'data',
        displayKey: 'name',
        source: function (query,process) {
            $.ajax({
                url:ip+'/autocomplete/filtrarUnidadMedida',
                type:'GET',
                data:'query=' + query,
                dataType:'JSON',
                async:'false',
                success: function (data) {
                    bondObjs = {};
                    bondNames = [];

                    $.each( data, function (i,item){
                        bondNames.push({id:item.id,name:item.name,codigo:item.codigo});
                        bondObjs[ item.id ] = item.id;
                        bondObjs[ item.name ] = item.name;
                        //bondObjs[ item.codigo ] = item.codigo;
                    });
                    process(bondNames);
                }
            });
        }
    }).on('typeahead:selected', function (even,datum) {
    $("#txt_id_umedida").val(bondObjs[datum.id]);
    
});


$('#txt_marca').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'data',
        displayKey: 'name',
        source: function (query,process) {
            $.ajax({
                url:ip+'/autocomplete/filtrarMarca',
                type:'GET',
                data:'query=' + query,
                dataType:'JSON',
                async:'false',
                success: function (data) {
                    bondObjs = {};
                    bondNames = [];

                    $.each( data, function (i,item){
                        bondNames.push({id:item.id,name:item.name,codigo:item.codigo});
                        bondObjs[ item.id ] = item.id;
                        bondObjs[ item.name ] = item.name;
                        //bondObjs[ item.codigo ] = item.codigo;
                    });
                    process(bondNames);
                }
            });
        }
    }).on('typeahead:selected', function (even,datum) {
    $("#txt_id_marca").val(bondObjs[datum.id]);
});


$('#txt_modelo').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'data',
        displayKey: 'name',
        source: function (query,process) {
            $.ajax({
                url:ip+'/autocomplete/filtrarMarca',
                type:'GET',
                data:'query=' + query,
                dataType:'JSON',
                async:'false',
                success: function (data) {
                    bondObjs = {};
                    bondNames = [];

                    $.each( data, function (i,item){
                        bondNames.push({id:item.id,name:item.name,codigo:item.codigo});
                        bondObjs[ item.id ] = item.id;
                        bondObjs[ item.name ] = item.name;
                        //bondObjs[ item.codigo ] = item.codigo;
                    });
                    process(bondNames);
                }
            });
        }
    }).on('typeahead:selected', function (even,datum) {
    $("#txt_id_modelo").val(bondObjs[datum.id]);
});


function procesar_registro(){  
    var frmNuevo=$("#frm_nuevo");
    $.ajax({
        type:"POST",
        url:ip+"/producto",
        dataType:"JSON",
        data:frmNuevo.serialize()+"&tipo=insertar",
        success:function(data){
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                window.location.href=ip+"/"+"producto";
            }
            else{
                mensaje_danger(data.mensaje);
            }            
        },
        beforeSend:function(){
            abre_loading();
            //$("#btn_grabar").prop('disabled', true);
        },
        complete:function(){
            cierra_loading();
            //$("#btn_grabar").prop('disabled', true);
        }
    });
}