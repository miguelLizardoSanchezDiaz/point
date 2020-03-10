$(document).ready(function() {

    $("#frm_nuevo").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            txt_codigo:{
                required:true
            },
            txt_descripcion:{
                required:true
            },
            txt_id_categoria:{
                required:true,
                min:1,
                number:true
            },
            txt_id_umedida:{
                required:true,
                min:1,
                number:true
            },
            /*txt_id_marca:{
                required:true,
                min:1,
                number:true
            },
            txt_id_modelo:{
                required:true,
                min:1,
                number:true
            },*/
            
        },
        messages: {
            txt_codigo: "Ingrese código",
            txt_descripcion: "Ingrese Descripción",
            txt_id_categoria: "Filtre Categoría",
            txt_id_umedida: "Filtre Unidad de Medida",
            //txt_id_marca: "Filtre Marca",
            //txt_id_modelo: "Filtre Modelo",
            
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

    $('#btn_editar').click(function() {
        if($("#frm_nuevo").valid()){
            procesar_editar();
        }
        else{
            mensaje_danger('Datos no válidos, verifique campos obligatorios.');
        }
    });

    $("#txt_categoria").change(function(){limpia_filtro('txt_categoria','txt_id_categoria');});
    $("#txt_umedida").change(function(){limpia_filtro('txt_umedida','txt_id_umedida');});
    $("#txt_marca").change(function(){limpia_filtro('txt_marca','txt_id_marca');});
    $("#txt_modelo").change(function(){limpia_filtro('txt_modelo','txt_id_modelo');});

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
                url:ip+'/autocomplete/filtrarModelo',
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
        },
        complete:function(){
            cierra_loading();
        }
    });
}


function procesar_editar()
{
    var frmNuevo=$("#frm_nuevo");
    var id=$("#txt_id_registro").val();
    var token=$("#_token").val();

    $.ajax({
        headers:{'X-CSRF-TOKEN':token},
        type:"PUT",
        url:ip+"/producto/"+id,
        dataType:"JSON",
        data:frmNuevo.serialize()+"&tipo=editar",
        success:function(data){
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                //window.location.href=ip+"/"+"producto";
            }
            else{
                mensaje_danger(data.mensaje);
            }

        },
        beforeSend:function(){
            abre_loading();
            //$("#btn_editar").prop('disabled', true);
        },
        complete:function(){
            cierra_loading();
            //$("#btn_editar").prop('disabled', true);
        }
    });
}