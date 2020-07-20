
<?php $__env->startSection('title'); ?>
    Data Rumus Flowmeter
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-master-data'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-master-data-manage-flowmeter-formulas'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Kelola Rumus Flowmeter
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                            <form action="" method="post">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <label for="flowmeter_formula_code">Kode Rumus</label>
                                    <input type="text" class="form-control text-uppercase" name="flowmeter_formula_code" id="flowmeter_formula_code" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="flowmeter_formula"><strong>Rumus Flowmeter</strong></label>
                                    <textarea name="flowmeter_formula" id="flowmeter_formula" cols="30" rows="5" class="form-control text-uppercase"></textarea>
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
                                    <div class="row">
                                        <div class="col-lg col-md col-sm col ">
                                            <button class="btn btn-primary form-control">
                                                <i class="fas fa-save"></i>        
                                            </button>
                                        </div>
                                        <div class="col-lg col-md col-sm col hidden">
                                            <button class="btn btn-primary form-control">
                                                <i class="fas fa-edit"></i>        
                                            </button>
                                        </div>
                                        <div class="col-lg col-md col-sm col hidden">
                                            <button class="btn btn-secondary form-control">
                                                <i class="fas fa-window-close"></i>        
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-secondary bg-warning">* Apabila ingin menggunakan rumus default Penggunaan Hari ini = Angka meteran hari ini - angka meteran hari kemarin. Isi text box dengan strip ( - ) </small>
                                <br><small class="text-white bg-danger">* Harap perhatikan operator aritmatika yang digunakan dan kode formula yang digunakan </small>
                            </form>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                            <table class="table table-bordered" id="list-formula-flowmeter">
                                <thead>
                                    <tr>
                                        <th style="width: 130px">Kode Flowmeter</th>
                                        <th style="width: 400px">Nama Flowmeter</th>
                                        <th style="width: 180px">Workcenter Flowmeter</th>
                                        <th style="width: 180px">Kategori Flowmeter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_flowmeter_formula/dashboard.blade.php ENDPATH**/ ?>