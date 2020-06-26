
<?php $__env->startSection('title'); ?>
    Jadwal Produksi
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-rollie-production-schedules'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                           Jadwal Produksi Aktif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 <?php echo e(Session::get('tambah')); ?>">
                            <div class="form-group float-right">
                                <a class="btn btn-primary" href='jadwal-produksi/tambah-jadwal'><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Jadwal Produksi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="example_wrapper">
                    <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <table class="table table-bordered" id="production-schedules-table" >
                            <thead>
                                <tr class="text-center">
                                    <th style="width:40px" class="<?php if(Session::get('hapus') == 'show' || Session::get('ubah') == 'show'): ?>
                                        show
                                    <?php else: ?>
                                        hidden
                                    <?php endif; ?>">#&nbsp;&nbsp;&nbsp;</th>
                                    <th style="width:120px">Nomor Wo</th>
                                    <th style="width:200px">Nama Produk</th>
                                    <th style="width:120px">Kode Produk</th>
                                    <th style="width:115px">Plan Date</th>
                                    <th style="width:130px">Realisation Date</th>
                                    <th style="width:115px">Status</th>
                                    <th style="width:115px">Plan Batch Size</th>
                                    <th style="width:130px">Actual Batch Size</th>
                                    <th style="width:115px">Keterangan 1</th>
                                    <th style="width:115px">Keterangan 2</th>
                                    <th style="width:115px">Keterangan 3</th>
                                    <th style="width:115px">Lot FG</th>
                                    <th style="width:300px">Revisi Formula</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php switch($schedule->wo_status):
                                    case ('0'): ?>
                                        <?php
                                            $status     = 'Pending | WIP Mixing';
                                            $style      = 'background-color:white';
                                        ?>
                                    <?php break; ?>
                                    <?php case ('1'): ?>
                                        <?php
                                            $status     = 'On Progress Mixing';
                                            $style      = 'background-color:#a6b1ff;';
                                        ?>
                                    <?php break; ?>
                                    <?php case ('2'): ?>
                                        <?php
                                            $status     = 'WIP Fillpack';
                                            $style      = 'background-color:#a6e6ff;';
                                        ?>
                                    <?php break; ?>
                                    <?php case ('3'): ?>
                                        <?php if(is_null($schedule->cppHead)): ?>
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
                                    <?php break; ?>
                                    <?php case ('4'): ?>
                                        <?php
                                            $status     = 'Waiting For Close';
                                            $style      = 'background-color:#a6ffb1;';
                                        ?>
                                    <?php break; ?>
                                    <?php case ('5'): ?>
                                        <?php
                                            $status     = 'Closed Wo';
                                            $style      = 'background-color:#44d44f;';
                                        ?>
                                    <?php break; ?>
                                    <?php case ('6'): ?>
                                        <?php
                                            $status     = 'Canceled';
                                            $style      = 'background-color:#ffa6bb;';
                                        ?>
                                    <?php break; ?>
                                        
                                <?php endswitch; ?>
                                <tr style="<?php echo e($style); ?>" >
                                    <td>
                                        <?php if($status == 'Canceled'): ?>
                                            
                                        <?php else: ?>
                                            <?php if(Session::get('ubah') == 'show'): ?>
                                                <a class="text-primary" onclick="setUpdateDataWo('realisation','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($schedule->id)); ?>')" data-toggle="modal" data-target="#prosesWoModal"> <i class="fa fa-edit"></i></a>&nbsp;|&nbsp;<a class="text-danger" onclick="deleteWo('<?php echo e($schedule->wo_number); ?>','<?php echo e($schedule->product->product_name); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($schedule->id)); ?>')"> <i class="fa fa-trash"></i></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($schedule->wo_number); ?></td>
                                    <td><?php echo e($schedule->product->product_name); ?></td>
                                    <td><?php echo e($schedule->product->oracle_code); ?></td>
                                    <td><?php echo e($schedule->production_plan_date); ?></td>
                                    <td><?php echo e($schedule->production_realisation_date); ?></td>
                                    <td> <?php echo e($status); ?> </td>
                                    <td><?php echo e($schedule->plan_batch_size); ?></td>
                                    <td><?php echo e($schedule->actual_batch_size); ?></td>
                                    <td><?php echo e($schedule->explanation_1); ?></td>
                                    <td><?php echo e($schedule->explanation_2); ?></td>
                                    <td><?php echo e($schedule->explanation_3); ?></td>
                                    <td>-</td>
                                    <td><?php echo e($schedule->formula_revision); ?></td>
                                    
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('rollie.production_schedules.pop-up.update-data-wo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/production_schedules/dashboard.blade.php ENDPATH**/ ?>