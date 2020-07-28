
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
                    List Draft Analisa Fisikokimia Produk Jadi
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
                                            <button onclick="document.location.href='fisiko-kimia-form/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($draftAnalisa->id)); ?>/<?php echo e($params); ?>'" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                        <td><?php echo e($draftAnalisa->cppHead->woNumbers[0]->product->product_name); ?></td>
                                        <td><?php echo e(rtrim($tanggal_produksi,', ')); ?></td>
                                        <td><?php echo e(rtrim($wo_number,', ')); ?></td>
                                        <td>Draft Analisa</td>
                                        <td><?php echo e(rtrim($mesin_filling,', ')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if($params == app('App\Http\Controllers\ResourceController')->encrypt("fiskokimias_qc_penyelia")): ?>
                                <?php if(!is_null($draftTsOven)): ?>
                                    <?php $__currentLoopData = $draftTsOven; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $draftAnalisa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                <button onclick="document.location.href='fisiko-kimia-form/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($draftAnalisa->id)); ?>/<?php echo e($params); ?>'" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                            <td><?php echo e($draftAnalisa->cppHead->woNumbers[0]->product->product_name); ?></td>
                                            <td><?php echo e(rtrim($tanggal_produksi,', ')); ?></td>
                                            <td><?php echo e(rtrim($wo_number,', ')); ?></td>
                                            <td>Draft Analisa</td>
                                            <td><?php echo e(rtrim($mesin_filling,', ')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/fiskokimia/dashboard.blade.php ENDPATH**/ ?>