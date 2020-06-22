@extends('auth.layouts.app')
@section('title','Sisy | Akses Aplikasi')
@section('page_title','List Aplikasi')
@section('menu-home','active')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            @php
                $lihat = 0;
            @endphp
            @foreach (Auth::user()->applicationPermissions as $application_permission)
                @if ($application_permission->application->is_active == true && $application_permission->is_active == true)
                    @php
                        $lihat++;               
                    @endphp         
                @endif
            @endforeach
            @if($lihat > 0)
                <div class="row">
                    @foreach(Auth::user()->applicationPermissions as $application_permission)
                        @if ($application_permission->application->is_active == true && $application_permission->is_active==true)
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
                                <div class="card bg-transparent text-center" style="min-height: 250px">
                                    <div class="card-header bg-primary text-white ">
                                        {{$application_permission->application->application_name}}
                                    </div>
                                    <div class="card-body text-justify bg-dark ">
                                        {{ $application_permission->application->application_description}}
                                    </div>
                                    <div class="card-footer bg-primary btn" onclick="document.location.href='{{ $application_permission->application->application_link }}'">
                                        <a href="{{ $application_permission->application->application_link }}" class="font-weight-bolder">Pergi Ke Aplikasi >> </a>
                                    </div>
                                </div>  
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-warning">Anda tidak memiliki hak akses ke aplikasi apapun didalam Portal SISY</h2>
                        <h3 class="text-white">Untuk request hak akses klik tombol dibawah ini</h3>
                        <a href="halaman-help" class="btn btn-danger text-white col-lg-6"><h4>Request Hak Akses </h4></a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>  
@endsection