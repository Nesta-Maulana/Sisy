
<?php $__env->startSection('title'); ?>
Monitoring Air
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-pengamatan'); ?>
    menu-open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active-emon-monitoring-water'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card ">
					<div class="card-header bg-dark">
						Lokasi Pengamatan - <?php echo e($flowmeters[0]->flowmeterLocation->flowmeter_location); ?>

					</div>
					<div class="card-body">
						<?php
							$row = 0;
						?>
						<div class="row">
							<?php $__currentLoopData = $flowmeters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-lg-6 col-md-6 col-sm-6" style="padding: 3px;">
									<div class="card">
										<div class="card-header bg-white"><?php echo e($flowmeter->flowmeter_name); ?>

										</div>
										<div class="card-footer bg-primary" style="padding:0.35rem .85rem;">
											<?php
												
											?>
											<div class="form-group mt-2">
												<div class="input-group mb-3">
												  	<input input type="number" min="0" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47"  class="form-control" style="font-size: 25px;" placeholder="Pengamatan" id="monitoring_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
												  	<div class="input-group-append">
												    	<button class="btn btn-outline-light" type="button" id="button_save_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
												    		<i style="font-size: 25px;" class="fas fa-clipboard-check" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
												    	</button>
												    	<button class="btn btn-outline-light btn-info hidden" type="button" id="button_edit_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
												    		<i style="font-size: 25px;" class="fas fa-edit" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
												    	</button>
												    	<button class="btn btn-outline-light btn-primary hidden" type="button" id="button_update_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
												    		<i style="font-size: 25px;" class="fas fa-save" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
												    	</button>
												    	<button class="btn btn-outline-light btn-secondary hidden" type="button" id="button_cancel_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
												    		<i style="font-size: 25px;" class="fas fa-window-close" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
												    	</button>
												  	</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
									$row++;
								?>
								<?php if($row == 2): ?>
									</div>
									<div class="row mt-2">

								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>	
					</div>
				</div>
			</div>
		</div>	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/energy_monitoring/monitoring_air/form.blade.php ENDPATH**/ ?>