
<?php $__env->startSection('title'); ?>
    Kelola Menu
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-open-general-setting'); ?> 
    active menu-open
<?php $__env->stopSection(); ?>
<?php $__env->startSection('active-master-app-manage-menu'); ?> 
    active 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row <?php echo e(Session::get('tambah')); ?>">
    <div class="col-lg-12 div col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-dark">
                Kelola Menu
            </div>
            <div class="card-body">
                <form action="kelola-menu" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group ">
                                <label for="aplikasi_id">Application :</label>
                                <select name="aplikasi_id" id="aplikasi_id" class="form-control" onchange="changeApplication()" required>
                                    <option value="" selected disabled>-- Choose Application --</option>
                                    <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($application->id)); ?>"><?php echo e($application->application_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="parent_menu">Parent Menu :</label>
                                <select name="parent_menu" id="parent_menu" class="form-control" onchange="changeParent()">
                                    <option value="" disabled selected>-- Choose Parent --</option>
                                    <option value="0">JADIKAN PARENT</option>
                               
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="route_name"> Route Menu :</label>
                                <input type="text" name="route_name" id="route_name" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label for="urutan"> Position :</label>
                                <input type="text" name="urutan" value="0" readonly id="urutan" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="menu">Menu Name :</label>
                                <input type="text" name="menu" id="menu" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group ">
                                <label for="icon">Icon :</label>
                                
                                <select name="icon" id="icons" class="form-control select2" >
                                    <option value="" disabled selected>-- Choose Icon --</option>
                                    <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($icon->icons); ?>" data-icon="<?php echo e($icon->icons); ?>"><?php echo e($icon->icons); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            

                            <div class="form-group ">
                                <label for="status"> Status :</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected disabled>-- Choose Status --</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group row" style="margin-top: 1.5rem!important;">
                                
                                <a href="" class="btn btn-outline-secondary mt-4 col-lg hidden" id="batal" onclick=""  style="margin-right: 10px;">Cancel</a>
                                <input type="submit" value="Update" id="update" class="btn mt-4 btn-outline-primary col-lg hidden"  style="margin-right: 10px;">
                                <input type="submit" value="Save" id="simpan" class="btn mt-4 btn-primary col-lg" style="margin-right: 10px;" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-dark">
                Data Menu
            </div>
            <div class="card-body">
                <?php echo e(Session::get('edit')); ?>

                <table class="table table-bordered " id="manage-menu-table">
                    <thead>
                        <tr>
                            <?php if(Session::get('ubah') == 'show'): ?>
                                <th> Action </th>
                            <?php endif; ?>
                            <th style="width: 250px;" class="search-application">Application</th>
                            <th style="width: 250px;">Parent Menu</th>
                            <th style="width: 250px;">Menu Name</th>
                            <th style="width: 250px;">Route Menu</th>
                            <th style="width: 100px;">Position</th>
                            <th style="width: 100px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $menus_data->sortBy('application_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php if(Session::get('ubah') == 'show'): ?>
                            <td>
                                <button onclick="editMenu('<?php echo e(app('App\Http\Controllers\ResourceController')->encrypt($menu->id)); ?>')" class="btn btn-outline-info form-control">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </td>
                            <?php endif; ?>
                            <td>
                                <?php echo e($menu->application->application_name); ?>

                            </td>
                            <td>
                            <?php if($menu->parent_id == 0): ?>
                                -
                            <?php else: ?>
                                <?php echo e($menu->parentMenu->menu_name); ?>

                            <?php endif; ?>
                            </td>
                            <td><?php echo e($menu->menu_name); ?></td>
                            <td><?php echo e($menu->menu_route); ?></td>
                            <td><?php echo e($menu->menu_position); ?></td>
                            <td>
                                <?php if($menu->is_active): ?>
                                    Active
                                <?php else: ?>
                                    Inactive
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/master_app/manage_menu/form.blade.php ENDPATH**/ ?>