/* Start Kelola Menu Script */
    function changeApplication() /* ini untuk mentriggers perubahan di parent menu*/
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
    
    function changeParent() /*ini untuk mentriggers urutan menu*/
    {
        var parent_menu_id      = $('#parent_menu').val();
        var aplikasi_id         = $('#aplikasi_id').val();
        $.ajax({
            url: 'kelola-menu/change-parent/' + parent_menu_id+'/'+aplikasi_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {  
                if(data.length==0)
                {
                    $('#urutan').val('0');
                }
                else
                {
                    var j = data.length*1-1;
                    $('#urutan').val((data[j].menu_position*1)+1);
                }
            }
        });
    }

    function editMenu(menu_id) /* untuk edit menu */
    {
        $.ajax({
            url: 'kelola-menu/edit-menu/' + menu_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                $('#simpan').hide()
                $('#update').show()
                $('#batal').show()
                $('#id').val(data.enkripsi_id)
                $('#aplikasi_id').focus()
                $('#aplikasi_id').val(data.aplikasi_id).trigger('change')
                $('#icons').val(data.icon).trigger('change')
                $('#status').val(data.status).trigger('change')
                $('#menu').val(data.menu)
                $('#route_name').val(data.route_name)
                setTimeout(function() {
                    $('#parent_menu').val(data.parent_id).trigger('change')
                }, 500);
            }
        });
    }
    
