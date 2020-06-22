
<?php $__env->startSection('title'); ?>
    CPP Produk
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-data-proses'); ?>
    menu-open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active-rollie-process-data-cpps'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    List Produk Fillpack
                </div>
                <div class="card-body">
                    <table class="display nowrap table table-bordered" id="dashboard-cpp-produk-tabel" width="100%">
                        <thead >
                            <tr>
                                <th scope="col" >Nomor Wo</th>
                                <th scope="col" >Produk</th>
                                <th scope="col" >Tanggal Produksi</th>
                                <th scope="col" >Status</th>
                                <th scope="col" >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $wo_numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wo_number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php switch($wo_number->wo_status):
                                    case ('3'): ?>
                                        <?php if(is_null($wo_number->cppHead)): ?>
                                            <?php
                                                $status     = 'WIP Packing';
                                                $style      = 'background-color:#a6ffea;';
                                                $button     = 'Proses Packing';
                                                $classbtn   = 'btn btn-primary';
                                                $onclick    = 'prosesWoNumber(\''.$wo_number->product->product_name.'\',\''.$wo_number->wo_number.'\',\''.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->id).'\',\'Packing\')';
                                            ?>
                                        <?php else: ?>
                                            <?php
                                                $status     = 'On Progress Fillpack';
                                                $style      = 'background-color:#00ffb8;';
                                                $button     = 'Ke Form Cpp Produk';
                                                $classbtn   = 'btn btn-outline-primary';
                                                $onclick    = 'document.location.href=\'cpp-produk/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->cpp_head_id).'\'';
                                            ?>
                                            <?php if($wo_number->rpdFillingHead['rpd_status'] == '1'): ?> 
                                                <?php
                                                    $status     = 'On Progress Packing';
                                                    $style      = 'background-color:#00ff7e;';
                                                    $button     = 'Ke Form Cpp Produk';
                                                    $classbtn   = 'btn btn-outline-primary';
                                                    $onclick    = 'document.location.href=\'cpp-produk/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->cpp_head_id).'\'';
                                                ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php break; ?>
                                <?php endswitch; ?>
                                <tr style="<?php echo e($style); ?>">
                                    <td  onclick="<?php echo e($onclick); ?>" >
                                        <strong><?php echo e($wo_number->wo_number); ?></strong>
                                    </td>
                                    <td><?php echo e($wo_number->product->product_name); ?></td>
                                    <td style="<?php echo e($style); ?>"><?php echo e($wo_number->production_realisation_date); ?></td>
                                    <td>
                                        <?php echo e($status); ?>

                                    </td>
                                    <td>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/cpp_produk/dashboard.blade.php ENDPATH**/ ?>