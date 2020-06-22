
<?php $__env->startSection('title'); ?>
    Data Produk
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-master-data'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-master-data-manage-products'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Kelola Data Produk
                </div>
                <div class="card-body">
                    <form action="kelola-produk" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input  type="hidden" class="form-control" id="product_id" name="product_id">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="product_name">Nama Produk</label>
                                    <input required="true" autocomplete="off" type="text" class="form-control" id="product_name" name="product_name">
                                </div>
                                <div class="form-group">
                                    <label for="oracle_code">Kode Oracle</label>
                                    <input required="true" autocomplete="off" type="text" class="form-control" id="oracle_code" name="oracle_code">
                                </div>
                                <div class="form-group">
                                    <label for="subbrand_id">Brand</label>
                                    <select name="subbrand_id" id="subbrand_id" class="form-control">
                                        <option value="id" selected disabled>-- Pilih Brand -- </option>
                                        <?php $__currentLoopData = $subbrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subbrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($subbrand->id)); ?>"><?php echo e($subbrand->subbrand_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_type_id">Jenis Produk</label>
                                    <select name="product_type_id" id="product_type_id" class="form-control">
                                        <option value="id" selected disabled>-- Pilih Jenis Produk -- </option>
                                        <?php $__currentLoopData = $productTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($productType->id)); ?>"><?php echo e($productType->product_type); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="filling_machine_group_head_id">Jenis Pack</label>
                                    <select name="filling_machine_group_head_id" id="filling_machine_group_head_id" class="form-control">
                                        <option value="id" selected disabled>-- Pilih Jenis Pack -- </option>
                                        <?php $__currentLoopData = $fillingMachineGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fillingMachineGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($fillingMachineGroup->id)); ?>"><?php echo e($fillingMachineGroup->filling_machine_group_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="expired_range">Expired Range (dalam bulan) </label>
                                    <input required="true" autocomplete="off" type="text" name="expired_range" class="form-control" id="expired_range" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="2">
                                </div>
                                <div class="form-group">
                                    <label for="trial_code">Trial Code </label>
                                    <input required="true" autocomplete="off" type="text" name="trial_code" class="form-control" id="trial_code">
                                </div>
                                <div class="form-group">
                                    <label for="sla">SLA (dalam hari) </label>
                                    <input required="true" autocomplete="off" type="text" name="sla" class="form-control" id="sla" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="2">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="spek_ts_min">Spek TS Min </label>
                                    <input required="true" autocomplete="off" type="text" name="spek_ts_min" class="form-control" id="spek_ts_min" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="spek_ts_max">Spek TS Max </label>
                                    <input required="true" autocomplete="off" type="text" name="spek_ts_max" class="form-control" id="spek_ts_max" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="spek_ph_min">Spek pH Min </label>
                                    <input required="true" autocomplete="off" type="text" name="spek_ph_min" class="form-control" id="spek_ph_min" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="spek_ph_max">Spek pH Max </label>
                                    <input required="true" autocomplete="off" type="text" name="spek_ph_max" class="form-control" id="spek_ph_max" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_analisa_mikro">Waktu Analisa Mikro (dalam hari) </label>
                                    <input required="true" autocomplete="off" type="text" name="waktu_analisa_mikro" class="form-control" id="waktu_analisa_mikro" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="2">
                                </div>

                                <div class="form-group">
                                    <label for="inkubasi">Waktu Inkubasi (dalam hari) </label>
                                    <input required="true" autocomplete="off" type="text" name="inkubasi" class="form-control" id="inkubasi" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="2">
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status Produk</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="id" selected disabled>-- Pilih Status Produk -- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" id="button_simpan">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <input type="submit" class="btn btn-primary form-control" value="Simpan Produk Baru">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_update">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <input type="submit" class="btn btn-primary form-control" value="Update Data Produk">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_batal">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            
                                            <a class="btn btn-outline-secondary form-control" href="">Batal</a>
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

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Produk
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <table class="table table-bordered" id="product-data-table">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Brand</th>
                                        <th style="width: 100px">Jenis Produk</th>
                                        <th style="width: 250px">Nama Produk</th>
                                        <th style="width: 150px">Kode Oracle</th>
                                        <th style="width: 100px">Spek Ts Min</th>
                                        <th style="width: 100px">Spek Ts Max</th>
                                        <th style="width: 100px">Spek pH Min</th>
                                        <th style="width: 120px">Spek pH Max</th>
                                        <th style="width: 200px">SLA <br>( Dalam Hari )</th>
                                        <th style="width: 200px">Waktu Analisa Mikro <br>( Dalam Hari )</th>
                                        <th style="width: 200px">Waktu Inkubasi <br>( Dalam Hari )</th>
                                        <th style="width: 150px">Trial Code</th>
                                        <th style="width: 200px">Expired Range <br>( Dalam Bulan )</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no =1;
                                    ?>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <button class="form-control btn btn-outline-primary" onclick="editProductData('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($product->id)); ?>')"><i class="fa fa-pencil"></i></button>
                                            </td>
                                            <td><?php echo e($product->subbrand->subbrand_name); ?></td>
                                            <td><?php echo e($product->productType->product_type); ?></td>
                                            <td><?php echo e($product->product_name); ?></td>
                                            <td><?php echo e($product->oracle_code); ?></td>
                                            <td><?php echo e($product->spek_ts_min); ?></td>
                                            <td><?php echo e($product->spek_ts_max); ?></td>
                                            <td><?php echo e($product->spek_ph_min); ?></td>
                                            <td><?php echo e($product->spek_ph_max); ?></td>
                                            <td><?php echo e($product->sla); ?></td>
                                            <td><?php echo e($product->waktu_analisa_mikro); ?></td>
                                            <td><?php echo e($product->inkubasi); ?></td>
                                            <td><?php echo e($product->trial_code); ?></td>
                                            <td><?php echo e($product->expired_range); ?></td>
                                        </tr>
                                    <?php
                                        $no++
                                    ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_product/dashboard.blade.php ENDPATH**/ ?>