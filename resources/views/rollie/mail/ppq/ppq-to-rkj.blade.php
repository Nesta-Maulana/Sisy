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
Berikut Kami sampaikan RKJ hasil eskalasi dari PPQ dengan detail sebagai berikut: <br><br>
		
<table border="1">
	<tr>
		<td>Nama Produk</td>
		<td> {{$rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name}} </td>
	</tr>
	<tr>
		<td>Kode Oracle</td>
		<td> {{$rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->oracle_code}} </td>
	</tr>
	<tr>
		<td>Nomor WO</td>
		<td> 
			@php
				$wonya = array();	 	
			@endphp
			@foreach ($rkj->ppq->palets as $palet_ppq)
				@php
					if (!in_array($palet_ppq->palet->cppDetail->woNumber->wo_number, $wonya)) 
					{
						array_push($wonya, $palet_ppq->palet->cppDetail->woNumber->wo_number);
					}
				@endphp 
			@endforeach
			@foreach ($wonya as $wo)
				{{ $wo.',' }}
			@endforeach
		</td>
	</tr>
	<tr>
		<td>Tanggal Produksi</td>
		<td> {{$rkj->ppq->palets[0]->palet->cppDetail->woNumber->production_realisation_date}} </td>
	</tr>
	<tr>
		<td>Nomor LOT</td>
		<td> 
			@foreach ($rkj->ppq->palets as $palet_ppq)
				{{ $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.',' }}
			@endforeach
		</td>
	</tr>
	<tr>
		<td>Jam Filling</td>
		<td> {{$rkj->ppq->jam_awal_ppq }} -  {{ $rkj->ppq->jam_akhir_ppq }}</td>
	</tr>
	<tr>
		<td>Jumlah (pcs)</td>
		<td>{{$rkj->ppq->jumlah_pack}}</td>
	</tr>
	<tr>
		<td>Alasan PPQ</td>
		<td>{{$rkj->ppq->alasan}}</td>
	</tr>
	<tr>
		<td>Kategori PPQ</td>
		<td>
			{{$rkj->ppq->kategoriPpq->kategori_ppq}}
			
		</td>
	</tr>
	<tr>
		<td>Hasil Penelusuran QC Tahanan</td>
		<td>{{$rkj->ppq->followUpPpq->hasil_analisa}}</td>
	</tr>
</table>
<br>
Untuk proses follow up RKJ secara detail masuk klik link berikut :
<br>
Link untuk R&D Produk	: <a href="{{ url('/rollie/follow-up-rkj-rnd-'.strtolower($rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->subbrand->brand->brand_name)) }}">Klik Disini</a> 
<br>
Link untuk QA  			: <a href="/rollie/follow-up-qa">Klik Disini</a> 

<br>
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
