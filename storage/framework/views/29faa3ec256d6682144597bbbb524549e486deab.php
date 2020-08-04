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
	Dear <?php echo e($userData->employee->fullname); ?>,<br>
	Password anda berhasil diubah dengan detail sebagai berikut : <br><br>
    <table>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><?php echo e($userData->username); ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td style="background-color:black"><span style="color:black"><?php echo e($password); ?></span></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <p style="color:black;font-size: 12px">apabila perubahan password diluar kehendak anda, harap hubungi administrator untuk penelusuran dengan memberikan info <span style="color: red">Hostname : <?php echo e($hostname); ?></span></p>
<br>
Terimakasih
<br>
Rollie's Crew
<br>
	<img src="<?php echo e(asset('images/logo/mail.png')); ?>" class="center">
<br>
<br>
<hr>
<p style="text-align: center;">&copy; 2019 PT. Nutrifood Indonesia | Sentul Integrated System</p>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Sisy\resources\views/auth/mail/change-password.blade.php ENDPATH**/ ?>