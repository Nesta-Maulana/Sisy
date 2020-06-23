
<?php $__env->startSection('title'); ?>
    Analisa Mikrobiologi 
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
            <form action="submit-hasil-analisa" method="post">
                <input type="hidden" name="analisa_mikro_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikro->id)); ?>">
                <input type="hidden" name="product_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikro->cppHead->product->id)); ?>">
                <input type="hidden" id="product_type_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikro->cppHead->product->productType->id)); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="row">
                            <div class="col-lg col-md col-sm">
                                <h5>Form Analisa Mikro Produk <?php echo e($analisaMikro->cppHead->product->product_name); ?></h5> 
                            </div>
                            <?php if(app('App\Http\Controllers\ResourceController')->decrypt($params) == 'analisa_ph_produk' || app('App\Http\Controllers\ResourceController')->decrypt($params) == 'analisa_mikro_release'): ?> 
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <a class="btn btn-outline-primary form-control" data-toggle="modal" data-target="#tambahSampelAnalisaMikro"><i class="fa fa-plus"></i>&nbsp; Tambah Sampel</a>
                                </div> 
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php switch(app('App\Http\Controllers\ResourceController')->decrypt($params)):
                                    case ('analisa_mikro_produk'): ?>
                                        <?php
                                            $sampelbiasa    = 0;
                                            $tabindex       = 0;
                                        ?>
                                        <?php $__currentLoopData = $analisaMikro->analisaMikroDetails->unique('filling_machine_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemMachine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <table class="table analisa-mikro-form" >
                                                <thead >
                                                    <tr>
                                                        <th style="display: none"></th>
                                                        <th title="Field #1" >
                                                            Mesin
                                                        </th>
                                                        <th title="Field #2">
                                                            Kode Sampel
                                                        </th>
                                                        <th title="Field #3">
                                                            Jam Filling
                                                        </th>
                                                        <th title="Field #4" >
                                                            Suhu
                                                        </th>
                                                        <th title="Field #6">
                                                            TPC
                                                        </th>
                                                        <?php if($analisaMikro->cppHead->product->oracle_code == '7300861'): ?>
                                                            <th title="Field #7" >
                                                                Yeast
                                                            </th>
                                                            <th title="Field #8" >
                                                                Mold
                                                            </th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $analisaMikro->analisaMikroDetails->sortBy(function($item){  return $item->suhu_preinkubasi.'-'.$item->urutan; } ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaMikroDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id): ?>
                                                            <?php if($analisaMikroDetail->kode_sampel !== 'S1' && $analisaMikroDetail->kode_sampel !== 'S2' && $analisaMikroDetail->kode_sampel !== 'S3' &&  strpos($analisaMikroDetail->kode_sampel,'R') === false): ?> 
                                                                <tr>
                                                                    <?php
                                                                        preg_match("/([0-9]+)/", $analisaMikroDetail->kode_sampel, $matches);
                                                                    ?>
                                                                    <td style="display: none">  <?php echo e($matches[0]); ?> <?php $sampelbiasa+=intval($matches); ?></td>
                                                                    <td>
                                                                        <?php echo e($analisaMikroDetail->fillingMachine->filling_machine_code); ?>

                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php switch($analisaMikroDetail->kode_sampel):
                                                                            case ('S1'): ?>
                                                                                <?php echo e('AW'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S2'): ?>
                                                                                <?php echo e('TG'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S3'): ?>
                                                                                <?php echo e('AK'); ?>

                                                                            <?php break; ?>
                                                                        
                                                                            <?php default: ?>
                                                                                <?php echo e($analisaMikroDetail->kode_sampel); ?>

                                                                        <?php endswitch; ?>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" readonly class="datetimepickernya form-control" value="<?php echo e($analisaMikroDetail->jam_filling); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[jam_filling]" id="jam_filling_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>" onfocusout="changeFillingMikro('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php echo e($analisaMikroDetail->suhu_preinkubasi); ?>&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->tpc); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[tpc]">
                                                                    </td>
                                                                    <?php if($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861'): ?>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->yeast); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->mold); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[mold]" maxlength="4">
                                                                        </td>
                                                                    <?php endif; ?>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $analisaMikro->analisaMikroDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaMikroDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id): ?>
                                                            <?php if(strpos($analisaMikroDetail->kode_sampel,'R') !== false): ?> 
                                                                <tr>
                                                                    <td style="display: none"><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        <?php echo e($analisaMikroDetail->fillingMachine->filling_machine_code); ?>

                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php switch($analisaMikroDetail->kode_sampel):
                                                                            case ('S1'): ?>
                                                                                <?php echo e('AW'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S2'): ?>
                                                                                <?php echo e('TG'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S3'): ?>
                                                                                <?php echo e('AK'); ?>

                                                                            <?php break; ?>
                                                                        
                                                                            <?php default: ?>
                                                                                <?php echo e($analisaMikroDetail->kode_sampel); ?>

                                                                        <?php endswitch; ?>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="<?php echo e($analisaMikroDetail->jam_filling); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[jam_filling]" id="jam_filling_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>" onfocusout="changeFillingMikro('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>')" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td style="text-align: center;">
                                                                        <?php echo e($analisaMikroDetail->suhu_preinkubasi); ?>&deg;
                                                                    </td>
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->tpc); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[tpc]">
                                                                    </td>
                                                                    <?php if($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861'): ?>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->yeast); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->mold); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[mold]" maxlength="4">
                                                                        </td>
                                                                    <?php endif; ?>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $analisaMikro->analisaMikroDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaMikroDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id): ?>
                                                            <?php if($analisaMikroDetail->kode_sampel == 'S1' || $analisaMikroDetail->kode_sampel == 'S2' || $analisaMikroDetail->kode_sampel == 'S3'): ?> 
                                                                <tr>
                                                                    <td style="display: none" ><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        <?php echo e($analisaMikroDetail->fillingMachine->filling_machine_code); ?>

                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php switch($analisaMikroDetail->kode_sampel):
                                                                            case ('S1'): ?>
                                                                                <?php echo e('AW'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S2'): ?>
                                                                                <?php echo e('TG'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S3'): ?>
                                                                                <?php echo e('AK'); ?>

                                                                            <?php break; ?>
                                                                        
                                                                            <?php default: ?>
                                                                                <?php echo e($analisaMikroDetail->kode_sampel); ?>

                                                                        <?php endswitch; ?>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="<?php echo e($analisaMikroDetail->jam_filling); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[jam_filling]" id="jam_filling_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>" onfocusout="changeFillingMikro('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>')" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php echo e($analisaMikroDetail->suhu_preinkubasi); ?>&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->tpc); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[tpc]">
                                                                    </td>
                                                                    <?php if($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861'): ?>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->yeast); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->mold); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[mold]" maxlength="4">
                                                                        </td>
                                                                    <?php endif; ?>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php break; ?>
                                    
                                    <?php case ('analisa_ph_produk'): ?>
                                        <?php
                                            $sampelbiasa    = 0;
                                            $tabindex       = 0;
                                        ?>
                                    
                                        <?php $__currentLoopData = $analisaMikro->analisaMikroDetails->unique('filling_machine_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemMachine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <table class="table analisa-mikro-form" >
                                                <thead >
                                                    <tr>
                                                        <th style="display:none;"></th>
                                                        <th title="Field #1" >
                                                            Mesin
                                                        </th>
                                                        <th title="Field #2">
                                                            Kode Sampel
                                                        </th>
                                                        <th title="Field #3">
                                                            Jam Filling
                                                        </th>
                                                        <th title="Field #4" >
                                                            Suhu
                                                        </th>
                                                        <th title="Field #6">
                                                            PH
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $analisaMikro->analisaMikroDetails->sortBy(function($item){  return $item->suhu_preinkubasi.'-'.$item->urutan; } ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaMikroDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id): ?>
                                                            <?php if($analisaMikroDetail->kode_sampel !== 'S1' && $analisaMikroDetail->kode_sampel !== 'S2' && $analisaMikroDetail->kode_sampel !== 'S3' &&  strpos($analisaMikroDetail->kode_sampel,'R') === false): ?> 
                                                                <tr>
                                                                    <?php
                                                                        preg_match("/([0-9]+)/", $analisaMikroDetail->kode_sampel, $matches);
                                                                    ?>
                                                                    <td style="display:none;"> <?php echo e($matches[0]); ?> <?php $sampelbiasa+=intval($matches); ?></td>
                                                                    <td>
                                                                        <?php echo e($analisaMikroDetail->fillingMachine->filling_machine_code); ?>

                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php switch($analisaMikroDetail->kode_sampel):
                                                                            case ('S1'): ?>
                                                                                <?php echo e('AW'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S2'): ?>
                                                                                <?php echo e('TG'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S3'): ?>
                                                                                <?php echo e('AK'); ?>

                                                                            <?php break; ?>
                                                                        
                                                                            <?php default: ?>
                                                                                <?php echo e($analisaMikroDetail->kode_sampel); ?>

                                                                        <?php endswitch; ?>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" tabindex="<?php echo e($tabindex+1); ?>" class="datetimepickernya form-control" value="<?php echo e($analisaMikroDetail->jam_filling); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[jam_filling]" id="jam_filling_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>" onfocusout="changeFillingMikro('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php echo e($analisaMikroDetail->suhu_preinkubasi); ?>&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" class="form-control" tabindex="<?php echo e($tabindex+1); ?>" value="<?php if(!is_null($analisaMikroDetail->ph)): ?> <?php echo e(number_format($analisaMikroDetail->ph, 2, '.', ',')); ?> <?php endif; ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[ph]">
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $analisaMikro->analisaMikroDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaMikroDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id): ?>
                                                            <?php if(strpos($analisaMikroDetail->kode_sampel,'R') !== false): ?> 
                                                                <tr>
                                                                    <td style="display:none;"><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        <?php echo e($analisaMikroDetail->fillingMachine->filling_machine_code); ?>

                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php switch($analisaMikroDetail->kode_sampel):
                                                                            case ('S1'): ?>
                                                                                <?php echo e('AW'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S2'): ?>
                                                                                <?php echo e('TG'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S3'): ?>
                                                                                <?php echo e('AK'); ?>

                                                                            <?php break; ?>
                                                                        
                                                                            <?php default: ?>
                                                                                <?php echo e($analisaMikroDetail->kode_sampel); ?>

                                                                        <?php endswitch; ?>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" tabindex="<?php echo e($tabindex+1); ?>" class="datetimepickernya form-control" value="<?php echo e($analisaMikroDetail->jam_filling); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[jam_filling]" id="jam_filling_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>" onfocusout="changeFillingMikro('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>')">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td style="text-align: center;">
                                                                        <?php echo e($analisaMikroDetail->suhu_preinkubasi); ?>&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php if(!is_null($analisaMikroDetail->ph)): ?> <?php echo e(number_format($analisaMikroDetail->ph, 2, '.', ',')); ?> <?php endif; ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[ph]">
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $analisaMikro->analisaMikroDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaMikroDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id): ?>
                                                            <?php if($analisaMikroDetail->kode_sampel == 'S1' || $analisaMikroDetail->kode_sampel == 'S2' || $analisaMikroDetail->kode_sampel == 'S3'): ?> 
                                                                <tr>
                                                                    <td style="display:none;" ><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        <?php echo e($analisaMikroDetail->fillingMachine->filling_machine_code); ?>

                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php switch($analisaMikroDetail->kode_sampel):
                                                                            case ('S1'): ?>
                                                                                <?php echo e('AW'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S2'): ?>
                                                                                <?php echo e('TG'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S3'): ?>
                                                                                <?php echo e('AK'); ?>

                                                                            <?php break; ?>
                                                                        
                                                                            <?php default: ?>
                                                                                <?php echo e($analisaMikroDetail->kode_sampel); ?>

                                                                        <?php endswitch; ?>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" tabindex="<?php echo e($tabindex+1); ?>" value="<?php echo e($analisaMikroDetail->jam_filling); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[jam_filling]" id="jam_filling_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>" onfocusout="changeFillingMikro('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php echo e($analisaMikroDetail->suhu_preinkubasi); ?>&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php if(!is_null($analisaMikroDetail->ph)): ?> <?php echo e(number_format($analisaMikroDetail->ph, 2, '.', ',')); ?> <?php endif; ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[ph]">
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php break; ?>    

                                    <?php case ('analisa_mikro_release'): ?>
                                        <?php
                                            $tabindex       = 0;
                                            $sampelbiasa = 0;
                                        ?>
                                    
                                        <?php $__currentLoopData = $analisaMikro->analisaMikroDetails->unique('filling_machine_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemMachine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <table class="table analisa-mikro-form" >
                                                <thead >
                                                    <tr>
                                                        <th style="display:none;"></th>
                                                        <th title="Field #1" >
                                                            Mesin
                                                        </th>
                                                        <th title="Field #2">
                                                            Kode Sampel
                                                        </th>
                                                        <th title="Field #3">
                                                            Jam Filling
                                                        </th>
                                                        <th title="Field #4" >
                                                            Suhu
                                                        </th>
                                                        <th title="Field #6">
                                                            PH
                                                        </th>
                                                        
                                                        <th title="Field #7">
                                                            TPC
                                                        </th>
                                                        <?php if($analisaMikro->cppHead->product->oracle_code == '7300861'): ?>
                                                            <th title="Field #8" >
                                                                Yeast
                                                            </th>
                                                            <th title="Field #9" >
                                                                Mold
                                                            </th>
                                                        <?php endif; ?>
                                                        <th title="Field #10">
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $analisaMikro->analisaMikroDetails->sortBy(function($item){  return $item->suhu_preinkubasi.'-'.$item->urutan; } ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaMikroDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id): ?>
                                                            <?php if($analisaMikroDetail->kode_sampel !== 'S1' && $analisaMikroDetail->kode_sampel !== 'S2' && $analisaMikroDetail->kode_sampel !== 'S3' &&  strpos($analisaMikroDetail->kode_sampel,'R') === false): ?> 
                                                                <tr <?php if($analisaMikro->cppHead->product->oracle_code == '7300861'): ?> <?php if(!is_null($analisaMikroDetail->tpc) && !is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->yeast) && !is_null($analisaMikroDetail->mold) && $analisaMikroDetail->status == '0'): ?> class="bg-danger" <?php endif; ?> <?php else: ?> <?php if(!is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->tpc) && $analisaMikroDetail->status == '0'): ?> class="bg-danger"  <?php endif; ?> <?php endif; ?>>
                                                                    <?php
                                                                        preg_match("/([0-9]+)/", $analisaMikroDetail->kode_sampel, $matches);
                                                                    ?>
                                                                    <td style="display:none;"> <?php echo e($matches[0]); ?> <?php $sampelbiasa+=intval($matches); ?> </td>
                                                                    <td>
                                                                        <?php echo e($analisaMikroDetail->fillingMachine->filling_machine_code); ?>

                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php switch($analisaMikroDetail->kode_sampel):
                                                                            case ('S1'): ?>
                                                                                <?php echo e('AW'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S2'): ?>
                                                                                <?php echo e('TG'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S3'): ?>
                                                                                <?php echo e('AK'); ?>

                                                                            <?php break; ?>
                                                                        
                                                                            <?php default: ?>
                                                                                <?php echo e($analisaMikroDetail->kode_sampel); ?>

                                                                        <?php endswitch; ?>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="<?php echo e($analisaMikroDetail->jam_filling); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[jam_filling]" id="jam_filling_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>" onfocusout="changeFillingMikro('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php echo e($analisaMikroDetail->suhu_preinkubasi); ?>&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" class="form-control" tabindex="<?php echo e($tabindex+1); ?>" value="<?php if(!is_null($analisaMikroDetail->ph)): ?> <?php echo e(number_format($analisaMikroDetail->ph, 2, '.', ',')); ?> <?php endif; ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[ph]">
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->tpc); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[tpc]">
                                                                    </td>
                                                                    <?php if($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861'): ?>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->yeast); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->mold); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[mold]" maxlength="4">
                                                                        </td>
                                                                    <?php endif; ?>
                                                                    <td>
                                                                        <select class="form-control" tabindex="<?php echo e($tabindex+1); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[status]">
                                                                            <option value="0" <?php if($analisaMikroDetail->status == '0'): ?> selected  <?php endif; ?>>#OK</option>
                                                                            <option value="1" <?php if($analisaMikroDetail->status == '1'): ?> selected  <?php endif; ?>>OK</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $analisaMikro->analisaMikroDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaMikroDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id): ?>
                                                            <?php if(strpos($analisaMikroDetail->kode_sampel,'R') !== false): ?> 
                                                                <tr <?php if($analisaMikro->cppHead->product->oracle_code == '7300861'): ?> <?php if(!is_null($analisaMikroDetail->tpc) && !is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->yeast) && !is_null($analisaMikroDetail->mold) && $analisaMikroDetail->status == '0'): ?> class="bg-danger" <?php endif; ?> <?php else: ?> <?php if(!is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->tpc) && $analisaMikroDetail->status == '0'): ?> class="bg-danger"  <?php endif; ?> <?php endif; ?>>
                                                                    <td style="display:none;"><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        <?php echo e($analisaMikroDetail->fillingMachine->filling_machine_code); ?>

                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php switch($analisaMikroDetail->kode_sampel):
                                                                            case ('S1'): ?>
                                                                                <?php echo e('AW'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S2'): ?>
                                                                                <?php echo e('TG'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S3'): ?>
                                                                                <?php echo e('AK'); ?>

                                                                            <?php break; ?>
                                                                        
                                                                            <?php default: ?>
                                                                                <?php echo e($analisaMikroDetail->kode_sampel); ?>

                                                                        <?php endswitch; ?>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="<?php echo e($analisaMikroDetail->jam_filling); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[jam_filling]" id="jam_filling_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>" onfocusout="changeFillingMikro('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>')">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td style="text-align: center;">
                                                                        <?php echo e($analisaMikroDetail->suhu_preinkubasi); ?>&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php if(!is_null($analisaMikroDetail->ph)): ?> <?php echo e(number_format($analisaMikroDetail->ph, 2, '.', ',')); ?> <?php endif; ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[ph]">
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->tpc); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[tpc]">
                                                                    </td>
                                                                    <?php if($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861'): ?>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->yeast); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->mold); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[mold]" maxlength="4">
                                                                        </td>
                                                                    <?php endif; ?>
                                                                    
                                                                    <td>
                                                                        <select class="form-control" tabindex="<?php echo e($tabindex+1); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[status]">
                                                                            <option value="0" <?php if($analisaMikroDetail->status == '0'): ?> selected  <?php endif; ?>>#OK</option>
                                                                            <option value="1" <?php if($analisaMikroDetail->status == '1'): ?> selected  <?php endif; ?>>OK</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $analisaMikro->analisaMikroDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaMikroDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id): ?>
                                                            <?php if($analisaMikroDetail->kode_sampel == 'S1' || $analisaMikroDetail->kode_sampel == 'S2' || $analisaMikroDetail->kode_sampel == 'S3'): ?> 
                                                                <tr <?php if($analisaMikro->cppHead->product->oracle_code == '7300861'): ?> <?php if(!is_null($analisaMikroDetail->tpc) && !is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->yeast) && !is_null($analisaMikroDetail->mold) && $analisaMikroDetail->status == '0'): ?> class="bg-danger" <?php endif; ?> <?php else: ?> <?php if(!is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->tpc) && $analisaMikroDetail->status == '0'): ?> class="bg-danger"  <?php endif; ?> <?php endif; ?>>
                                                                    <td style="display:none;" ><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        <?php echo e($analisaMikroDetail->fillingMachine->filling_machine_code); ?>

                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php switch($analisaMikroDetail->kode_sampel):
                                                                            case ('S1'): ?>
                                                                                <?php echo e('AW'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S2'): ?>
                                                                                <?php echo e('TG'); ?>

                                                                            <?php break; ?>
                                                                            <?php case ('S3'): ?>
                                                                                <?php echo e('AK'); ?>

                                                                            <?php break; ?>
                                                                        
                                                                            <?php default: ?>
                                                                                <?php echo e($analisaMikroDetail->kode_sampel); ?>

                                                                        <?php endswitch; ?>
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="<?php echo e($analisaMikroDetail->jam_filling); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[jam_filling]" id="jam_filling_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>" onfocusout="changeFillingMikro('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        <?php echo e($analisaMikroDetail->suhu_preinkubasi); ?>&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php if(!is_null($analisaMikroDetail->ph)): ?> <?php echo e(number_format($analisaMikroDetail->ph, 2, '.', ',')); ?> <?php endif; ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[ph]">
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                            readonly 
                                                                        <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->tpc); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[tpc]">
                                                                    </td>
                                                                    <?php if($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861'): ?>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->yeast); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input <?php if(Session::get('ubah') == 'hidden'): ?>
                                                                                readonly 
                                                                            <?php endif; ?> type="text" tabindex="<?php echo e($tabindex+1); ?>" class="form-control" value="<?php echo e($analisaMikroDetail->mold); ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[mold]" maxlength="4">
                                                                        </td>
                                                                    <?php endif; ?>
                                                                    
                                                                    <td>
                                                                        <select class="form-control" tabindex="<?php echo e($tabindex+1); ?>" name ="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id)); ?>[status]">
                                                                            <option value="0" <?php if($analisaMikroDetail->status == '0'): ?> selected  <?php endif; ?>>#OK</option>
                                                                            <option value="1" <?php if($analisaMikroDetail->status == '1'): ?> selected  <?php endif; ?>>OK</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php break; ?>
                                <?php endswitch; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg col-md col-sm">
                                <div class="form-group">
                                    <button class="btn btn-outline-secondary form-control" value="draft" name="simpan">Simpan Sebagai Draft</button>
                                </div>
                            </div>
                            <?php if(Session::get('ubah') == 'show'): ?>
                                <div class="col-lg col-md col-sm">
                                    <div class="form-group">
                                        <button class="btn btn-primary form-control" value="simpan" name="simpan">Simpan Hasil Analisa</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php echo $__env->make('rollie.analisa_mikro.pop-up.tambah-sampel-mikro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/analisa_mikro/form.blade.php ENDPATH**/ ?>