
<?php $__env->startSection('title'); ?>
    Hak Akses Lokasi Flowmeter
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-master-data'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-master-data-manage-flowmeter-location-permissions'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                Hak Akses Lokasi Pengamatan
                <div class="float-right <?php echo e(Session::get('tambah')); ?>">
                    <button class="btn btn-outline-primary" onclick="document.location.href='kelola-flowmeter-location-permission/tambah-akses'">Tambah Akses Lokasi</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="manage-menu-permission-table" style="width: 100%"> 
                    <thead class="dark">
                        <tr>
                            <th>Fullname</th>
                            <th>Flowmeter Kategori</th>
                            <th>Flowmeter Location</th>
                            <th>Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $flowmeterLocationPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterLocationPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($flowmeterLocationPermission->user->employee->fullname); ?></td>
                                <td><?php echo e($flowmeterLocationPermission->flowmeterLocation->flowmeterCategory->flowmeter_category); ?></td>
                                <td><?php echo e($flowmeterLocationPermission->flowmeterLocation->flowmeter_location); ?></td>
                                <td>
                                <select class="form-control" name="is_allow" id="is_allow_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocationPermission->id)); ?>" onchange="changeAccessFlowmeterLocation('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocationPermission->id)); ?>')">
                                       <option value="0" <?php if($flowmeterLocationPermission->is_allow == '0'): ?> selected <?php endif; ?>>Denied</option>
                                       <option value="1" <?php if($flowmeterLocationPermission->is_allow == '1'): ?> selected <?php endif; ?>>Allowed</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="width: 200px" class="filter-search"></td>
                            <td style="width: 200px" class="filter-search"></td>
                            <td  style="width: 200px" class="filter-search"></td>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_flowmeter_location_permission/dashboard.blade.php ENDPATH**/ ?>