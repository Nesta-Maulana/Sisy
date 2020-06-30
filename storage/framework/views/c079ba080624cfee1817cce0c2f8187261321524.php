
<?php $__env->startSection('title'); ?>
    Login - Register
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<form method="POST" class="form-validate mb-4 bounceInDown animated" action="<?php echo e(route('users.process-change-password')); ?>" id="login-page">
    <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <input id="login-username" type="text" name="username"
            autocomplete="off" data-msg="Please enter your username" class="input-material" value="<?php echo e($user->username); ?>" readonly required>
            <label for="login-username" class="label-material">User Name</label>
        </div>
        <div class="form-group">
            <input id="login-oldPassword" type="password" name="oldPassword" required data-msg="Please enter your oldPassword" class="input-material">
            <label for="login-oldPassword" class="label-material">Password Lama</label>
        </div>

        <div class="form-group">
            <input id="login-newPassword" type="password" name="newPassword" required data-msg="Please enter your new Password" class="input-material">
            <label for="login-newPassword" class="label-material">Password Baru</label>
        </div>

        <div class="form-group">
            <input id="login-cNewPassword" type="password" name="cNewPassword" required data-msg="Re-Type Your New Password" class="input-material">
            <label for="login-cNewPassword" class="label-material">Re-Type New Password</label>
        </div>
        <button type="submit" class="btn btn-primary form-control">Login</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.layouts.credential-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/auth/reset_password.blade.php ENDPATH**/ ?>