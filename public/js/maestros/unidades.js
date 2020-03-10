$(document).ready(function(){
	$("#frm_nuevo").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            txt_codigo:{
                required:true
            },
            txt_descripcion:{
                required:true,
            }
        },
        messages: {
            txt_codigo: "Ingrese código",
            txt_descripcion: "Ingrese una descripción",
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
});

function procesar_registro(){  
    var frmNuevo=$("#frm_nuevo");
    $.ajax({
        type:"POST",
        url:ip+"/unidad-medida",
        dataType:"JSON",
        data:frmNuevo.serialize(),
        success:function(data){
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                window.location.href=ip+"/"+"unidad-medida";
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
        url:ip+"/unidad-medida/"+id,
        dataType:"JSON",
        data:frmNuevo.serialize(),
        success:function(data){
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                window.location.href=ip+"/unidad-medida";
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