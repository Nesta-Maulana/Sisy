	function inputMonitoring(flowmeter_id) 
	{
		var monitoring_value 	= $('#monitoring_'+flowmeter_id).val();
		var flowmeter_name 		= $('#flowmeter_name_'+flowmeter_id).val();
		if (!monitoring_value || monitoring_value ==  '') 
		{
			swal({
	            title	: 'Proses Gagal',
	            text	: 'Harap isi hasil monitoring flowmeter '+flowmeter_name+" terlebih dahulu",
	            type	: 'error'
	        });
	        $('#monitoring_'+flowmeter_id).focus();
		}
		else
		{
			$.ajax({
		        headers: 
		        {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        url: 'input-monitoring', 
		        method: 'POST',
		        dataType: 'JSON',
		        data:
		        {
		        	'flowmeter_id' 				: flowmeter_id,
		        	'monitoring_value' 			: monitoring_value,
		        },
		        success: function (data) 
		        {
		        	if (data.success == true) 
	        		{
	        			$('#button_save_'+flowmeter_id).addClass('hidden');
	        			$('#button_edit_'+flowmeter_id).removeClass('hidden');
	        			$('#monitoring_'+flowmeter_id).attr('readonly','true');
	        			$('#monitoring_'+flowmeter_id).removeClass('bg-danger');
	        			$('#monitoring_'+flowmeter_id).addClass('bg-success');
	        		} 
	        		else 
	        		{
						swal({
				            title	: 'Proses Gagal',
				            text	: data.message,
				            type	: 'error'
				        });
	        		}
		        }
	    	});
		}
	}
	function editMonitoringData(flowmeter_id) 
	{
		var value_lama 	= $('#monitoring_'+flowmeter_id).val();
		$('#button_save_'+flowmeter_id).addClass('hidden');
		$('#button_edit_'+flowmeter_id).addClass('hidden');
		$('#button_update_'+flowmeter_id).removeClass('hidden');
		$('#button_cancel_'+flowmeter_id).removeClass('hidden');
		$('#monitoring_'+flowmeter_id).removeAttr('readOnly');
		$('#monitoring_'+flowmeter_id).focus();
		$('#monitoring_lama_'+flowmeter_id).val(value_lama);
		$('#monitoring_'+flowmeter_id).removeClass('bg-success');
		$('#monitoring_'+flowmeter_id).addClass('bg-secondary');
	}
	function cancelEditMonitoringData(flowmeter_id) 
	{
		var value_lama 	= $('#monitoring_lama_'+flowmeter_id).val();
		$('#button_save_'+flowmeter_id).addClass('hidden');
		$('#button_edit_'+flowmeter_id).removeClass('hidden');
		$('#button_update_'+flowmeter_id).addClass('hidden');
		$('#button_cancel_'+flowmeter_id).addClass('hidden');
		$('#monitoring_'+flowmeter_id).attr('readonly',true);
		$('#monitoring_'+flowmeter_id).val(value_lama);
		$('#monitoring_'+flowmeter_id).addClass('bg-success');
		$('#monitoring_'+flowmeter_id).removeClass('bg-secondary');
	}

	function updateMonitoringData(flowmeter_id) 
	{
		var flowmeter_id 		= flowmeter_id;
		var monitoring_value 	= $('#monitoring_'+flowmeter_id).val();
	    Swal.fire({
	        title: 'Perubahan Data Monitoring Flowmeter',
	        text:  'Apakah anda yakin akan merubah data pengamatan flowmeter '+$('#flowmeter_name_'+flowmeter_id).val()+' dari '+$('#monitoring_lama_'+flowmeter_id).val()+' menjadi '+monitoring_value+'?',
	        type: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        cancelButtonText: 'Tidak, Batalkan Proses',
	        confirmButtonText: 'Ya, Ubah Data',
	    }).then((result) => {
	        if (result.value) 
	        {
				$.ajax({
			        headers: 
			        {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        },
			        url: 'update-data-monitoring', 
			        method: 'POST',
			        dataType: 'JSON',
			        data:
			        {
			        	'flowmeter_id' 				: flowmeter_id,
			        	'monitoring_value' 			: monitoring_value,
			        },
			        success: function (data) 
			        {
			        	if (data.success == true) 
		        		{
		        			$('#button_save_'+flowmeter_id).addClass('hidden');
		        			$('#button_edit_'+flowmeter_id).removeClass('hidden');
		        			$('#button_update_'+flowmeter_id).addClass('hidden');
		        			$('#button_cancel_'+flowmeter_id).addClass('hidden');
		        			$('#monitoring_'+flowmeter_id).attr('readonly','true');
		        			$('#monitoring_'+flowmeter_id).removeClass('bg-danger');
		        			$('#monitoring_'+flowmeter_id).addClass('bg-success');
		        		} 
		        		else 
		        		{
							swal({
					            title	: 'Proses Gagal',
					            text	: data.message,
					            type	: 'error'
					        });
		        		}
			        }
		    	});	
	        }
	    })

	}
	function editMonitoringHistory(monitoring_date,monitoring_id)
	{
		$('#td_'+monitoring_date+'_'+monitoring_id).attr('style','padding:0px;');
		$('#td_'+monitoring_date+'_'+monitoring_id).removeAttr('onclick');
		// <input type='hidden' class='form-control' value'"+$('#td_'+monitoring_date+'_'+monitoring_id).html()+"'>;
		monitoring_value_before 	= $('#td_'+monitoring_date+'_'+monitoring_id).html();
		if (monitoring_value_before == 'No Value') 
		{
			monitoring_value 		= "";	
		} else {
			monitoring_value 		= monitoring_value_before;
		}
		$('#td_'+monitoring_date+'_'+monitoring_id).html("<input type='number' class='form-control' onkeypress='return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47' style='width:200px' id='input_monitoring_"+monitoring_date+"_"+monitoring_id+"' onfocusout=\"updateMonitoringData('"+monitoring_date+"','"+monitoring_id+"')\" value='"+monitoring_value+"' autofocus> <input type='hidden' class='form-control' id='hidden_monitoring_"+monitoring_date+"_"+monitoring_id+"' value='"+monitoring_value_before+"'>").on('change');
		// document.getElementById('td_'+monitoring_date+monitoring_id).innerHTML 	= "<input type='text' class='form-control'>";
		$('#input_monitoring_'+monitoring_date+'_'+monitoring_id).focus();

	}
	function updateMonitoringData(monitoring_date,monitoring_id)
	{
		var hidden_monitoring 	= $('#hidden_monitoring_'+monitoring_date+'_'+monitoring_id).val();
		var input_monitoring 	= $('#input_monitoring_'+monitoring_date+'_'+monitoring_id).val();
		if ( (hidden_monitoring == 'No Value' && (!input_monitoring || input_monitoring == '')) || hidden_monitoring == input_monitoring) 
		{
			$('#td_'+monitoring_date+'_'+monitoring_id).attr('style','padding: .75rem;');
			$('#td_'+monitoring_date+'_'+monitoring_id).attr('onclick','editMonitoringHistory("'+monitoring_date+'","'+monitoring_id+'")');
			$('#td_'+monitoring_date+'_'+monitoring_id).html(hidden_monitoring).on('change');
		}
		else
		{
			
			$.ajax({
		        headers: 
		        {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        url: 'input-monitoring', 
		        method: 'POST',
		        dataType: 'JSON',
		        data:
		        {
		        	'flowmeter_id' 				: flowmeter_id,
		        	'monitoring_value' 			: monitoring_value,
		        },
		        success: function (data) 
		        {
				}
			});	
		}
	}