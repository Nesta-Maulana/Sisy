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
		$('#td_'+monitoring_date+'_'+monitoring_id).html("<input type='number' class='form-control' onkeypress='return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47' style='width:200px' id='input_monitoring_"+monitoring_date+"_"+monitoring_id+"' onfocusout=\"updateMonitoringHistoryData('"+monitoring_date+"','"+monitoring_id+"')\" value='"+monitoring_value+"' autofocus> <input type='hidden' class='form-control' id='hidden_monitoring_"+monitoring_date+"_"+monitoring_id+"' value='"+monitoring_value_before+"'>").on('change');
		// document.getElementById('td_'+monitoring_date+monitoring_id).innerHTML 	= "<input type='text' class='form-control'>";
		$('#input_monitoring_'+monitoring_date+'_'+monitoring_id).focus();

	}
	function updateMonitoringHistoryData(monitoring_date,monitoring_id)
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
		        url: 'history-pengamatan/input-monitoring', 
		        method: 'POST',
		        dataType: 'JSON',
		        data:
		        {
		        	'flowmeter_id' 				: monitoring_id,
		        	'monitoring_value' 			: input_monitoring,
		        	'monitoring_date' 			: monitoring_date,
		        },
		        success: function (data) 
		        {
					if (data.success) 
					{
						swal({
				            title	: 'Proses Berhasil',
				            text	: data.message,
				            type	: 'success'
						});
						$('#td_'+monitoring_date+'_'+monitoring_id).attr('style','padding: .75rem;');
						$('#td_'+monitoring_date+'_'+monitoring_id).attr('onclick','editMonitoringHistory("'+monitoring_date+'","'+monitoring_id+'")');
						$('#td_'+monitoring_date+'_'+monitoring_id).html(input_monitoring).on('change');
					} else {
						swal({
				            title	: 'Proses Gagal',
				            text	: data.message,
				            type	: 'error'
						});
						$('#td_'+monitoring_date+'_'+monitoring_id).attr('style','padding: .75rem;');
						$('#td_'+monitoring_date+'_'+monitoring_id).attr('onclick','editMonitoringHistory("'+monitoring_date+'","'+monitoring_id+'")');
						$('#td_'+monitoring_date+'_'+monitoring_id).html(hidden_monitoring).on('change');
					}
				}
			});	
		}
	}

	function refreshTableMonitoringHistory() 
	{
		var month 		= $('#monitoring_month_filter').val();
		var category 	= $('#flowmeter_monitoring_category').val();
		var workcenter 	= $('#flowmeter_workcenter_filter').val();
		if(!month) month 				= 'null';
		if(!category) category 			= 'null';
		if(!workcenter) workcenter 		= 'null';
		$.ajax({
            url     : 'history-pengamatan/refresh-flowmeter-table/'+month+'/'+category+'/'+workcenter,
            method  : 'GET',
            dataType: 'JSON',
            success : function(data) 
            {
				if (data.success == true)
				{
					$('#colpan_tanggal').removeAttr('colspan');
					$('#colpan_tanggal').attr('colspan',data.tabel[0].monitoringHistories.length);
					isiheadtable = '',$headtable = $('#monitoring_history_head');
					isiheadtable += "<th class='hidden' style='border: 0px'>";	
					isiheadtable += "</th>";
					for (let c = 0; c < data.tabel[0].monitoringHistories.length; c++) 
					{
						isiheadtable += "<th>"+ data.tabel[0].monitoringHistories[c].monitoring_date +"</th>";	
					}
					$headtable.html(isiheadtable).on('change');

					var isitable = '', $table = $('#monitoring_history_table_body');
					for (var a = 0; a < data.tabel.length; a++) 
					{
						isitable += "<tr>";	
						isitable += "<td style='background-color: black;color:white'>";	
						isitable += data.tabel[a].flowmeter_name;	
						isitable += "</td>";	
						isitable += "<td>";	
						isitable += data.tabel[a].flowmeter_workcenter.flowmeter_workcenter;	
						isitable += "</td>";	
						for (let b = 0; b < data.tabel[a].monitoringHistories.length; b++) 
						{
							isitable += "<td id='td_"+data.tabel[a].monitoringHistories[b].enkripsi_monitoring_date+'_'+data.tabel[a].enkripsi_id+"' onclick=\"editMonitoringHistory('"+data.tabel[a].monitoringHistories[b].enkripsi_monitoring_date+"','"+data.tabel[a].enkripsi_id+"')\">";	
							isitable += data.tabel[a].monitoringHistories[b].monitoring_value;	
							isitable += "</td>";	
						}
						isitable += "</tr>";	
					}
					$table.html(isitable).on('change');
					if(data.flowmeter_workcenters !== 'null')
					{
						var optionvalue_flowmeter = '', $selectbox_workcenter = $('#flowmeter_workcenter_filter');
						optionvalue_flowmeter 	+= "<option value='0' selected disabled>-- Pilih Flowmeter Workcenter --</option>";
						for(var i = 0 ; i < data.flowmeter_workcenters.length ; i++)
						{
							optionvalue_flowmeter 	+= "<option value='"+data.flowmeter_workcenters[i].id+"'";
							if (data.flowmeter_workcenters[i].id == data.flowmeter_workcenter_active) 
							{
								optionvalue_flowmeter += " selected ";	
							}
							optionvalue_flowmeter   += ">"+data.flowmeter_workcenters[i].flowmeter_workcenter+"</option>";
						}
						$selectbox_workcenter.html(optionvalue_flowmeter).on('change');
					}
				} 
				else
				{

				}
			}
		});				
		
	}