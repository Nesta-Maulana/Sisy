
<?php $__env->startSection('title'); ?>
    Data Workcenter Flowmeter
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-master-data'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu-open-emon'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-master-data-manage-flowmeter-workcenters'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3" id="form-workcenter">
            <form action="kelola-flowmeter-workcenter" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Workcenter Flowmeter
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="flowmeter_category_id">Kategori Flowmeter</label>
                                    <select name="flowmeter_category_id" id="flowmeter_category_id" class="form-control">
                                        <option value="0" disabled selected>-- Harap Pilih Kategori Flowmeter --</option>
                                        <?php $__currentLoopData = $flowmeterCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterCategory->id)); ?>"><?php echo e($flowmeterCategory->flowmeter_category); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="flowmeter_workcenter">Workcenter Flowmeter</label>
                                    <input type="text" name="flowmeter_workcenter" id="flowmeter_workcenter" class="form-control" autocomplete="off">
                                    <input type="hidden" name="flowmeter_workcenter_id" id="flowmeter_workcenter_id" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status Workcenter</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Status Workcenter -- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" id="button_simpan">
                                <button class="btn btn-primary form-control">Tambahkan Workcenter</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_update">
                                <button class="btn btn-primary form-control">Ubah Data Workcenter</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_batal">
                                <a class="btn btn-outline-secondary form-control" onclick="window.location.href=''">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9" id="table-workcenter">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Workcenter Flowmeter
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <table class="table table-bordered" id="flowmeter-categories-table" width="100%">
                                <thead >
                                    <tr>
                                        <th>#</th>
                                        <th>Kategori Flowmeter</th>
                                        <th>Workcenter Flowmeter</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $p = 1;
                                    ?>
                                    <?php $__currentLoopData = $flowmeterWorkcenters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterWorkcenter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($p++); ?></td>
                                        <td><?php echo e($flowmeterWorkcenter->flowmeterCategory->flowmeter_category); ?></td>
                                        <td><?php echo e($flowmeterWorkcenter->flowmeter_workcenter); ?></td>
                                        <td>
                                            <?php if($flowmeterWorkcenter->is_active == '0'): ?>
                                                Inactive
                                            <?php else: ?>
                                                Active
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="editFlowmeterWorkcenter('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterWorkcenter->id)); ?>')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_flowmeter_workcenter/dashboard.blade.php ENDPATH**/ ?>