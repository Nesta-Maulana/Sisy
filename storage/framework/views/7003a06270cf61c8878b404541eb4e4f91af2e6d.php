
<?php $__env->startSection('title'); ?>
    Report Rekapitulasi Data Filling
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-report'); ?>
    menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-rollie-reports-rpd-filling'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
   <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="card">
               <div class="card-header bg-dark">
                   Report RPD Filling
               </div>
               <div class="card-body">
                   <div class="row">
                       <div class="col-lg-6 col-md-6 col-sm-6">
                           <div class="form-group">
                                <label>Filter Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="filter_tanggal">
                                </div>
                            </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extract-plugin-footer'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('datetime-picker/css/daterangepicker.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/moment2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('datetime-picker/js/daterangepicker.js')); ?>"></script>
    <script>
        $('#filter_tanggal').daterangepicker();
    </script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/reports/rpd_filling/dashboard.blade.php ENDPATH**/ ?>