/* End Kelola Menu Script */
/* start menu permissions*/
    function changePermission(method_access,menu_permission_id) 
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'kelola-hak-akses-menu/ubah-akses',
            method: 'POST',
            dataType: 'JSON',
            data: {
                'method_access'         : method_access,
                'menu_permission_id'    : menu_permission_id,
                'menu_permission'       : $('#permission_'+method_access+"_"+menu_permission_id).val()
            },
            success: function (data) {
                if (data.success) 
                {
                    swal({
                        title: 'Proses Berhasil',
                        text: data.message,
                        type: 'success'
                    })
                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                       
                }
            }
        });
    }
    function changeApplicationMenuPermission()
    {
        var menu_permission_application     = $('#menu_permission_application').val();
        var menu_permission_user            = $('#menu_permission_user').val();
        if (menu_permission_application !== '' && menu_permission_user !== '' && !(!menu_permission_application) && !(!menu_permission_user)) 
        {
            $.ajax({
                url: 'tambah-akses/ambil-menu/' + menu_permission_application +'/'+menu_permission_user,
                method: 'GET',
                dataType:'JSON',
                success: function(menus)
                {
                    var isi = '', $add_menu_permission_table = $('#add-menu-permission-table-body');
                    for (index = 0; index < menus.length; index++) 
                    {
                        isi     +='<tr>';
                        isi     +='<td>'+menus[index].menu_name+'</td>';
                        isi     +='<td>';
                        if (menus[index].menu_permission == 'all') 
                        {
                            isi     +='<select class="form-control" name="akses_'+menus[index].enkripsi_id+'[view]" id="akses_view_'+menus[index].enkripsi_id+'">';
                        } 
                        else 
                        {
                            isi     +='<select class="form-control" name="akses_'+menus[index].enkripsi_id+'[view]" id="akses_view_'+menus[index].enkripsi_id+'">';
                        }
                        if(menus[index].menu_permission.view == '1')
                        {
                            isi += '<option value="1" selected>Allowed</option>';
                            isi += '<option value="0">Denied</option>';
                        }
                        else if(menus[index].menu_permission.view == '0')
                        {
                            isi += '<option value="1">Allowed</option>';
                            isi += '<option value="0" selected>Denied</option>';
                        }
                        else
                        {
                            isi += '<option value="2">Select Permission</option>';
                            isi += '<option value="1">Allowed</option>';
                            isi += '<option value="0">Denied</option>';
                        }
                        isi     +='</select>';
                        isi     +='</td>';
                        isi     +='<td>';
                        if (menus[index].menu_permission == 'all') 
                        {
                            isi     +='<select class="form-control" name="akses_'+menus[index].enkripsi_id+'[create]" id="akses_create_'+menus[index].enkripsi_id+'">';
                        } 
                        else 
                        {   
                            isi     +='<select class="form-control" name="akses_'+menus[index].enkripsi_id+'[create]" id="akses_create_'+menus[index].enkripsi_id+'">';
                        }
                        if(menus[index].menu_permission.create == '1')
                        {
                            isi += '<option value="1" selected>Allowed</option>';
                            isi += '<option value="0">Denied</option>';
                        }
                        else if(menus[index].menu_permission.create == '0')
                        {
                            isi += '<option value="1">Allowed</option>';
                            isi += '<option value="0" selected>Denied</option>';
                        }
                        else
                        {
                            isi += '<option value="2">Select Permission</option>';
                            isi += '<option value="1">Allowed</option>';
                            isi += '<option value="0">Denied</option>';
                        }
                        isi     +='</select>';
                        isi     +='</td>';
                        isi     +='<td>';
                        if (menus[index].menu_permission == 'all') 
                        {
                            isi     +='<select class="form-control" name="akses_'+menus[index].enkripsi_id+'[edit]" id="akses_edit_'+menus[index].enkripsi_id+'">';
                        } 
                        else 
                        {
                            isi     +='<select class="form-control" name="akses_'+menus[index].enkripsi_id+'[edit]" id="akses_edit_'+menus[index].enkripsi_id+'">';
                        }
                        if(menus[index].menu_permission.edit == '1')
                        {
                            isi += '<option value="1" selected>Allowed</option>';
                            isi += '<option value="0">Denied</option>';
                        }
                        else if(menus[index].menu_permission.edit == '0')
                        {
                            isi += '<option value="1">Allowed</option>';
                            isi += '<option value="0" selected>Denied</option>';
                        }
                        else
                        {
                            isi += '<option value="2">Select Permission</option>';
                            isi += '<option value="1">Allowed</option>';
                            isi += '<option value="0">Denied</option>';
                        }
                        isi     +='</select>';
                        isi     +='</td>';
                        isi     +='<td>';
                        if (menus[index].menu_permission == 'all') 
                        {
                            isi     +='<select class="form-control" name="akses_'+menus[index].enkripsi_id+'[delete]" id="akses_delete_'+menus[index].enkripsi_id+'">';
                        } 
                        else 
                        {
                            isi     +='<select class="form-control" name="akses_'+menus[index].enkripsi_id+'[delete]" id="akses_delete_'+menus[index].enkripsi_id+'">';
                        }
                        if(menus[index].menu_permission.delete == '1')
                        {
                            isi += '<option value="1" selected>Allowed</option>';
                            isi += '<option value="0">Denied</option>';
                        }
                        else if(menus[index].menu_permission.delete == '0')
                        {
                            isi += '<option value="1">Allowed</option>';
                            isi += '<option value="0" selected>Denied</option>';
                        }
                        else
                        {
                            isi += '<option value="2">Select Permission</option>';
                            isi += '<option value="1">Allowed</option>';
                            isi += '<option value="0">Denied</option>';
                        }
                        isi     +='</select>';
                        isi     +='</td>';
                        isi     +='</tr>';  
    
                    }
                    $add_menu_permission_table.html(isi).on('change');
                    $('#button_submit').show();
                    $('#permission_user_id').val(menu_permission_user);
                }
            });
        } 
    }
    function editMenu(menu_id) 
    {
        $.ajax({
            url: 'kelola-menu/edit-menu/' + menu_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                if (data.success) 
                {
                    $('#simpan').hide()
                    $('#update').show()
                    $('#batal').show()
                    $('#id').val(data.enkripsi_id)
                    $('#aplikasi_id').focus()
                    $('#aplikasi_id').val(data.enkripsi_application_id).trigger('change')
                    $('#icons').val(data.menu_icon).trigger('change')
                    $('#status').val(data.is_active).trigger('change')
                    $('#menu').val(data.menu_name)
                    $('#route_name').val(data.menu_route)
                    setTimeout(function() {
                        $('#parent_menu').val(data.enkripsi_parent_id).trigger('change')
                    }, 500);
                } 
                else 
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                }
            }
        });
    }
