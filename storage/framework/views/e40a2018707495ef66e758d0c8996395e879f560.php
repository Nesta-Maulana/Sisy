
<?php $__env->startSection('title'); ?>
    Report Produk Release
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-report'); ?>
    menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-rollie-reports-rpr'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header bg-dark">
                    Export Data RPR
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Filter Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="filter_tanggal">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="product_name">Nama Produk</label>
                                <select name="product_name" id="product_name" class="form-control select2 select " style="width: 100%;height: calc(1.5em + .75rem + 2px);">
                                    <option value="all" selected>All product</option>
                                    <?php $__currentLoopData = $woNumbers->unique('product_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($woNumber->id)); ?>"><?php echo e($woNumber->product->product_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header bg-dark">
                    Upload Data BAR
                </div>
                <div class="card-body" >
                    <div class="form-group">
                        <label for="barFile">File input</label>
                        <form >
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="barFile">
                                    <label class="custom-file-label" for="barFile">Choose file</label>
                                </div>
                            </div>
                            <div class="small bg-warning mt-3">
                                * file akan terupload otomatis ketika anda memilihnya
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                     <b>Report Produk Release</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="report-release-produk-dashboard">
                        <thead class="">
                            <tr>
                                <th style="width: 200px">Nama Produk</th>
                                <th style="width: 200px">Tanggal Produksi</th>
                                <th style="width: 200px">Nomor WO</th>
                                <th style="width: 200px">Nomor Lot</th>
                                <th style="width: 200px">Tanggal Selesai Filling</th>
                                <th style="width: 200px">Mesin Filling</th>
                                <th style="width: 200px">Brand</th>
                                <th style="width: 200px">Mikro 30</th>
                                <th style="width: 200px">Mikro 55</th>
                                <th style="width: 200px">Kimia</th>
                                <th style="width: 200px">Sortasi</th>
                                <th style="width: 500px">PPQ</th>
                                <th style="width: 200px">Estimasi Release</th>
                                <th style="width: 200px">Status Mutu Akhir FG</th>
                                <th style="width: 200px">Referensi BAR</th>
                                <th style="width: 200px">Tanggal BAR</th>
                                <th style="width: 200px">Status BAR</th>
                                <th style="width: 200px">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $__currentLoopData = $woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $woNumber->cppHead->cppDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $cppDetail->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $status_mutu_fg = '';
                                        ?>
                                        <tr>
                                            <td><?php echo e($palet->cppDetail->woNumber->product->product_name); ?></td>
                                            <td><?php echo e($palet->cppDetail->woNumber->production_realisation_date); ?></td>
                                            <td><?php echo e($palet->cppDetail->woNumber->wo_number); ?></td>
                                            <td><?php echo e($palet->cppDetail->lot_number.'-'.$palet->palet); ?></td>
                                            <td><?php echo e(substr($woNumber->cppHead->cppDetails[count($woNumber->cppHead->cppDetails)-1]->palets[count($woNumber->cppHead->cppDetails[count($woNumber->cppHead->cppDetails)-1]->palets)-1]->end,0,10)); ?></td>
                                            <td><?php echo e($palet->cppDetail->fillingMachine->filling_machine_code); ?></td>
                                            <td><?php echo e($palet->cppDetail->woNumber->product->subbrand->subbrand_name); ?></td>
                                            <?php if($palet->analisa_mikro_30_status == '1'): ?>
                                                <td class="bg-success">
                                                    OK
                                                </td>
                                            <?php elseif($palet->analisa_mikro_30_status == '0'): ?>
                                                <?php
                                                    $analisaMikroResampling30    = $palet->cppDetail->cppHead->analisaMikro->analisaMikroResamplings->where('suhu_preinkubasi','30');  
                                                ?>
                                                <?php if($analisaMikroResampling30[count($analisaMikroResampling30)-1]->progress_status == '0'): ?>
                                                    <td class="bg-warning">
                                                        On Progress Resampling
                                                    </td>
                                                    <?php
                                                        $status_mutu_fg = 'On Progress';
                                                    ?>
                                                <?php else: ?>
                                                    <?php if($analisaMikroResampling30[count($analisaMikroResampling30)-1]->analisa_mikro_status == '1'): ?>
                                                        <td class="bg-sucess">
                                                            Mikro Resampling OK
                                                        </td>
                                                    <?php else: ?>
                                                        <td class="bg-danger">
                                                            Mikro Resampling #OK
                                                        </td>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php elseif(is_null($palet->analisa_mikro_30_status)): ?> 
                                                <td>
                                                    Analisa Mikro Belum Dilakukan
                                                </td>
                                                <?php
                                                    $status_mutu_fg = 'On Progress';
                                                ?>
                                            <?php endif; ?>

                                            <?php if($palet->cppDetail->woNumber->product->productType->product_type =='Susu'): ?>
                                                <?php if($palet->analisa_mikro_55_status == '1'): ?>
                                                    <td class="bg-success">
                                                        OK
                                                    </td>
                                                <?php elseif($palet->analisa_mikro_55_status == '0'): ?>
                                                    <?php
                                                        $analisaMikroResampling55    = $palet->cppDetail->cppHead->analisaMikro->analisaMikroResamplings->where('suhu_preinkubasi','55');  
                                                    ?>
                                                    <?php if($analisaMikroResampling55[count($analisaMikroResampling55)-1]->progress_status == '0'): ?>
                                                        <td class="bg-warning">
                                                            On Progress Resampling
                                                        </td>
                                                        <?php
                                                            $status_mutu_fg = 'On Progress';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php if($analisaMikroResampling55[count($analisaMikroResampling55)-1]->analisa_mikro_status == '1'): ?>
                                                            <td class="bg-sucess">
                                                                Mikro Resampling OK
                                                            </td>
                                                        <?php else: ?>
                                                            <td class="bg-danger">
                                                                Mikro Resampling #OK
                                                            </td>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php elseif(is_null($palet->analisa_mikro_55_status)): ?> 
                                                    <td>
                                                        Analisa Mikro Belum Dilakukan
                                                    </td>
                                                    <?php
                                                        $status_mutu_fg = 'On Progress';
                                                    ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <td>
                                                    -
                                                </td>
                                            <?php endif; ?>
                                            <?php if(is_null($palet->cppDetail->cppHead->analisaKimia)): ?>
                                                <td>Analisa Kimia Belum Dilakukan</td>
                                            <?php else: ?>
                                            <td></td>
                                               
                                            <?php endif; ?>
                                            <td>-</td>
                                            <td>
                                            <?php $__currentLoopData = $palet->paletPpqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paletPpq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php switch($paletPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq):
                                                    case ('Package Integrity'): ?>
                                                        <?php echo e($paletPpq->ppq->nomor_ppq.' - '.$paletPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq.' - '.$paletPpq->ppq->alasan); ?> <br>
                                                    <?php break; ?>
                                                    <?php case ('Kimia'): ?>
                                                        <?php echo e($paletPpq->ppq->nomor_ppq.' - '.$paletPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq.' - '.$paletPpq->ppq->alasan); ?> <br>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td>
                                                <?php
                                                        $tanggalfilling = $palet->end;
                                                        $sla = "+".$woNumber->product->sla." day";
                                                        $tanggalestimasi = strtotime($sla,strtotime($tanggalfilling));
                                                        echo date('Y-m-d',$tanggalestimasi);
                                                 ?>
                                            </td>
                                                <?php switch($status_mutu_fg):
                                                    case (''): ?>
                                                        <td class="bg-success">OK</td>
                                                    <?php break; ?>
                                                    <?php case ('On Progress'): ?>
                                                        <td class="bg-warning">On Progress Analisa</td>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            <td>
                                                <?php if(is_null($palet->bar_number)): ?>
                                                    -
                                                <?php else: ?>
                                                    <?php echo e($palet->bar_number); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(is_null($palet->bar_date)): ?>
                                                    -
                                                <?php else: ?>
                                                    <?php echo e($palet->bar_date); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(is_null($palet->bar_status)): ?>
                                                    -
                                                <?php else: ?>
                                                    <?php echo e($palet->bar_status); ?>

                                                <?php endif; ?>
                                            </td>
                                            <?php if(is_null($palet->bar_note) && is_null($palet->bar_number)): ?>
                                                <td>
                                                    -
                                                </td>
                                            <?php else: ?>
                                                <?php if(is_null($palet->bar_status)): ?>
                                                    <td onclick="" id="td_note_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>">
                                                        -
                                                    </td>
                                                <?php else: ?>
                                                    <td>
                                                        <?php echo e($palet->bar_note); ?>

                                                    </td>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Tanggal Produksi</th>
                                <th>Nomor WO</th>
                                <th>Nomor Lot</th>
                                <th >Tanggal Selesai Filling</th>
                                <th>Mesin Filling</th>
                                <th>Brand</th>
                                <th class="filter-search">Mikro 30</th>
                                <th>Mikro 55</th>
                                <th>Kimia</th>
                                <th>Sortasi</th>
                                <th>PPQ</th>
                                <th>Estimasi Release</th>
                                <th>Status Mutu Akhir FG</th>
                                <th>Referensi Bar</th>
                                <th>Tanggal Bar</th>
                                <th>Status Bar</th>
                                <th>Keterangan</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extract-plugin-footer'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('datetime-picker/css/daterangepicker.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/moment2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('datetime-picker/js/daterangepicker.js')); ?>"></script>
    <script>
        $('#filter_tanggal').daterangepicker();
    </script>
    <script src="<?php echo e(asset('js/master/xlsx.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/master/filesaver.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/master/custom-file.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
          bsCustomFileInput.init();
        });

        $('#barFile').change(function(e) 
        {
            var reader  = new FileReader();
            reader.readAsArrayBuffer(e.target.files[0]);
            reader.onload   = function (e) {
                var data    = new Uint8Array(reader.result);
                var wb      = XLSX.read(data,{type:'array'});
                // var htmlstr = XLSX.write(wb,{sheet:wb.SheetNames[0],type:'binary',bookType:'html'});
                var json    = XLSX.utils.sheet_to_json(wb.Sheets[wb.SheetNames[0]], {raw: true});
                // console.log(json);
                if (json.length > 0) 
                {
                    Swal.fire({
                        title: 'Konfirmasi Ekstract Excel BAR',
                        text:  'Apakah anda yakin akan mengekstrak BAR dengan nomor bar '+json[1].__EMPTY_8+' ?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Tidak, Proses yang lain',
                        confirmButtonText: 'Ya, Extract BAR',
                    }).then((result) => {
                        if (result.value) 
                        {
                            $.ajax({
                                headers: 
                                {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: '/rollie/report-produk-release/upload-bar', 
                                method: 'POST',
                                dataType: 'JSON',
                                data:{
                                    'data_bar' :json
                                },
                                success: function (data) 
                                {
                                    $('#barFile').val("");
                                    $('.custom-file-label')[0].innerHTML = 'Choose file' ;

                                    if (data.success)
                                    {
                                        swal({
                                            title: 'Proses Berhasil',
                                            text: data.message,
                                            type: 'success'
                                        });
                                        document.location.href='';
                                    }
                                    else
                                    {
                                        swal({
                                            title: 'Proses Gagal',
                                            text: data.message,
                                            type: 'error'
                                        });
                                    }
                                }  
                            });
                        }
                        else
                        {
                            $('#barFile').val("");
                            $('.custom-file-label')[0].innerHTML = 'Choose file';
                        }
                    });         
                }
            }    
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/reports/rpr/dashboard.blade.php ENDPATH**/ ?>