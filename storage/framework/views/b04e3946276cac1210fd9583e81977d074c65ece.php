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
            <?php $__currentLoopData = $psrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $psr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($psr->psr_number); ?></td>
                    <td><?php echo e($psr->woNumber->production_realisation_date); ?></td>
                    <td><?php echo e($psr->woNumber->wo_number); ?></td>
                    <?php if(count($psr->woNumber->cppDetails) == 1): ?>
                        <?php if($psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'A3CF B' || $psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'TPA A'): ?>
                            <td><?php echo e($psr->woNumber->cppDetails[0]->lot_number); ?></td>
                            <td>-</td>
                        <?php else: ?>
                            <td>-</td>
                            <td><?php echo e($psr->woNumber->cppDetails[0]->lot_number); ?></td>
                            
                        <?php endif; ?>
                    <?php else: ?>
                        <?php $__currentLoopData = $psr->woNumber->cppDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td><?php echo e($cppDetails->lot_number); ?></td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <td><?php echo e($psr->woNumber->product->oracle_code); ?></td>
                    <td><?php echo e($psr->woNumber->product->product_name); ?></td>
                    <td><?php echo e($psr->psr_qty); ?></td>
                    <td><?php echo e($psr->note); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <br />
    Untuk hardcopy akan diproses maks. H+1 HK setelah email ini diterima .
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
<?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/mail/psr/notif-to-penyelia.blade.php ENDPATH**/ ?>