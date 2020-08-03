
<?php $__env->startSection('title'); ?>
    Kelola Menu | Tambah Akses Menu
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-general-setting'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-menu-permissions'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Tambah Hak Akses Menu
                </div>
                <div class="card-body">
                    <form action="tambah-akses" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="menu_permission_user"> Pilih Pengguna </label>
                                    <select name="menu_permission_user[]" id="menu_permission_user" class="form-control select2 select" onchange="changeApplicationMenuPermission()" multiple>
                                        <option value="0" selected disabled>Pilih Pengguna</option>
                                        <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt('all')); ?>">Semua Pengguna</option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($user->id)); ?>"><?php echo e($user->employee->fullname); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <input type="hidden" id="permission_user_id">
                                <div class="form-group">
                                    <label for="menu_permission_application"> Pilih Aplikasi </label>
                                    <select name="menu_permission_application" id="menu_permission_application" class="select custom-select form-control select2" onchange="changeApplicationMenuPermission()">
                                        <option value="0" selected disabled>Pilih Aplikasi</option>
                                        <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($application->id)); ?>"><?php echo e($application->application_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 div col-md-8 col-sm-8">
                                <table class="table table-bordered" id="add-menu-permission-table">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>View</th>
                                            <th>Create</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add-menu-permission-table-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col-lg-8 order-last hidden" id="button_submit">
                                <div class="form-group">
                                    <input type="submit" value="Tambah Hak Akses" class="btn btn-primary form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_menu/add_menu_permission_form.blade.php ENDPATH**/ ?>