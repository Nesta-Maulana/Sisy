
<?php $__env->startSection('title'); ?>
    Data Pengguna
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-general-setting'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-manage-user'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Pengguna
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <table class="table table-bordered nowrap" id="manage-user-table" style="min-width:100%">
                                <thead>
                                    <tr >
                                        <th>#</th>
                                        <th  style="width: 130px">Fullname</th>
                                        <th >Username</th>
                                        <th >Email</th>
                                        <th >Departemen</th>
                                        <th >List Distribution Email</th>
                                        <th >Status Akun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="document.location.href='kelola-pengguna/edit-pengguna/<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($user->id)); ?>'">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-warning" onclick="changePasswordUser('<?php echo e($user->employee->fullname); ?>','<?php echo e($user->employee->email); ?>')">
                                                <i class="fas fa-magic"></i>&nbsp;<i class="fas fa-key"></i>
                                            </button>
                                        </td>
                                        <td><?php echo e($user->employee->fullname); ?></td>
                                        <td><?php echo e($user->username); ?></td>
                                        <td><?php echo e($user->employee->email); ?></td>
                                        <td><?php echo e($user->employee->departement->departement); ?></td>
                                        <td>
                                            <table class="table table-bordered table-striped" style="border : 1px solid black">
                                                <thead>
                                                    <tr>
                                                        <th>PPQ Mail TO</th>
                                                        <th>PPQ Mail CC</th>

                                                        <th>RKJ NFI Mail TO</th>
                                                        <th>RKJ NFI Mail CC</th>

                                                        <th>RKJ HB Mail TO</th>
                                                        <th>RKJ HB Mail CC</th>

                                                        <th>RKJ WRP Mail TO</th>
                                                        <th>RKJ WRP Mail CC</th>

                                                        <th>RKJ Sortasi Mail TO</th>
                                                        <th>RKJ Sortasi Mail CC</th>

                                                        <th>RKJ PSR TO</th>
                                                        <th>RKJ PSR CC</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(is_null(($user->employee->distributionList))): ?>
                                                        <tr>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                        </tr>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td>
                                                                <?php if($user->employee->distributionList->ppq_mail_to == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($user->employee->distributionList->ppq_mail_cc == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($user->employee->distributionList->rkj_nfi_mail_to == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($user->employee->distributionList->rkj_nfi_mail_cc == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td>
                                                                <?php if($user->employee->distributionList->rkj_hb_mail_to == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($user->employee->distributionList->rkj_hb_mail_cc == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td>
                                                                <?php if($user->employee->distributionList->rkj_wrp_mail_to == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($user->employee->distributionList->rkj_wrp_mail_cc == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td>
                                                                <?php if($user->employee->distributionList->sortasi_mail_to == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($user->employee->distributionList->sortasi_mail_cc == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td>
                                                                <?php if($user->employee->distributionList->psr_mail_to == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($user->employee->distributionList->psr_mail_cc == '1'): ?>
                                                                    <i class="fas fa-check"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-window-close"></i>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>
                                            <?php if($user->is_active == '1'): ?>
                                                <label class="">Active</label>
                                            <?php else: ?>
                                                <label class="">Inactive</label>
                                            <?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_user/dashboard.blade.php ENDPATH**/ ?>