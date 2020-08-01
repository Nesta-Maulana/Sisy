
<?php $__env->startSection('title'); ?>
    Data Flowmeter Usage
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-master-data'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-master-data-manage-flowmeter-usages'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row" id="form-manage-flowmeter-usage">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <form action="kelola-flowmeter-usage" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Flowmeter Penggunaan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="flowmeter_name">Nama Flowmeter</label>
                                    <input type="text" name="flowmeter_name" id="flowmeter_name" class="form-control" autocomplete="off">
                                    <input type="hidden" name="flowmeter_id" id="flowmeter_id" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="flowmeter_code">Kode Flowmeter</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">FU-</span>
                                        </div>
                                        <input type="text" name="flowmeter_code" id="flowmeter_code" class="form-control text-uppercase" autocomplete="off">
                                    </div>
                                    <input type="hidden" name="flowmeter_id" id="flowmeter_id" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="flowmeter_workcenter_id">Workcenter Flowmeter</label>
                                    <select name="flowmeter_workcenter_id" id="flowmeter_workcenter_id" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Workcenter Flowmeter-- </option>
                                        <?php $__currentLoopData = $flowmeterWorkcenters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterWorkcenter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterWorkcenter->id)); ?>"><?php echo e($flowmeterWorkcenter->flowmeterCategory->flowmeter_category.' - '.$flowmeterWorkcenter->flowmeter_workcenter); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <style>
                                .select2-container .select2-selection--single
                                {
                                    height: 38px;
                                }
                                .select2-container--default .select2-selection--single .select2-selection__rendered
                                {
                                    line-height: 35px;
                                }
                            </style>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="flowmeter_formula_id">Kode Rumus Penggunaan</label>
                                    <select name="flowmeter_formula_id" id="flowmeter_formula_id" class="form-control select2" required>
                                        <option value="id" selected disabled>-- Pilih Rumus Penggunaan -- </option>
                                        <?php $__currentLoopData = $flowmeterFormulas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterFormula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterFormula->id)); ?>"><?php echo e($flowmeterFormula->formula_code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Status  Flowmeter Usage</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Status  Flowmeter-- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <div class="row justify-content-end">
                                        <div class="col-lg col-md col-sm col">
                                            <button class="btn btn-primary form-control" id="button_simpan">Tambahkan </button>
                                        </div>
                                        <div class="col-lg col-md col-sm col hidden" id="button_update">
                                            <button class="btn btn-primary form-control">Ubah Data </button>
                                        </div>
                                        
                                        <div class="col-lg col-md col-sm col hidden" id="button_batal">
                                            <a class="btn btn-outline-secondary form-control" onclick="window.location.href=''">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-2" id="table-manage-flowmeter-usage">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Flowmeter Usage
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <table class="table table-bordered" id="flowmeter-categories-table" >
                               <thead >
                                     <tr>
                                         <th style="width: 50px">#</th>
                                         <th style="width: 200px">Nama Flowmeter</th>
                                         <th style="width: 200px">Satuan Flowmeter</th>
                                         <th style="width: 200px">Workcenter Flowmeter</th>
                                         <th style="width: 200px">Lokasi Flowmeter</th>
                                         <th style="width: 200px">Status</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_flowmeter_usage/dashboard.blade.php ENDPATH**/ ?>