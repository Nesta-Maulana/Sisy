
<?php $__env->startSection('title'); ?>
    RKOL | Follow Up PPQ Form   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-rkol'); ?>
    menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-rollie-rkol-'.$route); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
<form action="/rollie/form-follow-up-ppq/update-follow-up-ppq" method="POST">
        <?php echo e(csrf_field()); ?>

    <input type="hidden" name="follow_up_ppq_id" id="follow_up_ppq_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($followUpPpq->id)); ?>">
    <input type="hidden" name="params" id="params" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($route)); ?>">
    <input type="hidden" name="ppq_id" id="ppq_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($followUpPpq->ppq->id)); ?>">
    <input type="hidden" name="params_route" id="params_route" value="<?php echo e($route); ?>">
    <input type="hidden" name="params_induk" id="params_induk" value="<?php echo e($params_induk); ?>">
        
        <?php switch($route):
            case ('ppq-qc-release'): ?> <!-- ini bisa juga sebenernya akses qc tahanan nanti di deklarasi dengan params induk untuk pembedanya -->
                <?php switch($followUpPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq):
                    case ('Package Integrity'): ?>
                        <?php if($followUpPpq->status_follow_up_ppq == '1'): ?>
                            <?php
                                $attribute = 'readonly';
                            ?>
                        <?php else: ?>
                            <?php
                                $attribute = '';
                            ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h5>Follow Up PPQ <?php echo e($followUpPpq->ppq->nomor_ppq); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label for="jumlah_metode_sampling" class="control-label">Jumlah dan Metode Sampling</label>
                                                    <div>
                                                        <textarea class="form-control" name="jumlah_metode_sampling" id="jumlah_metode_sampling" <?php echo e($attribute); ?> ><?php if(!is_null($followUpPpq->jumlah_metode_sampling)): ?><?php echo e($followUpPpq->jumlah_metode_sampling); ?><?php endif; ?></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="hasil_analisa" class="control-label">Hasil Analisa</label>
                                                    <div>
                                                        <textarea class="form-control" name="hasil_analisa" id="hasil_analisa" <?php echo e($attribute); ?> ><?php if(!is_null($followUpPpq->hasil_analisa)): ?><?php echo e($followUpPpq->hasil_analisa); ?><?php endif; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_produk" class="control-label">Status Produk</label>
                                                    <?php if($attribute == 'readonly'): ?>
                                                        <input type="text" class="form-control" <?php switch($followUpPpq->status_produk):
                                                            case ('0'): ?>
                                                            value="Reject" style="background-color:#f19e9e;"
                                                            <?php break; ?>
                                                            <?php case ('1'): ?>
                                                            value="Release" style="background-color:#a3f19e;" 
                                                            <?php break; ?>
                                                            <?php case ('2'): ?>
                                                            value="Release Partial" style="background-color:#e4f19e"
                                                            <?php break; ?>
                                                        <?php endswitch; ?>
                                                        <?php echo e($attribute); ?>>
                                                    <?php else: ?>
                                                        <select class="form-control" name="status_produk" id="status_produk">
                                                            <option value="10" selected readonly> Pilih Status Produk </option>
                                                            <option value="0" <?php if($followUpPpq->status_produk == '0'): ?>  selected <?php endif; ?>> Reject </option>
                                                            <option value="1" <?php if($followUpPpq->status_produk == '1'): ?>  selected <?php endif; ?>> Release </option>
                                                            <option value="2" <?php if($followUpPpq->status_produk == '2'): ?>  selected <?php endif; ?>> Release Partial </option>
                                                        </select>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="tanggal_status_ppq" class="control-label">Tanggal Status Produk</label>
                                                    <?php if($attribute == 'readonly'): ?>
                                                        <input type='text' class="form-control" name="tanggal_status_ppq" id="tanggal_status_ppq" value="<?php if(!is_null($followUpPpq->tanggal_status_ppq)): ?><?php echo e($followUpPpq->tanggal_status_ppq); ?> <?php endif; ?>" <?php echo e($attribute); ?>>
                                                    
                                                    <?php else: ?>
                                                        <div class='input-group date datepicker' style="padding-left:0px;">
                                                            <input type='text' class="form-control" name="tanggal_status_ppq" id="tanggal_status_ppq" value="<?php if(!is_null($followUpPpq->tanggal_status_ppq)): ?>  <?php echo e($followUpPpq->tanggal_status_ppq); ?> <?php endif; ?>">
                                                            <span class="input-group-addon" style="margin-top: 5px; font-size: 20px; margin-left: 10px;">
                                                                <span class="fas fa-calendar"></span>
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nomor_lbd">Nomor LBD</label>
                                                    <input id="nomor_lbd" class="form-control" type="text" name="nomor_lbd" value="-" <?php echo e($attribute); ?>>
                                                </div>
                                                <?php if($attribute !== 'readonly'): ?>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <button class="btn btn-outline-primary form-control" name="params_save" value="draft" id="draft_button">Simpan Draft Penelusuran</button>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <a class="btn btn-primary form-control text-white" name="save" id="save_button" onclick="validasiInputFollowUp()">Simpan Hasil Penulusuran</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <?php if($params_induk !== 'null'): ?>
                                                                    <a href="<?php echo e(route('rollie.rkol.'.str_replace('-','_',$params_induk))); ?>" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard PPQ</a>
                                                                <?php else: ?>
                                                                    <a href="<?php echo e(route('rollie.rkol.ppq_qc_release')); ?>" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard PPQ</a>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-7">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h5>Detail PPQ <?php echo e($followUpPpq->ppq->nomor_ppq); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="nomor_ppq">Nomor PPQ</label>
                                                    <input id="nomor_ppq" class="form-control" type="text" name="nomor_ppq" value="<?php echo e($followUpPpq->ppq->nomor_ppq); ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_ppq">Tanggal PPQ</label>
                                                    <input id="tanggal_ppq" class="form-control" type="text" name="tanggal_ppq" value="<?php echo e(date('d-m-Y',strtotime($followUpPpq->ppq->ppq_date))); ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jam_awal_ppq">Jam Awal PPQ</label>
                                                    <input id="jam_awal_ppq" class="form-control" type="text" name="jam_awal_ppq" value="<?php echo e($followUpPpq->ppq->jam_awal_ppq); ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jam_akhir_ppq">Jam Akhir PPQ</label>
                                                    <input id="jam_akhir_ppq" class="form-control" type="text" name="jam_akhir_ppq" value="<?php echo e($followUpPpq->ppq->jam_akhir_ppq); ?>" readonly>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="jenis_ppq">Jenis PPQ</label>
                                                    <input id="jenis_ppq" class="form-control" type="text" name="jenis_ppq" value="<?php echo e($followUpPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq); ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kategori_ppq">Kategori PPQ</label>
                                                    <input id="kategori_ppq" class="form-control" type="text" name="kategori_ppq" value="<?php echo e($followUpPpq->ppq->kategoriPpq->kategori_ppq); ?>" readonly>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="detail_titik_ppq">Detail Titik PPQ</label>
                                                    <input id="detail_titik_ppq" class="form-control" type="text" name="detail_titik_ppq" value="<?php echo e($followUpPpq->ppq->detail_titik_ppq); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="alasan">Alasan PPQ</label>
                                                    <textarea id="alasan" rows="3"  class="form-control" type="text" name="alasan"  readonly><?php echo e($followUpPpq->ppq->alasan); ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="wo_number">Nomor Wo</label>
                                                    <?php
                                                        $wo_numbers   = array();
                                                        $lot_numbers   = array();
                                                        foreach ($followUpPpq->ppq->palets as $palet_ppq) 
                                                        {
                                                            if (!in_array($palet_ppq->palet->cppDetail->woNumber->wo_number,$wo_numbers)) 
                                                            {
                                                                array_push($wo_numbers,$palet_ppq->palet->cppDetail->woNumber->wo_number);
                                                            }
                                                            
                                                            if (!in_array($palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet,$lot_numbers)) 
                                                            {
                                                                array_push($lot_numbers,$palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet);
                                                            }
                                                        }
                                                        $wo_number   = '';
                                                        foreach ($wo_numbers as $woNumber) 
                                                        {
                                                            $wo_number .= $woNumber.', ';
                                                        }
                                                        
                                                        $lot_number   = '';
                                                        foreach ($lot_numbers as $lotNumber) 
                                                        {
                                                            $lot_number .= $lotNumber.', ';
                                                        }
                                                    ?>
                                                    <textarea id="wo_number" rows="3" class="form-control" type="text" name="wo_number"  readonly><?php echo e(rtrim($wo_number,', ')); ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lot_number">Lot Number</label>
                                                    <textarea id="lot_number" rows="3"  class="form-control" type="text" name="lot_number" readonly><?php echo e(rtrim($lot_number,', ')); ?></textarea>
                                                </div>
                                                <div class="form-group" style="margin-top: 2.75rem!important;">
                                                    <label for="jumlah_pack">Jumlah Pack PPQ</label>
                                                    <input id="jumlah_pack" class="form-control" type="text" name="jumlah_pack" value="<?php echo e($followUpPpq->ppq->jumlah_pack); ?>" readonly>
                                                </div>
                                                
                                                <div class="form-group" >
                                                    <label for="user_inputer">User Inputer</label>
                                                    <input id="user_inputer" class="form-control" type="text" name="user_inputer" value="<?php echo e($followUpPpq->ppq->userCreate->employee->fullname); ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php break; ?>
                <?php endswitch; ?>
                
            <?php break; ?>
            <?php case ('ppq-qc-tahanan'): ?>
                <?php if($followUpPpq->status_follow_up_ppq =='1'): ?>
                    <?php
                        $attribute = 'readonly';
                    ?>
                <?php else: ?>
                    <?php
                        $attribute = '';
                    ?>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h5>Follow Up PPQ <?php echo e($followUpPpq->ppq->nomor_ppq); ?> <?php if($followUpPpq->ppq->status_akhir > 2 ): ?> Eskalasi To RKJ <?php echo e($followUpPpq->ppq->rkj->nomor_rkj); ?> <?php endif; ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="row">
                                                    <div  <?php if(count($followUpPpq->correctiveActions) == '0' && count($followUpPpq->preventiveActions) == '0'): ?>
                                                        class="col-lg-12 col-md-12 col-sm-12"
                                                    <?php else: ?>
                                                        class="col-lg-6 col-md-6 col-sm-6"
                                                    <?php endif; ?>  id="hasil_evaluasi_div">
                                                        <div class="form-group">
                                                            <label for="hasil_analisa" class="control-label">Hasil Evaluasi</label>
                                                            <div>
                                                                <textarea type="text" class="form-control" name="hasil_analisa" id="hasil_analisa" placeholder="Hasil Evaluasi" rows="4" required <?php echo e($attribute); ?>><?php if(!is_null($followUpPpq->hasil_analisa)): ?><?php echo e($followUpPpq->hasil_analisa); ?><?php endif; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <?php if($followUpPpq->ppq->status_akhir !== '3'): ?>
                                                                
                                                            <div class="form-group">
                                                                <label for="">Tindakan Follow Up</label>
                                                                <select class="form-control" onchange="cekTindakanFollowUp()" id="tindakan" <?php if($attribute =='readonly'): ?>
                                                                    disabled 
                                                                <?php endif; ?>>
                                                                    <option value="pilih" selected disabled>Pilih Tindakan</option>
                                                                    <option value="rkj">Buat RKJ</option>
                                                                    <option value="ppq" <?php if(count($followUpPpq->correctiveActions) > 0 || count($followUpPpq->preventiveActions) > 0): ?> selected <?php endif; ?>>Isi Corrective Action & Preventive Action</option>
                                                                </select>
                                                            </div>   
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-lg-6 col sm-6 col-md-6 <?php if(count($followUpPpq->correctiveActions) == 0 && count($followUpPpq->correctiveActions) == 0): ?> <?php echo e('hidden'); ?> <?php else: ?>  <?php endif; ?>" id="status_produk_div">
                                                        <div class="form-group">
                                                            <label for="status_produk" class="control-label">Status Produk</label>
                                                            <?php if($attribute == 'readonly'): ?>
                                                                <input type="text" class="form-control" <?php switch($followUpPpq->status_produk):
                                                                    case ('0'): ?>
                                                                    value="Reject" style="background-color:#f19e9e;"
                                                                    <?php break; ?>
                                                                    <?php case ('1'): ?>
                                                                    value="Release" style="background-color:#a3f19e;" 
                                                                    <?php break; ?>
                                                                    <?php case ('2'): ?>
                                                                    value="Release Partial" style="background-color:#e4f19e"
                                                                    <?php break; ?>
                                                                <?php endswitch; ?>
                                                                <?php echo e($attribute); ?>>
                                                            <?php else: ?>
                                                                <select class="form-control" name="status_produk" id="status_produk">
                                                                    <option value="10" selected readonly> Pilih Status Produk </option>
                                                                    <option value="0" <?php if($followUpPpq->status_produk == '0'): ?>  selected <?php endif; ?>> Reject </option>
                                                                    <option value="1" <?php if($followUpPpq->status_produk == '1'): ?>  selected <?php endif; ?>> Release </option>
                                                                    <option value="2" <?php if($followUpPpq->status_produk == '2'): ?>  selected <?php endif; ?>> Release Partial </option>
                                                                </select>
                                                            <?php endif; ?>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="tanggal_status_ppq" class="control-label">Tanggal Status Produk</label>
                                                            <?php if($attribute == 'readonly'): ?>
                                                                <input type='text' class="form-control" name="tanggal_status_ppq" id="tanggal_status_ppq" value="<?php if(!is_null($followUpPpq->tanggal_status_ppq)): ?><?php echo e($followUpPpq->tanggal_status_ppq); ?> <?php endif; ?>" <?php echo e($attribute); ?>>
                                                            
                                                            <?php else: ?>
                                                                <div class='input-group date datepicker' style="padding-left:0px;">
                                                                    <input type='text' class="form-control" name="tanggal_status_ppq" id="tanggal_status_ppq" value="<?php if(!is_null($followUpPpq->tanggal_status_ppq)): ?>  <?php echo e($followUpPpq->tanggal_status_ppq); ?> <?php endif; ?>">
                                                                    <span class="input-group-addon" style="margin-top: 5px; font-size: 20px; margin-left: 10px;">
                                                                        <span class="fas fa-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nomor_lbd">Nomor LBD</label>
                                                            <input id="nomor_lbd" class="form-control" type="text" name="nomor_lbd" value="-" <?php echo e($attribute); ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="corrective"  <?php if(count($followUpPpq->correctiveActions) == 0 && count($followUpPpq->correctiveActions) == 0): ?> class="hidden" <?php else: ?>  <?php endif; ?> >
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                                                            <h6>Corrective Action</h6>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                                            <?php if($attribute !== 'readonly'): ?>
                                                                                <a class="btn btn-outline-primary text-secondary" onclick="cloneCorrectiveAction()"><i class="fa fa-plus"></i> Corrective Action</a>
                                                                            <?php endif; ?>
                                                                        </div>  
                                                                    </div>
                                                                </div>
                                                                <div class="card-body" id="corrective_action_body">
                                                                    <div id="corrective_action_div">
                                                                        <?php if(count($followUpPpq->correctiveActions) > 0): ?>
                                                                            <?php $__currentLoopData = $followUpPpq->correctiveActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $correctiveAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if($correctiveAction->createdBy->id !== Auth::user()->id): ?>
                                                                                    <?php
                                                                                        $attribute_corrective = 'readonly';
                                                                                    ?>
                                                                                <?php else: ?>
                                                                                    <?php
                                                                                        $attribute_corrective = '';
                                                                                    ?>
                                                                                <?php endif; ?>
                                                                                <?php if($followUpPpq->status_follow_up_ppq =='0'): ?>
                                                                                    <div class="form-group">
                                                                                        <label for="corrective_action" class="control-label">Corrective Action</label>
                                                                                        <div>
                                                                                            <textarea type="text" class="form-control corrective_action" name="corrective_action[]" id="corrective_action" placeholder="Corrective Action" <?php echo e($attribute); ?>><?php echo e($correctiveAction->corrective_action); ?></textarea>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="pic_corrective_action" class="control-label">PIC Corrective Action </label>
                                                                                        <input type="text" class="form-control pic_corrective_action" name="pic_corrective_action[]" id="pic_corrective_action" placeholder="PIC Corrective Action" value="<?php echo e($correctiveAction->pic_corrective_action); ?>" <?php echo e($attribute); ?>>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="due_date_corrective_action" class="control-label">Due Date Corrective Action </label>
                                                                                        <input type="date" class="form-control due_date_corrective_action" name="due_date_corrective_action[]" id="due_date_corrective_action" value="<?php echo e($correctiveAction->due_date_corrective_action); ?>" <?php echo e($attribute); ?>>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="status_corrective_action" class="control-label">Status Corrective Action </label>
                                                                                        <select name="status_corrective_action[]" id="status_preventive_action" class="form-control status_preventive_action" <?php if($attribute == 'readonly'): ?> disabled

                                                                                        <?php endif; ?>>
                                                                                            <option value="0" <?php if($correctiveAction->status_corrective_action == '0'): ?> selected <?php endif; ?>>On Progress</option>
                                                                                            <option value="1" <?php if($correctiveAction->status_corrective_action == '1'): ?> selected <?php endif; ?>>Done</option>
                                                                                        </select>
                                                                                    </div>
                                                                                <?php else: ?>
                                                                                    <?php if($correctiveAction->status_corrective_action == '0'): ?>
                                                                                        <?php
                                                                                            $status_corrective  = ''; 
                                                                                            $draft              = 1;
                                                                                            ?>
                                                                                    <?php else: ?>
                                                                                    <?php
                                                                                            $status_corrective  = 'readonly';
                                                                                            $draft              = 0;
                                                                                        ?>
                                                                                    <?php endif; ?>
                                                                                    <div class="form-group">
                                                                                        <label for="corrective_action" class="control-label">Corrective Action</label>
                                                                                        <div>
                                                                                            <textarea type="text" class="form-control corrective_action" name="corrective_action[]" id="corrective_action" placeholder="Corrective Action" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>><?php echo e($correctiveAction->corrective_action); ?></textarea>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="pic_corrective_action" class="control-label">PIC Corrective Action </label>
                                                                                        <input type="text" class="form-control pic_corrective_action" name="pic_corrective_action[]" id="pic_corrective_action" placeholder="PIC Corrective Action" value="<?php echo e($correctiveAction->pic_corrective_action); ?>" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="due_date_corrective_action" class="control-label">Due Date Corrective Action </label>
                                                                                        <input type="date" class="form-control due_date_corrective_action" name="due_date_corrective_action[]" id="due_date_corrective_action" value="<?php echo e($correctiveAction->due_date_corrective_action); ?>" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>>
                                                                                        <input type="hidden" class="form-control corrective_action_id" name="corrective_action_id[]" id="corrective_action_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($correctiveAction->id)); ?>" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="status_corrective_action" class="control-label">Status Corrective Action </label>
                                                                                        <select name="status_corrective_action[]" id="status_preventive_action" class="form-control status_preventive_action" <?php if($attribute_corrective == 'readonly' || $status_corrective == 'readonly'): ?> disabled

                                                                                        <?php endif; ?>>
                                                                                            <option value="0" <?php if($correctiveAction->status_corrective_action == '0'): ?> selected <?php endif; ?>>On Progress</option>
                                                                                            <option value="1" <?php if($correctiveAction->status_corrective_action == '1'): ?> selected <?php endif; ?>>Done</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="verifikasi_corrective_action" class="control-label">Verifikasi Corrective Action </label>
                                                                                        <textarea type="text" class="form-control verifikasi_corrective_action" name="verifikasi_corrective_action[]" id="verifikasi_corrective_action" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>><?php echo e($correctiveAction->verifikasi_corrective_action); ?></textarea>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php else: ?>
                                                                            <div class="form-group">
                                                                                <label for="corrective_action" class="control-label">Corrective Action</label>
                                                                                <div>
                                                                                    <textarea type="text" class="form-control" name="corrective_action[]" id="corrective_action[]" placeholder="Corrective Action" <?php echo e($attribute); ?>></textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="pic_corrective_action" class="control-label">PIC Corrective Action </label>
                                                                                <input type="text" class="form-control" name="pic_corrective_action[]" id="pic_corrective_action[]" placeholder="PIC Corrective Action" <?php echo e($attribute); ?>>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="due_date_corrective_action" class="control-label">Due Date Corrective Action </label>
                                                                                <input type="date" class="form-control" name="due_date_corrective_action[]" id="due_date_corrective_action[]" <?php echo e($attribute); ?>>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="status_corrective_action" class="control-label">Status Corrective Action </label>
                                                                                <select name="status_corrective_action[]" id="status_preventive_action[]" class="form-control" <?php if($attribute == 'readonly'): ?>
                                                                                    disabled 
                                                                                <?php endif; ?>>
                                                                                    <option value="0">On Progress</option>
                                                                                    <option value="1">Done</option>
                                                                                </select>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <hr>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                                                            <h6>Preventive Action</h6>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                                            <?php if($attribute !== 'readonly'): ?>
                                                                            <a class="btn btn-outline-primary text-secondary" onclick="clonePreventiveAction()"><i class="fa fa-plus"></i> Preventive Action</a>
                                                                            <?php endif; ?>
                                                                        </div>  
                                                                    </div>
                                                                </div>
                                                                <div class="card-body" id="preventive_action_body">
                                                                    <div id="preventive_action_div">
                                                                        <?php if(count($followUpPpq->preventiveActions) > 0): ?>
                                                                            <?php $__currentLoopData = $followUpPpq->preventiveActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preventiveAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if($preventiveAction->createdBy->id !== Auth::user()->id): ?>
                                                                                    <?php
                                                                                        $attribute_preventive = 'readonly';
                                                                                    ?>
                                                                                <?php else: ?>
                                                                                    <?php
                                                                                        $attribute_preventive = '';
                                                                                    ?>
                                                                                <?php endif; ?>
                                                                                <?php if($followUpPpq->status_follow_up_ppq == '0'): ?>
                                                                                    <div class="form-group">
                                                                                        <label for="preventive" class="control-label">Preventive Action</label>
                                                                                        <div>
                                                                                            <textarea type="text" class="form-control" name="preventive_action[]" id="preventive_action[]" placeholder="Preventive Action" <?php echo e($attribute); ?>><?php echo e($preventiveAction->preventive_action); ?></textarea>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="pic_preventive_action" class="control-label">PIC Preventive Action </label>
                                                                                        <input type="text" class="form-control" name="pic_preventive_action[]" id="pic_preventive_action[]" placeholder="PIC Preventive Action" value="<?php echo e($preventiveAction->pic_preventive_action); ?>" <?php echo e($attribute); ?>>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="due_date_preventive_action" class="control-label">Due Date Preventive Action </label>
                                                                                        <input type="date" class="form-control" name="due_date_preventive_action[]" id="due_date_preventive_action[]" value="<?php echo e($preventiveAction->due_date_preventive_action); ?>" <?php echo e($attribute); ?>>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="status_preventive_action" class="control-label">Status Preventive Action </label>
                                                                                        <select name="status_preventive_action[]" id="status_preventive_action[]"  class="form-control" <?php if($attribute =='readonly'): ?>
                                                                                            disabled 
                                                                                        <?php endif; ?>>
                                                                                            <option value="0" <?php if($preventiveAction->status_preventive_action == '0'): ?> selected <?php endif; ?>>On Progress</option>
                                                                                            <option value="1" <?php if($preventiveAction->status_preventive_action == '1'): ?> selected <?php endif; ?>>Done</option>
                                                                                        </select>
                                                                                    </div>
                                                                                <?php else: ?> 
                                                                                    <?php if($preventiveAction->status_preventive_action == '0'): ?>
                                                                                        <?php
                                                                                            $status_preventive  = ''; 
                                                                                            $draft              = 1;
                                                                                        ?>
                                                                                    <?php else: ?>
                                                                                        <?php
                                                                                            $status_preventive  = 'readonly'; 
                                                                                            $draft              = 0;
                                                                                        ?>
                                                                                    <?php endif; ?>
                                                                                    <div class="form-group">
                                                                                        <label for="preventive" class="control-label">Preventive Action</label>
                                                                                        <div>
                                                                                            <textarea type="text" class="form-control" name="preventive_action[]" id="preventive_action[]" placeholder="Preventive Action" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>><?php echo e($preventiveAction->preventive_action); ?></textarea>
                                                                                            <input type="hidden" class="form-control preventive_action_id" name="preventive_action_id[]" id="preventive_action_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($preventiveAction->id)); ?>" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>>

                                                                                        </div>
                                                                                    </div>
    
                                                                                    <div class="form-group">
                                                                                        <label for="pic_preventive_action" class="control-label">PIC Preventive Action </label>
                                                                                        <input type="text" class="form-control" name="pic_preventive_action[]" id="pic_preventive_action[]" placeholder="PIC Preventive Action" value="<?php echo e($preventiveAction->pic_preventive_action); ?>" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="due_date_preventive_action" class="control-label">Due Date Preventive Action </label>
                                                                                        <input type="date" class="form-control" name="due_date_preventive_action[]" id="due_date_preventive_action[]" value="<?php echo e($preventiveAction->due_date_preventive_action); ?>" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="status_preventive_action" class="control-label">Status Preventive Action </label>
                                                                                        <select name="status_preventive_action[]" id="status_preventive_action[]"  class="form-control" <?php if($attribute_preventive =='readonly' || $status_preventive =='readonly'): ?>
                                                                                            disabled 
                                                                                        <?php endif; ?>>
                                                                                            <option value="0" <?php if($preventiveAction->status_preventive_action == '0'): ?> selected <?php endif; ?>>On Progress</option>
                                                                                            <option value="1" <?php if($preventiveAction->status_preventive_action == '1'): ?> selected <?php endif; ?>>Done</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="verifikasi_preventive_action" class="control-label">Verifikasi Preventive Action </label>
                                                                                        <textarea type="text" class="form-control verifikasi_preventive_action" name="verifikasi_preventive_action[]" id="verifikasi_preventive_action" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>><?php echo e($preventiveAction->verifikasi_preventive_action); ?></textarea>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php else: ?>
                                                                            <div class="form-group">
                                                                                <label for="preventive" class="control-label">Preventive Action</label>
                                                                                <div>
                                                                                    <textarea type="text" class="form-control" name="preventive_action[]" id="preventive_action[]" placeholder="Preventive Action" <?php echo e($attribute); ?>></textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="pic_preventive_action" class="control-label">PIC Preventive Action </label>
                                                                                <input type="text" class="form-control" name="pic_preventive_action[]" id="pic_preventive_action[]" placeholder="PIC Preventive Action" <?php echo e($attribute); ?>>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="due_date_preventive_action" class="control-label">Due Date Preventive Action </label>
                                                                                <input type="date" class="form-control" name="due_date_preventive_action[]" id="due_date_preventive_action[]" <?php echo e($attribute); ?>>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="status_preventive_action" class="control-label">Status Preventive Action </label>
                                                                                <select name="status_preventive_action[]" id="status_preventive_action[]"  class="form-control" <?php if($attribute == 'readonly'): ?>
                                                                                    disabled 
                                                                                <?php endif; ?>>
                                                                                    <option value="0">On Progress</option>
                                                                                    <option value="1">Done</option>
                                                                                </select>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <hr>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if($attribute !== 'readonly'): ?>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                        </div>  
                                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                                            <div class="form-group">
                                                                <button class="btn btn-outline-primary form-control" name="params_save" value="draft">Simpan Draft Penelusuran</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                                            <div class="form-group">
                                                                <a class="btn btn-primary form-control text-white " value="draft" onclick="validasiInputFollowUp()">Simpan Hasil Penelusuran</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php else: ?>
                                                        <?php if($draft > 0): ?>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <a href="<?php echo e(route('rollie.rkol.ppq_qc_tahanan')); ?>" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard PPQ</a>
                                                                </div>  
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="form-group">
                                                                        <button class="btn btn-outline-primary form-control" name="params_save" value="updatenya">Update Corrective Action & Preventive Action</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <a href="<?php echo e(route('rollie.rkol.ppq_qc_tahanan')); ?>" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard PPQ</a>
                                                            </div>  
                                                        </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h5>Detail PPQ <?php echo e($followUpPpq->ppq->nomor_ppq); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="nomor_ppq">Nomor PPQ</label>
                                                    <input id="nomor_ppq" class="form-control" type="text" name="nomor_ppq" value="<?php echo e($followUpPpq->ppq->nomor_ppq); ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_ppq">Tanggal PPQ</label>
                                                    <input id="tanggal_ppq" class="form-control" type="text" name="tanggal_ppq" value="<?php echo e(date('d-m-Y',strtotime($followUpPpq->ppq->ppq_date))); ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jam_awal_ppq">Jam Awal PPQ</label>
                                                    <input id="jam_awal_ppq" class="form-control" type="text" name="jam_awal_ppq" value="<?php echo e($followUpPpq->ppq->jam_awal_ppq); ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jam_akhir_ppq">Jam Akhir PPQ</label>
                                                    <input id="jam_akhir_ppq" class="form-control" type="text" name="jam_akhir_ppq" value="<?php echo e($followUpPpq->ppq->jam_akhir_ppq); ?>" readonly>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="jenis_ppq">Jenis PPQ</label>
                                                    <input id="jenis_ppq" class="form-control" type="text" name="jenis_ppq" value="<?php echo e($followUpPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq); ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kategori_ppq">Kategori PPQ</label>
                                                    <input id="kategori_ppq" class="form-control" type="text" name="kategori_ppq" value="<?php echo e($followUpPpq->ppq->kategoriPpq->kategori_ppq); ?>" readonly>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="detail_titik_ppq">Detail Titik PPQ</label>
                                                    <input id="detail_titik_ppq" class="form-control" type="text" name="detail_titik_ppq" value="<?php echo e($followUpPpq->ppq->detail_titik_ppq); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="alasan">Alasan PPQ</label>
                                                    <textarea id="alasan" rows="3"  class="form-control" type="text" name="alasan"  readonly><?php echo e($followUpPpq->ppq->alasan); ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="wo_number">Nomor Wo</label>
                                                    <?php
                                                        $wo_numbers   = array();
                                                        $lot_numbers   = array();
                                                        foreach ($followUpPpq->ppq->palets as $palet_ppq) 
                                                        {
                                                            if (!in_array($palet_ppq->palet->cppDetail->woNumber->wo_number,$wo_numbers)) 
                                                            {
                                                                array_push($wo_numbers,$palet_ppq->palet->cppDetail->woNumber->wo_number);
                                                            }
                                                            
                                                            if (!in_array($palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet,$lot_numbers)) 
                                                            {
                                                                array_push($lot_numbers,$palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet);
                                                            }
                                                        }
                                                        $wo_number   = '';
                                                        foreach ($wo_numbers as $woNumber) 
                                                        {
                                                            $wo_number .= $woNumber.', ';
                                                        }
                                                        
                                                        $lot_number   = '';
                                                        foreach ($lot_numbers as $lotNumber) 
                                                        {
                                                            $lot_number .= $lotNumber.', ';
                                                        }
                                                    ?>
                                                    <textarea id="wo_number" rows="3" class="form-control" type="text" name="wo_number"  readonly><?php echo e(rtrim($wo_number,', ')); ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lot_number">Lot Number</label>
                                                    <textarea id="lot_number" rows="3"  class="form-control" type="text" name="lot_number" readonly><?php echo e(rtrim($lot_number,', ')); ?></textarea>
                                                </div>
                                                <div class="form-group" style="margin-top: 3.0rem!important;">
                                                    <label for="jumlah_pack">Jumlah Pack PPQ</label>
                                                    <input id="jumlah_pack" class="form-control" type="text" name="jumlah_pack" value="<?php echo e($followUpPpq->ppq->jumlah_pack); ?>" readonly>
                                                </div>
                                                
                                                <div class="form-group" >
                                                    <label for="user_inputer">User Inputer</label>
                                                    <input id="user_inputer" class="form-control" type="text" name="user_inputer" value="<?php echo e($followUpPpq->ppq->userCreate->employee->fullname); ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h5>Detail Fisikokimia</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="product_name">Nama Produk</label>
                                            <input class="form-control" type="text" name="product_name" id="product_name" value="<?php echo e($followUpPpq->ppq->cppHead->product->product_name); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="oracle_code">Kode Oracle</label>
                                            <input class="form-control" type="text" name="oracle_code" id="oracle_code" value="<?php echo e($followUpPpq->ppq->cppHead->product->oracle_code); ?>" readonly>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="spek_ts_min">Spek TS Min</label>
                                                    <input class="form-control" type="text" name="spek_ts_min" id="spek_ts_min" value="<?php echo e(number_format($followUpPpq->ppq->cppHead->product->spek_ts_min, 2, '.', ',')); ?>" readonly>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="spek_ts_max">Spek TS Max</label>
                                                    <input class="form-control" type="text" name="spek_ts_max" id="spek_ts_max" value="<?php echo e(number_format($followUpPpq->ppq->cppHead->product->spek_ts_max, 2, '.', ',')); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="spek_ph_min">Spek pH Min</label>
                                                    <input class="form-control" type="text" name="spek_ph_min" id="spek_ph_min" value="<?php echo e(number_format($followUpPpq->ppq->cppHead->product->spek_ph_min, 2, '.', ',')); ?>" readonly>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="spek_ph_max">Spek pH Max</label>
                                                    <input class="form-control" type="text" name="spek_ph_max" id="spek_ph_max" value="<?php echo e(number_format($followUpPpq->ppq->cppHead->product->spek_ph_max, 2, '.', ',')); ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                                <div class="card-header" id="dataTS" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <h5>
                                                        Data TS
							                            <i class="pull-right fa fa-arrow-down" id="iconnya"></i>

                                                    </h5> 

                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelledby="dataTS" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ts_awal_1">TS Awal 1</label>
                                                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ts_awal_1)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ts_awal_1,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ts_awal_2">TS Awal 2</label>
                                                                    <input type="text" class="form-control" id="ts_awal_2" name="ts_awal_2" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ts_awal_2)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ts_awal_2,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ts_awal_avg">TS Awal Avg</label>
                                                                    <input type="text" class="form-control" id="ts_awal_avg" name="ts_awal_avg" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ts_awal_avg)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ts_awal_avg,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ts_tengah_1">TS Tengah 1</label>
                                                                    <input type="text" class="form-control" id="ts_tengah_1" name="ts_tengah_1" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ts_tengah_1)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ts_tengah_1,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ts_tengah_2">TS Tengah 2</label>
                                                                    <input type="text" class="form-control" id="ts_tengah_2" name="ts_tengah_2" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ts_tengah_2)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ts_tengah_2,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ts_tengah_avg">TS Tengah Avg</label>
                                                                    <input type="text" class="form-control" id="ts_tengah_avg" name="ts_tengah_avg" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ts_tengah_avg)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ts_tengah_avg,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ts_akhir_1">TS Akhir 1</label>
                                                                    <input type="text" class="form-control" id="ts_akhir_1" name="ts_akhir_1" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ts_akhir_1)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ts_akhir_1,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ts_akhir_2">TS Akhir 2</label>
                                                                    <input type="text" class="form-control" id="ts_akhir_2" name="ts_akhir_2" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ts_akhir_2)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ts_akhir_2,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ts_akhir_avg">TS Akhir Avg</label>
                                                                    <input type="text" class="form-control" id="ts_akhir_avg" name="ts_akhir_avg" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ts_akhir_avg)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ts_akhir_avg,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="dataPH" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                    <h5>
                                                        Data pH
							                            <i class="pull-right fa fa-arrow-down" id="iconnya"></i>

                                                    </h5> 
                                                </div>

                                                <div id="collapseTwo" class="collapse" aria-labelledby="dataPH" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ph_awal">pH Awal</label>
                                                                    <input type="text" class="form-control" id="ph_awal" name="ph_awal" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ph_awal)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ph_awal,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>      
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ph_tengah">pH Tengah</label>
                                                                    <input type="text" class="form-control" id="ph_tengah" name="ph_tengah" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ph_tengah)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ph_tengah,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>      
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="ph_akhir">pH Akhir</label>
                                                                    <input type="text" class="form-control" id="ph_akhir" name="ph_akhir" <?php if(!is_null($followUpPpq->ppq->cppHead->analisaKimia->ph_akhir)): ?>
                                                                        value="<?php echo e(number_format($followUpPpq->ppq->cppHead->analisaKimia->ph_akhir,2,'.',',')); ?>" 
                                                                    <?php endif; ?> onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" readonly >
                                                                </div>      
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="dataSensori" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                    <h5>
                                                        Data Sensori
							                            <i class="pull-right fa fa-arrow-down" id="iconnya"></i>

                                                    </h5> 
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="dataSensori" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="sensori_awal">Sensori Awal</label>
                                                                    <input type="text" class="form-control" value="<?php echo e($followUpPpq->ppq->cppHead->analisaKimia->sensori_awal); ?>" name="sensori_awal" id="sensori_awal" readonly>
                                                                </div>      
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="sensori_tengah">Sensori Tengah</label>
                                                                    <input type="text" class="form-control" value="<?php echo e($followUpPpq->ppq->cppHead->analisaKimia->sensori_tengah); ?>" name="sensori_tengah" id="sensori_tengah" readonly>
                                                                </div>      
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="sensori_akhir">Sensori Akhir</label>
                                                                    <input type="text" class="form-control" value="<?php echo e($followUpPpq->ppq->cppHead->analisaKimia->sensori_akhir); ?>" name="sensori_akhir" id="sensori_akhir" readonly>  
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
                    </div>
                </div>
            <?php break; ?>
            <?php case ('ppq-engineering'): ?>
                <?php if($followUpPpq->status_case =='1'): ?>
                    <?php
                        $attribute ='readonly';
                    ?>
                <?php else: ?>
                    <?php
                        $attribute ='';
                    ?>
                <?php endif; ?>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h5>Form Follow Up PPQ Engineering</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="root_cause">Root Cause</label>
                                                <textarea name="root_cause" id="root_cause" class="form-control" <?php echo e($attribute); ?>><?php if(!is_null($followUpPpq->root_cause)): ?><?php echo e($followUpPpq->root_cause); ?><?php endif; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori_case">Kategori Case</label>
                                                <select name="kategori_case" id="kategori_case" class="form-control" <?php if($attribute == 'readonly'): ?> disabled <?php endif; ?>>
                                                    <option value="10" selected>Pilih Kategori</option>
                                                    <option value="0" <?php if($followUpPpq->kategori_case == '0'): ?> selected <?php endif; ?>>Lama</option>
                                                    <option value="1" <?php if($followUpPpq->kategori_case == '1'): ?> selected <?php endif; ?>>Baru</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                                            <h6>Corrective Action</h6>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <?php if($attribute !== 'readonly'): ?>
                                                                <a class="btn btn-outline-primary text-secondary" onclick="cloneCorrectiveAction()"><i class="fa fa-plus"></i> Corrective Action</a>
                                                            <?php endif; ?>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class="card-body" id="corrective_action_body">
                                                    <div id="corrective_action_div">
                                                        <?php if(count($followUpPpq->correctiveActions) > 0): ?>
                                                            <?php $__currentLoopData = $followUpPpq->correctiveActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $correctiveAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($correctiveAction->createdBy->id !== Auth::user()->id): ?>
                                                                    <?php
                                                                        $attribute_corrective = 'readonly';
                                                                    ?>
                                                                <?php else: ?>
                                                                    <?php
                                                                        $attribute_corrective = '';
                                                                    ?>
                                                                <?php endif; ?>
                                                                <?php if($followUpPpq->status_case =='0' || is_null($followUpPpq->status_case)): ?>
                                                                    <div class="form-group">
                                                                        <label for="corrective_action" class="control-label">Corrective Action</label>
                                                                        <div>
                                                                            <textarea type="text" class="form-control corrective_action" name="corrective_action[]" id="corrective_action" placeholder="Corrective Action" <?php echo e($attribute); ?>><?php echo e($correctiveAction->corrective_action); ?></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="pic_corrective_action" class="control-label">PIC Corrective Action </label>
                                                                        <input type="text" class="form-control pic_corrective_action" name="pic_corrective_action[]" id="pic_corrective_action" placeholder="PIC Corrective Action" value="<?php echo e($correctiveAction->pic_corrective_action); ?>" <?php echo e($attribute); ?>>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="due_date_corrective_action" class="control-label">Due Date Corrective Action </label>
                                                                        <input type="date" class="form-control due_date_corrective_action" name="due_date_corrective_action[]" id="due_date_corrective_action" value="<?php echo e($correctiveAction->due_date_corrective_action); ?>" <?php echo e($attribute); ?>>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="status_corrective_action" class="control-label">Status Corrective Action </label>
                                                                        <select name="status_corrective_action[]" id="status_preventive_action" class="form-control status_preventive_action" <?php if($attribute == 'readonly'): ?> disabled

                                                                        <?php endif; ?>>
                                                                            <option value="0" <?php if($correctiveAction->status_corrective_action == '0'): ?> selected <?php endif; ?>>On Progress</option>
                                                                            <option value="1" <?php if($correctiveAction->status_corrective_action == '1'): ?> selected <?php endif; ?>>Done</option>
                                                                        </select>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <?php if($correctiveAction->status_corrective_action == '0'): ?>
                                                                        <?php
                                                                            $status_corrective  = ''; 
                                                                            $draft              = 1;
                                                                            ?>
                                                                    <?php else: ?>
                                                                        <?php
                                                                            $status_corrective  = 'readonly';
                                                                            $draft              = 0;
                                                                        ?>
                                                                    <?php endif; ?>
                                                                    <div class="form-group">
                                                                        <label for="corrective_action" class="control-label">Corrective Action</label>
                                                                        <div>
                                                                            <textarea type="text" class="form-control corrective_action" name="corrective_action[]" id="corrective_action" placeholder="Corrective Action" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>><?php echo e($correctiveAction->corrective_action); ?></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="pic_corrective_action" class="control-label">PIC Corrective Action </label>
                                                                        <input type="text" class="form-control pic_corrective_action" name="pic_corrective_action[]" id="pic_corrective_action" placeholder="PIC Corrective Action" value="<?php echo e($correctiveAction->pic_corrective_action); ?>" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="due_date_corrective_action" class="control-label">Due Date Corrective Action </label>
                                                                        <input type="date" class="form-control due_date_corrective_action" name="due_date_corrective_action[]" id="due_date_corrective_action" value="<?php echo e($correctiveAction->due_date_corrective_action); ?>" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>>
                                                                        <input type="hidden" class="form-control corrective_action_id" name="corrective_action_id[]" id="corrective_action_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($correctiveAction->id)); ?>" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="status_corrective_action" class="control-label">Status Corrective Action </label>
                                                                        <select name="status_corrective_action[]" id="status_preventive_action" class="form-control status_preventive_action" <?php if($attribute_corrective == 'readonly' || $status_corrective == 'readonly'): ?> disabled

                                                                        <?php endif; ?>>
                                                                            <option value="0" <?php if($correctiveAction->status_corrective_action == '0'): ?> selected <?php endif; ?>>On Progress</option>
                                                                            <option value="1" <?php if($correctiveAction->status_corrective_action == '1'): ?> selected <?php endif; ?>>Done</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="verifikasi_corrective_action" class="control-label">Verifikasi Corrective Action </label>
                                                                        <textarea type="text" class="form-control verifikasi_corrective_action" name="verifikasi_corrective_action[]" id="verifikasi_corrective_action" <?php echo e($attribute_corrective); ?> <?php echo e($status_corrective); ?>><?php echo e($correctiveAction->verifikasi_corrective_action); ?></textarea>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <div class="form-group">
                                                                <label for="corrective_action" class="control-label">Corrective Action</label>
                                                                <div>
                                                                    <textarea type="text" class="form-control" name="corrective_action[]" id="corrective_action[]" placeholder="Corrective Action" <?php echo e($attribute); ?>></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="pic_corrective_action" class="control-label">PIC Corrective Action </label>
                                                                <input type="text" class="form-control" name="pic_corrective_action[]" id="pic_corrective_action[]" placeholder="PIC Corrective Action" <?php echo e($attribute); ?>>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="due_date_corrective_action" class="control-label">Due Date Corrective Action </label>
                                                                <input type="date" class="form-control" name="due_date_corrective_action[]" id="due_date_corrective_action[]" <?php echo e($attribute); ?>>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="status_corrective_action" class="control-label">Status Corrective Action </label>
                                                                <select name="status_corrective_action[]" id="status_preventive_action[]" class="form-control" <?php if($attribute == 'readonly'): ?>
                                                                    disabled 
                                                                <?php endif; ?>>
                                                                    <option value="0">On Progress</option>
                                                                    <option value="1">Done</option>
                                                                </select>
                                                            </div>
                                                        <?php endif; ?>
                                                    <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                                            <h6>Preventive Action</h6>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <?php if($attribute !== 'readonly'): ?>
                                                            <a class="btn btn-outline-primary text-secondary" onclick="clonePreventiveAction()"><i class="fa fa-plus"></i> Preventive Action</a>
                                                            <?php endif; ?>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class="card-body" id="preventive_action_body">
                                                    <div id="preventive_action_div">
                                                        <?php if(count($followUpPpq->preventiveActions) > 0): ?>
                                                            <?php $__currentLoopData = $followUpPpq->preventiveActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preventiveAction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($preventiveAction->createdBy->id !== Auth::user()->id): ?>
                                                                    <?php
                                                                        $attribute_preventive = 'readonly';
                                                                    ?>
                                                                <?php else: ?>
                                                                    <?php
                                                                        $attribute_preventive = '';
                                                                    ?>
                                                                <?php endif; ?>
                                                                <?php if($followUpPpq->status_case == '0' || is_null($followUpPpq->status_case)): ?>
                                                                    <div class="form-group">
                                                                        <label for="preventive" class="control-label">Preventive Action</label>
                                                                        <div>
                                                                            <textarea type="text" class="form-control" name="preventive_action[]" id="preventive_action[]" placeholder="Preventive Action" <?php echo e($attribute); ?>><?php echo e($preventiveAction->preventive_action); ?></textarea>
                                                                        </div>

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="pic_preventive_action" class="control-label">PIC Preventive Action </label>
                                                                        <input type="text" class="form-control" name="pic_preventive_action[]" id="pic_preventive_action[]" placeholder="PIC Preventive Action" value="<?php echo e($preventiveAction->pic_preventive_action); ?>" <?php echo e($attribute); ?>>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="due_date_preventive_action" class="control-label">Due Date Preventive Action </label>
                                                                        <input type="date" class="form-control" name="due_date_preventive_action[]" id="due_date_preventive_action[]" value="<?php echo e($preventiveAction->due_date_preventive_action); ?>" <?php echo e($attribute); ?>>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="status_preventive_action" class="control-label">Status Preventive Action </label>
                                                                        <select name="status_preventive_action[]" id="status_preventive_action[]"  class="form-control" <?php if($attribute =='readonly'): ?>
                                                                            disabled 
                                                                        <?php endif; ?>>
                                                                            <option value="0" <?php if($preventiveAction->status_preventive_action == '0'): ?> selected <?php endif; ?>>On Progress</option>
                                                                            <option value="1" <?php if($preventiveAction->status_preventive_action == '1'): ?> selected <?php endif; ?>>Done</option>
                                                                        </select>
                                                                    </div>
                                                                <?php else: ?> 
                                                                    <?php if($preventiveAction->status_preventive_action == '0'): ?>
                                                                        <?php
                                                                            $status_preventive  = ''; 
                                                                            $draft              = 1;
                                                                        ?>
                                                                    <?php else: ?>
                                                                        <?php
                                                                            $status_preventive  = 'readonly'; 
                                                                            $draft              = 0;
                                                                        ?>
                                                                    <?php endif; ?>
                                                                    <div class="form-group">
                                                                        <label for="preventive" class="control-label">Preventive Action</label>
                                                                        <div>
                                                                            <textarea type="text" class="form-control" name="preventive_action[]" id="preventive_action[]" placeholder="Preventive Action" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>><?php echo e($preventiveAction->preventive_action); ?></textarea>
                                                                            <input type="hidden" class="form-control preventive_action_id" name="preventive_action_id[]" id="preventive_action_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($preventiveAction->id)); ?>" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="pic_preventive_action" class="control-label">PIC Preventive Action </label>
                                                                        <input type="text" class="form-control" name="pic_preventive_action[]" id="pic_preventive_action[]" placeholder="PIC Preventive Action" value="<?php echo e($preventiveAction->pic_preventive_action); ?>" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="due_date_preventive_action" class="control-label">Due Date Preventive Action </label>
                                                                        <input type="date" class="form-control" name="due_date_preventive_action[]" id="due_date_preventive_action[]" value="<?php echo e($preventiveAction->due_date_preventive_action); ?>" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="status_preventive_action" class="control-label">Status Preventive Action </label>
                                                                        <select name="status_preventive_action[]" id="status_preventive_action[]"  class="form-control" <?php if($attribute_preventive =='readonly' || $status_preventive =='readonly'): ?>
                                                                            disabled 
                                                                        <?php endif; ?>>
                                                                            <option value="0" <?php if($preventiveAction->status_preventive_action == '0'): ?> selected <?php endif; ?>>On Progress</option>
                                                                            <option value="1" <?php if($preventiveAction->status_preventive_action == '1'): ?> selected <?php endif; ?>>Done</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="verifikasi_preventive_action" class="control-label">Verifikasi Preventive Action </label>
                                                                        <textarea type="text" class="form-control verifikasi_preventive_action" name="verifikasi_preventive_action[]" id="verifikasi_preventive_action" <?php echo e($attribute_preventive); ?> <?php echo e($status_preventive); ?>><?php echo e($preventiveAction->verifikasi_preventive_action); ?></textarea>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <div class="form-group">
                                                                <label for="preventive" class="control-label">Preventive Action</label>
                                                                <div>
                                                                    <textarea type="text" class="form-control" name="preventive_action[]" id="preventive_action[]" placeholder="Preventive Action" <?php echo e($attribute); ?>></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="pic_preventive_action" class="control-label">PIC Preventive Action </label>
                                                                <input type="text" class="form-control" name="pic_preventive_action[]" id="pic_preventive_action[]" placeholder="PIC Preventive Action" <?php echo e($attribute); ?>>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="due_date_preventive_action" class="control-label">Due Date Preventive Action </label>
                                                                <input type="date" class="form-control" name="due_date_preventive_action[]" id="due_date_preventive_action[]" <?php echo e($attribute); ?>>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="status_preventive_action" class="control-label">Status Preventive Action </label>
                                                                <select name="status_preventive_action[]" id="status_preventive_action[]"  class="form-control" <?php if($attribute == 'readonly'): ?>
                                                                    disabled 
                                                                <?php endif; ?>>
                                                                    <option value="0">On Progress</option>
                                                                    <option value="1">Done</option>
                                                                </select>
                                                            </div>
                                                        <?php endif; ?>
                                                    <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="status_case">Status Case</label>
                                                <select name="status_case" id="status_case" class="form-control" <?php if($attribute =='readonly'): ?>
                                                    disabled 
                                                <?php endif; ?>>
                                                    <option value="10" selected>Pilih Status Case</option>
                                                    <option value="0" <?php if($followUpPpq->status_case == '0'): ?> selected <?php endif; ?>>On Progress</option>
                                                    <option value="1" <?php if($followUpPpq->status_case == '1'): ?> selected <?php endif; ?>>Close</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($attribute !== 'readonly'): ?>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <button class="btn btn-outline-primary form-control" name="params_save" value="draft">Simpan Draft Penelusuran</button>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <a class="btn btn-primary form-control text-white" name="save" onclick="validasiInputFollowUp()">Simpan Hasil Penulusuran</a>
                                            </div>
                                        </div>
                                    <?php else: ?> 
                                        <?php if($draft > 0): ?>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <a href="<?php echo e(route('rollie.rkol.ppq_engineering')); ?>" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard PPQ</a>
                                                </div>  
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <button class="btn btn-outline-primary form-control" name="params_save" value="updatenya">Update Corrective Action & Preventive Action</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <a href="<?php echo e(route('rollie.rkol.ppq_engineering')); ?>" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard PPQ</a>
                                                </div>  
                                            </div>
                                        <?php endif; ?>    
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Detail PPQ</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="nomor_ppq">Nomor PPQ</label>
                                        <input id="nomor_ppq" class="form-control" type="text" name="nomor_ppq" value="<?php echo e($followUpPpq->ppq->nomor_ppq); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_ppq">Tanggal PPQ</label>
                                        <input id="tanggal_ppq" class="form-control" type="text" name="tanggal_ppq" value="<?php echo e(date('d-m-Y',strtotime($followUpPpq->ppq->ppq_date))); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_awal_ppq">Jam Awal PPQ</label>
                                        <input id="jam_awal_ppq" class="form-control" type="text" name="jam_awal_ppq" value="<?php echo e($followUpPpq->ppq->jam_awal_ppq); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_akhir_ppq">Jam Akhir PPQ</label>
                                        <input id="jam_akhir_ppq" class="form-control" type="text" name="jam_akhir_ppq" value="<?php echo e($followUpPpq->ppq->jam_akhir_ppq); ?>" readonly>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="jenis_ppq">Jenis PPQ</label>
                                        <input id="jenis_ppq" class="form-control" type="text" name="jenis_ppq" value="<?php switch($followUpPpq->ppq->jenis_ppq):case ('0'): ?>KIMIA <?php break; ?> <?php case ('1'): ?>MIKRO <?php break; ?> <?php case ('2'): ?>SORTASI <?php break; ?> <?php case ('3'): ?>PACKAGE INTEGRITY <?php break; ?>
                                        <?php endswitch; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_ppq">Kategori PPQ</label>
                                        <input id="kategori_ppq" class="form-control" type="text" name="kategori_ppq" value="<?php switch($followUpPpq->ppq->kategori_ppq):case ('0'): ?>MAN <?php break; ?> <?php case ('1'): ?>Machine <?php break; ?> <?php case ('2'): ?>Method <?php break; ?> <?php case ('3'): ?>Material <?php break; ?> <?php case ('4'): ?>Enviroment <?php break; ?> <?php case ('5'): ?>Sortasi <?php break; ?>@case('6')Miss Handling <?php break; ?>@case('7')Dan Lain-Lain <?php break; ?>
                                        <?php endswitch; ?>" readonly>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="detail_titik_ppq">Detail Titik PPQ</label>
                                        <input id="detail_titik_ppq" class="form-control" type="text" name="detail_titik_ppq" value="<?php echo e($followUpPpq->ppq->detail_titik_ppq); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="alasan">Alasan PPQ</label>
                                        <textarea id="alasan" rows="3"  class="form-control" type="text" name="alasan"  readonly><?php echo e($followUpPpq->ppq->alasan); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="wo_number">Nomor Wo</label>
                                        <?php
                                            $wo_numbers   = array();
                                            $lot_numbers   = array();
                                            foreach ($followUpPpq->ppq->palets as $palet_ppq) 
                                            {
                                                if (!in_array($palet_ppq->palet->cppDetail->woNumber->wo_number,$wo_numbers)) 
                                                {
                                                    array_push($wo_numbers,$palet_ppq->palet->cppDetail->woNumber->wo_number);
                                                }
                                                
                                                if (!in_array($palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet,$lot_numbers)) 
                                                {
                                                    array_push($lot_numbers,$palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet);
                                                }
                                            }
                                            $wo_number   = '';
                                            foreach ($wo_numbers as $woNumber) 
                                            {
                                                $wo_number .= $woNumber.', ';
                                            }
                                            
                                            $lot_number   = '';
                                            foreach ($lot_numbers as $lotNumber) 
                                            {
                                                $lot_number .= $lotNumber.', ';
                                            }
                                        ?>
                                        <textarea id="wo_number" rows="3" class="form-control" type="text" name="wo_number"  readonly><?php echo e(rtrim($wo_number,', ')); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="lot_number">Lot Number</label>
                                        <textarea id="lot_number" rows="3"  class="form-control" type="text" name="lot_number" readonly><?php echo e(rtrim($lot_number,', ')); ?></textarea>
                                    </div>
                                    <div class="form-group" style="margin-top: 3.0rem!important;">
                                        <label for="jumlah_pack">Jumlah Pack PPQ</label>
                                        <input id="jumlah_pack" class="form-control" type="text" name="jumlah_pack" value="<?php echo e($followUpPpq->ppq->jumlah_pack); ?>" readonly>
                                    </div>
                                    
                                    <div class="form-group" >
                                        <label for="user_inputer">User Inputer</label>
                                        <input id="user_inputer" class="form-control" type="text" name="user_inputer" value="<?php echo e($followUpPpq->ppq->userCreate->employee->fullname); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php break; ?>

        <?php endswitch; ?>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extract-plugin-footer'); ?>
    <script src="<?php echo e(asset('datetime-picker/js/jquery.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('datetime-picker/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('datetime-picker/css/bootstrap-datetimepicker.min.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/moment.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script>
        $('.timepickernya').datetimepicker({
            format: 'HH:mm:ss',
            locale:'en',
            date: new Date()
        }); 
        $('.datepickernya').datetimepicker({
            format: 'YYYY-MM-DD',
            locale:'en',
            date: new Date()
        }); 

        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            locale:'en'
        }); 
        $('.datetimepickernya').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
        }); 
    </script> 
    <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/bootstrap-datetimepicker.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/follow_up_ppq/form.blade.php ENDPATH**/ ?>