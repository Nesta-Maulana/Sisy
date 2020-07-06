
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    Draft PSR 
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <table class="table table-bordered" style="overflow-x: scroll;" id="permintaan-sampel-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th style="width: 30px">
                                                            <i class="fas fa-mail-bulk"></i>
                                                        </th>
                                                        <th style="width: 100px">
                                                            <i class="fas fa-list-alt"></i>
                                                        </th>
                                                        <th style="width: 30px">
                                                            <i class="fas fa-print"></i>
                                                        </th>
                                                        <th style="width: 150px">Tanggal Produksi</th>
                                                        <th style="width: 120px">Nomor Wo</th>
                                                        <th style="width: 120px">Kode Batch 1</th>
                                                        <th style="width: 120px">Kode Batch 2</th>
                                                        <th style="width: 120px">Kode Produk</th>
                                                        <th style="width: 250px">Nama Produk</th>
                                                        <th style="width: 120px">Jumlah Sampel</th>
                                                        <th style="width: 120px">Note</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $psrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $psr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <?php if($psr->psr_status  == '0'): ?> 
                                                                <td>
                                                                    <div class="button-awal">
                                                                        <input type="checkbox" style="height: 22px;width: 25px;" name="sendmail[]" class="sendmail" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>" onclick="handleChangeMail()">                                                                    
                                                                    </div>
                                                                </td>
                                                            <?php else: ?> 
                                                                <td>
                                                                    <i class="fas fa-check"></i>
                                                                </td>
                                                            <?php endif; ?>
                                                            <?php if($psr->psr_status == '0'): ?>
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
                                                            <?php else: ?>
                                                                <td>
                                                                    <div class="button-awal">
                                                                        <button class="btn-primary btn" onclick="editPsr('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>')">
                                                                            <i class="fas fa-mail-bulk"></i><i class="fas fa-pencil-alt"></i> 
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
                                                            <?php endif; ?>
                                                            <?php if($psr->psr_status == '1'): ?>
                                                                <td>
                                                                    <div class="button-awal">
                                                                        <input type="checkbox" style="height: 22px;width: 25px;" name="printpsr[]" class="sendmail" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>" onchange="handlePrintPsr()">
                                                                    </div>
                                                                </td>
                                                            <?php else: ?>
                                                                <?php if($psr->psr_status == '0'): ?>
                                                                    <td>
                                                                        <i class="fas fa-window-close"></i>
                                                                    </td>
                                                                <?php else: ?>
                                                                    <td>
                                                                        <i class="fas fa-check"></i>
                                                                    </td>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
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
                                    <div class="row mt-2">
                                        <div class="col-lg-8 col-md-8 col-sm-8"></div>
                                        <div class="col-lg col-md col-sm hidden" id="print_psr">
                                            <div class="form-group">
                                                <button class="btn btn-primary form-control" onclick="printPsr()">
                                                    <i class="fas fa-print"></i> Print PSR
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg col-md col-sm hidden" id="mail_psr">
                                            <div class="form-group">
                                                <button class="btn btn-primary form-control" onclick="sendMailPsr()">
                                                    <i class="fas fa-mail-bulk"></i> Send PSR
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('rollie.psr.pop-up.lihat-detail-psr', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/psr/dashboard.blade.php ENDPATH**/ ?>