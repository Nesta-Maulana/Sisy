<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sisy | <?php echo $__env->yieldContent('title'); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="<?php echo e(asset('css/login_style/app.css')); ?>">
</head>
<body>
    <div class="login-page">
        <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
                <div class="row">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-6">
                        <div class="info d-flex align-items-center bg-transparent">
                            <div class="content">
                                <div class="logo">
                                    <span style="font-size: 50px;">Sisy</span><span>&nbsp;&nbsp;(Noun.)</span>
                                </div>
                                <p>
                                    Is a magical website that was built with magical systems to connect all data of PT. Nutrifood Indonesia Sentul
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Form Panel    -->
                    <div class="col-lg-6">
                        <div class="form d-flex align-items-center">
                            <div class="content">
                                <?php echo $__env->yieldContent('content'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights text-center">
            <p>Design with <i class="fas fa-heart"></i> and <i class="fa fa-coffee"></i> by <a href="https://www.instagram.com/nesta_nm" style="color:#c7ff00;">Nesta Maulana</a></p>
        </div>
    </div>
    
    <?php if($message = Session::get('success')): ?>
    <div class="success" data-flashdata="<?php echo e($message); ?>"></div>
    <?php endif; ?> <?php if($message = Session::get('error')): ?>
    <div class="failed" data-flashdata="<?php echo e($message); ?>"></div>
    <?php endif; ?> <?php if($message = Session::get('info')): ?>
    <div class="info" data-flashdata="<?php echo e($message); ?>"></div>
    <?php endif; ?>

    <!-- JavaScript files-->
    <script src="<?php echo e(mix('js/login_script/app.js')); ?>"></script>
    <script src="<?php echo e(mix('js/login_script/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('sweetalert/sweetalert2.all.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
        const flashdatas = $('.failed').data('flashdata');
        if (flashdatas) 
        {
            swal({
                title: "Failed",
                text: flashdatas,
                type: "error",
            });
        }
        const flashdata = $('.success').data('flashdata');
        if (flashdata) {
            swal({
                title: "Success",
                text: flashdata,
                type: "success",
            });
        }
                        
        const flashdatasi = $('.info').data('flashdata');
        if(flashdatasi){
            swal({
                title: "Proses Berhasil",
                text: flashdatasi,
                type: "info",
            });
        }
    });
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/auth/layouts/credential-form.blade.php ENDPATH**/ ?>