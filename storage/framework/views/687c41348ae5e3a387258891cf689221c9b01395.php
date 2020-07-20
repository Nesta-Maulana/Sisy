
<?php $__env->startSection('title'); ?>
    Data Flowmeter
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-master-data'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-master-data-manage-flowmeters'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row" id="form-manage-flowmeter">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <form action="kelola-flowmeter" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Flowmeter
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
                                    <label for="flowmeter_unit_id">Satuan Flowmeter</label>
                                    <select name="flowmeter_unit_id" id="flowmeter_unit_id" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Satuan Flowmeter-- </option>
                                        <?php $__currentLoopData = $flowmeterUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterUnit->id)); ?>"><?php echo e($flowmeterUnit->flowmeter_unit); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
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
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="flowmeter_location_id">Lokasi Flowmeter</label>
                                    <select name="flowmeter_location_id" id="flowmeter_location_id" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Lokasi Flowmeter-- </option>
                                        <?php $__currentLoopData = $flowmeterLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterLocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocation->id)); ?>"><?php echo e($flowmeterLocation->flowmeter_location); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kategori_pencatatan">Kategori Pencatatan</label>
                                    <select name="kategori_pencatatan" id="kategori_pencatatan" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Kategori Pencatatan -- </option>
                                        <option value="0" >Perhari</option>
                                        <option value="1" >Pershift</option>
                                        <option value="2" >Perjam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Status  Flowmeter</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Status  Flowmeter-- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end" >
                            <div class="col-6">
                                <button class="btn btn-primary form-control" id="button_simpan">Tambahkan </button>
                            </div>
                            <div class="col-3 hidden" id="button_update">
                                <button class="btn btn-primary form-control">Ubah Data </button>
                            </div>
                            
                            <div class="col-3 hidden" id="button_batal">
                                <a class="btn btn-outline-secondary form-control" onclick="window.location.href=''">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-2" id="table-manage-flowmeter">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Flowmeter
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
                                     <?php $__currentLoopData = $flowmeters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <tr>
                                         <td>
                                             <button class="btn btn-outline-primary" onclick="editFlowmeter('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>')">
                                                 <i class="fa fa-edit"></i>
                                             </button>
                                         </td>
                                         <td><?php echo e($flowmeter->flowmeter_name); ?></td>
                                         <td><?php echo e($flowmeter->flowmeterUnit->flowmeter_unit); ?></td>
                                         <td><?php echo e($flowmeter->flowmeterWorkcenter->flowmeter_workcenter); ?></td>
                                         <td><?php echo e($flowmeter->flowmeterLocation->flowmeter_location); ?></td>
                                         <td>
                                             <?php if($flowmeter->is_active == '0'): ?>
                                                 Inactive
                                             <?php else: ?>
                                                 Active
                                             <?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_flowmeter/dashboard.blade.php ENDPATH**/ ?>