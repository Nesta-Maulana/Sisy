
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
                                <th style="width: 200px">PPQ</th>
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
                                            <?php endif; ?>
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
                                            <?php endif; ?>
                                            <?php if(is_null($palet->cppDetail->cppHead->analisaKimia)): ?>
                                                <td>Analisa Kimia Belum Dilakukan</td>
                                            <?php else: ?>
                                                <?php if($palet->cppDetail->cppHead->analisaKimia->progress_status == '0'): ?>
                                                    <td class="bg-warning">
                                                        On Progress Analisa
                                                    </td>
                                                <?php else: ?>
                                                    <?php if($palet->cppDetail->cppHead->analisaKimia->analisa_kimia_status == '0'): ?>
                                                        <?php if(): ?>
                                                            
                                                        <?php else: ?>
                                                            
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <td class="bg-sucess">
                                                            OK
                                                        </td>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/reports/rpr/dashboard.blade.php ENDPATH**/ ?>