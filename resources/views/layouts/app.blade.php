@php
    $url                = \Request::getRequestUri();
    $application_name   = explode('/',$url);
    $application_name   = $application_name[1];
    $application_name   = ucwords(str_replace('-', ' ', $application_name));
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Sentul Integrated System Template</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ mix('css/master/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/master/custom.css') }}">
    <style>
        .nowrap
        {
            white-space:nowrap;

        }
    </style>
    @yield('extract-plugin-head')
</head>
<body class="hold-transition sidebar-mini sidebar-collapse ">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('credential_access.home-page')}}" class="nav-link">Landing Page</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">User Guide</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Help</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        Hello, {{ Auth::user()->employee->fullname }} <i class="fas fa-chevron-down"></i> 
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="javascript:void(0)" class="brand-link">
                <img src="{{ asset('images/logo/logo-kecil.png')}}"alt="Sisy Logo" class="brand-image img-circle " style="opacity: .8;max-height: 44px;margin-left: 0px">
                <span class="brand-text font-weight-light">Sisy - {{ $application_name }}</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('images/user.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="javascript:void(0)" class="d-block">{{ Auth::user()->employee->fullname }}</a>
                    </div>
                </div>
                <!-- .Sidebar user panel -->
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-flat text-sm" data-widget="treeview" role="menu" data-accordion="false">
                        {{-- <li class="nav-header">MENU</li> --}}
                       @foreach ($menus as $menu)
                            @if (!is_null($menu->menuPermissions->where('user_id',Auth::user()->id)->where('view','1')->first()))
                                @php
                                    $cekchild1 = app('App\Http\Controllers\MasterAppController')->cekChild(app('App\Http\Controllers\ResourceController')->encrypt($menu->id));
                                    $route     = str_replace('_', '-',$menu->menu_route);
                                    $route     = str_replace(' ', '-',$route);
                                    $route     = str_replace('.', '-',$route);
                                @endphp
                                @if ($cekchild1['jumlahchild'] == 0)
                                    <li class="nav-item">
                                        <a href="{{ route($menu->menu_route) }}" class="nav-link @yield('active-'.$route)">
                                            <i class="fas {{ $menu->menu_icon }} nav-icon"></i> 
                                            <p>
                                                {{ $menu->menu_name }}
                                            </p>
                                        </a>
                                    </li>
                                @else
                                    @php
                                        $activemenu     = strtolower($menu->menu_name);
                                        $activemenu     = str_replace(' ', '-',$activemenu);
                                    @endphp
                                    <li class="nav-item has-treeview @yield('menu-open-' .$activemenu)">
                                        <a href="#" class="nav-link @yield('active-' .$activemenu)">
                                            <i class="nav-icon fa {{ $menu->menu_icon }}"></i>
                                            <p>
                                                {{ $menu->menu_name }}
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            @foreach ($cekchild1['child'] as $child1)
                                                @php
                                                    $cekchild2 = app('App\Http\Controllers\MasterAppController')->cekChild(app('App\Http\Controllers\ResourceController')->encrypt($child1->id));
                                                    $routechild1     = str_replace(' ', '-',$child1->menu_route);
                                                    $routechild1     = str_replace('_', '-',$routechild1);
                                                    $routechild1     = str_replace('.', '-',$routechild1);
                                                @endphp
                                                @if ($cekchild2['jumlahchild'] == 0)
                                                    <li class="nav-item">
                                                        <a href="{{ route($child1->menu_route) }}" class="nav-link @yield('active-' .$routechild1)">
                                                            <i class="fas {{ $child1->menu_icon }} nav-icon"></i>
                                                            <p>{{ $child1->menu_name }}</p>
                                                        </a>
                                                    </li>
                                                @else
                                                    @php
                                                        $activemenu1     = strtolower($child1->menu_name);
                                                        $activemenu1     = str_replace(' ', '-',$activemenu1);
                                                    @endphp
                                                    <li class="nav-item has-treeview @yield('menu-open-'.$activemenu1)">
                                                        <a href="#" class="nav-link @yield('active-' .$activemenu1)">
                                                            <i class="nav-icon fa {{ $child1->menu_icon }}"></i>
                                                            <p>
                                                                {{ $child1->menu_name }}
                                                                <i class="right fas fa-angle-left"></i>
                                                            </p>
                                                        </a>
                                                        <ul class="nav nav-treeview">
                                                            @foreach ($cekchild2['child'] as $child2)
                                                                @php
                                                                    $routechild2     = str_replace(' ', '-',$child2->menu_route);
                                                                    $routechild2     = str_replace('_', '-',$routechild2);
                                                                    $routechild2     = str_replace('.', '-',$routechild2);
                                                                @endphp
                                                                <li class="nav-item">
                                                                    <a href="{{ route($child2->menu_route) }}" class="nav-link @yield('active-' .$routechild2)">
                                                                        <i class="fas {{ $child2->menu_icon }} nav-icon"></i>
                                                                        <p>{{ $child2->menu_name }}</p>
                                                                    </a>
                                                                </li>   
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif

                                            @endforeach
                                        </ul>
                                    </li> 
                                @endif
                            @endif
                       @endforeach
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-lg-8 col-md-8 col-sm-6">
                            <h1 class="m-0 text-dark"><small>{{ ucwords($application_name) }} | @yield('title')</small></h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('credential_access.home-page') }}">Sisy</a></li>
                                <li class="breadcrumb-item active">{{ $application_name }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <!-- Sweet alert  -->
            @if ($message = Session::get('success'))
                <div class="success" data-flashdata="{{ $message }}"></div>
            @endif

            @if ($message = Session::get('error'))
                <div class="error" data-flashdata="{{ $message }}"></div>
            @endif 

            @if ($message = Session::get('infonya'))
                <div class="infonya" data-flashdata="{{ $message }}"></div>
            @endif
            <!--/. Sweet alert  -->

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2019 <a href="javascript:void(0)">PT. Nutrifood Indonesia</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
              <b>Version</b> 3.1.0 | Developed By  <a href="sayanesta.github.io">Nesta Maulana</a>
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/master/app.js') }}"></script>
    {{-- <script src="{{ asset('js/master/custom.js') }}"></script> --}}
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>    
    {{-- Sweet alert script --}}
    <script type="text/javascript">
        $(document).ready(function () 
        {
            const flashdatas = $('.error').data('flashdata');
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
                            
            const flashdatasi = $('.infonya').data('flashdata');
            if(flashdatasi){
                swal({
                    title: "Proses Berhasil",
                    text: flashdatasi,
                    type: "info",
                });
            }
            $('#myModal').on('shown.bs.modal', function()
            {
                $('#myInput').trigger('focus')
            });
            // bsCustomFileInput.init();
        });
    </script>
    <link rel="stylesheet" href="{{ mix('css/master/datatable.css') }}">
    <script src="{{ mix('js/master/datatable.js') }}"></script>
    <style>
        .hidden
        {
            display: none
        }
    </style>
    @switch($application_name)
        @case('Master Apps')
            <script src="{{  asset('js/master_app/master_app.js') }}"></script>
        @break
        @case('Rollie')
            <script src="{{  mix('js/master/sheet.js') }}"></script>
            <script src="{{  asset('js/rollie_app/rollie.js') }}"></script>
        @break
        @case('Emon')
            <script src="{{  asset('js/emon_app/emon.js') }}"></script>
        @break
    @endswitch
    @yield('extract-plugin-footer')



</body>
</html>