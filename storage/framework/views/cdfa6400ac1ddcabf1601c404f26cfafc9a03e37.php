
<?php $__env->startSection('title'); ?>
    Fisikokimia 
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
            <div class="card">
                <div class="card-header bg-dark">
                    List Draft Analisa Fisikokimia Produk Jadi
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="fisikokimia-dashboard-table">
                        <thead>
                            <tr>
                                <th style="width:30px">#</th>
                                <th style="width:300px"> Nama Produk </th>
                                <th style="width:200px"> Tanggal Produksi</th>
                                <th style="width:180px"> Nomor Wo </th>
                                <th style="width:160px"> Status Analisa Kimia </th>
                                <th style="width:100px">Mesin Filling</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cppHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $wo_number          = '';
                                    $mesin_filling      = '';
                                    $tanggal_produksi   ='';
                                ?>
                                <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $wo_number      .= $woNumber->wo_number.',';
                                        if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                        {
                                            $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                        }
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fillingMachineGroupDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                        {
                                            $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                        }
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr style="background-color:#ffa6bb;">
                                    <td>
                                        <button onclick="analisaFisikokimiaProduk('<?php echo e($params); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id)); ?>','<?php echo e($cppHead->product->product_name); ?>','<?php echo e(rtrim($tanggal_produksi,', ')); ?>')" class="btn btn-primary">
                                            <i class="fas fa-file-signature"></i>
                                        </button>
                                    </td>
                                    <td><?php echo e($cppHead->woNumbers[0]->product->product_name); ?></td>
                                    <td><?php echo e(rtrim($tanggal_produksi,', ')); ?></td>
                                    <td><?php echo e(rtrim($wo_number,', ')); ?></td>
                                    <td>Belum Analisa</td>
                                    <td><?php echo e(rtrim($mesin_filling,', ')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!is_null($draftAnalisas)): ?>
                                <?php $__currentLoopData = $draftAnalisas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $draftAnalisa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $wo_number          = '';
                                        $mesin_filling      = '';
                                        $tanggal_produksi   ='';
                                    ?>
                                    <?php $__currentLoopData = $draftAnalisa->cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $wo_number      .= $woNumber->wo_number.',';
                                        if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                        {
                                            $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                        }
                                    ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $draftAnalisa->cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fillingMachineGroupDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                            {
                                                $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                            }
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-warning">
                                        <td>
                                            <button onclick="document.location.href='fisiko-kimia-form/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($draftAnalisa->id)); ?>/<?php echo e($params); ?>'" class="btn btn-primary">Update Fisikokimia</button>
                                        </td>
                                        <td><?php echo e($draftAnalisa->cppHead->woNumbers[0]->product->product_name); ?></td>
                                        <td><?php echo e(rtrim($tanggal_produksi,', ')); ?></td>
                                        <td><?php echo e(rtrim($wo_number,', ')); ?></td>
                                        <td>Draft Analisa</td>
                                        <td><?php echo e(rtrim($mesin_filling,', ')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5>List Analisa Fisikokimia Produk Jadi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="fisikokimia-dashboard-done-table"  >
                        <thead>
                            <tr>
                                <th scope="col" style="width:250px" > Nama Produk </th>
                                <th scope="col" style="width:200px"> Tanggal Produksi</th>
                                <th scope="col" style="width:200px"> Nomor Wo </th>
                                <th scope="col" style="width:200px"> Mesin Filling</th>
                                <th scope="col" style="width:200px"> Status Analisa Kimia</th>
                                <th scope="col" style="width:200px"> #</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $doneAnalisa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisaKimia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $wo_number          = '';
                                    $mesin_filling      = '';
                                    $tanggal_produksi   ='';
                                ?>
                                <?php $__currentLoopData = $analisaKimia->cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $wo_number      .= $woNumber->wo_number.',';
                                    if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                    {
                                        $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                    }
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $analisaKimia->cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fillingMachineGroupDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                        {
                                            $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                        }
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($analisaKimia->cppHead->woNumbers[0]->product->product_name); ?></td>
                                    <td><?php echo e(rtrim($tanggal_produksi,', ')); ?></td>
                                    <td><?php echo e(rtrim($wo_number,', ')); ?></td>
                                    <td><?php echo e(rtrim($mesin_filling,', ')); ?></td>
                                    <td>
                                        <?php if($analisaKimia->analisa_kimia_status == '1'): ?>
                                            OK
                                        <?php else: ?>
                                            <?php echo e($analisaKimia->cppHead->ppq->alasan); ?> 
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button onclick="document.location.href='fisiko-kimia-form/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($analisaKimia->id)); ?>/<?php echo e($params); ?>'" class="btn btn-primary">Lihat Hasil Analisa</button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extact-plugin-footer'); ?>
    <link rel="stylesheet" href=" <?php echo e(asset('general_style/plugins/fullcalendar/main.min.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('general_style/plugins/fullcalendar-daygrid/main.min.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('general_style/plugins/fullcalendar-timegrid/main.min.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('general_style/plugins/fullcalendar-bootstrap/main.min.css')); ?>">
    <!-- fullCalendar 2.2.5 -->
    <script src="<?php echo e(asset('general_style/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('general_style/plugins/fullcalendar/main.min.js')); ?>"></script>
    <script src="<?php echo e(asset('general_style/plugins/fullcalendar-daygrid/main.min.js')); ?>"></script>
    <script src="<?php echo e(asset('general_style/plugins/fullcalendar-timegrid/main.min.js')); ?>"></script>
    <script src="<?php echo e(asset('general_style/plugins/fullcalendar-interaction/main.min.js')); ?>"></script>
    <script src="<?php echo e(asset('general_style/plugins/fullcalendar-bootstrap/main.min.js')); ?>"></script>
    <script>
        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()
        var calendar = new Calendar(calendarEl, {
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
        customButtons: {
            listButton: {
            text: 'Table List Analisa Mikro',
            class:'btn btn-primary',
            click: function() {
                    $('.btn-primary')[0].focus()
                }
            }
        },
        header    : {
            left  : 'prev,today,next',
            center: 'title',
            right : 'listButton'
        },
        //Random default events
        events    : [
            <?php $__currentLoopData = $cppHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                    $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                ?>
                <?php if(is_null($cppHead->analisa_mikro_id)): ?>
                    { 
                        /*ini kalo belum analisa mikro*/
                        id              :'<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id)); ?>',
                        title           : '<?php echo e($cppHead->product->product_name); ?>',
                        start           : '<?php echo e(date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)))); ?>', 
                        textColor       : '#fff',
                        backgroundColor : "#ff5f5f", 
                        borderColor     : "#fff", 
                        fontSize        : "12px",
                        extendedProps   :
                        {
                            progress_status : '0',/* ini untuk proses analisa mikro pertama kali soalnya belum ada */
                        },
                    },
                <?php else: ?>
                    <?php if($cppHead->analisaMikro->progress_status == '0'): ?>
                        { 
                            /*ini kalo belum analisa mikro*/
                            id                  :'<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id)); ?>',
                            title               : '<?php echo e($cppHead->product->product_name); ?>',
                            start               : '<?php echo e(date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)))); ?>', 
                            textColor           : '#000',
                            backgroundColor     : "#eeff5f", 
                            borderColor         : "#fff", 
                            fontSize            : "12px",
                            extendedProps       :
                            {
                                progress_status : '1', /* ini untuk masuk ke form analisa mikro soalnya udah ada draft analisanya  */ 
                            },
                        },
                    <?php else: ?>
                        <?php if($cppHead->analisaMikro->analisa_mikro_status == '1'): ?>
                            { 
                                /*ini kalo belum analisa mikro*/
                                id              :'<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id)); ?>',
                                title           : '<?php echo e($cppHead->product->product_name); ?>',
                                start           : '<?php echo e(date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)))); ?>', 
                                textColor       : '#000',
                                backgroundColor : "#61ff5f", 
                                borderColor     : "#fff", 
                                fontSize        : "12px",
                                extendedProps   :
                                {
                                    progress_status          :'2', /* ini untuk masuk ke form analisa mikro soalnya hasilnya udah done dan hasilnya OK  */
                                },
                            },
                        <?php else: ?>
                            <?php if( count($cppHead->analisaMikro->analisaMikroResampling) == '0' ): ?>
                                { 
                                    /*ini kalo belum analisa mikro*/
                                    id              :'<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id)); ?>',
                                    title           : '<?php echo e($cppHead->product->product_name); ?>',
                                    start           : '<?php echo e(date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)))); ?>', 
                                    textColor       : '#fff',
                                    backgroundColor : "#ff5f5f", 
                                    borderColor     : "#fff", 
                                    fontSize        : "12px",
                                    extendedProps   :
                                    {
                                        progress_status          :'3', /* ini untuk proses analisa mikro resampling yang pertama kali dikarenakan belum ada sama sekali resampling soalnya analisa mikronya #OK */
                                    },
                                },
                            <?php else: ?>
                                <?php if($cppHead->analisaMikro->analisaMikroResampling[count($cppHead->analisaMikro->analisaMikroResampling)-1]->progress_status == '0'): ?>
                                    { 
                                        id              :'<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->analisaMikroResampling[count($cppHead->analisaMikro->analisaMikroResampling)-1]->id)); ?>',
                                        title           : '<?php echo e($cppHead->product->product_name); ?>',
                                        start           : '<?php echo e(date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)))); ?>', 
                                        textColor       : '#000',
                                        backgroundColor : "#eeff5f",  
                                        borderColor     : "#fff", 
                                        fontSize        : "12px",
                                        extendedProps   :
                                        {
                                            progress_status          : '4', /* ini untuk masuk ke form analisa mikro resampling soalnya udah ada draft analisanya  */
                                        },
                                    },  
                                <?php else: ?>
                                    <?php if($cppHead->analisaMikro->analisaMikroResampling[count($cppHead->analisaMikro->analisaMikroResampling)-1]->analisa_mikro_status == '1'): ?>
                                        { 
                                            id              :'<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->analisaMikroResampling[count($cppHead->analisaMikro->analisaMikroResampling)-1]->id)); ?>',
                                            title           : '<?php echo e($cppHead->product->product_name); ?>',
                                            start           : '<?php echo e(date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)))); ?>', 
                                            textColor       : '#000',
                                            backgroundColor : "#61ff5f", 
                                            borderColor     : "#fff", 
                                            fontSize        : "12px",
                                            status          : '5', /* ini untuk masuk ke form analisa mikro resampling yang hasilnya OK */
                                        },  
                                    <?php else: ?>
                                        { 
                                            id              :'<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id)); ?>',
                                            title           : '<?php echo e($cppHead->product->product_name); ?>',
                                            start           : '<?php echo e(date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)))); ?>', 
                                            textColor       : '#fff',
                                            backgroundColor : "#ff5f5f", 
                                            borderColor     : "#fff", 
                                            fontSize        : "12px",
                                            extendedProps   :
                                            {
                                                progress_status          : '6', /* ini untuk proses resampling lagi  */
                                            },
                                        },  
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        ],
        eventClick: function(info) 
        {
            /* 
                disini akan masuk ke alert analisa berdasarkan progress status yang sudah diset
            */
           switch (info.event.extendedProps.progress_status) 
           {
                case '0':
                   /* ini untuk pertama kali analisa mikro pertama kali */
                   Swal.fire({
                        title       : 'Apakah Anda Akan Melakukan Analisa Mikro '+info.event.title+' ?',
                        text        : "Setelah melakukan konfirmasi ini anda akan dialihkan menuju form RPD-M",
                        type        : 'info',
                        showCancelButton    : true,
                        confirmButtonColor  : '#3085d6',
                        cancelButtonColor   : '#d33',
                        confirmButtonText   : 'Ya, Proses RPD-M!'
                    }).then((result) => 
                    {
                        if (result.value) 
                        {
                            $.ajax({
                                headers:
                                {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'analisa-mikro-produk/proses-analisa-mikro',
                                method: 'POST',
                                dataType: 'JSON',
                                data: 
                                { 
                                    'cpp_head_id'   : info.event.id
                                },
                                success: function (data) 
                                {
                                    if (data.success == true) 
                                    {
                                        swal({
                                            title   : "Proses Berhasil",
                                            text    : "RPD Mikro telah berhasil digenerate oleh sistem, anda akan di alihkan secara otomatis oleh sistem menuju form input hasil analisa.",
                                            type    : "success",
                                        });
                                        window.setTimeout(function () {
                                            window.location.href=data.url+'/'+'form/'+data.analisa_mikro_id;
                                        },1000)
                                    } 
                                    else 
                                    {
                                        swal({
                                            title   : "Failed",
                                            text    : data.message,
                                            type    : "error"
                                        });
                                        window.location.href    = "";
                                    }
                                },
                            });
                        } 
                    })
                break;
                case '1':
                    window.location.href = window.location.href+'/form/'+info.event.id;
                break;
           }
        },
        //editable  : false,
        droppable : false, // this not allows things to be dropped onto the calendar !!!
        });

        calendar.render();
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/fiskokimia/dashboard.blade.php ENDPATH**/ ?>