$(document).ready(function(){	
    $("#frm_nuevo").validate({
	    ignore: "input[type='text']:hidden",
	    rules: {
	        txt_codigo:{
	            required:true
	        },
	        cbo_tipo:{
	            required:true,
	        },
	        txt_direccion:{
	            required:true
	        },
	        /*txt_razonsocial:{
	            required:true
	        },
	        txt_nombreComercial:{
	            required:true
	        }*/
	    },
	    messages: {
	        txt_codigo: "Ingrese código",
	        cbo_tipo: "Debe seleccionar un tipo de documento",
	        txt_direccion: "Debe ingresar dirección",
	        //txt_nombreComercial:"Debe ingresar nombre comercial",
	        //txt_direccion:"Debe ingresar dirección"
	    }

	});
    
    /*	$("#frm_nuevo").validate({
	        ignore: "input[type='text']:hidden",
	        rules: {
	            txt_codigo:{
	                required:true
	            },
	            cbo_tipo:{
	                required:true,
	            },
	            txt_direccion:{
	                required:true
	            },
	            txt_nombre:{
	                required:true
	            },
	            txt_apellidopaterno:{
	                required:true
	            },
	            txt_apellidomaterno:{
	                required:true
	            },
	            txt_nacimiento:{
	                required:true
	            }
	        },
	        messages: {
	            txt_codigo: "Ingrese código",
	            cbo_tipo: "Debe seleccionar un tipo de documento",
	            txt_nombre: "Debe ingresar nombre",
	            txt_apellidopaterno: "Debe ingresar apellido paterno",
	            txt_apellidomaterno: "Debe ingresar apellido materno",
	            txt_nacimiento: "Debe ingresar fecha nacimiento",
	            txt_direccion:"Debe ingresar dirección"
	        }

	    });*/
    

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

    $('#persona').hide();

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
    //Money Euro
    $('[data-mask]').inputmask();

    validar_persona_empresa();
    var ubigeo_id=$('#txt_ubigeo_id').val();
    if(ubigeo_id!=''){
    	$('#cbo_ubigeo').val(ubigeo_id).trigger('change.select2');
    }
});

$('#txt_codigo').change(function(){
	var codigo=$("#txt_codigo").val();
	valida_tercero(codigo);
});

function valida_tercero(codigo){
 	var frmNuevo=$("#frm_nuevo");
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
            else{
            	$("#btn_guardar").prop('disabled', false);
            	var tipo_doc=$("#cbo_documento").val();
            	if (tipo_doc==1){
            		consulta_numero_ruc(codigo);
            	}
            	else if (tipo_doc=2){
            		consulta_numero_dni(codigo);
            	}
            }
            
        },
        beforeSend:function(){
        },
        complete:function(){
        }
    });
}

