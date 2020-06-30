
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
                                                        <th style="width: 150px">#</th>
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
                                                            <td>
                                                                <div class="button-awal">
                                                                    <input type="checkbox" style="height: 22px;width: 25px;" name="sendmail[]" class="sendmail" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>">
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
                                    <?php if(count($psrs) > 0): ?>
                                    <div class="row mt-2">
                                        <div class="col-lg-10 col-md-10 col-sm-10"></div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <button class="btn btn-primary form-control" onclick="sendMailPsr()">
                                                    <i class="fas fa-mail-bulk"></i> Send PSR
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    List PSR 
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <table class="table table-bordered" style="overflow-x: scroll;" id="permintaan-sampel-rtd-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th style="width: 150px">#</th>
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
                                                            <td>
                                                                <div class="button-awal">
                                                                    <input type="checkbox" style="height: 22px;width: 25px;" name="sendmail[]" class="sendmail" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($psr->id)); ?>">
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
                                    <?php if(count($psrs) > 0): ?>
                                    <div class="row mt-2">
                                        <div class="col-lg-10 col-md-10 col-sm-10"></div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <button class="btn btn-primary form-control" onclick="sendMailPsr()">
                                                    <i class="fas fa-mail-bulk"></i> Send PSR
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
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