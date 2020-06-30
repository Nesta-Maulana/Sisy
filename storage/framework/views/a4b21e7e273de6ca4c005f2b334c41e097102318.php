
<?php $__env->startSection('title'); ?>
    Home
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-emon-home-operator'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php $__currentLoopData = $menus->where('id','70')->first()->childMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $monitoring): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php switch($monitoring->menu_name):
                            case ('Monitoring Gas'): ?>
                                <div class="col-lg col-md col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-body btn bg-danger  text-center" onclick="window.location.href='<?php echo e(route($monitoring->menu_route)); ?>'">
                                            <h1 class="d-flex justify-content-center">
                                                <i class="fas fa-fire text-white"></i> <br>
                                            </h1>
                                            <h4 class="text-white"><?php echo e($monitoring->menu_name); ?></h4>
                                        </div>
                                    </div>
                                </div>    
                            <?php break; ?>
                            <?php case ('Monitoring Air'): ?>
                                <div class="col-lg col-md col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-body btn bg-primary text-center" onclick="window.location.href='<?php echo e(route($monitoring->menu_route)); ?>'">
                                            <h1 class="d-flex justify-content-center">
                                                <i class="fas fa-tint text-white"></i> <br>
                                            </h1>
                                            <h4 class="text-white"><?php echo e($monitoring->menu_name); ?></h4>
                                        </div>
                                    </div>
                                </div>    
                            <?php break; ?>

                            <?php case ('Monitoring Listrik'): ?>
                                <div class="col-lg col-md col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-body btn bg-warning text-center" onclick="window.location.href='<?php echo e(route($monitoring->menu_route)); ?>'">
                                            <h1 class="d-flex justify-content-center">
                                                <i class="fas fa-bolt text-white"></i> <br>
                                            </h1>
                                            <h4 class="text-white"><?php echo e($monitoring->menu_name); ?></h4>
                                        </div>
                                    </div>
                                </div>    
                            <?php break; ?>
                        <?php endswitch; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg col-md col-sm-12 mt-2">
                        <div class="card">
                            <div class="card-body btn bg-info text-center" onclick="window.location.href='<?php echo e(route($monitoring->menu_route)); ?>'">
                                <h1 class="d-flex justify-content-center">
                                    <i class="fas fa-database text-white"></i> <br>
                                </h1>
                                <h4 class="text-white">Riwayat Pengamatan</h4>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/energy_monitoring/home/home-operator.blade.php ENDPATH**/ ?>