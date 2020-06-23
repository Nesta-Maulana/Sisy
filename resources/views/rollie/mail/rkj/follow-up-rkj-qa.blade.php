<!DOCTYPE html>
<html>
<head>
    <style>
    	body
    	{
    		width: 100%;
    		margin-left: auto;
			margin-right: auto;
    	}
    	.center {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 50%;
			height: 50%;
		}
		.line{
			/*background-image: ;*/
			height: 5px;
		}
		
		.button1 {
		  background-color: #C5C5C5;; 
		  color: black; 
		  border: 2px solid #4CAF50;
		  height: 30px;
		}

		.button1:hover {
		  background-color: #4CAF50;
		  color: white;
		}
    </style>
</head>
<body>
	Dear all,<br>
	Berikut Kami sampaikan Follow Up RKJ dengan detail sebagai berikut: <br><br>
		
	<table border="1">
		<tr>
			<td>Nama Produk</td>
			<td>:</td>
			<td> {{$followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name}} </td>
		</tr>
		<tr>
			<td>Kode Oracle</td>
			<td>:</td>
			<td> {{$followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->oracle_code}} </td>
		</tr>
		<tr>
			<td>Nomor WO</td>
			<td>:</td>
			<td> 
				@php
					$woNumbers = array();	 	
				@endphp
				@foreach ($followUpRkj->rkj->ppq->palets as $palet_ppq)
					@php
						if (!in_array($palet_ppq->palet->cppDetail->woNumber->wo_number, $woNumbers)) 
						{
							array_push($woNumbers, $palet_ppq->palet->cppDetail->woNumber->wo_number);
						}
					@endphp 
				@endforeach
				@php
					$woNumber = '';	 	
				@endphp
				@foreach ($woNumbers as $wo)
					@php
						$woNumber .= $wo.' ,';
					@endphp
				@endforeach
				{{ rtrim($woNumber,' ,') }}
			</td>
		</tr>
		<tr>
			<td>Tanggal Produksi</td>
			<td>:</td>
			<td> {{$followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->production_realisation_date}} </td>
		</tr>
		<tr>
			<td>Nomor LOT</td>
			<td>:</td>
			<td> 

				@php
					$lotNumbers = array();	 	
				@endphp
				@foreach ($followUpRkj->rkj->ppq->palets as $palet_ppq)
					@php
						if (!in_array($palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet, $lotNumbers)) 
						{
							array_push($lotNumbers, $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet);
						}
					@endphp 
				@endforeach
				@php
					$lotNumber = '';	 	
				@endphp
				@foreach ($lotNumbers as $lot)
					@php
						$lotNumber .= $lot.' ,';
					@endphp
				@endforeach
				{{ rtrim($lotNumber,' ,') }}
			</td>
		</tr>
		<tr>
			<td>Jam Filling</td>
			<td>:</td>
			<td> {{$followUpRkj->rkj->ppq->jam_awal_ppq }} -  {{ $followUpRkj->rkj->ppq->jam_akhir_ppq }}</td>
		</tr>
		<tr>
			<td>Jumlah (pcs)</td>
			<td>:</td>
			<td>{{$followUpRkj->rkj->ppq->jumlah_pack}}</td>
		</tr>
		<tr>
			<td>Alasan RKJ</td>
			<td>:</td>
			<td>{{$followUpRkj->rkj->ppq->alasan}}</td>
		</tr>
		<tr>
			<td>Nomor RKP</td>
            <td>:</td>
			<td>{{$followUpRkj->nomor_rkp}}</td>
		</tr>
		<tr>
			<td>
				Hasil Investigasi
			</td>
			<td>:</td>
			<td>
				{{ $followUpRkj->hasil_investigasi }}
			</td>
		</tr>
        <tr>
			<td>
				Tanggal LOI
			</td>
			<td>:</td>
			<td>
				{{ $followUpRkj->tanggal_loi }}
			</td>
		</tr>
		<tr>
			<td>
				Status Produk
			</td>
			<td>:</td>
			<td>
				@switch($followUpRkj->status_case)
				    @case('0')
				        On Progress
			        @break
			        @case('1')
				        Done
			        @break
				@endswitch
			</td>
		</tr>
		
		@if (count($followUpRkj->preventiveActions) > 0)
			<tr>
				<td>Corrective Action</td>
				<td>:</td>
				<td>
					<table border="1" width="100%">
						@foreach ($followUpRkj->preventiveActions as $preventiveAction)
							<tr>
								<td>Corrective Action</td>
								<td>:</td>
								<td>{{ $preventiveAction->preventive_action }}</td>
							</tr>
							<tr>
								<td>PIC Corrective Action</td>
								<td>:</td>
								<td>{{ $preventiveAction->pic_preventive_action }}</td>
							</tr>

							<tr>
								<td>Due Date Corrective Action</td>
								<td>:</td>
								<td>{{ $preventiveAction->due_date_preventive_action }}</td>
							</tr>

							<tr>
								<td>Status Corrective Action</td>
								<td>:</td>
								<td>
									@if ($preventiveAction->due_date_preventive_action == '0')
										{{ 'On Progress' }}
									@else
										{{ 'Done' }}	
									@endif
								</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
						@endforeach
					</table>
				</td>
			</tr>
		@endif
	</table>
	<br />

<br>
Terimakasih
<br>
Rollie's Crew
<br>
	<img src="{{ asset('images/logo/logo-rollie.png') }}" class="center">
<br>
<br>
<p style="color:red;font-size: 12px">*Email ini dikirim secara otomatis, harap tidak membalas email ini. Apabila anda tidak berkaitan dengan email ini maka abaikan atau hubungi administrator aplikasi.</p>
<hr>
<p style="text-align: center;">&copy; 2019 PT. Nutrifood Indonesia | Sentul Integrated System</p>
</body>

</html>
