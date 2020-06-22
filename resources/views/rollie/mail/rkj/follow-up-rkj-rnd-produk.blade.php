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
			<td>Hasil Analisa QC Tahanan</td>
			<td>:</td>
			<td>{{$followUpRkj->rkj->ppq->followUpPpq->hasil_analisa}}</td>
		</tr>
		<tr>
			<td>
				Hasil Evaluasi RnD
			</td>
			<td>:</td>
			<td>
				{{ $followUpRkj->hasil_analisa }}
			</td>
		</tr>
	
		<tr>
			<td>
				Status Produk
			</td>
			<td>:</td>
			<td>
				@switch($followUpRkj->status_produk)
					@case('0')
						REJECT
					@break
					@case('1')
						Release
					@break
	
					@case('2')
						Release Partial
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td>
				Tanggal Status Produk
			</td>
			<td>:</td>
			<td>
				{{ $followUpRkj->tanggal_status_produk }}
			</td>
		</tr>
		@if (count($followUpRkj->correctiveActions) > 0)
        <tr>
            <td>Corrective Action</td>
            <td>:</td>
            <td>
                <table width="100%" border="1">
                    @foreach ($followUpRkj->correctiveActions as $correctiveAction)
                        <tr>
                            <td>Corrective Action</td>
                            <td>:</td>
                            <td>{{ $correctiveAction->corrective_action }}</td>
                        </tr>
                        <tr>
                            <td>PIC Corrective Action</td>
                            <td>:</td>
                            <td>{{ $correctiveAction->pic_corrective_action }}</td>
                        </tr>

                        <tr>
                            <td>Due Date Corrective Action</td>
                            <td>:</td>
                            <td>{{ $correctiveAction->due_date_corrective_action }}</td>
                        </tr>

                        <tr>
                            <td>Status Corrective Action</td>
                            <td>:</td>
                            <td>
                                @if ($correctiveAction->due_date_corrective_action == '0')
                                    {{ 'On Progress' }}
                                @else
                                    {{ 'Done' }}	
                                @endif
                            </td>
						</tr>
						@if (!is_null($correctionAction->verfikasi_corrective_action))
							<tr>
								<td>Status Corrective Action</td>
								<td>:</td>
								<td>
									{{$correctiveAction->verifikasi_corrective_action}}
								</td>
							</tr>
						@endif
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    @endif
	</table>

<br>
Terimakasih
<br>
Rollie's Crew
<br>
	<img src="{{ asset('general_style/images/logo/logo-rollie.png') }}" class="center">
<br>
<br>
<p style="color:red;font-size: 12px">*Email ini dikirim secara otomatis, harap tidak membalas email ini. Apabila anda tidak berkaitan dengan email ini maka abaikan atau hubungi administrator aplikasi.</p>
<hr>
<p style="text-align: center;">&copy; 2019 PT. Nutrifood Indonesia | Sentul Integrated System</p>
</body>

</html>
