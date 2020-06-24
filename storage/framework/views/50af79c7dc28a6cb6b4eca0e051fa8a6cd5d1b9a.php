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
		<td> <?php echo e($ppq->palets[0]->palet->cppDetail->woNumber->product->product_name); ?> </td>
	</tr>
	<tr>
		<td>Kode Oracle</td>
		<td> <?php echo e($ppq->palets[0]->palet->cppDetail->woNumber->product->oracle_code); ?> </td>
	</tr>
	<tr>
		<td>Nomor WO</td>
		<td> 
			<?php
				$wonya = array();	 	
			?>
			<?php $__currentLoopData = $ppq->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
				<?php
					if (!in_array($palet_ppq->palet->cppDetail->woNumber->wo_number, $wonya)) 
					{
						array_push($wonya, $palet_ppq->palet->cppDetail->woNumber->wo_number);
					}
				?> 
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php $__currentLoopData = $wonya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo e($wo.','); ?>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</td>
	</tr>
	<tr>
		<td>Tanggal Produksi</td>
		<td> <?php echo e($ppq->palets[0]->palet->cppDetail->woNumber->production_realisation_date); ?> </td>
	</tr>
	<tr>
		<td>Nomor LOT</td>
		<td> 
			<?php $__currentLoopData = $ppq->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo e($palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.','); ?>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</td>
	</tr>
	<tr>
		<td>Jam Filling</td>
		<td> <?php echo e($ppq->jam_awal_ppq); ?> -  <?php echo e($ppq->jam_akhir_ppq); ?></td>
	</tr>
	<tr>
		<td>Jumlah (pcs)</td>
		<td><?php echo e($ppq->jumlah_pack); ?></td>
	</tr>
	<tr>
		<td>Alasan PPQ</td>
		<td><?php echo e($ppq->alasan); ?></td>
	</tr>
	<tr>
		<td>Kategori PPQ</td>
		<td>
			<?php echo e($ppq->kategoriPpq->kategori_ppq); ?>

		</td>
	</tr>
	<tr>
		<td>User Inputer</td>
		<td><?php echo e($ppq->userCreate->employee->fullname); ?></td>
	</tr>
</table>
	<br />
	<br />
	Untuk Proses Follow Up PPQ secara detail masuk klik link berikut : 
	<br>
<?php if($ppq->kategoriPpq->jenisPpq->jenis_ppq == 'Mikro' || $ppq->kategoriPpq->jenisPpq->jenis_ppq == 'Package Integrity'): ?>
	Link untuk QC Release	: <a href="<?php echo e(url('/rollie/follow-up-ppq-qc-release/'.app('App\Http\Controllers\ResourceController')->encrypt($ppq->id))); ?>"> Klik disini </a> 
	<br>
<?php else: ?>
	Link untuk Penyelia QC	: <a href="<?php echo e(url('rollie/follow-up-ppq-qc-tahanan/'.app('App\Http\Controllers\ResourceController')->encrypt($ppq->id))); ?>"> Klik disini </a> 
	<br>
<?php endif; ?>
<?php if($ppq->kategoriPpq->kategori_ppq == 'Machine'): ?>
	Link untuk Engineering	: <a href="<?php echo e(url('rollie/follow-up-ppq-engineering/'.app('App\Http\Controllers\ResourceController')->encrypt($ppq->id))); ?>"> Klik disini </a> 
<?php endif; ?>
<br>
Terimakasih
<br>
Rollie's Crew
<br>
	<img src="<?php echo e(asset('images/logo/logo-rollie.png')); ?>" class="center">
<br>
<br>
<p style="color:red;font-size: 12px">*Email ini dikirim secara otomatis, harap tidak membalas email ini. Apabila anda tidak berkaitan dengan email ini maka abaikan atau hubungi administrator aplikasi.</p>
<hr>
<p style="text-align: center;">&copy; 2019 PT. Nutrifood Indonesia | Sentul Integrated System</p>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/mail/ppq/new-ppq.blade.php ENDPATH**/ ?>