
<?php $__env->startSection('title'); ?>
    Form Cpp Produk
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-data-proses'); ?>
    menu-open
<?php $__env->stopSection(); ?>

<?php $__env->startSection('active-rollie-process-data-cpps'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    CPP Produk <?php echo e($cppHead->woNumbers[0]->product->product_name); ?>

                </div>
                <div class="card-body">
                    
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="produk">Nama Produk : </label>
                                    <?php if(count($activeCppProduct) > 1): ?>
                                        <select name="nama_produk" id="nama_produk" onchange="changeProduct(this)" class="form-control">
                                            <?php $__currentLoopData = $activeCppProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cpp_active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cpp_active->id)); ?>" <?php if($cpp_active->woNumbers[0]->product->id === $cppHead->woNumbers[0]->product->id): ?>
                                                    selected
                                                <?php endif; ?>><?php echo e($cpp_active->woNumbers[0]->product->product_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php else: ?>
                                        <input type="text" value="<?php echo e($cppHead->woNumbers[0]->product->product_name); ?>" name="nama_produk" id="nama_produk" class="form-control" readonly>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="form-group">
                                    <label for="noWo">No WO : </label>
                                    <?php if(count($cppHead->woNumbers) > 1): ?>
                                        <select name="no_wo" id="no_wo" class="form-control" onchange="refreshTableCpp()">
                                            <?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wo_number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($wo_number->id)); ?>"><?php echo e($wo_number->wo_number); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                                        </select>
                                    <?php else: ?>
                                        <input type="text" value="<?php echo e($cppHead->woNumbers[0]->wo_number); ?>" name="nomor_wo" id="nomor_wo" class="form-control" readonly>
                                        <input type="hidden" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->woNumbers[0]->id)); ?>" name="no_wo" id="no_wo" class="form-control" readonly>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                
                                <div class="form-group">
                                    <label for="tglMixing">Tanggal Packing : </label>
                                    <input type="text" value="<?php echo e($cppHead->packing_date); ?>" name="tglMixing" id="tglMixing" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="noWo">Expired Date : </label>
                                    <input type="text" value="<?php $__currentLoopData = $cppHead->woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wo_number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($wo_number->expired_date.','); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    

                    
                    <?php if(Session::get('tambah') == 'show' && Session::get('ubah') =='show'): ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group ">
                                    <button class="btn btn-outline-primary form-control" data-toggle="modal" data-target="#tambahBatchPackingModal">Tambah Wo</button>
                                </div>
                            </div>
                            <?php $__currentLoopData = $cppHead->woNumbers[0]->product->fillingMachineGroupHead->fillingMachineGroupDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mesinfilling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group" >
                                        <button class="btn btn-primary form-control" onclick="addPalet('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($mesinfilling->fillingMachine->id)); ?>',$('#no_wo').val(),'<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id)); ?>')">
                                            Tambah Palet <?php echo e($mesinfilling->fillingMachine->filling_machine_name); ?>

                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <button class="btn btn-success form-control" onclick="closeCppProduct()">
                                        Close CPP
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <button class="btn btn-outline-primary form-control" onclick="refreshTableCpp()">Refresh Table</button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    

                    
                    <?php $__currentLoopData = $cppHead->woNumbers[0]->product->fillingMachineGroupHead->fillingMachineGroupDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fillingMachineDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $index_code     = strlen($fillingMachineDetail->fillingMachine->filling_machine_code);
                            $machine_code   = $fillingMachineDetail->fillingMachine->filling_machine_code[$index_code-1];
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group col-lg-12 text-center">
                                <hr>
                                    <h5><?php echo e($fillingMachineDetail->fillingMachine->filling_machine_code); ?></h5>
                                <hr>
                                </div>
                                <table class="table table-bordered" id="table-cpp-<?php echo e(strtolower($fillingMachineDetail->fillingMachine->filling_machine_name)); ?>">
                                    <thead class="bg-dark text-center text-white" >
                                        <tr>
                                            <th width="250px">Palet</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Box</th>
                                            <th class="<?php echo e(Session::get('hapus')); ?>">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail-cpp-<?php echo e(strtolower($fillingMachineDetail->fillingMachine->filling_machine_name)); ?>">
                                        <?php $__currentLoopData = $cppHead->cppDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cppDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($cppDetail->wo_number_id === $cppHead->woNumbers[0]->id): ?>
                                                <?php if(strpos($cppDetail->lot_number,$machine_code)): ?>
                                                    <?php $__currentLoopData = $cppDetail->palets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                         <tr <?php if(count($palet->atEvents)>0): ?> class="bg-warning" <?php endif; ?>>
                                                             <td>
                                                                <div class="form-inline">
                                                                    <label class="col-lg-6 col-md-6 col-sm-6" style="font-size: 15px;"> <?php echo e($cppDetail->lot_number); ?> - </label>
                                                                    <input type="text" value="<?php echo e($palet->palet); ?>" class="col-lg-6 col-sm-6 col-md-6 form-control"  id="nomor_palet_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>" 
                                                                    <?php if(Session::get('ubah') == 'show'): ?>
                                                                        onfocusout="changePalet('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>')"
                                                                    <?php else: ?>
                                                                    readonly 
                                                                    <?php endif; ?>>
                                                                </div>
                                                             </td>
                                                             <td>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                        <input type="text" class="datetimepickernya form-control" id="start_palet_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>" value="<?php echo e($palet->start); ?>" <?php if(Session::get('ubah') == 'show'): ?>
                                                                            onfocusout="changeStart('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>')" 
                                                                        <?php else: ?>
                                                                            readonly 
                                                                        <?php endif; ?>>
                                                                    </div>
                                                                </div>
                                                             </td>
                                                             <td>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" class="datetimepickernya form-control" value="<?php echo e($palet->end); ?>" id="end_palet_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>" <?php if(Session::get('ubah') == 'show'): ?>
                                                                            onfocusout="changeEnd('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>')"
                                                                            <?php else: ?>
                                                                            readonly 
                                                                            <?php endif; ?> >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             </td>
                                                             <td>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text"  id="box_palet_<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>" value="<?php echo e($palet->jumlah_box); ?>" class="form-control" <?php if(Session::get('ubah') =='show'): ?>
                                                                            onfocusout="changeBox('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>')"
                                                                            <?php else: ?>
                                                                                readonly 
                                                                            <?php endif; ?>>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             </td>
                                                             <td>
                                                                 <div class="row">
                                                                     <div class="col-lg-12 col-md-12 col sm-12">
                                                                         <div class="form-group">
                                                                             <a onclick="deletePalet('<?php echo e($cppDetail->lot_number); ?>-<?php echo e($palet->palet); ?>','<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($palet->id)); ?>')" class="btn btn-danger text-white form-control">
                                                                                <i class="fas fa-trash"></i>
                                                                            </a>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </td>
                                                         </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group ">
                                    <button class="btn btn-outline-primary form-control" data-toggle="modal" data-target="#tambahBatchPackingModal">Tambah Wo Proses</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group" >
                                    <button class="btn btn-primary form-control" onclick="addPalet('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($fillingMachineDetail->fillingMachine->id)); ?>',$('#no_wo').val(),'<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id)); ?>')">
                                        Tambah Palet <?php echo e($fillingMachineDetail->fillingMachine->filling_machine_name); ?>

                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </div>
            </div>
            
        </div>
    </div>
    <input type="hidden" name="cpp_head_id" id="cpp_head_id" value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id)); ?>">
    <?php echo $__env->make('rollie.cpp_produk.pop-up.tambah-batch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/cpp_produk/form.blade.php ENDPATH**/ ?>