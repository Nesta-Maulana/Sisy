
<?php $__env->startSection('title'); ?>
    RKOL | RKJ Produk   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-rkol'); ?>
    menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-rollie-rkol-'.$route); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h5>List RKJ Produk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <table class="table table-bordered" id="ppq-produk-dashboard-table" >
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:200px">Nomor RKJ</th>
                                    <th class="text-center" style="width:250px">Nama Produk</th>
                                    <th class="text-center" style="width:200px">Tanggal Produksi</th>
                                    <th class="text-center" style="width:350px">Lot RKJ</th>
                                    <th class="text-center" style="width:200px">Referensi Nomor PPQ</th>
                                    <th class="text-center" style="width:200px">Referensi Alasan PPQ</th>
                                    <th class="text-center" style="width:200px">Hasil Penelusuran</th>
                                    <th class="text-center" style="width:150px">Status PPQ</th>
                                    <th class="text-center" style="width:200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $rkjs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rkj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php switch($rkj->status_akhir):
                                        case ('0'): ?>
                                            <?php
                                                $style  = "background-color:#9ef1e9;";
                                                $status = 'New RKJ' ;
                                            ?> 
                                        <?php break; ?>
                                        <?php case ('1'): ?>
                                            <?php
                                                $style  = "background-color:#a3f19e;";
                                                $status = 'On Progress RKJ' ;
                                            ?> 
                                        <?php break; ?> 
                                        <?php case ('2'): ?>
                                            <?php
                                                switch ($rkj->followUpRkj->status_produk) 
                                                {
                                                    case '0':
                                                        $status_produk = 'Reject';   
                                                    break;
                                                    case '1':
                                                        $status_produk = 'Release';   
                                                    break;
                                                    case '2':
                                                        $status_produk = 'Release Partial';   
                                                    break;
                                                }
                                                $style  = "background-color:#d9f19e;";
                                                $status = 'Done RKJ - '.$status_produk;
                                            ?>
                                        <?php break; ?>  
                                    <?php endswitch; ?>
                                    <tr style="<?php echo e($style); ?>" >
                                        <td onclick="prosesFollowUpRkj('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rkj->id)); ?>','<?php echo e($rkj->nomor_rkj); ?>','<?php echo e($rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name); ?>','<?php echo e($rkj->ppq->alasan); ?>','<?php echo e($rkj->status_akhir); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($route)); ?>')"> <strong><?php echo e($rkj->nomor_rkj); ?></strong> </td>
                                        <input type="hidden" id="follow_up_rkj_id_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rkj->id)); ?>" <?php if(!is_null($rkj->followUpRkj)): ?> value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rkj->followUpRkj->id)); ?>" <?php endif; ?>>
                                        <td> <?php echo e($rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name); ?> </td>
                                        <td> <?php echo e($rkj->ppq->production_realisation_date); ?> </td>
                                        <td>
                                            <?php
                                                $palet  = '';
                                            ?>
                                            <?php $__currentLoopData = $rkj->ppq->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $palet  .= $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ';
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e(rtrim($palet,', ')); ?>

                                        </td>
                                        <td>
                                           <?php echo e($rkj->ppq->nomor_ppq); ?>

                                        </td>
                                        <td>
                                            <?php echo e($rkj->ppq->alasan); ?>

                                        </td>
                                        <td>
                                            <?php echo e($rkj->ppq->followUpPpq->hasil_analisa); ?>

                                        </td>
                                        <td>
                                            <?php echo e($status); ?>

                                        </td>

                                        <td>
                                        <button onclick="prosesFollowUpRkj('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($rkj->id)); ?>','<?php echo e($rkj->nomor_rkj); ?>','<?php echo e($rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name); ?>','<?php echo e($rkj->ppq->alasan); ?>','<?php echo e($rkj->status_akhir); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($route)); ?>')" class="btn btn-primary form-control">Form Follow Up RKJ</button>
                                        </td>
                                        
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/rkj_product/dashboard.blade.php ENDPATH**/ ?>