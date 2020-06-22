<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/master/app.css') }}"> 
    <link rel="stylesheet" href="{{ mix('css/master/custom.css') }}">
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
	                    <a class="nav-item  nav-link text-white @yield('menu-home')" href="{{ route('credential_access.home-page') }}">Home</a>
	                    <a class="nav-item nav-link text-white @yield('menu-user-guide')" href="{{ route('credential_access.user-guide') }}">User Guide</a>
	                    <a class="nav-item nav-link text-white @yield('menu-halaman-help')" href="{{ route('credential_access.help-page') }}">Help</a>
	                    <a class="nav-item nav-link text-white" href="{{ route('logout') }}"
	                       onclick="event.preventDefault();
	                                     document.getElementById('logout-form').submit();">
	                        {{ __('Logout') }}
	                    </a>
	                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        @csrf
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
		                    <h2>@yield('page_title')</h2>
		                </div>
		                <div class="card-body">
		                	@yield('content')
		                </div>
		            </div>
		        </div>
			</section>
		</div>
    </div>

    @if ($message = Session::get('success'))
        <div class="success" data-flashdata="{{ $message }}"></div>
    @endif
    @if ($message = Session::get('error'))
        <div class="failed" data-flashdatas="{{ $message }}"></div>
    @endif
    <script src="{{ mix('js/master/app.js') }}"></script>
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
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
