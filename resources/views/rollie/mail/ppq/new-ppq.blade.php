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
Berikut Kami sampaikan PPQ dengan detail sebagai berikut: <br><br>
		
<table border="1">
	<tr>
		<td>Nama Produk</td>
		<td> {{$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name}} </td>
	</tr>
	<tr>
		<td>Kode Oracle</td>
		<td> {{$ppq->palets[0]->palet->cppDetail->woNumber->product->oracle_code}} </td>
	</tr>
	<tr>
		<td>Nomor WO</td>
		<td> 
			@php
				$wonya = array();	 	
			@endphp
			@foreach ($ppq->palets as $palet_ppq)
				{{-- {{ dd($palet_ppq->palet->cppDetail) }} --}}
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
		<td> {{$ppq->palets[0]->palet->cppDetail->woNumber->production_realisation_date}} </td>
	</tr>
	<tr>
		<td>Nomor LOT</td>
		<td> 
			@foreach ($ppq->palets as $palet_ppq)
				{{ $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.',' }}
			@endforeach
		</td>
	</tr>
	<tr>
		<td>Jam Filling</td>
		<td> {{$ppq->jam_awal_ppq }} -  {{ $ppq->jam_akhir_ppq }}</td>
	</tr>
	<tr>
		<td>Jumlah (pcs)</td>
		<td>{{$ppq->jumlah_pack}}</td>
	</tr>
	<tr>
		<td>Alasan PPQ</td>
		<td>{{$ppq->alasan}}</td>
	</tr>
	<tr>
		<td>Kategori PPQ</td>
		<td>
			{{ $ppq->kategoriPpq->kategori_ppq }}
		</td>
	</tr>
	<tr>
		<td>User Inputer</td>
		<td>{{ $ppq->userCreate->employee->fullname }}</td>
	</tr>
</table>
	<br />
	<br />
	Untuk Proses Follow Up PPQ secara detail masuk klik link berikut : 
	<br>
@if ($ppq->kategoriPpq->jenisPpq->jenis_ppq == 'Mikro' || $ppq->kategoriPpq->jenisPpq->jenis_ppq == 'Package Integrity')
	Link untuk QC Release	: <a href="{{ url('/rollie/follow-up-ppq-qc-release/'.app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)) }}"> Klik disini </a> 
	<br>
@else
	Link untuk Penyelia QC	: <a href="{{ url('rollie/follow-up-ppq-qc-tahanan/'.app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)) }}"> Klik disini </a> 
	<br>
@endif
@if ($ppq->kategoriPpq->kategori_ppq == 'Machine')
	Link untuk Engineering	: <a href="{{ url('rollie/follow-up-ppq-engineering/'.app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)) }}"> Klik disini </a> 
@endif
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
