
<?php $__env->startSection('title'); ?>
    Form RPD Filling
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-data-proses'); ?>
    menu-open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active-rollie-process-data-rpds'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <div class="row">
                    <?php if($activeRpdFilling->count() > 1): ?>  
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            RPD Filling Produk : 
                        </div>
                        <select name="rpd_product_id" id="rpd_product_id" class="pull-left select form-control col-lg-9 col-md-9 col-sm-9" style="padding: 0 .8rem" onchange="changeProduct(this)">
                        <?php $__currentLoopData = $activeRpdFilling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rpdFillingActive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rpdFillingActive->id)); ?>" <?php if($rpdFillingActive->id == $rpdFillingHead->id): ?>
                                selected
                            <?php endif; ?>><?php echo e($rpdFillingActive->product->product_name); ?></option>         
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </select>   
                    <?php else: ?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <span style="font-weight: bolder">RPD Filling Produk <?php echo e($rpdFillingHead->woNumbers[0]->product->product_name); ?></span> 
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="row form-group left">
                                    <label class="col-md-3 col-lg-3 col-sm-3">Nama Produk</label>
                                    <input type="text" value="<?php echo e($rpdFillingHead->woNumbers[0]->product->product_name); ?>" class="form-control col-md-6 col-sm-6 col-lg-6" id="nama_produk" readonly >
                                </div>
                                <div class="row form-group left">
                                    <label class="col-md-3 col-lg-3 col-sm-3">Tanggal Produksi</label>
                                    <textarea class="form-control col-md-6 col-sm-6 col-lg-6" readonly><?php foreach ($rpdFillingHead->woNumbers as $key => $wo_number) { $tampil = $wo_number->wo_number." => ".$wo_number->production_realisation_date."&#13;&#10;";echo $tampil;}?></textarea>
                                </div>
                                <div class="row form-group left">
                                    <label class="col-md-3 col-lg-3 col-sm-3">&Sigma; Batch</label>
                                    <input type="text" value="<?php echo e($rpdFillingHead->woNumbers->count()); ?> Batch" class="form-control col-md-6 col-sm-6 col-lg-6" readonly>
                                </div>
                            </div>
                        </div>
                    
                    
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <button onclick="window.location.href='draft-ppq-filling/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rpdFillingHead->id)); ?>'" class="btn btn-outline-secondary form-control">
                                    <i class="fas fa-eye"></i> Draft PPQ
                                </button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <button data-toggle="modal" data-target="#tambahBatchFillingModal" class="btn btn-outline-primary  form-control">
                                    <i class="fas fa-plus"></i> Batch / Wo
                                </button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <a id="tambahsampelbutton"   onclick="hapusDataPopupTambahSampel();getPopUp('tambahPiSampelModal')" class="btn btn-primary text-white form-control">
                                    <i class="fas fa-plus"></i> Sample
                                </a>
                            </div>
                        </div>
                    
                    
                        <div class="row mt-3">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-header bg-warning text-dark">
                                        <b>Draft Analisa Sample QC</b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" id="draft-analisa-rpd" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col" >Nomor Wo</th>
                                                    <th scope="col" >Mesin Filling</th>
                                                    <th scope="col" style="display: none;">Tanggal Filling</th>
                                                    <th scope="col" >Jam Filling</th>
                                                    <th scope="col" >Sample</th>
                                                    <?php if(Session::get('ubah') == 'show' || Session::get('hapus') == 'show'): ?>
                                                        <th scope="col" >Aksi</th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody id="draft_detail_pi">
                                                <?php $__currentLoopData = $rpdFillingHead->rpdFillingDetailPis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail_pi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(is_null($detail_pi->airgap) && is_null($detail_pi->ts_accurate_kanan) && is_null($detail_pi->ts_accurate_kiri) && is_null($detail_pi->ls_accurate) && is_null($detail_pi->sa_accurate) && is_null($detail_pi->surface_check) && is_null($detail_pi->pinching) && is_null($detail_pi->strip_folding) && is_null($detail_pi->konduktivity_kanan) && is_null($detail_pi->konduktivity_kiri) && is_null($detail_pi->design_kanan) && is_null($detail_pi->design_kiri) && is_null($detail_pi->dye_test) && is_null($detail_pi->residu_h2o2) && is_null($detail_pi->prod_code_and_no_md) && is_null($detail_pi->correction)): ?>
                                                    <tr>
                                                        <td><?php echo e($detail_pi->woNumber->wo_number); ?></td>
                                                        <td><?php echo e($detail_pi->fillingMachine->filling_machine_code); ?></td>
                                                        <td style="display: none;"><?php echo e($detail_pi->filling_date); ?></td>
                                                        <td><?php echo e($detail_pi->filling_time); ?></td>
                                                        <td><?php echo e($detail_pi->fillingSampelCode->filling_sampel_code); ?></td>
                                                        <?php if(Session::get('ubah') == 'show' || Session::get('hapus') == 'show'): ?>
                                                        <td>
                                                            <div class="row">
                                                                <?php if(Session::get('ubah') == 'show'): ?>
                                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <button  class="btn btn-primary form-control " onclick="analisa_sampel_pi('<?php echo e($detail_pi->fillingSampelCode->filling_sampel_code); ?>','<?php echo e(ucwords($detail_pi->fillingSampelCode->filling_sampel_event)); ?>','<?php echo e($detail_pi->fillingMachine->filling_machine_code); ?>','<?php echo e($detail_pi->filling_date); ?>','<?php echo e($detail_pi->filling_time); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($detail_pi->id)); ?>','<?php echo e($detail_pi->woNumber->product->product_name); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($detail_pi->woNumber->id)); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($detail_pi->fillingMachine->id)); ?>');getPopUp('analisaPiSampelModal')">
                                                                            <i class="fas fa-file-signature"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <?php endif; ?>
                                                                <?php if(Session::get('hapus') == 'show'): ?>
                                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <button class="btn btn-danger form-control" onclick="hapus_sampel('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($detail_pi->id)); ?>',false,'<?php echo e($detail_pi->fillingSampelCode->filling_sampel_code); ?> - <?php echo e($detail_pi->fillingSampelCode->filling_sampel_event); ?>','<?php echo e($detail_pi->fillingMachine->filling_machine_code); ?>','<?php echo e($detail_pi->filling_date); ?> - <?php echo e($detail_pi->filling_time); ?>')"><i class="fas fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $rpdFillingHead->rpdFillingDetailAtEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail_at_event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(is_null($detail_at_event->ls_sa_sealing_quality) && is_null($detail_at_event->ls_sa_proportion) && is_null($detail_at_event->status_akhir)): ?>
                                                    <tr>
                                                        <td><?php echo e($detail_at_event->woNumber->wo_number); ?></td>
                                                        <td><?php echo e($detail_at_event->fillingMachine->filling_machine_code); ?></td>
                                                        <td style="display: none;"><?php echo e($detail_at_event->filling_date); ?></td>
                                                        <td><?php echo e($detail_at_event->filling_time); ?></td>
                                                        <td><?php echo e($detail_at_event->fillingSampelCode->filling_sampel_code); ?> ( Event )</td>
                                                        <?php if(Session::get('ubah') == 'show' || Session::get('hapus') == 'show'): ?>
                                                        <td>
                                                            <div class="row">
                                                                <?php if(Session::get('ubah') == 'show'): ?>
                                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <button  class="btn btn-info form-control" onclick="analisa_sampel_at_event('<?php echo e($detail_at_event->fillingSampelCode->filling_sampel_code); ?>','<?php echo e(ucwords($detail_at_event->fillingSampelCode->filling_sampel_event)); ?>','<?php echo e($detail_pi->fillingMachine->filling_machine_code); ?>','<?php echo e($detail_at_event->filling_date); ?>','<?php echo e($detail_at_event->filling_time); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($detail_at_event->id)); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($detail_at_event->woNumber->id)); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($detail_at_event->fillingMachine->id)); ?>','<?php echo e($detail_at_event->woNumber->product->product_name); ?>');getPopUp('analisaSampleAtEvent')">
                                                                            <i class="fas fa-file-signature"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <?php endif; ?>
                                                                <?php if(Session::get('hapus') == 'show'): ?>
                                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <button class="btn btn-danger form-control" onclick="hapus_sampel('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($detail_at_event->id)); ?>',true,'<?php echo e($detail_at_event->fillingSampelCode->filling_sampel_code); ?> - <?php echo e($detail_at_event->fillingSampelCode->filling_sampel_event); ?>','<?php echo e($detail_at_event->fillingMachine->filling_machine_code); ?>','<?php echo e($detail_pi->filling_date); ?> - <?php echo e($detail_pi->filling_time); ?>')"><i class="fas fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8"></div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <button class="btn btn-primary form-control" onclick="closeRpdFilling('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rpdFillingHead->id)); ?>')"><i class="fas fa-spell-check"></i> Close RPD</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header bg-warning text-dark">
                                        <b>Done Analisa Sample QC</b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" id="done-analisa-rpd" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col" >Nomor Wo</th>
                                                    <th scope="col" >Mesin Filling</th>
                                                    <th scope="col" style="display: none;">Tanggal Filling</th>
                                                    <th scope="col" >Jam Filling</th>
                                                    <th scope="col" >Jenis Sample</th>
                                                    <th scope="col" >Status Akhir</th>
                                                </tr>
                                            </thead>
                                            <tbody id="done_table_detail_pi">
                                                <?php $__currentLoopData = $rpdFillingHead->rpdFillingDetailPis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail_pi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!is_null($detail_pi->airgap) && !is_null($detail_pi->ts_accurate_kanan) && !is_null($detail_pi->ts_accurate_kiri) && !is_null($detail_pi->ls_accurate) && !is_null($detail_pi->sa_accurate) && !is_null($detail_pi->surface_check) && !is_null($detail_pi->pinching) && !is_null($detail_pi->strip_folding) && !is_null($detail_pi->konduktivity_kanan) && !is_null($detail_pi->konduktivity_kiri) && !is_null($detail_pi->design_kanan) && !is_null($detail_pi->design_kiri) && !is_null($detail_pi->dye_test) && !is_null($detail_pi->residu_h2o2) && !is_null($detail_pi->prod_code_and_no_md) && !is_null($detail_pi->correction)): ?>
                                                    <tr>
                                                        <td><?php echo e($detail_pi->woNumber->wo_number); ?></td>
                                                        <td><?php echo e($detail_pi->fillingMachine->filling_machine_code); ?></td>
                                                        <td style="display: none;"><?php echo e($detail_pi->filling_date); ?></td>
                                                        <td><?php echo e($detail_pi->filling_time); ?></td>
                                                        <td><?php echo e($detail_pi->fillingSampelCode->filling_sampel_code); ?></td>
                                                        <td><?php echo e($detail_pi->status_akhir); ?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $rpdFillingHead->rpdFillingDetailAtEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail_at_event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!is_null($detail_at_event->ls_sa_sealing_quality) && !is_null($detail_at_event->ls_sa_proportion) && !is_null($detail_at_event->status_akhir)): ?>
                                                    <tr>
                                                        <td><?php echo e($detail_at_event->woNumber->wo_number); ?></td>
                                                        <td><?php echo e($detail_at_event->fillingMachine->filling_machine_code); ?></td>
                                                        <td style="display: none;"><?php echo e($detail_at_event->filling_date); ?></td>
                                                        <td><?php echo e($detail_at_event->filling_time); ?></td>
                                                        <td><?php echo e($detail_at_event->fillingSampelCode->filling_sampel_code); ?> ( Event )</td>
                                                        <td><?php echo e($detail_at_event->status_akhir); ?></td>
    
                                                    </tr>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="rpd_filling_head_id" id="rpd_filling_head_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rpdFillingHead->id)); ?>">
    <?php echo $__env->make('rollie.rpd_filling.pop-up.tambah-sampel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('rollie.rpd_filling.pop-up.tambah-batch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('rollie.rpd_filling.pop-up.analisa-sampel-pi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('rollie.rpd_filling.pop-up.analisa-sampel-at-event', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extract-plugin-footer'); ?>
    <script src="<?php echo e(asset('datetime-picker/js/jquery.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('datetime-picker/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('datetime-picker/css/bootstrap-datetimepicker.min.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/moment.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script>
        $('.timepickernya').datetimepicker({
            format: 'HH:mm:ss',
            locale:'en',
            date: new Date()
        }); 
        $('.datepickernya').datetimepicker({
            format: 'YYYY-MM-DD',
            locale:'en',
            date: new Date()
        }); 

        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            locale:'en'
        }); 
        $('.datetimepickernya').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
        }); 
    </script> 
    <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/bootstrap-datetimepicker.min.js')); ?>"></script>
    
    <script type="text/javascript" src="<?php echo e(asset('js/rollie_app/bootstrap.min.js')); ?>"></script>
    <script>
        function getPopUp(modal_id) 
        {
            $('#nama_produk').focus();
            setTimeout(function(){ 
                $('#'+modal_id).modal('show');
            },500);
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/rpd_filling/form.blade.php ENDPATH**/ ?>