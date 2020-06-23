
<?php $__env->startSection('title'); ?>
    RKOL | PPQ Produk   
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
                <h5>List PPQ Produk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <table class="table table-bordered" id="ppq-produk-dashboard-table" >
                            <thead>
                                <tr>
                                    <th class="text-center" style="">#</th>
                                    <th class="text-center" style="width:200px">Nomor PPQ</th>
                                    <th class="text-center" style="width:250px">Nama Produk</th>
                                    <th class="text-center" style="width:200px">Tanggal Produksi</th>
                                    <th class="text-center" style="width:350px">Lot PPQ</th>
                                    <th class="text-center" style="width:200px">Jenis PPQ</th>
                                    <th class="text-center" style="width:200px">Alasan PPQ</th>
                                    <th class="text-center" style="width:200px">Jumlah PPQ</th>
                                    <th class="text-center" style="width:150px">Status PPQ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $ppqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php switch($ppq->status_akhir):
                                        case ('0'): ?>
                                            <?php
                                                $style  = "background-color:#f19e9e;";
                                                $status = 'New PPQ';
                                                $button = 'Proses Follow Up PPQ';
                                                $icons  = 'fa-pencil-square-o';
                                            ?> 
                                        <?php break; ?>
                                        <?php case ('1'): ?>
                                            <?php
                                                $style  = "background-color:#d9f19e;";
                                                $status = 'On Progress PPQ' ;
                                                $button = 'Form Follow Up PPQ';
                                                $icons  = 'fa-pencil-square-o';
                                            ?>
                                        <?php break; ?>
                                        <?php case ('2'): ?>
                                            <?php
                                                if ($route == 'ppq-engineering') 
                                                {
                                                    if (is_null($ppq->followUpPpq->status_case) || $ppq->followUpPpq->status_case == '0' || $ppq->followUpPpq->status_case == '' )
                                                    {
                                                        $style  = "background-color:#d9f19e;";
                                                        $status = 'On Progress PPQ' ;
                                                        $button = 'Form Follow Up PPQ';
                                                        $icons  = 'fa-pencil-square-o';

                                                    }
                                                    else if (!is_null($ppq->followUpPpq->status_case) && $ppq->followUpPpq->status_case =='1')
                                                    {
                                                        $style  = "background-color:#a3f19e;";
                                                        $status = $ppq->followUpPpq->status_produk ;       
                                                        $button = 'Lihat Hasil Follow Up';
                                                        $icons  = 'fa-eye';

                                                    }
                                                }
                                                else
                                                {
                                                    $style  = "background-color:#a3f19e;";
                                                    $status = $ppq->followUpPpq->status_produk ;
                                                    $button = 'Lihat Hasil Follow Up';
                                                    $icons  = 'fa-eye';

                                                }
                                                switch ($status) 
                                                {
                                                    case '0':
                                                        $status = 'Reject';
                                                        $style  = "background-color:#ff1d1d;";
                                                    break;
                                                    
                                                    case '1':
                                                        $status = 'Release';
                                                    break;
                                                    
                                                    case '2':
                                                        $status = 'Release Partial';
                                                    break;
                                                }
                                            ?> 
                                        <?php break; ?>
                                        <?php case ('3'): ?>
                                            <?php
                                                $style  = "background-color:#f19e9e;";
                                                $status = 'On Progress RKJ' ;
                                                $button = 'Lihat Hasil Follow Up';
                                                $icons  = 'fa-eye';

                                            ?> 
                                        <?php break; ?> 
                                        <?php case ('4'): ?>
                                            <?php
                                                $style  = "background-color:#d9f19e;";
                                                $status = 'Done RKJ' ;
                                                $button = 'Lihat Hasil Follow Up';
                                                $icons  = 'fa-eye';
                                            ?>
                                        <?php break; ?> 
                                        <?php case ('5'): ?>
                                            <?php
                                                $style  = "background-color:beige;";
                                                $status = 'Draft PPQ' ;
                                                $icons  = 'fa-pencil-square-o';

                                                // $button = 'Lihat Hasil Follow Up';
                                            ?>
                                        <?php break; ?>      
                                    <?php endswitch; ?>
                                    <?php switch($route):
                                        case ('ppq-qc-release'): ?>
                                            <?php
                                                $onclick    = "prosesFollowUpPpq('".app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)."','".$ppq->nomor_ppq."','".$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name."','".$ppq->alasan."','".$ppq->status_akhir."','".app('App\Http\Controllers\ResourceController')->encrypt($route)."','".app('App\Http\Controllers\ResourceController')->encrypt('null')."')";
                                            ?>
                                        <?php break; ?>

                                        <?php case ('ppq-qc-tahanan'): ?>
                                            <?php switch($ppq->kategoriPpq->jenisPpq->jenis_ppq):
                                                case ('Package Integrity'): ?>
                                                    <?php
                                                        $onclick    = "prosesFollowUpPpq('".app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)."','".$ppq->nomor_ppq."','".$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name."','".$ppq->alasan."','".$ppq->status_akhir."','".app('App\Http\Controllers\ResourceController')->encrypt('ppq-qc-release')."','".app('App\Http\Controllers\ResourceController')->encrypt($route)."')";     
                                                    ?>
                                                <?php break; ?>
                                                <?php case ('Kimia'): ?>
                                                    <?php
                                                        $onclick    = "prosesFollowUpPpq('".app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)."','".$ppq->nomor_ppq."','".$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name."','".$ppq->alasan."','".$ppq->status_akhir."','".app('App\Http\Controllers\ResourceController')->encrypt($route)."','".app('App\Http\Controllers\ResourceController')->encrypt('null')."')";
                                                    ?>
                                                <?php break; ?>
                                            <?php endswitch; ?>
                                        <?php break; ?>
                                        <?php case ('ppq-engineering'): ?>
                                            <?php
                                                $onclick    = "prosesFollowUpPpq('".app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)."','".$ppq->nomor_ppq."','".$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name."','".$ppq->alasan."','".$ppq->status_akhir."','".app('App\Http\Controllers\ResourceController')->encrypt($route)."','".app('App\Http\Controllers\ResourceController')->encrypt('null')."')";     
                                            ?>
                                        <?php break; ?>
                                        
                                    <?php endswitch; ?>
                                    <?php if($ppq->kategoriPpq->jenisPpq->jenis_ppq == 'Mikro'): ?>
                                        <?php if($ppq->analisaMikroResampling->progress_status == '1' && $ppq->analisaMikroResampling->analisa_mikro_status == '0'): ?>
                                            <tr style="<?php echo e($style); ?>" >
                                                <td>
                                                    <button class="btn btn-primary" onclick="<?php echo e($onclick); ?>">
                                                        <i class="fas <?php echo e($icons); ?>"></i>
                                                    </button>
                                                </td>
                                                <td > <span style="font-weight: 800;"><?php echo e($ppq->nomor_ppq); ?></span> </td>
                                                <input type="hidden" id="follow_up_ppq_id_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" <?php if(!is_null($ppq->followUpPpq)): ?> value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->followUpPpq->id)); ?>" <?php endif; ?>>
                                                <td> <?php echo e($ppq->palets[0]->palet->cppDetail->woNumber->product->product_name); ?> </td>
                                                <td> <?php echo e($ppq->production_realisation_date); ?> </td>
                                                <td>
                                                    <?php
                                                        $palet  = '';
                                                    ?>
                                                    <?php $__currentLoopData = $ppq->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $palet  .= $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ';
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e(rtrim($palet,', ')); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($ppq->kategoriPpq->jenisPpq->jenis_ppq); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($ppq->alasan); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($ppq->jumlah_pack); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($status); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <tr style="<?php echo e($style); ?>" >
                                            <td>
                                                <button class="btn btn-primary" onclick="<?php echo e($onclick); ?>"><i class="fas <?php echo e($icons); ?>"></i></button>
                                            </td>
                                            <td > <span style="font-weight: 800;"><?php echo e($ppq->nomor_ppq); ?></span> </td>
                                            <input type="hidden" id="follow_up_ppq_id_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)); ?>" <?php if(!is_null($ppq->followUpPpq)): ?> value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($ppq->followUpPpq->id)); ?>" <?php endif; ?>>
                                            <td> <?php echo e($ppq->palets[0]->palet->cppDetail->woNumber->product->product_name); ?> </td>
                                            <td> <?php echo e($ppq->production_realisation_date); ?> </td>
                                            <td>
                                                <?php
                                                    $palet  = '';
                                                ?>
                                                <?php $__currentLoopData = $ppq->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet_ppq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $palet  .= $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ';
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(rtrim($palet,', ')); ?>

                                            </td>
                                            <td>
                                                <?php echo e($ppq->kategoriPpq->jenisPpq->jenis_ppq); ?>

                                            </td>
                                            <td>
                                                <?php echo e($ppq->alasan); ?>

                                            </td>
                                            <td>
                                                <?php echo e($ppq->jumlah_pack); ?>

                                            </td>
                                            <td>
                                                <?php echo e($status); ?>

                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/ppq_product/dashboard.blade.php ENDPATH**/ ?>