
<?php $__env->startSection('title'); ?>
    Form RPD Filling | Draft PPQ
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-data-proses'); ?>
    menu-open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active-rollie-process-data-rpds'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<?php if(count($ppqs) > 0	): ?>
    	<div class="accordion" id="accordionExample">
			<?php $__currentLoopData = $ppqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  	<div class="row">
			  		<div class="col-lg-12 col-md-12 col-sm-12">
			  			<div class="card">
					    	<div class="card-header bg-dark" id="ppq<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						      	<h5 class="mt-2">
					        		PPQ PI <?php echo e($ppq->nomor_ppq); ?>		
						        	<span class="pull-right" style="font-size: 30px;transform: rotate(90deg);">&#10145;</span>
						      	</h5>
						    </div>
						    <div id="collapseOne" class="collapse" aria-labelledby="ppq<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" data-parent="#accordionExample">
						      	<div class="card-body">
						        	<div class="row">
						                <div class="col-lg-6 col-md-6 col-sm-6">
						                    <div class="form-group">
						                        <label for="">Nomor PPQ</label>
						                        <input type="text" class="form-control" id="nomor_ppq_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" readonly="true" placeholder="Nomor PPQ" value="<?php echo e($ppq->nomor_ppq); ?>">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Nomor Wo</label>
						                        <input type="text" id="wo_number_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php echo e($ppq->rpdFillingDetailPi->woNumber->wo_number); ?>" readonly class="form-control">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Nama Produk</label>
						                        <input type="text" id="product_name_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php echo e($ppq->rpdFillingDetailPi->woNumber->product->product_name); ?>" readonly class="form-control">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Kode Oracle</label>
						                        <input type="text" class="form-control" id="oracle_code_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" readonly="true" placeholder="Kode Oracle" value="<?php echo e($ppq->rpdFillingDetailPi->woNumber->product->oracle_code); ?>">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Tanggal Produksi</label>
						                        <input type="text" id="tanggal_produksi_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php echo e($ppq->rpdFillingDetailPi->woNumber->production_realisation_date); ?>" readonly class="form-control">
						                    </div>
					                        <div class="form-group">
					                            <label for="">Mesin Filling</label>
					                            <input type="text" id="filling_machine_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php echo e($ppq->rpdFillingDetailPi->fillingMachine->filling_machine_code); ?>" readonly class="form-control">
					                            <input type="hidden" id="mesin_filling_id_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->rpdFillingDetailPi->fillingMachine->id)); ?>" readonly class="form-control">
					                        </div>
						                    <div class="form-group">
						                        <label for="">Nomor LOT</label>
						                        <?php if(!is_null($ppq->palets)): ?>
						                            <input type="text" class="form-control" id="nomor_lot_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php $__currentLoopData = $ppq->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($palet_ppq->palet->cppDetail->lot_number); ?>-<?php echo e($palet_ppq->palet->palet); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>" readonly>
						                        <?php else: ?>
						                            <textarea class="form-control text-white" style="background-color: red" id="nomor_lot_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" cols="30" rows="2" readonly>Palet belum tersedia, harap hubungi tim packing untuk segera mengisi form packing dan memisahkan pack PPQ</textarea>
						                        <?php endif; ?>
						                        
						                        <?php if(!is_null($ppq->palets)): ?>
						                        	<input type="hidden" class="form-control" id="nomor_lot_id_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php $__currentLoopData = $ppq->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id)); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
						                        <?php else: ?>
						                        	<input type="hidden" class="form-control" id="nomor_lot_id_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="0">
						                        <?php endif; ?>
						                    </div> 
						                    <div class="form-group">
						                        <label for="">Jumlah (pack) : </label>
						                        <?php if($ppq->jumlah_pack !== 0): ?>                        
						                            <input type="text" class="form-control" id="jumlah_pack_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php echo e($ppq->jumlah_pack); ?>">
						                        <?php else: ?>
						                            <textarea class="form-control text-white" style="background-color: red" cols="30" rows="2" readonly>Jumlah Pack belum tersedia, harap hubungi tim packing untuk segera mengisi jumlah pack pada form packing dan memisahkan pack PPQ</textarea>
						                            <input type="hidden" class="form-control" id="jumlah_pack_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="0">

						                        <?php endif; ?>
						                    </div>
						                </div>
						                <div class="col-lg-6 col-md-6 col-sm-6">
						                    <div class="form-group">
						                        <label for="">Tanggal PPQ FG</label>
						                        <input type="text" id="tanggal_ppq_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php echo e(date('Y-m-d')); ?>" readonly class="form-control">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Jam Filling Awal PPQ : </label>
						                        <input type="text" class="form-control" id="jam_filling_mulai_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" placeholder="Jam Filiing Awal" value="<?php echo e($ppq->jam_awal_ppq); ?> "readonly>
						                    </div>
						                    <div class="form-group">
						                        <label for="">Jam Filling Akhir PPQ : </label>
						                        <input type="text" class="form-control"  id="jam_filling_akhir_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" value="<?php echo e($ppq->jam_akhir_ppq); ?> "readonly>
						                    </div>
						                    <div class="form-group">
						                        <label for="">Alasan PPQ : </label>
						                        <textarea class="form-control" inputmode="url" id="alasan_ppq_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" required><?php echo e($ppq->alasan); ?></textarea>
						                    </div>
						                    <div class="form-group">
						                        <label for="">Detail Titik PPQ : </label>
						                        <textarea class="form-control" id="detail_titik_ppq_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" required><?php echo e($ppq->detail_titik_ppq); ?></textarea>
						                    </div>
						                    <div class="form-group">
						                        <label for="">Kategori PPQ : </label>
						                        <select id="kategori_ppq_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" class="form-control" required>
						                            <option value="" selected disabled> Pilih Kategori PPQ </option>
						                            <option value="0" <?php if($ppq->kategori_ppq == '0'): ?> selected <?php endif; ?>> Man </option>
						                            <option value="1" <?php if($ppq->kategori_ppq == '1'): ?> selected <?php endif; ?>> Machine </option>
						                            <option value="2" <?php if($ppq->kategori_ppq == '2'): ?> selected <?php endif; ?>> Methode </option>
						                            <option value="3" <?php if($ppq->kategori_ppq == '3'): ?> selected <?php endif; ?>> Material </option>
						                            <option value="4" <?php if($ppq->kategori_ppq == '4'): ?> selected <?php endif; ?>> Environment </option>
						                            <option value="5" <?php if($ppq->kategori_ppq == '5'): ?> selected <?php endif; ?>> Sortasi </option>
						                            <option value="6" <?php if($ppq->kategori_ppq == '6'): ?> selected <?php endif; ?>> Miss Handling </option>
						                            <option value="7" <?php if($ppq->kategori_ppq == '7'): ?> selected <?php endif; ?>> Lain-lain </option>
						                        </select>
						                    </div>
						                    
						                    <div class="form-group">
						                        <label for="">PIC Input: </label>
						                        <input type="text" class="form-control" value="<?php echo e($ppq->userCreate->employee->fullname); ?>" readonly>
						                    </div>
						                    <div class="form-group">
						                        <?php if(is_null($ppq->palets)): ?>
						                        	<button class="btn btn-primary form-control" onclick="update_draft_ppq('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>','<?php echo e($ppq->nomor_ppq); ?>')">Update Draft PPQ</button>
						                        <?php else: ?>
						                        	<button class="btn btn-primary form-control" onclick="proses_draft_ppq('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>','<?php echo e($ppq->nomor_ppq); ?>')">Proses PPQ</button>
						                        <?php endif; ?>

						                    </div>
						                </div>
						            </div>
						      	</div>
						    </div>
					  	</div>
			  		</div>
			  	</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	<?php else: ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-header bg-dark">
						<strong>List Draft PPQ <?php echo e($rpdFillingHead->product->product_name); ?> <?php echo e($rpdFillingHead->woNumbers[0]->production_realisation_date); ?></strong>
					</div>
					<div class="card-body">	
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h4 class="text-center text-danger">
									Tidak Ada Draft PPQ
								</h4>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
								<div class="form-group">
									<button class="btn btn-outline-secondary" onclick="window.location.href='/rollie/rpd-filling/form/list-ppq-pi/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rpdFillingHead->id)); ?>'">Go To List Done PPQ PI <?php echo e($rpdFillingHead->product->product_name); ?></button>
									<button class="btn btn-outline-primary" onclick="window.location.href='/rollie/rpd-filling/form/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rpdFillingHead->id)); ?>'">Back To RPD Filling Product <?php echo e($rpdFillingHead->product->product_name); ?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/rpd_filling/form-draft-ppq.blade.php ENDPATH**/ ?>