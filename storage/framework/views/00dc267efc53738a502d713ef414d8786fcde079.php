
<?php $__env->startSection('title'); ?>
    PSR Produk
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-data-proses'); ?>
    menu-open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active-rollie-process-data-psr'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Permintaan Sampel RTD
                </div>
                <div class="card-body">
                    <table class="table table-bordered" style="overflow-x: scroll;">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 120px">#</th>
                                <th style="width: 150px">Tanggal Produksi</th>
                                <th style="width: 120px">Nomor Wo</th>
                                <th style="width: 120px">Kode Batch 1</th>
                                <th style="width: 120px">Kode Batch 2</th>
                                <th style="width: 120px">Kode Produk</th>
                                <th style="width: 150px">Nama Produk</th>
                                <th style="width: 120px">Jumlah Sampel</th>
                                <th style="width: 120px">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $psrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $psr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="button-awal">
                                            <button class="btn-primary btn" onclick="editPsr('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-secondary btn" onclick="getPsrDetail('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>','<?php echo e($psr->woNumber->product->product_name); ?>','<?php echo e($psr->woNumber->wo_number); ?>','<?php echo e($psr->woNumber->production_realisation_date); ?>','<?php echo e($psr->psr_qty); ?>','<?php echo e($psr->psr_number); ?>')" data-toggle="modal" data-target="#lihatDetailPsr">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="button-ubah hidden">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-save text-white" onclick="updatePsr('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>')"></i>
                                            </button>
                                            <button class="btn btn-secondary" onclick="cancelEditPsr('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>')">
                                                <i class="fas fa-window-close"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td><?php echo e($psr->woNumber->production_realisation_date); ?></td>
                                    <td><?php echo e($psr->woNumber->wo_number); ?></td>
                                    <?php if(count($psr->woNumber->cppDetails) == 1): ?>
                                        <?php if($psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'A3CF B' || $psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'TPA A'): ?>
                                            <td><?php echo e($psr->woNumber->cppDetails[0]->lot_number); ?></td>
                                            <td>-</td>
                                        <?php else: ?>
                                            <td>-</td>
                                            <td><?php echo e($psr->woNumber->cppDetails[0]->lot_number); ?></td>
                                            
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $psr->woNumber->cppDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e($cppDetails->lot_number); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <td><?php echo e($psr->woNumber->product->oracle_code); ?></td>
                                    <td><?php echo e($psr->woNumber->product->product_name); ?></td>
                                    <td id="qty_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>"><?php echo e($psr->psr_qty); ?></td>
                                    <td id="note_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>"><?php echo e($psr->note); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('rollie.psr.pop-up.lihat-detail-psr', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/psr/dashboard.blade.php ENDPATH**/ ?>