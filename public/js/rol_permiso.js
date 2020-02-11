$(document).ready(function(){
	ver_lista_asignados();
    ver_lista_no_asignados();
        
    $('#cmd_asignar').attr("disabled","false")
    $('#cmd_quitar').attr("disabled","false")
});

function ver_lista_asignados(){
	var frmNuevo=$("#form_asignar");

	//var id_rol = document.forms.form_asignar.cbo_rol.value;
	//alert(id_rol);
	var datos = frmNuevo.serialize();//+'id_rol='+id_rol;
	var url = ip+'/permiso/ver_permiso_asignado';
	$.post(url, datos, function (resultado) {
		$("#div_permisos_asignados").html(resultado);
	});

}

function ver_lista_no_asignados(){
	var frmNuevo=$("#form_asignar");
	//var id_rol = document.forms.form_asignar.cbo_rol.value;
	//alert(id_rol);
	var datos = frmNuevo.serialize();//'id_rol='+id_rol;
	var url = ip+'/permiso/ver_permiso_no_asignado';
	$.post(url, datos, function (resultado) {
  		$("#div_permisos_no_asignados").html(resultado);
	});
}

function activar_asignar(){
	$('#cmd_asignar').removeAttr('disabled')	
	$('#cmd_quitar').attr("disabled","false")	
}

function activar_quitar(){
	$('#cmd_asignar').attr("disabled","false")
	$('#cmd_quitar').removeAttr('disabled')
}
function asignar_permiso(){
	//var id_permiso = document.forms.form1.cbo_permisos.value
	//var id_rol = document.forms.form1.cbo_rol.value
	var frmNuevo=$("#form_asignar");
	var datos = frmNuevo.serialize();//'id_rol='+id_rol+'&id_permiso='+id_permiso
	var url = ip+'/permiso/asignar_permiso'
	$.post(url, datos, function (resultado){
		ver_lista_asignados();
		ver_lista_no_asignados();
	});
}

function quitar_permiso(){
	//var id_permiso = document.forms.form1.cbo_permisos.value
	//var id_rol = document.forms.form1.cbo_rol.value
	var frmNuevo=$("#form_asignar");
	var datos = frmNuevo.serialize();//'id_rol='+id_rol+'&id_permiso='+id_permiso
	var url = ip+'/permiso/quitar_permiso';
	$.post(url, datos, function (resultado){
		ver_lista_asignados();
		ver_lista_no_asignados();
	});
}