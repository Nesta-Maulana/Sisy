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
	Berikut kami sampaikan jumlah permintaan sampel RTD: <br><br>
    <table border='1'>
        <thead>
            <tr class="text-center">
                <th style="width: 150px">Nomor PSR</th>
                <th style="width: 150px">Tanggal Produksi</th>
                <th style="width: 120px">Nomor Wo</th>
                <th style="width: 120px">Kode Batch 1</th>
                <th style="width: 120px">Kode Batch 2</th>
                <th style="width: 120px">Kode Produk</th>
                <th style="width: 250px">Nama Produk</th>
                <th style="width: 120px">Jumlah Sampel</th>
                <th style="width: 120px">Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($psrs as $psr)
                <tr>
                    <td>{{ $psr->psr_number }}</td>
                    <td>{{ $psr->woNumber->production_realisation_date }}</td>
                    <td>{{ $psr->woNumber->wo_number }}</td>
                    @if (count($psr->woNumber->cppDetails) == 1)
                        @if ($psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'A3CF B' || $psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'TPA A')
                            <td>{{ $psr->woNumber->cppDetails[0]->lot_number }}</td>
                            <td>-</td>
                        @else
                            <td>-</td>
                            <td>{{ $psr->woNumber->cppDetails[0]->lot_number }}</td>
                            
                        @endif
                    @else
                        @foreach ($psr->woNumber->cppDetails as $cppDetails)
                            <td>{{ $cppDetails->lot_number }}</td>
                        @endforeach
                    @endif
                    <td>{{ $psr->woNumber->product->oracle_code }}</td>
                    <td>{{ $psr->woNumber->product->product_name }}</td>
                    <td>{{ $psr->psr_qty }}</td>
                    <td>{{ $psr->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br />
    Untuk hardcopy akan diproses maks. H+1 HK setelah email ini diterima .
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
