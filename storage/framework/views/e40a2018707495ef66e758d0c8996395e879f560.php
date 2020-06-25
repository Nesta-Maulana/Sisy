
<?php $__env->startSection('title'); ?>
    Report Produk Release
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-report'); ?>
    menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-rollie-reports-rpr'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header bg-dark">
                    Export Data RPR
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Filter Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="filter_tanggal">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="product_name">Nama Produk</label>
                                <select name="product_name" id="product_name" class="form-control select2 select " style="width: 100%;height: calc(1.5em + .75rem + 2px);">
                                    <option value="all" selected>All product</option>
                                    <?php $__currentLoopData = $woNumbers->unique('product_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($woNumber->id)); ?>"><?php echo e($woNumber->product->product_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header bg-dark">
                    Upload Data BAR
                </div>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam blanditiis vero eum earum! Vel quod iste inventore totam. Dolores vero excepturi ad velit consequuntur quaerat eaque consectetur illum modi voluptate?
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                     <b>Report Produk Release</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="report-release-produk-dashboard">
                        <thead class="">
                            <tr>
                                <th style="width: 200px">Nama Produk</th>
                                <th style="width: 200px">Tanggal Produksi</th>
                                <th style="width: 200px">Nomor WO</th>
                                <th style="width: 200px">Nomor Lot</th>
                                <th style="width: 200px">Tanggal Selesai Filling</th>
                                <th style="width: 200px">Mesin Filling</th>
                                <th style="width: 200px">Brand</th>
                                <th style="width: 200px">Mikro 30</th>
                                <th style="width: 200px">Mikro 55</th>
                                <th style="width: 200px">Kimia</th>
                                <th style="width: 200px">Sortasi</th>
                                <th style="width: 500px">PPQ</th>
                                <th style="width: 200px">Estimasi Release</th>
                                <th style="width: 200px">Status Mutu Akhir FG</th>
                                <th style="width: 200px">Referensi Bar</th>
                                <th style="width: 200px">Tanggal Bar</th>
                                <th style="width: 200px">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $__currentLoopData = $woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $woNumber->cppHead->cppDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $cppDetail->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $status_mutu_fg = '';
                                        ?>
                                        <tr>
                                            <td><?php echo e($palet->cppDetail->woNumber->product->product_name); ?></td>
                                            <td><?php echo e($palet->cppDetail->woNumber->production_realisation_date); ?></td>
                                            <td><?php echo e($palet->cppDetail->woNumber->wo_number); ?></td>
                                            <td><?php echo e($palet->cppDetail->lot_number.'-'.$palet->palet); ?></td>
                                            <td><?php echo e(substr($woNumber->cppHead->cppDetails[count($woNumber->cppHead->cppDetails)-1]->palets[count($woNumber->cppHead->cppDetails[count($woNumber->cppHead->cppDetails)-1]->palets)-1]->end,0,10)); ?></td>
                                            <td><?php echo e($palet->cppDetail->fillingMachine->filling_machine_code); ?></td>
                                            <td><?php echo e($palet->cppDetail->woNumber->product->subbrand->subbrand_name); ?></td>
                                            <?php if($palet->analisa_mikro_30_status == '1'): ?>
                                                <td class="bg-success">
                                                    OK
                                                </td>
                                            <?php elseif($palet->analisa_mikro_30_status == '0'): ?>
                                                <?php
                                                    $analisaMikroResampling30    = $palet->cppDetail->cppHead->analisaMikro->analisaMikroResamplings->where('suhu_preinkubasi','30');  
                                                ?>
                                                <?php if($analisaMikroResampling30[count($analisaMikroResampling30)-1]->progress_status == '0'): ?>
                                                    <td class="bg-warning">
                                                        On Progress Resampling
                                                    </td>
                                                    <?php
                                                        $status_mutu_fg = 'On Progress';
                                                    ?>
                                                <?php else: ?>
                                                    <?php if($analisaMikroResampling30[count($analisaMikroResampling30)-1]->analisa_mikro_status == '1'): ?>
                                                        <td class="bg-sucess">
                                                            Mikro Resampling OK
                                                        </td>
                                                    <?php else: ?>
                                                        <td class="bg-danger">
                                                            Mikro Resampling #OK
                                                        </td>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php elseif(is_null($palet->analisa_mikro_30_status)): ?> 
                                                <td>
                                                    Analisa Mikro Belum Dilakukan
                                                </td>
                                                <?php
                                                    $status_mutu_fg = 'On Progress';
                                                ?>
                                            <?php endif; ?>

                                            <?php if($palet->cppDetail->woNumber->product->productType->product_type =='Susu'): ?>
                                                <?php if($palet->analisa_mikro_55_status == '1'): ?>
                                                    <td class="bg-success">
                                                        OK
                                                    </td>
                                                <?php elseif($palet->analisa_mikro_55_status == '0'): ?>
                                                    <?php
                                                        $analisaMikroResampling55    = $palet->cppDetail->cppHead->analisaMikro->analisaMikroResamplings->where('suhu_preinkubasi','55');  
                                                    ?>
                                                    <?php if($analisaMikroResampling55[count($analisaMikroResampling55)-1]->progress_status == '0'): ?>
                                                        <td class="bg-warning">
                                                            On Progress Resampling
                                                        </td>
                                                        <?php
                                                            $status_mutu_fg = 'On Progress';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php if($analisaMikroResampling55[count($analisaMikroResampling55)-1]->analisa_mikro_status == '1'): ?>
                                                            <td class="bg-sucess">
                                                                Mikro Resampling OK
                                                            </td>
                                                        <?php else: ?>
                                                            <td class="bg-danger">
                                                                Mikro Resampling #OK
                                                            </td>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php elseif(is_null($palet->analisa_mikro_55_status)): ?> 
                                                    <td>
                                                        Analisa Mikro Belum Dilakukan
                                                    </td>
                                                    <?php
                                                        $status_mutu_fg = 'On Progress';
                                                    ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <td>
                                                    -
                                                </td>
                                            <?php endif; ?>
                                            <?php if(is_null($palet->cppDetail->cppHead->analisaKimia)): ?>
                                                <td>Analisa Kimia Belum Dilakukan</td>
                                            <?php else: ?>
                                                <?php if(is_null($palet->cppDetail->cppHead->analisaKimia->ppq->palets->where('palet_id',$palet->id)->first())): ?>
                                                    <td class="bg-success">OK</td>
                                                <?php else: ?>
                                                    <?php if($palet->cppDetail->cppHead->analisaKimia->progress_status == '0'): ?>
                                                        <td class="bg-warning">
                                                            On Progress Analisa
                                                        </td>
                                                    <?php else: ?>
                                                        <?php if($palet->cppDetail->cppHead->analisaKimia->analisa_kimia_status == '0'): ?>
                                                            <?php switch($palet->cppDetail->cppHead->analisaKimia->ppq->status_akhir):
                                                                case ('0'): ?>
                                                                    <?php
                                                                        $status_mutu_fg = 'On Progress';
                                                                    ?>
                                                                    <td class="bg-warning">
                                                                        Analisa Kimia #OK <?php echo e($palet->cppDetail->cppHead->analisaKimia->ppq->alasan); ?> - Draft PPQ
                                                                    </td>
                                                                <?php break; ?>
                                                                <?php case ('1'): ?>
                                                                    <?php
                                                                        $status_mutu_fg = 'On Progress';
                                                                    ?>
                                                                    <td class="bg-warning">
                                                                        Analisa Kimia #OK <?php echo e($palet->cppDetail->cppHead->analisaKimia->ppq->alasan); ?> - On Progress PPQ
                                                                    </td>
                                                                <?php break; ?>
                                                                
                                                                <?php case ('2'): ?>
                                                                    <?php switch($palet->cppDetail->cppHead->analisaKimia->ppq->followUpPpq->status_produk):
                                                                        case ('0'): ?>
                                                                            <td class="bg-danger">
                                                                                Analisa Kimia #OK <?php echo e($palet->cppDetail->cppHead->analisaKimia->ppq->alasan); ?> - Reject 
                                                                            </td>    
                                                                        <?php break; ?>
                                                                        <?php case ('1'): ?>
                                                                            <td class="bg-success">
                                                                                Analisa Kimia #OK <?php echo e($palet->cppDetail->cppHead->analisaKimia->ppq->alasan); ?> - Release 
                                                                            </td>    
                                                                        <?php break; ?>                                                                       
                                                                        
                                                                        <?php case ('2'): ?>
                                                                            <td class="bg-warning">
                                                                                Analisa Kimia #OK <?php echo e($palet->cppDetail->cppHead->analisaKimia->ppq->alasan); ?> - Release Partial 
                                                                            </td>    
                                                                        <?php break; ?>                                                                       
                                                                    <?php endswitch; ?>
                                                                <?php break; ?>     
                                                            <?php endswitch; ?>
                                                        <?php else: ?>
                                                            <td class="bg-sucess">
                                                                OK
                                                            </td>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <td>-</td>
                                            <td>
                                            <?php $__currentLoopData = $palet->paletPpqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paletPpq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php switch($paletPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq):
                                                    case ('Package Integrity'): ?>
                                                        <?php echo e($paletPpq->ppq->nomor_ppq.' - '.$paletPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq.' - '.$paletPpq->ppq->alasan); ?> <br>
                                                    <?php break; ?>
                                                    <?php case ('Kimia'): ?>
                                                        <?php echo e($paletPpq->ppq->nomor_ppq.' - '.$paletPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq.' - '.$paletPpq->ppq->alasan); ?> <br>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td>
                                                <?php
                                                        $tanggalfilling = $palet->end;
                                                        $sla = "+".$woNumber->product->sla." day";
                                                        $tanggalestimasi = strtotime($sla,strtotime($tanggalfilling));
                                                        echo date('Y-m-d',$tanggalestimasi);
                                                 ?>
                                            </td>
                                                <?php switch($status_mutu_fg):
                                                    case (''): ?>
                                                        <td class="bg-success">OK</td>
                                                    <?php break; ?>
                                                    <?php case ('On Progress'): ?>
                                                        <td class="bg-warning">On Progress Analisa</td>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Tanggal Produksi</th>
                                <th>Nomor WO</th>
                                <th>Nomor Lot</th>
                                <th >Tanggal Selesai Filling</th>
                                <th>Mesin Filling</th>
                                <th>Brand</th>
                                <th class="filter-search">Mikro 30</th>
                                <th>Mikro 55</th>
                                <th>Kimia</th>
                                <th>Sortasi</th>
                                <th>PPQ</th>
                                <th>Estimasi Release</th>
                                <th>Status Mutu Akhir FG</th>
                                <th>Referensi Bar</th>
                                <th>Tanggal Bar</th>
                                <th>Keterangan</th>
                            </tr>
                        </tfoot>
                    </table>
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
        $('#filter_tanggal').daterangepicker();
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/reports/rpr/dashboard.blade.php ENDPATH**/ ?>