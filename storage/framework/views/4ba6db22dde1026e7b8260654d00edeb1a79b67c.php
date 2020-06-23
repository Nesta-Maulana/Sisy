
<?php $__env->startSection('title'); ?>
    <?php echo e($form); ?> | PPQ Produk |  <?php echo e($product_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-'.$parent_menu); ?>
    menu-open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active-rollie-'.$route); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="row">
    <div class="col-lg-12">
        <form action="/rollie/<?php echo e(explode('/', \Request::getRequestUri())[2]); ?>/form/input-ppq" method="post">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="jenis_ppq" value="<?php echo e($jenisPpq->id); ?>">
            <input type="hidden" name="params" value="<?php echo e($params); ?>">
            <?php if($jenisPpq->jenis_ppq == 'Package Integrity'): ?>
                <input type="hidden" name="rpd_filling_detail_pi_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($activeVariable->id)); ?>">
            <?php elseif($jenisPpq->jenis_ppq == 'Kimia'): ?>
                <input type="hidden" name="cpp_head_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palets[0]->cppDetail->cppHead->id)); ?>">
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="">Nomor PPQ</label>
                        <input type="text" class="form-control" name="nomor_ppq" readonly="true" placeholder="Nomor PPQ" value="<?php echo e($nomor_ppq); ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Wo</label>
                        <input type="text" name="wo_number" value="<?php echo e($wo_number); ?>" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" name="product_name" value="<?php echo e($product_name); ?>" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kode Oracle</label>
                        <input type="text" class="form-control" name="oracle_code" readonly="true" placeholder="Kode Oracle" value="<?php echo e($oracle_code); ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Produksi</label>
                        <input type="text" name="tanggal_produksi" value="<?php echo e($production_realisation_date); ?>" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Mesin Filling</label>
                        <input type="text" name="filling_machine" value="<?php echo e($filling_machine_code); ?>" readonly class="form-control">
                        <input type="hidden" name="mesin_filling_id" value="<?php echo e($filling_machine_id); ?>" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nomor LOT</label>
                        <?php if(!is_null($palets)): ?>
                            <input type="text" class="form-control" name="nomor_lot" value="<?php $__currentLoopData = $palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($palet->cppDetail->lot_number); ?>-<?php echo e($palet->palet); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>" readonly>
                        <?php else: ?>
                            <textarea class="form-control text-white" style="background-color: red" name="nomor_lot" cols="30" rows="2" readonly>Palet belum tersedia, harap hubungi tim packing untuk segera mengisi form packing dan memisahkan pack PPQ</textarea>
                        <?php endif; ?>
                        
                        <?php if(!is_null($palets)): ?>
                        	<input type="hidden" class="form-control" name="nomor_lot_id" value="<?php $__currentLoopData = $palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
                        <?php else: ?>
                        	<input type="hidden" class="form-control" name="nomor_lot_id" value="0">
                        <?php endif; ?>
                    </div> 
                    <div class="form-group">
                        <label for="">Jumlah (pack) : </label>
                        <?php if($jumlahpack !== 0): ?>                        
                            <input type="text" class="form-control" name="jumlah_pack" value="<?php echo e($jumlahpack); ?>">
                        <?php else: ?>
                            <textarea class="form-control text-white" style="background-color: red" cols="30" rows="2" readonly>Jumlah Pack belum tersedia, harap hubungi tim packing untuk segera mengisi jumlah pack pada form packing dan memisahkan pack PPQ</textarea>
                            <input type="hidden" class="form-control" name="jumlah_pack" value="0">

                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="jenis_ppq">Jenis PPQ :</label>
                        <input type="text" class="form-control" value="<?php echo e($jenisPpq->jenis_ppq); ?>" name="jenis_ppq_keterangan" id="jenis_ppq_keterangan" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="">Tanggal PPQ FG</label>
                        <input type="text" name="tanggal_ppq" value="<?php echo e(date('Y-m-d')); ?>" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Jam Filling Awal PPQ : </label>
                        <input type="text" class="form-control" name="jam_filling_mulai"    placeholder="Jam Filiing Awal" value="<?php echo e($jam_filling_mulai); ?> "readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jam Filling Akhir PPQ : </label>
                        <input type="text" class="form-control"  name="jam_filling_akhir" value="<?php echo e($jam_filling_akhir); ?> "readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Alasan PPQ : </label>
                        <textarea class="form-control"  name="alasan_ppq" rows="3" <?php if($jenisPpq->jenis_ppq == 'Kimia'): ?> readonly <?php endif; ?> required><?php echo e($alasan_ppq); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Detail Titik PPQ : </label>
                        <textarea class="form-control" name="detail_titik_ppq" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori PPQ : </label>
                        <select name="kategori_ppq_value" class="form-control" name="kategori_ppq_value" required>
                            <option value="" selected disabled> Pilih Kategori PPQ </option>
                            <?php $__currentLoopData = $kategoriPpqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategoriPpq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kategoriPpq->id); ?>"> <?php echo e($kategoriPpq->kategori_ppq); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">PIC Input: </label>
                        <input type="text" class="form-control" value="<?php echo e(Auth::user()->employee->fullname); ?>" readonly>
                    </div>
                    <div class="form-group" style="margin-top: 2.5rem">
                        <?php if(is_null($palets)): ?>
                        	<button class="btn btn-primary form-control">Buat Draft PPQ</button>
                        <?php else: ?>
                        	<button class="btn btn-primary form-control">Buat PPQ</button>
                        <?php endif; ?>

                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div> 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/ppq_product/form.blade.php ENDPATH**/ ?>