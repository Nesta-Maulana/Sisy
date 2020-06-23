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
	Berikut Kami sampaikan Follow Up PPQ dengan detail sebagai berikut: <br><br>
		
	<table border="1">
		<tr>
			<td>Nama Produk</td>
			<td>:</td>
			<td> <?php echo e($followUpPpq->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name); ?> </td>
		</tr>
		<tr>
			<td>Kode Oracle</td>
			<td>:</td>
			<td> <?php echo e($followUpPpq->ppq->palets[0]->palet->cppDetail->woNumber->product->oracle_code); ?> </td>
		</tr>
		<tr>
			<td>Nomor WO</td>
			<td>:</td>
			<td> 
				<?php
					$woNumbers = array();	 	
				?>
				<?php $__currentLoopData = $followUpPpq->ppq->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						if (!in_array($palet_ppq->palet->cppDetail->woNumber->wo_number, $woNumbers)) 
						{
							array_push($woNumbers, $palet_ppq->palet->cppDetail->woNumber->wo_number);
						}
					?> 
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php
					$woNumber = '';	 	
				?>
				<?php $__currentLoopData = $woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$woNumber .= $wo.' ,';
					?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php echo e(rtrim($woNumber,' ,')); ?>

			</td>
		</tr>
		<tr>
			<td>Tanggal Produksi</td>
			<td>:</td>
			<td> <?php echo e($followUpPpq->ppq->palets[0]->palet->cppDetail->woNumber->production_realisation_date); ?> </td>
		</tr>
		<tr>
			<td>Nomor LOT</td>
			<td>:</td>
			<td> 

				<?php
					$lotNumbers = array();	 	
				?>
				<?php $__currentLoopData = $followUpPpq->ppq->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						if (!in_array($palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet, $lotNumbers)) 
						{
							array_push($lotNumbers, $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet);
						}
					?> 
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php
					$lotNumber = '';	 	
				?>
				<?php $__currentLoopData = $lotNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$lotNumber .= $lot.' ,';
					?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php echo e(rtrim($lotNumber,' ,')); ?>

			</td>
		</tr>
		<tr>
			<td>Jam Filling</td>
			<td>:</td>
			<td> <?php echo e($followUpPpq->ppq->jam_awal_ppq); ?> -  <?php echo e($followUpPpq->ppq->jam_akhir_ppq); ?></td>
		</tr>
		<tr>
			<td>Jumlah (pcs)</td>
			<td>:</td>
			<td><?php echo e($followUpPpq->ppq->jumlah_pack); ?></td>
		</tr>
		<tr>
			<td>Alasan PPQ</td>
			<td>:</td>
			<td><?php echo e($followUpPpq->ppq->alasan); ?></td>
		</tr>
		<tr>
			<td>Kategori PPQ</td>
			<td>:</td>
			<td>
				<?php switch($followUpPpq->ppq->kategori_ppq):
				    case ('0'): ?>
				        Man
			        <?php break; ?>
				    <?php case ('1'): ?>
				        Machine
			        <?php break; ?>
				    <?php case ('2'): ?>
				        Method
			        <?php break; ?>
				    <?php case ('3'): ?>
				        Material
			        <?php break; ?>
				    <?php case ('4'): ?>
				    	Enviroment
			        <?php break; ?>
				    <?php case ('5'): ?>
				    	Sortasi
			        <?php break; ?>
				    <?php case ('6'): ?>
				    	Miss Handling
			        <?php break; ?>
				    <?php case ('7'): ?>
				        Lainnya
			        <?php break; ?>
				<?php endswitch; ?>
				
			</td>
		</tr>
		<tr>
			<td>
				Hasil Analisa
			</td>
			<td>:</td>
			<td>
				<?php echo e($followUpPpq->hasil_analisa); ?>

			</td>
		</tr>

		<tr>
			<td>
				Status Produk
			</td>
			<td>:</td>
			<td>
				<?php switch($followUpPpq->status_ppq):
				    case ('0'): ?>
				        REJECT
			        <?php break; ?>
			        <?php case ('1'): ?>
				        Release
			        <?php break; ?>

			        <?php case ('2'): ?>
				        Release Partial
			        <?php break; ?>
				<?php endswitch; ?>
			</td>
		</tr>
		<?php if($followUpPpq->nomor_lbd !== '-'): ?>
		<tr>
			<td>
				Nomor LBD
			</td>
			<td>:</td>
			<td>
				<?php echo e($followUpPpq->nomor_lbd); ?>

			</td>
		</tr>
		<?php endif; ?>
		<?php if(count($followUpPpq->correctiveActions) > 0): ?>
			<tr>
				<td>Corrective Action</td>
				<td>:</td>
				<td>
					<table border="1px solid black;" width="100%">
						<?php $__currentLoopData = $followUpPpq->correctiveActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $correctiveAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td>Corrective Action</td>
								<td>:</td>
								<td><?php echo e($correctiveAction->corrective_action); ?></td>
							</tr>
							<tr>
								<td>PIC Corrective Action</td>
								<td>:</td>
								<td><?php echo e($correctiveAction->pic_corrective_action); ?></td>
							</tr>

							<tr>
								<td>Due Date Corrective Action</td>
								<td>:</td>
								<td><?php echo e($correctiveAction->due_date_corrective_action); ?></td>
							</tr>

							<tr>
								<td>Status Corrective Action</td>
								<td>:</td>
								<td>
									<?php if($correctiveAction->status_corrective_action == '0'): ?>
										<?php echo e('On Progress'); ?>

									<?php else: ?>
										<?php echo e('Done'); ?>	
									<?php endif; ?>
								</td>
							</tr>
							<?php if(!is_null($correctiveAction->verifikasi_corrective_action)): ?>
								<tr>
									<td>Verifikasi Corrective Action</td>
									<td>:</td>
									<td><?php echo e($correctiveAction->verifikasi_corrective_action); ?></td>
								</tr>
							<?php endif; ?>
							<tr>
								<td>User Inputer</td>
								<td>:</td>
								<td>
									<?php echo e($correctiveAction->createdBy->employee->fullname); ?>

								</td>
							</tr>

							<tr>
								<td colspan="3"></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				</td>
			</tr>
		<?php endif; ?>

		<?php if(count($followUpPpq->preventiveActions) > 0): ?>
			<tr>
				<td>Preventive Action</td>
				<td>:</td>
				<td>
					<table border="1px solid black" width="100%">
						<?php $__currentLoopData = $followUpPpq->preventiveActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preventiveAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td>Preventive Action</td>
								<td>:</td>
								<td><?php echo e($preventiveAction->preventive_action); ?></td>
							</tr>
							<tr>
								<td>PIC Preventive Action</td>
								<td>:</td>
								<td><?php echo e($preventiveAction->pic_preventive_action); ?></td>
							</tr>

							<tr>
								<td>Due Date Preventive Action</td>
								<td>:</td>
								<td><?php echo e($preventiveAction->due_date_preventive_action); ?></td>
							</tr>

							<tr>
								<td>Status Preventive Action</td>
								<td>:</td>
								<td>
									<?php if($preventiveAction->status_preventive_action == '0'): ?>
										<?php echo e('On Progress'); ?>

									<?php else: ?>
										<?php echo e('Done'); ?>	
									<?php endif; ?>
								</td>
							</tr>

							<?php if(!is_null($preventiveAction->verifikasi_preventive_action)): ?>
								<tr>
									<td>Verifikasi Preventive Action</td>
									<td>:</td>
									<td><?php echo e($preventiveAction->verifikasi_preventive_action); ?></td>
								</tr>
							<?php endif; ?>
							<tr>
								<td>User Inputer</td>
								<td>:</td>
								<td>
									<?php echo e($preventiveAction->createdBy->employee->fullname); ?>

								</td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				</td>
			</tr>
		<?php endif; ?>
	</table>
	<br />

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
<?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/mail/ppq/follow-up-ppq-kimia-qc-tahanan.blade.php ENDPATH**/ ?>