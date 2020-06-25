
<?php $__env->startSection('title'); ?>
    RPD Filling
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
                    <b>List Produk Fillpack</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="rpd-filling-dashboard-table" >
                        <thead>
                            <tr class="text-center">
                                <th scope="col" >Nomor Wo</th>
                                <th scope="col" >Nama Produk</th>
                                <th scope="col" >Tanggal Produksi</th>
                                <th scope="col" >Formula</th>
                                <th scope="col" >Status</th>
                                <th scope="col" >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $wo_numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wo_number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php switch($wo_number->wo_status):
                                    case ('2'): ?>
                                        <?php
                                            $status     = 'WIP Fillpack';
                                            $style      = 'background-color:#a6e6ff;';
                                            $button     = 'Proses Filling';
                                            $classbtn   = 'btn btn-primary';
                                            $onclick    = 'prosesWoNumber(\''.$wo_number->product->product_name.'\',\''.$wo_number->wo_number.'\',\''.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->id).'\',\'Filling\')';
                                        ?>
                                    <?php break; ?>
                                    <?php case ('3'): ?>
                                        
                                        <?php if(is_null($wo_number->cppHead)): ?>
                                            <?php
                                                $status     = 'On Progress Filling';
                                                $style      = 'background-color:#a6ffea;';
                                            ?>
                                        <?php else: ?>
                                            <?php
                                                $status     = 'On Progress Fillpack';
                                                $style      = 'background-color:#00ffb8;';
                                            ?>
                                        <?php endif; ?>
                                        <?php
                                            $button     = 'Ke Form RPD Filling';
                                            $classbtn   = 'btn btn-outline-primary';
                                            $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                        ?>
                                        <?php if($wo_number->rpdFillingHead['rpd_status'] == '1'): ?> 
                                            <?php
                                                $status     = 'On Progress Packing';
                                                $style      = 'background-color:#00ff7e;';
                                                $button     = 'Closed RPD Filling';
                                                $classbtn   = 'btn btn-outline-secondary';
                                                $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                            ?>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php case ('4'): ?>
                                        <?php if(is_null($wo_number->cppHead)): ?>
                                            <?php
                                                $status     = 'On Progress Filling';
                                                $style      = 'background-color:#a6ffea;';
                                            ?>
                                        <?php else: ?>
                                            <?php
                                                $status     = 'On Progress Fillpack';
                                                $style      = 'background-color:#00ffb8;';
                                            ?>
                                        <?php endif; ?>
                                        <?php
                                            $button     = 'Ke Form RPD Filling';
                                            $classbtn   = 'btn btn-outline-primary';
                                            $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                        ?>
                                        <?php if($wo_number->rpdFillingHead['rpd_status'] == '1'): ?> 
                                            <?php
                                                $status     = 'On Progress Packing';
                                                $style      = 'background-color:#00ff7e;';
                                                $button     = 'Closed RPD Filling';
                                                $classbtn   = 'btn btn-outline-secondary';
                                                $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                            ?>
                                        <?php endif; ?>
                                    <?php break; ?>

                                    <?php case ('5'): ?>
                                        <?php
                                            $status     = 'Closed Wo';
                                            $style      = 'background-color:#00ff7e;';
                                            $button     = 'Closed RPD Filling';
                                            $classbtn   = 'btn btn-outline-secondary';
                                            $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                        ?>
                                    <?php break; ?>
                                <?php endswitch; ?>
                                <tr style="<?php echo e($style); ?>">
                                    <td style="width:120px;" onclick="<?php echo e($onclick); ?>">
                                        <strong><?php echo e($wo_number->wo_number); ?></strong>
                                    </td>
                                    <td style="width:250px;"><?php echo e($wo_number->product->product_name); ?></td>
                                    <td style="width:150px;"><?php echo e($wo_number->production_realisation_date); ?></td>
                                    <td><?php echo e($wo_number->formula_revision); ?></td>
                                    <td style="width:120px;"><?php echo e($status); ?></td>
                                    <td style="width:150px">
                                        <button class="<?php echo e($classbtn); ?>" onclick="<?php echo e($onclick); ?>"><?php echo e($button); ?></button>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/rpd_filling/dashboard.blade.php ENDPATH**/ ?>