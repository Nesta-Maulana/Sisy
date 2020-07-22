
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
								<select name="flowmeter_location" id="flowmeter_location" class="form-control" onchange="document.location.href=this.value">
									<?php $__currentLoopData = $flowmeterLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterLocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocation->id)); ?>" <?php if($flowmeterLocation->id == $flowmeters[0]->flowmeterLocation->id): ?> selected <?php endif; ?>><?php echo e($flowmeterLocation->flowmeter_location); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								</select>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php
							$row	 	= 0;
							$today 		= date('Y-m-d');
						?>
						<div class="row">
							<?php $__currentLoopData = $flowmeters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php
									$energyMonitoringToday  = $flowmeter->energyMonitorings->where('monitoring_date',$today)->first();
									if(!is_null($energyMonitoringToday))
									{
										$monitoring_value 	= $energyMonitoringToday->monitoring_value;
									}
									else
									{
										$monitoring_value ="";
									}
								?>
								<div class="col-lg-4 col-md-4 col-sm-6 col-12 mt-2">
									<div class="card">
										<div class="card-header text-center" style="padding-left: 0; padding-right: 0;">
											<strong style="font-size: 14px" id="flowmeter_name_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"> <?php echo e($flowmeter->flowmeter_name); ?></strong>
										</div>
										<div class="card-body align-items-stretch no-gutters" style="padding:0px">
										  	<input input type="number" min="0" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47"  <?php if(is_null($energyMonitoringToday)): ?> class="form-control bg-danger" <?php else: ?> class="form-control bg-success" readonly="true" <?php endif; ?> style="font-size: 25px;" id="monitoring_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>" value="<?php echo e($monitoring_value); ?>">
										  	<input type="number" class="hidden" id="monitoring_lama_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
										</div>

										<div class="card-footer" style="padding:0px ">
											<div class="row no-gutters">
												<div class="col-lg-12 col-md-12 col-sm-12 col-12 <?php if(!is_null($energyMonitoringToday)): ?>
														hidden
													<?php endif; ?>" id="button_save_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
													<button class=" btn btn-primary form-control " type="button"  onclick="inputMonitoring('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>')">
														<i style="font-size: 25px;" class="fas fa-save" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
													</button>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 col-12 <?php if(is_null($energyMonitoringToday)): ?>
														hidden
													<?php endif; ?>" id="button_edit_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
													<button  onclick="editMonitoringData('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>')" class="btn btn-outline-primary form-control" type="button">
														<i style="font-size: 25px;" class="fas fa-edit" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
													</button>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-6 hidden" id="button_update_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
													<button onclick="updateMonitoringData('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>')" class="btn btn-primary form-control" type="button" >
														<i style="font-size: 25px;" class="fas fa-save" id="icon_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>"></i>
													</button>
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-6 col-6 hidden" id="button_cancel_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>">
													<button class="btn btn-outline-secondary form-control" type="button" onclick="cancelEditMonitoringData('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>')">
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