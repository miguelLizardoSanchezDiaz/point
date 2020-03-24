$(document).ready(function(){
    $("#frm_nuevo").validate({
	    ignore: "input[type='text']:hidden",
	    rules: {
	        cbo_caja:{
                required:true
            },
            cbo_operacion:{
                required:true,
            },
            txt_fecha:{
	            required:true
	        },
	        txt_monto:{
	            required:true,
	        },
            cbo_formapago:{
                required:true,
            },
	    },
	    messages: {
	        cbo_caja: "Seleccione caja",
            cbo_operacion: "Seleccione tipo operación",
            txt_fecha: "Ingrese fecha",
	        txt_monto: "Ingrese monto",
            cbo_formapago: "Ingrese monto"
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

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
    //Money Euro
    $('[data-mask]').inputmask();

});

$('#txt_monto').change(function(){
    var monto=$("#txt_monto").val();
    var monto_convertido = monto*1;
    $("#txt_monto").val(monto_convertido.toFixed(2));
});

function procesar_registro(){  
    var frmNuevo=$("#frm_nuevo");
    $.ajax({
        type:"POST",
        url:ip+"/movimientos-caja",
        dataType:"JSON",
        data:frmNuevo.serialize(),
        success:function(data){
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                window.location.href=ip+"/home";
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
        url:ip+"/movimientos-caja/"+id,
        dataType:"JSON",
        data:frmNuevo.serialize(),
        success:function(data){
            console.log(data);
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                window.location.href=ip+"/"+"movimientos-caja";
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