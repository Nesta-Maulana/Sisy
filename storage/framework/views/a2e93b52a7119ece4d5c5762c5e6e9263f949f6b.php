
<?php $__env->startSection('title','Sisy | Akses Aplikasi'); ?>
<?php $__env->startSection('page_title','List Aplikasi'); ?>
<?php $__env->startSection('menu-home','active'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
                $lihat = 0;
            ?>
            <?php $__currentLoopData = Auth::user()->applicationPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($application_permission->application->is_active == true && $application_permission->is_active == true): ?>
                    <?php
                        $lihat++;               
                    ?>         
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($lihat > 0): ?>
                <div class="row">
                    <?php $__currentLoopData = Auth::user()->applicationPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($application_permission->application->is_active == true && $application_permission->is_active==true): ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
                                <div class="card bg-transparent text-center" style="min-height: 250px">
                                    <div class="card-header bg-primary text-white ">
                                        <?php echo e($application_permission->application->application_name); ?>

                                    </div>
                                    <div class="card-body text-justify bg-dark ">
                                        <?php echo e($application_permission->application->application_description); ?>

                                    </div>
                                    <div class="card-footer bg-primary btn" onclick="document.location.href='<?php echo e($application_permission->application->application_link); ?>'">
                                        <a href="<?php echo e($application_permission->application->application_link); ?>" class="font-weight-bolder">Pergi Ke Aplikasi >> </a>
                                    </div>
                                </div>  
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-warning">Anda tidak memiliki hak akses ke aplikasi apapun didalam Portal SISY</h2>
                        <h3 class="text-white">Untuk request hak akses klik tombol dibawah ini</h3>
                        <a href="halaman-help" class="btn btn-danger text-white col-lg-6"><h4>Request Hak Akses </h4></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/auth/home.blade.php ENDPATH**/ ?>