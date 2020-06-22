
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
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header ">
                    <h5>
                        Hak Akses Aplikasi 
                        <div class="pull-right">
                            <button class="btn btn-outline-primary" onclick="document.location.href='kelola-hak-akses-aplikasi/tambah-akses'">Tambah Akses Aplikasi</button>
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="manage-application-permission-table"> 
                        <thead class="dark">
                            <tr>
                                <th>Fullname</th>
                                <th >Aplikasi</th>
                                <th  >Access?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $user->applicationPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicationPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($user->employee->fullname); ?></td>
                                        <td><?php echo e($applicationPermission->application->application_name); ?></td>
                                        <td>
                                            <select class="form-control"  name="application_permission_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($applicationPermission->id)); ?>" id="application_permission_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($applicationPermission->id)); ?>" onchange="changeApplicationPermission('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($applicationPermission->id)); ?>')">
                                                <option value="0" <?php if($applicationPermission->is_active == '0'): ?> selected <?php endif; ?>>Denied</option>
                                                <option value="1" <?php if($applicationPermission->is_active == '1'): ?> selected <?php endif; ?>>Allowed</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td  class="filter-search">Fullname</td>
                                <td  class="filter-search">Aplikasi</td>
                                <td >Access?</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_application/dashboard-manage-permissions.blade.php ENDPATH**/ ?>