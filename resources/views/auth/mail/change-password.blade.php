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
	Dear {{ $userData->employee->fullname }},<br>
	Password anda berhasil diubah dengan detail sebagai berikut : <br><br>
    <table>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>{{ $userData->username }}</td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td style="background-color:black"><span style="color:black">{{$password}}</span></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <p style="color:black;font-size: 12px">apabila perubahan password diluar kehendak anda, harap hubungi administrator untuk penelusuran dengan memberikan info <span style="color: red">Hostname : {{ $hostname }}</span></p>
<br>
Terimakasih
<br>
Rollie's Crew
<br>
	<img src="{{ asset('images/logo/logo-rollie.png') }}" class="center">
<br>
<br>
<hr>
<p style="text-align: center;">&copy; 2019 PT. Nutrifood Indonesia | Sentul Integrated System</p>
</body>

</html>