/* end menu permissions*/

/* start kelola aplikasi */
    function editApplication(application_id) 
    {
        $.ajax({
            url: 'kelola-aplikasi/edit-application/' + application_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                if (data.success) 
                {
                    $('#simpan').hide();
                    $('#update').show();
                    $('#batal').show();
                    $('#id').val(data.enkripsi_id);
                    $('#application_id').focus();
                    $('#application_id').val(data.enkripsi_id);
                    $('#application_name').val(data.application_name);
                    $('#application_description').val(data.application_description);
                    $('#application_link').val(data.application_link);
                    $('#application_status').val(data.is_active);
                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                }
            }
        });
    }
/* end kelola aplikasi */
/* start application permission*/
    function getApplicationPermission(){
        var user_id            = $('#user_id').val();
        if (user_id !== '') 
        {
            $.ajax({
                url: 'tambah-akses/ambil-aplikasi/' + user_id,
                method: 'GET',
                dataType:'JSON',
                success: function(applications)
                {
                    var isi = '', $add_application_permission_table = $('#add-application-permission-table-body');
                    for (index = 0; index < applications.length; index++) 
                    {
                        isi     +='<tr>';
                        isi     +='<td>'+applications[index].application_name+'</td>';
                        isi     +='<td>';
                        isi     +='<select class="form-control" name="akses_'+applications[index].enkripsi_id+'" id="akses_view_'+applications[index].enkripsi_id+'">';
                        if (applications[index].application_permission == 'all') 
                        {
                            isi += '<option value="2">Select Permission</option>';
                            isi += '<option value="1">Allowed</option>';
                            isi += '<option value="0">Denied</option>';
                        } 
                        else 
                        {
                            if(applications[index].application_permission.is_active == '1')
                            {
                                isi += '<option value="1" selected>Allowed</option>';
                                isi += '<option value="0">Denied</option>';
                            }
                            else if(applications[index].application_permission.is_active == '0')
                            {
                                isi += '<option value="1">Allowed</option>';
                                isi += '<option value="0" selected>Denied</option>';
                            }
                            else
                            {
                                isi += '<option value="2">Select Permission</option>';
                                isi += '<option value="1">Allowed</option>';
                                isi += '<option value="0">Denied</option>';
                            }
                        }
                        isi     +='</select>';
                        isi     +='</td>';
                        isi     +='</tr>';  

                    }
                    $add_application_permission_table.html(isi).on('change');
                    $('#button_submit').show();
                }
            });
        } 
    }

    function changeApplicationPermission(applicaton_permission_id) 
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'kelola-hak-akses-aplikasi/ubah-akses',
            method: 'POST',
            dataType: 'JSON',
            data: 
            {
                'application_permission_id'     : applicaton_permission_id,
                'application_permission'        : $('#application_permission_'+applicaton_permission_id).val()
            },
            success: function (data) {
                if (data.success) 
                {
                    swal({
                        title: 'Proses Berhasil',
                        text: data.message,
                        type: 'success'
                    })
                    
                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })   
                }
            }
        });
    }
