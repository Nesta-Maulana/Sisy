
<?php $__env->startSection('title'); ?>
    Data Satuan Flowmeter
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-master-data'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-master-data-manage-flowmeter-units'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <form action="kelola-flowmeter-unit" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Satuan Flowmeter
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="flowmeter_unit">Satuan Flowmeter</label>
                                    <input type="text" name="flowmeter_unit" id="flowmeter_unit" class="form-control">
                                    <input type="hidden" name="flowmeter_unit_id" id="flowmeter_unit_id" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status Satuan Flowmeter</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Status Satuan Flowmeter-- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" id="button_simpan">
                                <button class="btn btn-primary form-control">Tambahkan Satuan</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_update">
                                <button class="btn btn-primary form-control">Ubah Data Satuan</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_batal">
                                <a class="btn btn-outline-secondary form-control" onclick="window.location.href=''">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7">
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
                                        <th>Satuan Flowmeter</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $p = 1;
                                    ?>
                                    <?php $__currentLoopData = $flowmeterUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($p++); ?></td>
                                        <td><?php echo e($flowmeterUnit->flowmeter_unit); ?></td>
                                        <td>
                                            <?php if($flowmeterUnit->is_active == '0'): ?>
                                                Inactive
                                            <?php else: ?>
                                                Active
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="editFlowmeterUnit('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterUnit->id)); ?>')">
                                                Ubah Data
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_flowmeter_unit/dashboard.blade.php ENDPATH**/ ?>