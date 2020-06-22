<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sisy | Login - Register</title>
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
                                <form method="POST" class="form-validate mb-4 animate__bounceInDown animate__animated" action="/login" id="login-page">
                                    <?php echo e(csrf_field()); ?>

                                        <div class="form-group">
                                            <input id="login-username" type="text" name="username"
                                            autocomplete="off" data-msg="Please enter your username" class="input-material" required>
                                            <label for="login-username" class="label-material">User Name</label>
                                        </div>
                                        <div class="form-group">
                                            <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                                            <label for="login-password" class="label-material">Password</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary form-control">Login</button>
                                </form>
                                <form action="register" id="register" method="POST" class="form-validate mb-4 sembunyi animate__bounceInUp animate__animated"> 
                                    <?php echo e(csrf_field()); ?>

                                    <div>
                                        <div class="form-group">
                                            <input id="register-nama" type="text" required data-msg="Please enter your fullname" class="input-material" name="fullname">
                                            <label for="register-nama" class="label-material">Fullname</label>
                                        </div>
                                        <div class="form-group">
                                            <input id="register-username" type="text" required data-msg="Please enter your username" class="input-material" name="username">
                                            <label for="register-username" class="label-material">User Name</label>
                                        </div>
                                        <div class="form-group">
                                            <input id="register-email" type="email" required data-msg="Please enter your email" class="input-material" name="email">
                                            <label for="register-email" class="label-material" >Email</label>
                                        </div>

                                        <div class="form-group">
                                            <label for="login-departemen" class="label-material">Departemen</label>
                                            <select   id="login-departemen" required data-msg="Please enter your departemen" class="form-control" name="departemen">
                                                <option value="" selected disabled>-- PILIH Departemen --</option>
                                                <option value="1">FQC</option>
                                                <option value="2">FSA</option>
                                                <option value="3">FRC</option>
                                                <option value="4">FEC</option>
                                                <option value="5">FGS</option>
                                                <option value="6">FPD</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary form-control">Sign Up</button>
                                    </div>
                                </form>
                                <form id="forgot-password-form" method="POST" action="/forgot-password" class="form-validate mb-4 sembunyi animate__flipInY animate__animmated">
                                    <?php echo e(csrf_field()); ?>

                                    <div>
                                        <div class="form-group">
                                            <input id="forgot-username" type="text" required data-msg="Please enter your username" class="input-material" name="username" required autocomplete="off">
                                            <label for="forgot-username" class="label-material">Username</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary form-control">Reset My Password</button>
                                    </div>
                                </form>
                                <span id="log-in" class="sembunyi animate__bounceInUp animate__animated">
                                    <small>Already Have an account? </small><a style="color:#007bff;" onclick="login()">Bring Me To Login</a>
                                </span>
                                <br/>
                                <span id="join-us" class="animate__bounceInUp animate__animated">
                                    <small>Do not have an account? </small><a style="color:#007bff;" onclick="register()">Let's Join Us</a>
                                </span> 
                                <span id="forgot-password" class="animate__bounceInDown animate__animated">
                                    <small>Forgot Your Password? </small><a style="color:#006bff;" onclick="forgot_password()">Let's Us Help You</a>
                                </span>
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

</html><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/auth/login.blade.php ENDPATH**/ ?>