
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
			<div class="card">
				<div class="card-header bg-primary">
					Lokasi Monitoring Air
				</div>
				<div class="card-body">
					<?php
						$row = 0
					?>
					<div class="row">
						<?php $__currentLoopData = $flowmeterLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterLocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-lg-6 div col-md-6 col-sm-6">
								<div class="card bg-primary text-center text-white">
									<div class="card-body" onclick="window.location.href='monitoring-air/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocation->id)); ?>'">
										<h3>
											<i class="fas fa-map-marker-alt"></i>&nbsp; <?php echo e($flowmeterLocation->flowmeter_location); ?>

										</h3>
									</div>
								</div>
							</div>
							<?php
								$row++;
							?>
							<?php if($row == 2): ?>
								</div>
								<div class="row mt-2">
								<?php
									$row = 0;
								?>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</di>
	</div>   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/energy_monitoring/monitoring_air/dashboard.blade.php ENDPATH**/ ?>