
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
    <?php switch(app('App\Http\Controllers\ResourceController')->decrypt($params)):
        case ('analisa_mikro_produk'): ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Draft Analisa Mikro Produk Jadi</h5>
                        </div>
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Analisa Mikro Produk Jadi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="analisa-mikro-dashboard-table" width="100%">
                                <thead >
                                    <tr>
                                        <th> # </th>
                                        <th> Nama Produk </th>
                                        <th> Nomor Wo </th>
                                        <th> Tanggal Produksi </th>
                                        <th> Tanggal Analisa </th>
                                        <th> Status Analisa Mikro </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $cppHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(is_null($cppHead->analisa_mikro_id)): ?>
                                            <?php
                                                $style      = 'background-color:#a6e6ff';
                                                $onclick    = '';
                                                $status     = 'Belum Analisa'
                                            ?>
                                        <?php else: ?>
                                            <?php if($cppHead->analisaMikro->progress_status == '0'): ?>
                                                <?php
                                                    $style      = 'background-color:#f5ffa6';
                                                    $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                    $status     = 'Draft Analisa';
                                                ?>
                                            <?php else: ?>
                                                <?php if($cppHead->analisaMikro->analisa_mikro_status == '0'): ?>
                                                    <?php if(is_null($cppHead->analisaMikro->analisaMikroResamplings) || count($cppHead->analisaMikro->analisaMikroResamplings) == 0): ?>
                                                        <?php
                                                            $style      = 'background-color:#ffd7a6';
                                                            $onclick    =  str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);;
                                                            $status     = 'Analisa Mikro #OK - Waiting Qc Release Verification';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php
                                                            $style      = 'background-color:#ffa6a6';
                                                            $onclick    =  str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);;
                                                            $status     = 'Analisa Mikro Resampling'
                                                        ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if($cppHead->analisaMikro->verifikasi_qc_release == '0'): ?>
                                                        <?php
                                                            $style      = 'background-color:#ffeca6';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK - Waiting QC Release Verification';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <tr style="<?php echo e($style); ?>">
                                            <td> 
                                                <button class="btn btn-primary" onclick="window.location.href='<?php echo e($onclick); ?>'"> 
                                                    <i class="fas fa-edit"></i>
                                                </button> 
                                            </td>
                                            <td>
                                                <?php echo e($cppHead->woNumbers[0]->product->product_name); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $wo_number = '';
                                                ?>
                                                <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $wo_number  .= $woNumber->wo_number.', ';
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(rtrim($wo_number,', ')); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $production_realisation_date = '';
                                                ?>
                                                <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (strpos($production_realisation_date,$woNumber->production_realisation_date.', ') === false) 
                                                        {
                                                            $production_realisation_date  .= $woNumber->production_realisation_date.', ';
                                                        }
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(rtrim($production_realisation_date,', ')); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                                                    $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                                                    echo date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)));
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo e($status); ?>

                                            </td>
                                        </tr>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                <?php $__env->startSection('extract-plugin-footer'); ?>
                    <link rel="stylesheet" href=" <?php echo e(asset('fullcalendar/fullcalendar/main.min.css')); ?>">
                    <link rel="stylesheet" href=" <?php echo e(asset('fullcalendar/fullcalendar-daygrid/main.min.css')); ?>">
                    <link rel="stylesheet" href=" <?php echo e(asset('fullcalendar/fullcalendar-timegrid/main.min.css')); ?>">
                    <link rel="stylesheet" href=" <?php echo e(asset('fullcalendar/fullcalendar-bootstrap/main.min.css')); ?>">
                    <!-- fullCalendar 2.2.5 -->
                    <script src="<?php echo e(asset('fullcalendar/moment/moment.min.js')); ?>"></script>
                    <script src="<?php echo e(asset('fullcalendar/fullcalendar/main.min.js')); ?>"></script>
                    <script src="<?php echo e(asset('fullcalendar/fullcalendar-daygrid/main.min.js')); ?>"></script>
                    <script src="<?php echo e(asset('fullcalendar/fullcalendar-timegrid/main.min.js')); ?>"></script>
                    <script src="<?php echo e(asset('fullcalendar/fullcalendar-interaction/main.min.js')); ?>"></script>
                    <script src="<?php echo e(asset('fullcalendar/fullcalendar-bootstrap/main.min.js')); ?>"></script>
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
        <?php break; ?>
        <?php case ('analisa_ph_produk'): ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Analisa Mikro Produk Jadi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="analisa-mikro-dashboard-table" width="100%">
                                <thead >
                                    <tr>
                                        <th> # </th>
                                        <th> Nama Produk </th>
                                        <th> Nomor Wo </th>
                                        <th> Tanggal Produksi </th>
                                        <th> Tanggal Analisa </th>
                                        <th> Status Analisa Mikro </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $cppHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(is_null($cppHead->analisa_mikro_id)): ?>
                                            <?php
                                                $style      = 'background-color:#a6e6ff';
                                                $onclick    = '';
                                                $status     = 'Belum Analisa'
                                            ?>
                                        <?php else: ?>
                                            <?php if($cppHead->analisaMikro->progress_status == '0'): ?>
                                                <?php
                                                    $style      = 'background-color:#f5ffa6';
                                                    $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                    $status     = 'Draft Analisa';
                                                ?>
                                            <?php else: ?>
                                                <?php if($cppHead->analisaMikro->analisa_mikro_status == '0'): ?>
                                                    <?php if(is_null($cppHead->analisaMikro->analisaMikroResamplings) || count($cppHead->analisaMikro->analisaMikroResamplings) == 0): ?>
                                                        <?php
                                                            $style      = 'background-color:#ffd7a6';
                                                            $onclick    =  str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);;
                                                            $status     = 'Analisa Mikro #OK - Waiting Qc Release Verification';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php
                                                            $style      = 'background-color:#ffa6a6';
                                                            $onclick    =  str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);;
                                                            $status     = 'Analisa Mikro Resampling'
                                                        ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if($cppHead->analisaMikro->verifikasi_qc_release == '0'): ?>
                                                        <?php
                                                            $style      = 'background-color:#ffeca6';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK - Waiting QC Release Verification';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <tr style="<?php echo e($style); ?>">
                                            <td> 
                                                <button class="btn btn-primary" onclick="window.location.href='<?php echo e($onclick); ?>'"> 
                                                    <i class="fas fa-edit"></i>
                                                </button> 
                                            </td>
                                            <td>
                                                <?php echo e($cppHead->woNumbers[0]->product->product_name); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $wo_number = '';
                                                ?>
                                                <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $wo_number  .= $woNumber->wo_number.', ';
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(rtrim($wo_number,', ')); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $production_realisation_date = '';
                                                ?>
                                                <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (strpos($production_realisation_date,$woNumber->production_realisation_date.', ') === false) 
                                                        {
                                                            $production_realisation_date  .= $woNumber->production_realisation_date.', ';
                                                        }
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(rtrim($production_realisation_date,', ')); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                                                    $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                                                    echo date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)));
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo e($status); ?>

                                            </td>
                                        </tr>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php break; ?>
        <?php case ('analisa_mikro_release'): ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Draft Analisa Mikro Produk Jadi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="analisa-mikro-dashboard-table">
                                <thead >
                                    <tr>
                                        <th style="width: 20px"> # </th>
                                        <th style="width: 200px"> Nama Produk </th>
                                        <th style="width: 200px"> Nomor Wo </th>
                                        <th style="width: 200px"> Tanggal Produksi </th>
                                        <th style="width: 200px"> Tanggal Analisa </th>
                                        <th style="width: 400px;"> Status Analisa Mikro </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $cppHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(is_null($cppHead->analisaMikro)): ?>
                                            <?php
                                                $style      = 'background-color:#a6e6ff';
                                                $onclick    = '';
                                                $status     = 'Belum Analisa'
                                            ?>
                                        <?php else: ?>
                                            <?php if($cppHead->product->productType->product_type == 'Susu'): ?>
                                                <?php if($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '0' && $cppHead->analisaMikro->progress_status_55 == '0' ): ?>
                                                    <?php
                                                        $style      = 'background-color:#f5ffa6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa';
                                                    ?>   
                                                <?php elseif($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '1' && $cppHead->analisaMikro->progress_status_55 == '0'): ?>
                                                    <?php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa - Analisa Mikro 30 To Be Confirmed - Analisa Mikro 55 On Progress';
                                                    ?>
                                                <?php elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2' && $cppHead->analisaMikro->progress_status_55 == '1'): ?>
                                                    <?php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa - Analisa Mikro 30 Done - 55 To Be Confirmed ';
                                                    ?>
                                                <?php elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2' && $cppHead->analisaMikro->progress_status_55 == '2'): ?>
                                                    <?php if($cppHead->analisaMikro->analisa_mikro_status =='0'): ?>
                                                        <?php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php
                                                            $style      = 'background-color:#f5ffa6';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro #OK';
                                                        ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '0' ): ?>
                                                    <?php
                                                        $style      = 'background-color:#f5ffa6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa';
                                                    ?>   
                                                <?php elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '1'): ?>
                                                    <?php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Analisa Mikro 30 To Be Confirmed';
                                                    ?>
                                                <?php elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2'): ?>
                                                    <?php if($cppHead->analisaMikro->analisa_mikro_status =='1'): ?>
                                                        <?php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php if($cppHead->analisaMikro->analisaMikroResamplings[count($cppHead->analisaMikro->analisaMikroResamplings)-1]->analisa_mikro_status == '1'): ?>
                                                            <?php
                                                                $style      = 'background-color:#a6ffad';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling OK';
                                                            ?>
                                                        <?php elseif($cppHead->analisaMikro->analisaMikroResamplings[count($cppHead->analisaMikro->analisaMikroResamplings)-1]->analisa_mikro_status == '0'): ?>
                                                            <?php
                                                                $style      = 'background-color:#ffa6a6';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling #OK';
                                                            ?>
                                                        <?php else: ?>
                                                            <?php
                                                                $style      = 'background-color:#f5ffa6';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling On Progress';
                                                            ?>
                                                        <?php endif; ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($status == 'Draft Analisa' || $status == 'Analisa Mikro 30 To Be Confirmed'): ?>
                                            <tr style="<?php echo e($style); ?>">
                                                <td> 
                                                    <button class="btn btn-primary" onclick="window.location.href='<?php echo e($onclick); ?>'"> 
                                                        <i class="fas fa-edit"></i>
                                                    </button> 
                                                </td>
                                                <td>
                                                    <?php echo e($cppHead->woNumbers[0]->product->product_name); ?>

                                                </td>
                                                <td>
                                                    <?php
                                                        $wo_number = '';
                                                    ?>
                                                    <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $wo_number  .= $woNumber->wo_number.', ';
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e(rtrim($wo_number,', ')); ?>

                                                </td>
                                                <td>
                                                    <?php
                                                        $production_realisation_date = '';
                                                    ?>
                                                    <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            if (strpos($production_realisation_date,$woNumber->production_realisation_date.', ') === false) 
                                                            {
                                                                $production_realisation_date  .= $woNumber->production_realisation_date.', ';
                                                            }
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e(rtrim($production_realisation_date,', ')); ?>

                                                </td>
                                                <td>
                                                    <?php
                                                        $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                                                        $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                                                        echo date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)));
                                                    ?>
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Done Analisa Mikro Produk Jadi </h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="analisa-mikro-dashboard-tabledone">
                                <thead >
                                    <tr>
                                        <th style="width: 20px"> # </th>
                                        <th style="width: 200px"> Nama Produk </th>
                                        <th style="width: 200px"> Nomor Wo </th>
                                        <th style="width: 200px"> Tanggal Produksi </th>
                                        <th style="width: 200px"> Tanggal Analisa </th>
                                        <th style="width: 400px;"> Status Analisa Mikro </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $cppHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(is_null($cppHead->analisaMikro)): ?>
                                            <?php
                                                $style      = 'background-color:#a6e6ff';
                                                $onclick    = '';
                                                $status     = 'Belum Analisa'
                                            ?>
                                        <?php else: ?>
                                            <?php if($cppHead->product->productType->product_type == 'Susu'): ?>
                                                <?php if($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '0' && $cppHead->analisaMikro->progress_status_55 == '0' ): ?>
                                                    <?php
                                                        $style      = 'background-color:#f5ffa6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa';
                                                    ?>   
                                                <?php elseif($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '1' && $cppHead->analisaMikro->progress_status_55 == '0'): ?>
                                                    <?php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa - Analisa Mikro 30 To Be Confirmed - Analisa Mikro 55 On Progress';
                                                    ?>
                                                <?php elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2' && $cppHead->analisaMikro->progress_status_55 == '1'): ?>
                                                    <?php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa - Analisa Mikro 30 Done - 55 To Be Confirmed ';
                                                    ?>
                                                <?php elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2' && $cppHead->analisaMikro->progress_status_55 == '2'): ?>
                                                    <?php if($cppHead->analisaMikro->analisa_mikro_status =='0'): ?>
                                                        <?php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php
                                                            $style      = 'background-color:#f5ffa6';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro #OK';
                                                        ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '0' ): ?>
                                                    <?php
                                                        $style      = 'background-color:#f5ffa6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa';
                                                    ?>   
                                                <?php elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '1'): ?>
                                                    <?php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Analisa Mikro 30 To Be Confirmed';
                                                    ?>
                                                <?php elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2'): ?>
                                                    <?php if($cppHead->analisaMikro->analisa_mikro_status =='1'): ?>
                                                        <?php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        ?>
                                                    <?php else: ?>
                                                        <?php if($cppHead->analisaMikro->analisaMikroResamplings[count($cppHead->analisaMikro->analisaMikroResamplings)-1]->analisa_mikro_status == '1'): ?>
                                                            <?php
                                                                $style      = 'background-color:#a6ffad';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling OK';
                                                            ?>
                                                        <?php elseif($cppHead->analisaMikro->analisaMikroResamplings[count($cppHead->analisaMikro->analisaMikroResamplings)-1]->analisa_mikro_status == '0'): ?>
                                                            <?php
                                                                $style      = 'background-color:#ffa6a6';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling #OK';
                                                            ?>
                                                        <?php else: ?>
                                                            <?php
                                                                $style      = 'background-color:#f5ffa6';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling On Progress';
                                                            ?>
                                                        <?php endif; ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <tr style="<?php echo e($style); ?>">
                                            <td> 
                                                <button class="btn btn-primary" onclick="window.location.href='<?php echo e($onclick); ?>'"> 
                                                    <i class="fas fa-eye"></i>
                                                </button> 
                                            </td>
                                            <td>
                                                <?php echo e($cppHead->woNumbers[0]->product->product_name); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $wo_number = '';
                                                ?>
                                                <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $wo_number  .= $woNumber->wo_number.', ';
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(rtrim($wo_number,', ')); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $production_realisation_date = '';
                                                ?>
                                                <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if (strpos($production_realisation_date,$woNumber->production_realisation_date.', ') === false) 
                                                        {
                                                            $production_realisation_date  .= $woNumber->production_realisation_date.', ';
                                                        }
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(rtrim($production_realisation_date,', ')); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                                                    $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                                                    echo date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)));
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo e($status); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php break; ?>
    <?php endswitch; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/analisa_mikro/dashboard.blade.php ENDPATH**/ ?>