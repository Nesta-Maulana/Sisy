function changeApplication() 
{
    var parent = $('#aplikasi_id').val();
    $.ajax({
        url: 'kelola-menu/change-application/' + parent,
        method: 'GET',
        dataType:'JSON',
        success: function(data){
            
            var optionparent = '<option disabled selected>-- Choose Parent Menu --</option>', $comboparent = $('#parent_menu');
            optionparent+= '<option value="SHYvdVduMDhVTjRCSFR4Z0l1RVNlUT09"> -- JADIKAN PARENT -- </option>';
            for (index = 0; index < data.length; index++) 
            {   
                optionparent+='<option  value="'+data[index].idnya+'" data-icon="' + data[index].menu_icon + '">'+data[index].menu_name+'</option>';
            }
            $comboparent.html(optionparent).on('change');
        }
    });
    
}