/* end application permission */
/* start manage product */
    function editProductData(product_id) 
    {
        $.ajax({
            url: 'kelola-produk/edit-produk/' + product_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                if (data.success) 
                {
                    $('#button_simpan').hide();
                    $('#button_update').show();
                    $('#button_batal').show();
                    $('#product_id').val(data.enkripsi_id);
                    $('#product_name').focus();
                    $('#product_name').val(data.product_name);
                    $('#oracle_code').val(data.oracle_code);
                    $('#subbrand_id').val(data.enkripsi_subbrand_id);
                    $('#product_type_id').val(data.enkripsi_product_type_id);
                    $('#filling_machine_group_head_id').val(data.enkripsi_filling_machine_group_head_id);
                    $('#expired_range').val(data.expired_range);
                    $('#trial_code').val(data.trial_code);
                    $('#spek_ts_min').val(data.spek_ts_min);
                    $('#spek_ts_max').val(data.spek_ts_max);
                    $('#spek_ph_min').val(data.spek_ph_min);
                    $('#spek_ph_max').val(data.spek_ph_max);
                    $('#sla').val(data.sla);
                    $('#waktu_analisa_mikro').val(data.waktu_analisa_mikro);
                    $('#inkubasi').val(data.inkubasi);
                    $('#is_active').val(data.is_active);
                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                }
            }
        });
    }
/* end manage product */
/* start manage filling machine */
    function editFillingMachineData(product_id) 
    {
        $.ajax({
            url: 'kelola-mesin-filling/edit-mesin-filling/' + product_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                if (data.success) 
                {
                    $('#button_simpan').hide();
                    $('#button_update').show();
                    $('#button_batal').show();
                    $('#filling_machine_id').val(data.enkripsi_id);
                    $('#filling_machine_code').val(data.filling_machine_code);
                    $('#filling_machine_name').val(data.filling_machine_name);
                    $('#filling_machine_code').focus();
                    $('#is_active').val(data.is_active);
                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                }
            }
        });
    }
