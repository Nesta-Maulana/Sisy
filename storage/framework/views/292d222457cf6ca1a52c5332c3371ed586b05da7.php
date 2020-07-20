
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
                            <th>Flowmeter Workcenter</th>
                            <th>Flowmeter Location</th>
                            <th>Akses</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td  style="width: 200px" class="filter-search">Fullname</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_flowmeter_location_permission/dashboard.blade.php ENDPATH**/ ?>