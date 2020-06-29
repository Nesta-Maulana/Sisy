
<?php $__env->startSection('title'); ?>
    Kelola Menu
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-pengaturan-aplikasi'); ?> 
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
                Hak Akses Menu
                <div class="float-right <?php echo e(Session::get('tambah')); ?>">
                    <button class="btn btn-outline-primary" onclick="document.location.href='kelola-hak-akses-menu/tambah-akses'">Tambah Akses Menu</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="manage-menu-permission-table" style="width: 100%"> 
                    <thead class="dark">
                        <tr>
                            <th style="width: 200px">Fullname</th>
                            <th  style="width: 200px">Aplikasi</th>
                            <th  style="width: 200px">Menu</th>
                            <th  style="width: 200px">Read</th>
                            <th  style="width: 200px">Create</th>
                            <th  style="width: 200px">Update</th>
                            <th  style="width: 200px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $user->menuPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(is_null($menuPermission->menu)): ?>
                                <?php echo e(dd($menuPermission)); ?>

                            <?php endif; ?>
                                <tr>
                                    <td><?php echo e($user->employee->fullname); ?></td>
                                    <td><?php echo e($menuPermission->menu->application->application_name); ?></td>
                                    <td><?php echo e($menuPermission->menu->menu_name); ?></td>
                                    <td>
                                        <select class="form-control" name="permission_view_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>" id="permission_view_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>" onchange="changePermission('view','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>')">
                                            <option value="0" <?php if(!$menuPermission->view): ?> selected <?php endif; ?>>Denied</option>
                                            <option value="1" <?php if($menuPermission->view): ?> selected <?php endif; ?>>Allowed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="permission_create_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>" id="permission_create_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>" onchange="changePermission('create','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>')">
                                            <option value="0" <?php if(!$menuPermission->create): ?> selected <?php endif; ?>>Denied</option>
                                            <option value="1" <?php if($menuPermission->create): ?> selected <?php endif; ?>>Allowed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="permission_edit_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>" id="permission_edit_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>" onchange="changePermission('edit','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>')">
                                            <option value="0" <?php if(!$menuPermission->edit): ?> selected <?php endif; ?>>Denied</option>
                                            <option value="1" <?php if($menuPermission->edit): ?> selected <?php endif; ?>>Allowed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="permission_delete_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>" id="permission_delete_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>" onchange="changePermission('delete','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id)); ?>')">
                                            <option value="0" <?php if(!$menuPermission->delete): ?> selected <?php endif; ?>>Denied</option>
                                            <option value="1" <?php if($menuPermission->delete): ?> selected <?php endif; ?>>Allowed</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td  style="width: 200px" class="filter-search">Fullname</td>
                            <td  style="width: 200px" class="filter-search">Aplikasi</td>
                            <td  style="width: 200px">Menu</td>
                            <td  style="width: 200px">Read</td>
                            <td  style="width: 200px">Create</td>
                            <td  style="width: 200px">Update</td>
                            <td  style="width: 200px">Delete</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_menu/manage_menu_permission.blade.php ENDPATH**/ ?>