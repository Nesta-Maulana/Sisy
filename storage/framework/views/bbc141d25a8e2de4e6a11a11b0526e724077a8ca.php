
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
						<div class="row no-gutters">
							<div class="col-lg-3 col-md-3 col-sm-3 col-3">
								Lokasi Pengamatan -
							</div> 
							<div class="col-lg-9 col-md-9 col-sm-9 col-9">
								<select name="flowmeter_location" id="flowmeter_location" class="form-control">
									<option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeters[0]->flowmeterLocation->id)); ?>"><?php echo e($flowmeters[0]->flowmeterLocation->flowmeter_location); ?></option>
								</select>
							</div>
						</div>

					</div>
					<div class="card-body">
						<?php
							$row = 0;
						?>
						<div class="row">
							<?php $__currentLoopData = $flowmeters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-lg-4 col-md-4 col-sm-6 col-12 mt-2">
									<div class="card">
										<div class="card-header text-center">
											<strong style="font-size: 14px"> <?php echo e($flowmeter->flowmeter_name); ?></strong>
										</div>
										<div class="card-body align-items-stretch no-gutters" style="padding:0px">
											<input type="text" name="" id="" class="form-control <?php if($flowmeter): ?> bg-danger <?php endif; ?>" style="font-size: 35px" >
										</div>
										<div class="card-footer" style="padding:0px ">
											<div class="row no-gutters">
												<div class="col-lg-12 col-md-12 col-sm-12 col-12">
													<button class=" btn btn-primary form-control" type="button" id="button_save_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
														<i style="font-size: 25px;" class="fas fa-save" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
													</button>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 col-12 hidden" id="button_edit_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
													<button class="btn btn-outline-primary form-control" type="button">
														<i style="font-size: 25px;" class="fas fa-edit" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
													</button>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-6 " id="button_update_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
													<button class="btn btn-primary form-control hidden" type="button" >
														<i style="font-size: 25px;" class="fas fa-save" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
													</button>
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-6 col-6 " id="button_cancel_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
													<button class="btn btn-outline-secondary form-control hidden" type="button">
														<i style="font-size: 25px;" class="fas fa-window-close" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>	
					</div>
				</div>
			</div>
		</div>	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/energy_monitoring/monitoring_air/form.blade.php ENDPATH**/ ?>