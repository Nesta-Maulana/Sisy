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
Dear QC Release,<br>
{{  $subject }} dengan tanggal produksi {{ $analisaMikro->cppHead->woNumbers[0]->production_realisation_date }} telah keluar.<br>
Berikut detail hasil analisa mikro produk tersebut : 
<br>
<table border="1">
	<tr>
		<td>Nama Produk</td>
		<td> {{ $analisaMikro->cppHead->woNumbers[0]->product->product_name }} </td>
	</tr>
	<tr>
		<td>Kode Oracle</td>
		<td> {{ $analisaMikro->cppHead->woNumbers[0]->product->oracle_code }} </td>
	</tr>
	<tr>
		<td>Nomor WO</td>
		<td> 
			@php
				$wonya = array();	 	
			@endphp
			@foreach ($analisaMikro->cppHead->woNumbers as $woNumber)
				@php
					if (!in_array($woNumber->wo_number, $wonya)) 
					{
						array_push($wonya, $woNumber->wo_number);
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
		<td> 
			@php
				$tanggalproduksis = array();	 	
			@endphp
			@foreach ($analisaMikro->cppHead->woNumbers as $woNumber)
				@php
					if (!in_array($woNumber->production_realisation_date, $tanggalproduksis)) 
					{
						array_push($tanggalproduksis, $woNumber->production_realisation_date);
					}
				@endphp 
			@endforeach
			@foreach ($tanggalproduksis as $tanggalproduksi)
				{{ $tanggalproduksi.',' }}
			@endforeach
		</td>
	</tr>
    @if ($analisaMikro->analisa_mikro_status == '0')
        <tr>
            <td>Status Analisa Mikro</td>
            <td style="background-color: red;color:white;"> 
                # OK
            </td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>
                @php
                    $keterangans     = explode(' | ',$keterangan)
                @endphp
                @foreach ($keterangans as $keterangan)
                    @if ($keterangan !== '')
                        {{ $keterangan.',' }} <br>
                    @endif
                @endforeach
            </td>
        </tr>
        @else
        <tr>
            <td>Status Analisa Mikro</td>
            <td style="background-color: #4CAF50;color:black;"> 
                 OK
            </td>
        </tr>
        @endif
</table>
<br>
Harap crosscheck dan close hasil analisa mikro tersebut dengan menekan link di bawah ini :
<br>
<b> Link untuk QC Release &nbsp;&nbsp;&nbsp;&nbsp; : <a href="{{ url('/rollie/analisa-mikro-release/'.app('App\Http\Controllers\ResourceController')->encrypt($analisaMikro->id)) }}"> Klik Disini </a> </b>   

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
