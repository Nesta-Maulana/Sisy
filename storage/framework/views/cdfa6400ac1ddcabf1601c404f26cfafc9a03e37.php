
<?php $__env->startSection('title'); ?>
    Fisikokimia 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-data-analisa'); ?>
    menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-rollie-analysis-data-'.str_replace('_', '-',app('App\Http\Controllers\ResourceController')->decrypt($params)) ); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5>List Draft Analisa Fisikokimia Produk Jadi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="fisikokimia-dashboard-table">
                        <thead>
                            <tr>
                                <th style="width:30px">#</th>
                                <th style="width:300px"> Nama Produk </th>
                                <th style="width:200px"> Tanggal Produksi</th>
                                <th style="width:180px"> Nomor Wo </th>
                                <th style="width:160px"> Status Analisa Kimia </th>
                                <th style="width:100px">Mesin Filling</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cppHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $wo_number          = '';
                                    $mesin_filling      = '';
                                    $tanggal_produksi   ='';
                                ?>
                                <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $wo_number      .= $woNumber->wo_number.',';
                                        if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                        {
                                            $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                        }
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fillingMachineGroupDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                        {
                                            $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                        }
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr style="background-color:#ffa6bb;">
                                    <td>
                                        <button onclick="analisaFisikokimiaProduk('<?php echo e($params); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id)); ?>','<?php echo e($cppHead->product->product_name); ?>','<?php echo e(rtrim($tanggal_produksi,', ')); ?>')" class="btn btn-primary">
                                            <i class="fas fa-file-signature"></i>
                                        </button>
                                    </td>
                                    <td><?php echo e($cppHead->woNumbers[0]->product->product_name); ?></td>
                                    <td><?php echo e(rtrim($tanggal_produksi,', ')); ?></td>
                                    <td><?php echo e(rtrim($wo_number,', ')); ?></td>
                                    <td>Belum Analisa</td>
                                    <td><?php echo e(rtrim($mesin_filling,', ')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!is_null($draftAnalisas)): ?>
                                <?php $__currentLoopData = $draftAnalisas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $draftAnalisa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $wo_number          = '';
                                        $mesin_filling      = '';
                                        $tanggal_produksi   ='';
                                    ?>
                                    <?php $__currentLoopData = $draftAnalisa->cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $wo_number      .= $woNumber->wo_number.',';
                                        if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                        {
                                            $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                        }
                                    ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $draftAnalisa->cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fillingMachineGroupDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                            {
                                                $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                            }
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-warning">
                                        <td>
                                            <button onclick="document.location.href='fisiko-kimia-form/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($draftAnalisa->id)); ?>/<?php echo e($params); ?>'" class="btn btn-primary">Update Fisikokimia</button>
                                        </td>
                                        <td><?php echo e($draftAnalisa->cppHead->woNumbers[0]->product->product_name); ?></td>
                                        <td><?php echo e(rtrim($tanggal_produksi,', ')); ?></td>
                                        <td><?php echo e(rtrim($wo_number,', ')); ?></td>
                                        <td>Draft Analisa</td>
                                        <td><?php echo e(rtrim($mesin_filling,', ')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5>List Analisa Fisikokimia Produk Jadi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="fisikokimia-dashboard-done-table"  >
                        <thead>
                            <tr>
                                <th scope="col" style="width:250px" > Nama Produk </th>
                                <th scope="col" style="width:200px"> Tanggal Produksi</th>
                                <th scope="col" style="width:200px"> Nomor Wo </th>
                                <th scope="col" style="width:200px"> Mesin Filling</th>
                                <th scope="col" style="width:200px"> Status Analisa Kimia</th>
                                <th scope="col" style="width:200px"> #</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $doneAnalisa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaKimia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $wo_number          = '';
                                    $mesin_filling      = '';
                                    $tanggal_produksi   ='';
                                ?>
                                <?php $__currentLoopData = $analisaKimia->cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $wo_number      .= $woNumber->wo_number.',';
                                    if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                    {
                                        $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                    }
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $analisaKimia->cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fillingMachineGroupDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                        {
                                            $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                        }
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($analisaKimia->cppHead->woNumbers[0]->product->product_name); ?></td>
                                    <td><?php echo e(rtrim($tanggal_produksi,', ')); ?></td>
                                    <td><?php echo e(rtrim($wo_number,', ')); ?></td>
                                    <td><?php echo e(rtrim($mesin_filling,', ')); ?></td>
                                    <td>
                                        <?php if($analisaKimia->analisa_kimia_status == '1'): ?>
                                            OK
                                        <?php else: ?>
                                            <?php echo e($analisaKimia->cppHead->ppq->alasan); ?> 
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button onclick="document.location.href='fisiko-kimia-form/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaKimia->id)); ?>/<?php echo e($params); ?>'" class="btn btn-primary">Lihat Hasil Analisa</button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/fiskokimia/dashboard.blade.php ENDPATH**/ ?>