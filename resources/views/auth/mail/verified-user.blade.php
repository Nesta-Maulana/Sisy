<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
    <style type="text/css">
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
 	<h4>Dear {{$user->employee->fullname}},</h4>
	<br/>
		Akun anda sudah terverifikasi, berikut adalah detail data user akses untuk masuk ke portal Sisy :  
		<table border="1">

			<tr>
				<td>Username</td>
				<td>:</td>
				<td>{{ $user->username }}</td>
			</tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td style="background-color:black"><span style="color:black">sentulappuser</span></td>
            </tr>
        </table>
        <p style="color:red;font-size: 12px">Harap jangan memberikan username dan password kepada orang lain, simpan data akses ini sebaik mungkin seperti menyimpan kenangan dari mantan.</span></p>
        
	<br>

	<img src="{{ asset('images/line.png') }}" alt="" class="line">
	<br>
	Salam Hangat,
	<br>
	<br>
	<br>
	Sisy's Team
	<br>
	<img src="{{ asset('images/logo/mail.png') }}" class="center">
	<br>
	<br>
	<p style="color:red;font-size: 12px">*Email ini dikirim secara otomatis, harap tidak membalas email ini. Apabila anda tidak berkaitan dengan email ini maka abaikan atau hubungi administrator aplikasi.</p>
	<hr>
	<p style="text-align: center;">&copy; 2019 PT. Nutrifood Indonesia | Sentul Integrated System</p>
	
</body>

</html>
