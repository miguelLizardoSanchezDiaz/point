$(document).ready(function(){	

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    var marca_id=$('#txt_marca_id').val();
    if(marca_id!=''){
        $('#cbo_marca').val(marca_id).trigger('change.select2');
    }

});