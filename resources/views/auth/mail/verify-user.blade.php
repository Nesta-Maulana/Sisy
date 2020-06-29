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
		Terima kasih sudah melakukan registrasi di aplikasi Sisy - Sentul Integrated System. Email anda yang tertaut pada Portal Sisy adalah {{$user->employee->email}} . Untuk pertama kali, Anda harus verifikasi data yang berikut adalah benar dan sesuai dengan data diri anda .  
		<table border="1">

			<tr>
				<td>Username</td>
				<td>:</td>
				<td>{{ $user->username }}</td>
			</tr>
			<tr>
				<td>Fullname</td>
				<td>:</td>
				<td>{{ $user->employee->fullname }}</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td>{{ $user->employee->email }}</td>
			</tr>
		</table>
		Apabila data tersebut benar, Silahkan klik tautan Aktivasi dibawah ini untuk mengaktifkan. Apabila anda tidak merasa mengisi data tersebut silahkan hubungi administrator untuk memblokir akun tersebut. 
	<br/>
	<br/>
	<br/>

	<a href="{{ route('verify.account',['user_id'=> app('App\Http\Controllers\ResourceController')->encrypt($user->id) ]) }}" style="font-weight: 900"> Verifikasi Akun </a> 

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
