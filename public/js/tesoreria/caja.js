$(document).ready(function(){	
    $("#frm_nuevo").validate({
	    ignore: "input[type='text']:hidden",
	    rules: {
	        txt_codigo:{
	            required:true
	        },
	        cbo_punto:{
	            required:true,
	        },
	        txt_descripcion:{
	            required:true
	        },
	    },
	    messages: {
	        txt_codigo: "Ingrese código",
	        cbo_punto: "Debe seleccionar un punto de venta",
	        txt_descripcion: "Ingrese descripción"
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

    $('#btn_guardar2').click(function() {
        if($("#frm_nuevo").valid()){
            procesar_registro_editar();
        }
        else{
            mensaje_danger('Datos no válidos, verifique campos obligatorios.');
        }
    });

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    var punto_id=$('#txt_punto_id').val();
    if(punto_id!=''){
    	$('#cbo_punto').val(punto_id).trigger('change.select2');
    }

});

function procesar_registro(){  
    var frmNuevo=$("#frm_nuevo");
    $.ajax({
        type:"POST",
        url:ip+"/cajas",
        dataType:"JSON",
        data:frmNuevo.serialize(),
        success:function(data){
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                window.location.href=ip+"/"+"cajas";
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

function procesar_registro_editar(){
    var frmNuevo=$("#frm_nuevo");
    var id = $("#txt_id_registro").val();
    $.ajax({
        type:"PUT",
        url:ip+"/cajas/"+id,
        dataType:"JSON",
        data:frmNuevo.serialize(),
        success:function(data){
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                window.location.href=ip+"/"+"cajas";
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