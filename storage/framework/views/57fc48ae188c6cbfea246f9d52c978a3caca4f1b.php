<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(mix('css/master/app.css')); ?>"> 
    <link rel="stylesheet" href="<?php echo e(mix('css/master/custom.css')); ?>">
    <style>
    	.active
    	{
    		border-bottom: 1px solid white;
    	}
    </style> 
</head>
<body class="body" style="background:radial-gradient(ellipse at center, #0264d6 1%,#1c2b5a 100%);">
	<div class="wrapper">
	    <nav class="navbar navbar-expand-lg">
	        <div class="container">
	            <a class="navbar-brand home-logo text-white" href="#">Sentul Integrated System</a>
	            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
	                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	                <span class="navbar-toggler-icon"></span>
	            </button>
	            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	                <div class="navbar-nav ml-auto ">
	                    <a class="nav-item  nav-link text-white <?php echo $__env->yieldContent('menu-home'); ?>" href="<?php echo e(route('credential_access.home-page')); ?>">Home</a>
	                    <a class="nav-item nav-link text-white <?php echo $__env->yieldContent('menu-user-guide'); ?>" href="<?php echo e(route('credential_access.user-guide')); ?>">User Guide</a>
	                    <a class="nav-item nav-link text-white <?php echo $__env->yieldContent('menu-halaman-help'); ?>" href="<?php echo e(route('credential_access.help-page')); ?>">Help</a>
	                    <a class="nav-item nav-link text-white" href="<?php echo e(route('logout')); ?>"
	                       onclick="event.preventDefault();
	                                     document.getElementById('logout-form').submit();">
	                        <?php echo e(__('Logout')); ?>

	                    </a>
	                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
	                        <?php echo csrf_field(); ?>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </nav>
    	<!-- Content Header (Page header) -->
		<div class="container">
			<section class="content">
		        <div class="row mt-5">
		            <div class="card bg-transparent border-white" style="border:1px solid white;">
		                <div class="card-header text-center text-white  border-white">
		                    <h2><?php echo $__env->yieldContent('page_title'); ?></h2>
		                </div>
		                <div class="card-body">
		                	<?php echo $__env->yieldContent('content'); ?>
		                </div>
		            </div>
		        </div>
			</section>
		</div>
    </div>

    <?php if($message = Session::get('success')): ?>
        <div class="success" data-flashdata="<?php echo e($message); ?>"></div>
    <?php endif; ?>
    <?php if($message = Session::get('error')): ?>
        <div class="failed" data-flashdatas="<?php echo e($message); ?>"></div>
    <?php endif; ?>
    <script src="<?php echo e(mix('js/master/app.js')); ?>"></script>
    <script src="<?php echo e(asset('sweetalert/sweetalert2.all.min.js')); ?>"></script>
    <script>
        const flashdatas = $('.failed').data('flashdatas');
        const flashdata = $('.success').data('flashdata');
        if (flashdatas) {
            swal({
                title: "Failed",
                text: flashdatas,
                type: "error",
            });
        }
        if (flashdata) {
            swal({
                title: "Success",
                text: flashdata,
                type: "success",
            });
        }
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Sisy\resources\views/auth/layouts/app.blade.php ENDPATH**/ ?>