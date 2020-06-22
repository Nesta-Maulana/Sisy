
<?php $__env->startSection('title'); ?>
    Kelola Hak Akses Aplikasi
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-pengaturan-aplikasi'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-application-permissions'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form action="tambah-akses" method="POST">
    <?php echo e(csrf_field()); ?>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Tambah Akses Aplikasi
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="user_id">Text</label>
                                <select name="user_id[]" id="user_id" class="form-control select2 select" onchange="getApplicationPermission()" multiple>
                                    <option value="0" selected disabled>Pilih Pengguna</option>
                                    <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt('all')); ?>">Semua Pengguna</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($user->id)); ?>"><?php echo e($user->employee->fullname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <table class="table table-bordered" id="add-application-permission-table">
                                    <thead>
                                        <tr>
                                            <th>Application</th>
                                            <th>Access</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add-application-permission-table-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 order-last hidden" id="button_submit">
                            <div class="form-group">
                                <input type="submit" value="Tambah Hak Akses" class="btn btn-primary form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_application/form-manage-permissions.blade.php ENDPATH**/ ?>