
<?php $__env->startSection('title'); ?>
    Kelola Menu
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
                    Tambah Hak Akses Lokasi Pengamatan
                </div>
                <div class="card-body">
                    <form action="tambah-akses" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="location_permission_user"> Pilih Pengguna </label>
                                    <select name="location_permission_user[]" id="location_permission_user" class="form-control select2 select" data-placeholder="Pilih Pengguna" multiple >
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt('all')); ?>">Semua Pengguna</option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($user->id)); ?>"><?php echo e($user->employee->fullname); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <input type="hidden" id="permission_user_id">
                                <div class="form-group">
                                    <label for="flowmeter_category_id"> Pilih Kategori Flowmeter </label>
                                    <select name="flowmeter_category_id" id="flowmeter_category_id" class="select custom-select form-control select2"  data-placeholder="Kategori Flowmeter" multiple>
                                        <?php $__currentLoopData = $flowmeterCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterCategory->id)); ?>"><?php echo e($flowmeterCategory->flowmeter_category); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <a class="btn btn-outline-primary form-control" onclick="changeLocationPermissions()">Filter Akses</a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <table class="table table-bordered" id="add-location-permission-table" style="min-width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Location</th>
                                                    <th>Access</th>
                                                </tr>
                                            </thead>
                                            <tbody id="add-location-permission-table-body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-last hidden" id="button_submit">
                                        <div class="form-group">
                                            <input type="submit" value="Tambah Hak Akses" class="btn btn-primary form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startSection('extract-plugin-footer'); ?>
        <script>
            function selectAll(select_multiple_id) 
            {
                $('#'+select_multiple_id+' option').prop('selected', true);
                $('#button_select_all_'+select_multiple_id).attr('onclick','unselectAll("'+select_multiple_id+'")');
                document.getElementById('button_select_all_'+select_multiple_id).innerHTML = "Unselect All"
            }
            
            function unselectAll(select_multiple_id) 
            {
                $('#'+select_multiple_id+' option').prop('selected', false);
                $('#button_select_all_'+select_multiple_id).attr('onclick','selectAll("'+select_multiple_id+'")');
                document.getElementById('button_select_all_'+select_multiple_id).innerHTML = "Select All"
            }
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_flowmeter_location_permission/form.blade.php ENDPATH**/ ?>