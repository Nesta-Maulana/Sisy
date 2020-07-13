
<?php $__env->startSection('title'); ?>
    Report Rekapitulasi Data Filling
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-report'); ?>
    menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-rollie-reports-rpd-filling'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .select2-container .select2-selection--single{
        height: 38px;
    }
    .select2-selection__rendered{
        padding-top: 4px;
    }
</style>
   <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="card">
               <div class="card-header bg-dark">
                   Report RPD Filling
               </div>
               <div class="card-body">
                   <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12">
                           <div class="card">
                               <div class="card-header bg-secondary">
                                    Filter For Export Excel
                               </div>
                               <div class="card-body">
                                
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label>Filter Tanggal Produksi</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" id="filter_tanggal" value="" onchange="filterTanggalProduksi(this.value)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label for="product_name">Nama Produk</label>
                                                <select name="product_id[]" id="product_id" class="select form-control select2" data-placeholder="Pilih Produk" onchange="filterProductName()" multiple>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label for="wo_number_id">Nomor Wo</label>
                                                <select name="wo_number_id" id="wo_number_id" class="select form-control select2" data-placeholder="Pilih Wo"  multiple>
                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <button class="btn btn-primary form-control" id="export" onclick="exportReportRpd()">Export Excel</button>
                                        </div>
                                    </div>
                                
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row mt-2">
                       <div class="col-lg-12 col-md-12 col-sm-12">
                           <style>
                                .dt-body-nowrap 
                                {
                                    white-space: nowrap;
                                }
                           </style>
                           <table class="table table-bordered text-center" id="report-rpd-filling">
                               <thead>
                                   <tr>
                                       <th class="width: 300px">Nomor&nbsp;&nbsp;&nbsp;&nbsp;Wo</th>
                                       <th style="width: 300px">Nama Produk</th>
                                       <th style="width: 135px">Tanggal Produksi</th>
                                       <th style="width: 100px">Mesin Filling</th>
                                       <th style="width: 100px">Sampel</th>
                                       <th style="width: 120px">Tanggal Filling</th>
                                       <th style="width: 100px">Jam Filling</th>
                                       <th style="width: 100px"> Berat Kanan </th> 
                                       <th style="width: 80px"> Berat Kiri </th> 
                                       <th style="width: 100px"> Overlap </th> 
                                       <th style="width: 150px"> Ls Sa Proportion </th> 
                                       <th style="width: 120px"> Volume Kanan </th> 
                                       <th style="width: 100px"> Volume Kiri </th> 
                                       <th style="width: 100px"> Airgap </th> 
                                       <th style="width: 140px"> Ts Accurate Kanan </th> 
                                       <th style="width: 135px"> Ts Accurate Kiri </th> 
                                       <th style="width: 100px"> Ls Accurate </th> 
                                       <th style="width: 100px"> Sa Accurate </th> 
                                       <th style="width: 120px"> Surface Check </th> 
                                       <th style="width: 100px"> Pinching </th> 
                                       <th style="width: 100px"> Strip Folding </th> 
                                       <th style="width: 150px"> Konduktivity Kanan </th> 
                                       <th style="width: 150px"> Konduktivity Kiri </th> 
                                       <th style="width: 130px"> Design Kanan </th> 
                                       <th style="width: 100px"> Design Kiri </th> 
                                       <th style="width: 100px"> Dye Test </th> 
                                       <th style="width: 100px"> Residu H2o2 </th> 
                                       <th style="width: 180px"> Prod Code and No Md </th> 
                                       <th style="width: 100px"> Correction </th> 
                                       <th style="width: 130px"> Dissolving Test </th> 
                                       <th style="width: 100px"> Status Akhir </th> 
                                   </tr>
                               </thead>
                               <tbody id="isi-report-rpd-filling">
                                   <?php $__currentLoopData = $rpdHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rpdHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <?php $__currentLoopData = $rpdHead->rpdFillingDetailPis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rpdFillingDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->startSection('extract-plugin-footer'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('datetime-picker/css/daterangepicker.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/moment2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('datetime-picker/js/daterangepicker.js')); ?>"></script>
    <script>
        $('#filter_tanggal').daterangepicker({
            startDate: new Date(new Date().getFullYear(), 0, 1),
            endDate: new Date(),
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    </script>   
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/reports/rpd_filling/dashboard.blade.php ENDPATH**/ ?>