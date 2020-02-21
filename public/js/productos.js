$(document).ready(function() {

    $("#frm_nuevo").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            /*txt_nombre:{
                required:true
            },*/
            
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
            txt_id_categoria: "Filtre Categoría",
            txt_codigo: "Ingrese un código",
            txt_nombre: "Ingrese un código",
            txt_stock_min: "Ingrese un código",
            txt_stock_max: "Ingrese un código",
            txt_precio_antes: "Ingrese un código",
            txt_porc_dcto: "Ingrese un código",
        }

    });
    var proceso=$("#proceso").val();
    if(proceso=='crea'){
    	$('#rootwizard').bootstrapWizard({
            tabClass: 'nav nav-pills',
            onNext: function(tab, navigation, index) {
                //console.log(tab+' '+navigation+' '+index);
                //alert('next');
                if($("#frm_nuevo").valid()){
                    procesar_guardar();
                }
                else{
                    mensaje_danger("Datos inválidos, revisar datos obligatorios");
                    return false;
                }
            },
            onTabClick: function(tab, navigation, index) {
                //console.log(tab+' '+navigation+' '+index);
                if($("#frm_nuevo").valid()){
                    procesar_guardar();
                }
                else{
                    mensaje_danger("Datos inválidos, revisar datos obligatorios");
                    return false;
                }
            },
            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard .progress-bar').css({width:$percent+'%'});
            },

        });
    }
    if(proceso=='edita'){
        $('#rootwizard').bootstrapWizard({
            tabClass: 'nav nav-pills',
            onNext: function(tab, navigation, index) {
                //console.log(tab+' '+navigation+' '+index);
                //alert('next');
                if($("#frm_nuevo").valid()){
                    procesar_editar();
                }
                else{
                    mensaje_danger("Datos inválidos, revisar datos obligatorios");
                    return false;
                }
            },
            onTabClick: function(tab, navigation, index) {
                //console.log(tab+' '+navigation+' '+index);
                if($("#frm_nuevo").valid()){
                    procesar_editar();
                }
                else{
                    mensaje_danger("Datos inválidos, revisar datos obligatorios");
                    return false;
                }
            },
            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard .progress-bar').css({width:$percent+'%'});
            },

        });
    }
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
                        bondObjs[ item.codigo ] = item.codigo;
                    });
                    process(bondNames);
                }
            });
        }
    }).on('typeahead:selected', function (even,datum) {
    $("#txt_id_categoria").val(bondObjs[datum.id]);
    
});


function procesar_guardar(){
    var frmNuevo=$("#frm_nuevo");
    $.ajax({
        type:"POST",
        url:ip+"/productos",
        dataType:"JSON",
        data:frmNuevo.serialize()+'&tipo=insertar',
        success:function(data){
            if(data.estado=="ok"){
                //mensaje_success(data.mensaje);
                //var url = ip+"/kardex"; 
                //$(location).attr('href',url);
                $('#id_producto').val(data.parent_id);
            }
            else{
                mensaje_danger(data.mensaje);
                return false;
            }
        },
        beforeSend:function(){
            //$("#btn_grabar").prop('disabled', true);
        },
        complete:function(){
            //$("#btn_grabar").prop('disabled', false);
        }
    });
}

function procesar_editar(){
    var frmNuevo=$("#frm_nuevo");
    var id=$("#id_producto_principal").val();
    $.ajax({
        type:"PUT",
        url:ip+"/productos/"+id,
        dataType:"JSON",
        data:frmNuevo.serialize()+"&tipo=editar",
        success:function(data){
            if(data.estado=="ok"){
                //mensaje_success(data.mensaje);
                //window.location.href=ip+"/"+'productos';
                $('#id_producto').val(data.parent_id);
            }
            else{
                mensaje_danger(data.mensaje);
                return false;
            }
        },
        beforeSend:function(){
            $("#btn_grabar").prop('disabled', true);
        },
        complete:function(){
            $("#btn_grabar").prop('disabled', false);
        }
    });
}


$("#txt_codigo").change(function(){
    valida_no_repetido();
});

$("#txt_precio_antes").change(function(){
    calcula_descuento();
});

$("#txt_porc_dcto").change(function(){
    calcula_descuento();
});

function calcula_descuento(){
    var dcto=$("#txt_porc_dcto").val();
    var precio_antes=$("#txt_precio_antes").val();

    var precio_despues=precio_antes-precio_antes*dcto/100;

    $("#txt_precio_despues").val(precio_despues);
}
function valida_no_repetido(){
    var codigo=$("#txt_codigo").val();
    var frmNuevo=$("#frm_nuevo");
    $.ajax({
        type:"POST",
        url:ip+"/valida_no_repetido_codigo",
        dataType:"JSON",
        data:frmNuevo.serialize()+'&codigo='+codigo,
        success:function(data){
            if(data.estado=='existe'){
                mensaje_danger('Código ya existe, verifique!');
                $("#txt_codigo").val('');
            }
            else{
                
            }
        },
        beforeSend:function(){
            //$("#btn_grabar").prop('disabled', true);
        },
        complete:function(){
            //$("#btn_grabar").prop('disabled', false);
        }
    });

}
function elimina_foto_detalle(id_detalle_pro){
    var frmNuevo=$("#frm_nuevo");
    $.ajax({
        type:"POST",
        url:ip+"/elimina_detalle_producto",
        dataType:"JSON",
        data:frmNuevo.serialize()+'&id_detalle_pro='+id_detalle_pro,
        success:function(data){
            if(data.estado=='ok'){
                mensaje_success('Eliminado Correctamente');
                $('#foto_detalle'+data.id_detalle+'').hide(1000);
            }
            else{
                mensaje_success('Inténtelo nuevamente');
            }
        },
        beforeSend:function(){
            //$("#btn_grabar").prop('disabled', true);
        },
        complete:function(){
            //$("#btn_grabar").prop('disabled', false);
        }
    });
}