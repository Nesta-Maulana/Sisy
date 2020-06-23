
<?php $__env->startSection('title'); ?>
    Form PPQ | Analisa Mikrobiologi 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-data-analisa'); ?>
    menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-rollie-analysis-data-analisa-mikro-release'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<input type="hidden" id="decode_1" value="<?php echo e(app('App\Http\Controllers\ResourceController')->decrypt(Request::Segment(4))); ?>">
<input type="hidden" id="decode_2" value="<?php echo e(app('App\Http\Controllers\ResourceController')->decrypt(Request::Segment(5))); ?>">
<input type="hidden" id="encode_1" value="<?php echo e(Request::Segment(4)); ?>">
<input type="hidden" id="encode_2" value="<?php echo e(Request::Segment(5)); ?>">
<input type="hidden" id="auto_code" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt('null')); ?>">
<div class="accordion" id="accordionExample">
	<?php if($ppq_30 !== 'null' && !is_null($ppq_30) ): ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-header bg-dark" id="ppq30" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="openClose()">
						<h5>
							<b>PPQ Analisa Kimia Suhu 30 - <?php echo e($ppq_30->cppHead->product->product_name); ?></b>
							<i class="pull-right fa fa-arrow-down open" id="iconnya"></i>
							
						</h5>
					</div>
					<?php
						$wo_number 						= '';
						$production_realisation_date 	= '';
						$filling_machine 				= '';
						$filling_machine_id 			= '';
						$nolot 							= '';
						$nolot_id 						= '';
						$jumlah_pack 					= 0;
					?>	
					<?php $__currentLoopData = $ppq_30->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if(strpos($wo_number,$palet_ppq->palet->cppDetail->woNumber->wo_number.', ') === false): ?>
							<?php
								$wo_number 	.= $palet_ppq->palet->cppDetail->woNumber->wo_number.', ';
							?>
						<?php endif; ?>
						<?php if(strpos($production_realisation_date,$palet_ppq->palet->cppDetail->woNumber->production_realisation_date.', ') === false): ?>
							<?php
								$production_realisation_date 	.= $palet_ppq->palet->cppDetail->woNumber->production_realisation_date.', ';
							?>
						<?php endif; ?>
						
						<?php if(strpos($filling_machine,$palet_ppq->palet->cppDetail->fillingMachine->filling_machine_code.', ') === false): ?>
							<?php
								$filling_machine 	.= $palet_ppq->palet->cppDetail->fillingMachine->filling_machine_code.', ';
							?>
						<?php endif; ?>
						
						<?php if(strpos($filling_machine_id,app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->cppDetail->fillingMachine->filling_machine_id).', ') === false): ?>
							<?php
								$filling_machine_id 	.= app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->cppDetail->fillingMachine->filling_machine_id).', ';
							?>
						<?php endif; ?>
	
						
						<?php if(strpos($nolot,$palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ') === false): ?>
							<?php
								$nolot 	.= $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ';
							?>
						<?php endif; ?>
	
						<?php if(strpos($nolot_id,app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id).', ') === false): ?>
							<?php
								$nolot_id 	.= app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id).', ';
							?>
						<?php endif; ?>
						<?php
							$jumlah_pack 	+= $palet_ppq->palet->jumlah_pack;
						?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<div id="collapseOne" class="collapse show" aria-labelledby="ppq30" data-parent="#accordionExample">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="">Nomor PPQ</label>
										<input readonly="true" type="text" class="form-control" id="nomor_ppq_30" placeholder="Nomor PPQ" value="<?php echo e($ppq_30->nomor_ppq); ?>">
										<input readonly="true" type="hidden" class="form-control" id="ppq_id_30" placeholder="Nomor PPQ" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq_30->id)); ?>">
									</div>
									<div class="form-group">
										<label for="">Nomor Wo</label>
										<input readonly="true" type="text" id="wo_number_30" value="<?php echo e(rtrim($wo_number,', ')); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Nama Produk</label>
										<input readonly="true" type="text" id="product_name_30" value="<?php echo e($ppq_30->cppHead->product->product_name); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Kode Oracle</label>
										<input readonly="true" type="text" class="form-control" id="oracle_code_30" placeholder="Kode Oracle" value="<?php echo e($ppq_30->cppHead->product->oracle_code); ?>">
									</div>
									<div class="form-group">
										<label for="">Tanggal Produksi</label>
										<input readonly="true" type="text" id="tanggal_produksi_30" value="<?php echo e(trim($production_realisation_date,', ')); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Mesin Filling</label>
										<input readonly="true" type="text" id="filling_machine_30" value="<?php echo e(rtrim($filling_machine,', ')); ?>"  class="form-control">
										<input readonly="true" type="hidden" id="mesin_filling_id_30" value="<?php echo e(rtrim($filling_machine_id,', ')); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="nolot">No Lot</label>
										<input id="nolot_30" class="form-control" type="text" name="nolot_30" value="<?php echo e(rtrim($nolot,', ')); ?>" readonly>
										<input id="nolot_id_30" class="form-control hidden" type="hidden" name="nolot_id" value="<?php echo e(rtrim($nolot_id,', ')); ?>">
									</div>
									<div class="form-group">
										<label for="jumlah_pack">Jumlah Pack</label>
										<input id="jumlah_pack_30" class="form-control" type="text" name="jumlah_pack_30" value="<?php echo e($ppq_30->jumlah_pack); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 ">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="">Tanggal PPQ Mikro</label>
										<input readonly="true" type="text" id="tanggal_ppq_30" value="<?php echo e($ppq_30->ppq_date); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Jam Filling Awal PPQ : </label>
										<input readonly="true" type="text" class="form-control" id="jam_filling_mulai_30" placeholder="Jam Filiing Awal" value="<?php echo e($ppq_30->jam_awal_ppq); ?> ">
									</div>
									<div class="form-group">
										<label for="">Jam Filling Akhir PPQ : </label>
										<input readonly="true" type="text" class="form-control"  id="jam_filling_akhir_30" value="<?php echo e($ppq_30->jam_akhir_ppq); ?> ">
									</div>
									<div class="form-group">
										<label for="">Alasan PPQ : </label>
										<textarea class="form-control" inputmode="url" id="alasan_ppq_30" rows="2" required ><?php echo e($ppq_30->alasan); ?></textarea>
									</div>
									<div class="form-group">
										<label for="">Detail Titik PPQ : </label>
										<textarea class="form-control" id="detail_titik_ppq_30" rows="4" required><?php echo e(html_entity_decode(rtrim($ppq_30->detail_titik_ppq,'14&#13;&#10;'))); ?></textarea>
									</div>
									<div class="form-group">
										<label for="">Kategori PPQ : </label>
										<select id="kategori_ppq_id_30" class="form-control" name="kategori_ppq_id">
											<option value="" selected disabled> Pilih Kategori PPQ </option>
											<?php $__currentLoopData = $jenisPpq->kategoriPpqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategoriPpq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($kategoriPpq->id)); ?>" <?php if($kategoriPpq->id === $ppq_30->kategori_ppq_id): ?> <?php echo e('selected'); ?>  <?php endif; ?>> <?php echo e($kategoriPpq->kategori_ppq); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									
									<div class="form-group">
										<label for="">PIC Input: </label>
										<input readonly="true" type="text" class="form-control" value="<?php echo e($ppq_30->userCreate->employee->fullname); ?>" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<button class="btn-primary btn form-control" onclick="prosesPpqAnalisaMikro('30')">Proses data PPQ 30</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if($ppq_55 !== 'null' && !is_null($ppq_55) ): ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-header bg-dark" id="ppq55" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="openClose()">
						<h5>
							<b>PPQ Analisa Kimia Suhu 55 - <?php echo e($ppq_55->cppHead->product->product_name); ?></b>
							<i class="pull-right fa fa-arrow-down open" id="iconnya"></i>
							
						</h5>
					</div>
					<?php
						$wo_number 						= '';
						$production_realisation_date 	= '';
						$filling_machine 				= '';
						$filling_machine_id 			= '';
						$nolot 							= '';
						$nolot_id 						= '';
						$jumlah_pack 					= 0;
					?>	
					<?php $__currentLoopData = $ppq_55->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if(strpos($wo_number,$palet_ppq->palet->cppDetail->woNumber->wo_number.', ') === false): ?>
							<?php
								$wo_number 	.= $palet_ppq->palet->cppDetail->woNumber->wo_number.', ';
							?>
						<?php endif; ?>
						<?php if(strpos($production_realisation_date,$palet_ppq->palet->cppDetail->woNumber->production_realisation_date.', ') === false): ?>
							<?php
								$production_realisation_date 	.= $palet_ppq->palet->cppDetail->woNumber->production_realisation_date.', ';
							?>
						<?php endif; ?>
						
						<?php if(strpos($filling_machine,$palet_ppq->palet->cppDetail->fillingMachine->filling_machine_code.', ') === false): ?>
							<?php
								$filling_machine 	.= $palet_ppq->palet->cppDetail->fillingMachine->filling_machine_code.', ';
							?>
						<?php endif; ?>
						
						<?php if(strpos($filling_machine_id,app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->cppDetail->fillingMachine->filling_machine_id).', ') === false): ?>
							<?php
								$filling_machine_id 	.= app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->cppDetail->fillingMachine->filling_machine_id).', ';
							?>
						<?php endif; ?>

						
						<?php if(strpos($nolot,$palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ') === false): ?>
							<?php
								$nolot 	.= $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ';
							?>
						<?php endif; ?>

						<?php if(strpos($nolot_id,app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id).', ') === false): ?>
							<?php
								$nolot_id 	.= app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id).', ';
							?>
						<?php endif; ?>
						<?php
							$jumlah_pack 	+= $palet_ppq->palet->jumlah_pack;
						?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<div id="collapseOne" class="collapse show" aria-labelledby="ppq55" data-parent="#accordionExample">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="">Nomor PPQ</label>
										<input readonly="true" type="text" class="form-control" id="nomor_ppq_55" placeholder="Nomor PPQ" value="<?php echo e($ppq_55->nomor_ppq); ?>">
										<input readonly="true" type="hidden" class="form-control" id="ppq_id_55" placeholder="Nomor PPQ" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq_55->nomor_ppq)); ?>">
									</div>
									<div class="form-group">
										<label for="">Nomor Wo</label>
										<input readonly="true" type="text" id="wo_number_55" value="<?php echo e(rtrim($wo_number,', ')); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Nama Produk</label>
										<input readonly="true" type="text" id="product_name_55" value="<?php echo e($ppq_55->cppHead->product->product_name); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Kode Oracle</label>
										<input readonly="true" type="text" class="form-control" id="oracle_code_55" placeholder="Kode Oracle" value="<?php echo e($ppq_55->cppHead->product->oracle_code); ?>">
									</div>
									<div class="form-group">
										<label for="">Tanggal Produksi</label>
										<input readonly="true" type="text" id="tanggal_produksi_55" value="<?php echo e(trim($production_realisation_date,', ')); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Mesin Filling</label>
										<input readonly="true" type="text" id="filling_machine_55" value="<?php echo e(rtrim($filling_machine,', ')); ?>"  class="form-control">
										<input readonly="true" type="hidden" id="mesin_filling_id_55" value="<?php echo e(rtrim($filling_machine_id,', ')); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="nolot">No Lot</label>
										<input id="nolot_55" class="form-control" type="text" name="nolot_55" value="<?php echo e(rtrim($nolot,', ')); ?>" readonly>
										<input id="nolot_id_55" class="form-control hidden" type="hidden" name="nolot_id" value="<?php echo e(rtrim($nolot_id,', ')); ?>">
									</div>
									<div class="form-group">
										<label for="jumlah_pack">Jumlah Pack</label>
										<input id="jumlah_pack_55" class="form-control" type="text" name="jumlah_pack_55" value="<?php echo e($jumlah_pack); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 ">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="">Tanggal PPQ Mikro</label>
										<input readonly="true" type="text" id="tanggal_ppq_55" value="<?php echo e($ppq_55->ppq_date); ?>"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Jam Filling Awal PPQ : </label>
										<input readonly="true" type="text" class="form-control" id="jam_filling_mulai_55" placeholder="Jam Filiing Awal" value="<?php echo e($ppq_55->jam_awal_ppq); ?> ">
									</div>
									<div class="form-group">
										<label for="">Jam Filling Akhir PPQ : </label>
										<input readonly="true" type="text" class="form-control"  id="jam_filling_akhir_55" value="<?php echo e($ppq_55->jam_akhir_ppq); ?> ">
									</div>
									<div class="form-group">
										<label for="">Alasan PPQ : </label>
										<textarea class="form-control" inputmode="url" id="alasan_ppq_55" rows="2" required ><?php echo e($ppq_55->alasan); ?></textarea>
									</div>
									<div class="form-group">
										<label for="">Detail Titik PPQ : </label>
										<textarea class="form-control" id="detail_titik_ppq_55" rows="4" required><?php echo e(html_entity_decode(rtrim($ppq_55->detail_titik_ppq,'14&#13;&#10;'))); ?></textarea>
									</div>
									<div class="form-group">
										<label for="">Kategori PPQ : </label>
										<select id="kategori_ppq_id_55" class="form-control" name="kategori_ppq_id">
											<option value="" selected disabled> Pilih Kategori PPQ </option>
											<?php $__currentLoopData = $jenisPpq->kategoriPpqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategoriPpq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($kategoriPpq->id)); ?>" <?php if($kategoriPpq->id === $ppq_55->kategori_ppq_id): ?> <?php echo e('selected'); ?>  <?php endif; ?>> <?php echo e($kategoriPpq->kategori_ppq); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									
									<div class="form-group">
										<label for="">PIC Input: </label>
										<input readonly="true" type="text" class="form-control" value="<?php echo e($ppq_55->userCreate->employee->fullname); ?>" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<button class="btn-primary btn form-control" onclick="prosesPpqAnalisaMikro('55')">Proses data PPQ 55</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/analisa_mikro/form-ppq.blade.php ENDPATH**/ ?>