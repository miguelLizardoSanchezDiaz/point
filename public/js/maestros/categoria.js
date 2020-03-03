$(document).ready(function(){
	
});

$('#txt_codigo').change(function(){
	var codigo=$("#txt_codigo").val();
	valida_tercero(codigo);
});

function valida_tercero(codigo){
 	var frmNuevo=$("#frm_tercero");
    $.ajax({
        type:"POST",
        url:ip+"/tercero/valida_codigo",
        dataType:"JSON",
        data:frmNuevo.serialize()+'&codigo='+codigo,
        success:function(data){
            if(data.estado=='si'){
            	alert('El código ya existe verifique');
            	$("#btn_guardar").prop('disabled', true);
            }            
        },
        beforeSend:function(){
        },
        complete:function(){
        }
    });
}