function consulta_numero_ruc(ruc){
	var frmNuevo=$("#frm_nuevo");
	$.ajax({
		type:"POST",
		url:ip +'/tercero/consultar_ruc_contribuyente',
		dataType:"json",
		data:frmNuevo.serialize()+'&nro_ruc='+ruc,//+'&id='+id,
		success:function(data){
			if(data.length==0)
			{
				alert('RUC no encontrado!!');
			}
			else
			{
				if (data[0].emp_tipo_via!='-') {
					if (data[0].emp_numero!='-') {
						if (data[0].emp_manzana=='-') {
							if (data[0].emp_interior!='-') {
								if (data[0].emp_departamento!='-') {
									if (data[0].emp_codigo_zona!='-') {
										var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' NRO '+data[0].emp_numero+' INT '+data[0].emp_interior+' DPTO '+data[0].emp_departamento+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
									}
									else{
										var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' NRO '+data[0].emp_numero+' INT '+data[0].emp_interior+' DPTO '+data[0].emp_departamento;
									}
								}
								else{
									if (data[0].emp_codigo_zona!='-') {
										var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' NRO '+data[0].emp_numero+' INT '+data[0].emp_interior+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
									}
									else{
										var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' NRO '+data[0].emp_numero+' INT '+data[0].emp_interior;
									}
								}
							}
							else{
								if (data[0].emp_departamento!='-') {
									if (data[0].emp_codigo_zona!='-') {
										var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' NRO '+data[0].emp_numero+' DPTO '+data[0].emp_departamento+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
									}
									else{
										var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' NRO '+data[0].emp_numero+' DPTO '+data[0].emp_departamento;
									}
								}
								else{
									if (data[0].emp_codigo_zona!='-') {
										var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' NRO '+data[0].emp_numero+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
									}
									else{
										var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' NRO '+data[0].emp_numero;
									}
								}
							}
						}
					}
					else{
						if (data[0].emp_departamento!='-') {
							var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' MZ '+data[0].emp_manzana+' DPTO '+data[0].emp_departamento+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;;
						}
						else if(data[0].emp_kilometro!='-'){
							if (data[0].emp_codigo_zona!='-') {
								var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' KM '+data[0].emp_kilometro+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
							}
							else{
								var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' KM '+data[0].emp_kilometro+' '+data[0].emp_tipo_zona;
							}
						}
						else{
							if (data[0].emp_codigo_zona!='-') {
								var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' MZ '+data[0].emp_manzana+' LOTE '+data[0].emp_lote+' INT '+data[0].emp_interior+' '+data[0].emp_tipo_zona;
							}
							else{
								var domicilio=data[0].emp_tipo_via+' '+data[0].emp_nombre_via+' MZ '+data[0].emp_manzana+' LOTE '+data[0].emp_lote+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
							}
						}
					}	
				}
				else{
					if (data[0].emp_numero=='-') {
						if (data[0].emp_manzana!='-') {
							if (data[0].emp_interior!='-') {
								if (data[0].emp_departamento!='-') {
									var domicilio=' MZ '+data[0].emp_manzana+' LOTE '+data[0].emp_lote+' INT '+data[0].emp_interior+' DPTO '+data[0].emp_departamento+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
								}
								else{
									var domicilio=' MZ '+data[0].emp_manzana+' LOTE '+data[0].emp_lote+' INT '+data[0].emp_interior+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
								}
							}
							else{
								if (data[0].emp_departamento!='-') {
									var domicilio=' MZ '+data[0].emp_manzana+' LOTE '+data[0].emp_lote+' DPTO '+data[0].emp_departamento+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
								}
								else{
									var domicilio=' MZ '+data[0].emp_manzana+' LOTE '+data[0].emp_lote+' '+data[0].emp_codigo_zona+' '+data[0].emp_tipo_zona;
								}
							}
						}
					}
				}
				
				$("#txt_razonsocial").val(data[0].emp_descripcion);
				$("#txt_direccion").val(domicilio);
				
			}
		},
		beforeSend:function(){
			$("#img_loading_ruc").show();
		},
		complete:function(){
            $("#img_loading_ruc").hide();
		}
	});
}

function consulta_numero_dni(dni){
	var frmNuevo=$("#frm_nuevo");
	$.ajax({
		type:"POST",
		url:ip +'/tercero/consultar_dni',
		dataType:"json",
		data:frmNuevo.serialize()+'&nro_dni='+dni,//+'&id='+id,
		success:function(data){
			console.log(data);
			if(data.length==0)
			{
				alert('DNI no encontrado!!');
			}
			else
			{
				$("#txt_nombre").val(data.nombres);
				$("#txt_apellidopaterno").val(data.apellidoPaterno);
				$("#txt_apellidomaterno").val(data.apellidoMaterno);
			}
		},
		beforeSend:function(){
			$("#img_loading_ruc").show();
		},
		complete:function(){
            $("#img_loading_ruc").hide();
		}
	});
}

function validar_persona_empresa(){
	var valor=$('#cbo_documento').val();
	if (valor==2){
		$('#persona').show();
		$('#empresa').hide();
	}
	else{
		$('#persona').hide();
		$('#empresa').show();
	}
}

function procesar_registro(){  
    var frmNuevo=$("#frm_nuevo");
    $.ajax({
        type:"POST",
        url:ip+"/tercero",
        dataType:"JSON",
        data:frmNuevo.serialize(),
        success:function(data){
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                window.location.href=ip+"/"+"tercero";
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
        url:ip+"/tercero/"+id,
        dataType:"JSON",
        data:frmNuevo.serialize(),
        success:function(data){
            if(data.estado=="ok"){
                mensaje_success(data.mensaje);
                window.location.href=ip+"/"+"tercero";
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