/* end manage filling machine */
/* start emon data master */
    function editFlowmeterCategory(flowmeter_category_id) 
    {
        $.ajax({
            url: 'kelola-kategori-flowmeter/edit-flowmeter-category/' + flowmeter_category_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                if (data.success) 
                {
                    $('#button_simpan').hide();
                    $('#button_update').show();
                    $('#button_batal').show();
                    $('#flowmeter_category_id').val(data.enkripsi_id);
                    $('#flowmeter_category').val(data.flowmeter_category);
                    $('#is_active').val(data.is_active);
                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                }
            }
        });
    }
    function editFlowmeterWorkcenter(flowmeter_category_id) 
    {
        $.ajax({
            url: 'kelola-flowmeter-workcenter/edit-flowmeter-workcenter/' + flowmeter_category_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                if (data.success) 
                {
                    $('#button_simpan').hide();
                    $('#button_update').show();
                    $('#button_batal').show();
                    $('#flowmeter_workcenter_id').val(data.enkripsi_id);
                    $('#flowmeter_workcenter').val(data.flowmeter_workcenter);
                    $('#flowmeter_category_id').val(data.enkripsi_flowmeter_category_id).trigger('change')
                    $('#is_active').val(data.is_active).trigger('change')
                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                }
            }
        });   
    }
    function editFlowmeterUnit(flowmeter_unit_id) 
    {
        
        $.ajax({
            url: 'kelola-flowmeter-unit/edit-flowmeter-unit/' + flowmeter_unit_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                if (data.success) 
                {
                    $('#button_simpan').hide();
                    $('#button_update').show();
                    $('#button_batal').show();
                    $('#flowmeter_unit_id').val(data.enkripsi_id);
                    $('#flowmeter_unit').val(data.flowmeter_unit);
                    $('#is_active').val(data.is_active).trigger('change');

                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                }
            }
        });  
    }
    function editFlowmeterLocation(flowmeter_location_id) 
    {
        
        $.ajax({
            url: 'kelola-flowmeter-location/edit-flowmeter-location/' + flowmeter_location_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                if (data.success) 
                {
                    $('#button_simpan').hide();
                    $('#button_update').show();
                    $('#button_batal').show();
                    $('#flowmeter_location_id').val(data.enkripsi_id);
                    $('#flowmeter_location').val(data.flowmeter_location);
                    $('#is_active').val(data.is_active).trigger('change');
                    $('#flowmeter_category_id').val(data.enkripsi_flowmeter_category_id).trigger('change');
                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                }
            }
        });  
    }

    function editFlowmeter(flowmeter_id) 
    {
        
        $.ajax({
            url: 'kelola-flowmeter/edit-flowmeter/' + flowmeter_id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                if (data.success) 
                {
                    $('#button_simpan').hide();
                    $('#button_update').show();
                    $('#button_batal').show();
                    $('#flowmeter_id').val(data.enkripsi_id);
                    $('#flowmeter_name').val(data.flowmeter_name);
                    $('#flowmeter_location_id').val(data.enkripsi_flowmeter_location_id).trigger('change')
                    $('#flowmeter_workcenter_id').val(data.enkripsi_flowmeter_workcenter_id).trigger('change')
                    $('#flowmeter_unit_id').val(data.enkripsi_flowmeter_unit_id).trigger('change')
                    $('#kategori_pencatatan').val(data.recording_schedule).trigger('change')
                    $('#is_active').val(data.is_active).trigger('change')
                }
                else
                {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    })
                }
            }
        });  
    }
    
    function changeLocationPermissions()
    {
        var user_id                     = $('#location_permission_user').val();
        var flowmeter_category_id       = $('#flowmeter_category_id').val();
        if (!user_id || !flowmeter_category_id || user_id == '' || flowmeter_category_id == '' )
        {
            swal({
                title: 'Proses Gagal',
                text: "Harap pilih parameter user dan kategori flowmeter terlebih dahulu",
                type: 'error'
            });
        }
        else
        {
            $.ajax({
                url: 'get-location/' + flowmeter_category_id + '/' +user_id,
                method: 'GET',
                dataType:'JSON',
                success: function(data)
                {  
                    var isi = '', $add_location_permission_table = $('#add-location-permission-table-body');
                    for ( i = 0; i < data.length; i++) 
                    {
                        isi += "<tr>";
                        isi += "<td>";
                        isi += data[i].flowmeter_category.flowmeter_category;
                        isi += "</td>";
                        
                        isi += "<td>";
                        isi += data[i].flowmeter_location;
                        isi += "</td>";
                        denied_access = "";
                        allow_access = "";
                        if(data[i].permissions == '0')
                        { 
                            denied_access = "selected";    
                        }
                        else if(data[i].permissions == '1')
                        {
                            allow_access = "selected";    
                        }
                        isi += "<td>";
                        
                        isi += "<select class='form-control' name='location_permission_"+data[i].enkripsi_id+"'>";
                        
                        isi += "<option value='-' disabled selected> Grant Access </option>";
                        isi += "<option value='0' "+denied_access+"> Denied </option>";
                        isi += "<option value='1'"+allow_access+"> Allowed </option>";
                        isi += "</select>";
                        isi += "</td>";

                        isi += "</tr>";
                    }
                    $add_location_permission_table.html(isi).on('change');
                    $('#button_submit').removeClass('hidden');
                }
            });
        }
    }
    
    function changeAccessFlowmeterLocation(flowmeter_location_id) 
    {
        flowmeter_location_permission_id    = flowmeter_location_id;
        access                              = $('#is_allow_'+flowmeter_location_permission_id).val();
        // console.log(access);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'kelola-flowmeter-location-permission/ubah-akses',
            method: 'POST',
            dataType: 'JSON',
            data: {
                'flowmeter_location_permission_id' : flowmeter_location_permission_id,
                'access' : access
            },
            success: function (data) 
            {
                if (data.success == true) 
                {
                    swal({
                        title: 'Proses Berhasil',
                        text: data.message,
                        type: 'success'
                    });
                } else {
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    });
                }
            }
        });   
    }
/*  */