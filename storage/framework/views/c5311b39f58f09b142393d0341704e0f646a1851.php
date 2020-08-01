
<?php $__env->startSection('title'); ?>
    Riwayat Pengamatan
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-pengamatan'); ?>
    menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-emon-monitoring-histories'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered
        {
            line-height: 35px;
        }
        .select2-container .select2-selection--single
        {
            height: 35px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Filter Riwayat Pengamatan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="monitoring_month_filter">Bulan Monitoring</label>
                                <div class='input-group date' >
                                    <input type='month' class="form-control" name="monitoring_month_filter" id="monitoring_month_filter" value="<?php echo e(date('Y-m')); ?>" min="2019-01" max="<?php echo e(date('Y-m')); ?>" onchange="refreshTableMonitoringHistory()">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="flowmeter_monitoring_category">Kategori Flowmeter</label>
                                <select name="flowmeter_monitoring_category" id="flowmeter_monitoring_category" class="form-control select2" onchange="refreshTableMonitoringHistory()">
                                    <option value="0" selected disabled>-- Pilih Kategori Pengamatan --</option>
                                    <?php $__currentLoopData = $flowmeterCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $flowmeter_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($flowmeter_category); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="flowmeter_workcenter_filter">Flowmeter Workcenter</label>
                                <select name="flowmeter_workcenter_filter" id="flowmeter_workcenter_filter" class="form-control select2" onchange="refreshTableMonitoringHistory()">
                                    <option value="0" selected disabled>-- Pilih Flowmeter Workcenter --</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="">Monitoring Bulan <span id="month_label"><?php echo e(date('F').' '.date('Y')); ?></span></h5>
                </div>
                <div class="card-body" style="padding: 0px">
                    <div class="table-responsive">
                        <style>
                            tr {
                                white-space: nowrap;
                            }
                            th:first-child,td:first-child
                            {
                                position:sticky;
                                left:0px;
                            }
                        </style>
                        <table class="table table-bordered" id="monitoring_history_table" style="overflow-x: overflow;">
                            <thead class="bg-dark">
                                <tr>
                                    <th rowspan="2" class="bg-dark" style="background-color: black;color:white">Nama Flowmeter</th>
                                    <th rowspan="2" style="vertical-align: bottom">Flowmeter Workcenter</th>
                                    <th colspan="<?php echo e($colspan); ?>" class="text-center" id="colpan_tanggal">Tanggal</th>
                                </tr>
                                <tr id="monitoring_history_head">
                                    <th style="border: 0px" class="hidden"></th>
                                    <?php $__currentLoopData = $allDay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e($day); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </thead>
                            <tbody id="monitoring_history_table_body">
                                <?php $__currentLoopData = $flowmeters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flowmeter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="background-color: black;color:white">
                                            <?php echo e($flowmeter->flowmeter_name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($flowmeter->flowmeterWorkcenter->flowmeter_workcenter); ?>

                                        </td>
                                        <?php $__currentLoopData = $flowmeter->monitoringHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $monitoringHistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td id="td_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($monitoringHistory['monitoring_date'])); ?>_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>" onclick="editMonitoringHistory('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($monitoringHistory['monitoring_date'])); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id)); ?>')"><?php echo e($monitoringHistory['monitoring_value']); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startSection('extract-plugin-footer'); ?>
        <script src="<?php echo e(asset('datetime-picker/js/jquery.min.js')); ?>"></script>
        <link rel="stylesheet" href="<?php echo e(asset('datetime-picker/css/bootstrap.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('datetime-picker/css/bootstrap-datetimepicker.min.css')); ?>">
        <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/moment.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('datetime-picker/js/bootstrap-datetimepicker.min.js')); ?>"></script>
        <script>
            
            $('.timepickernya').datetimepicker({
                viewMode: 'years',
                format: 'MMMM/YYYY',
                date: new Date()

            }); 
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/energy_monitoring/monitoring_history/dashboard.blade.php ENDPATH**/ ?>