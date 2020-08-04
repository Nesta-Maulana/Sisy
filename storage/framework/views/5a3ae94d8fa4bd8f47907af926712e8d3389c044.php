
<?php $__env->startSection('title'); ?>
    Data Kategori Flowmeter
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-master-data'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu-open-emon'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-master-data-manage-flowmeter-categories'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <form action="kelola-kategori-flowmeter" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" id="flowmeter_category_id" name="flowmeter_category_id" value="">
                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Kategori Flowmeter
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="flowmeter_category">Kategori Flowmeter</label>
                                    <input id="flowmeter_category" class="form-control" type="text" name="flowmeter_category" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="is_active">Status Kategori Flowmeter</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Status Mesin Filling -- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" id="button_simpan">
                                <button class="btn btn-primary form-control">Tambahkan Kategori</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_update">
                                <button class="btn btn-primary form-control">Ubah Data Kategori</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_batal">
                                <button class="btn btn-outline-secondary form-control">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-lg-7 col-md-7 col-sm-7">
            <div class="card">
                <div class="card-header bg-dark">
                    List Kategori Flowmeter
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="flowmeter-categories-table" width="100%">
                        <thead >
                            <tr>
                                <th>#</th>
                                <th>Kategori Flowmeter</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                            ?>
                            <?php $__currentLoopData = $flowmeterCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeterCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($flowmeterCategory->flowmeter_category); ?></td>
                                    <td>
                                        <?php if($flowmeterCategory->is_active): ?>
                                            Active
                                        <?php else: ?>
                                            Inactive
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-primary" onclick="editFlowmeterCategory('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeterCategory->id)); ?>')">
                                            <i class="fa fa-pencil"></i></button>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_flowmeter_categories/dashboard.blade.php ENDPATH**/ ?>