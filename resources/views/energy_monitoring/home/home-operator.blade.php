@extends('layouts.app')
@section('title')
    Home
@endsection
@section('active-emon-home-operator') 
    active 
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($menus->where('id','70')->first()->childMenus as $monitoring)
                        @switch($monitoring->menu_name)
                            @case('Monitoring Gas')
                                <div class="col-lg col-md col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-body btn bg-danger  text-center" onclick="window.location.href='{{ route($monitoring->menu_route) }}'">
                                            <h1 class="d-flex justify-content-center">
                                                <i class="fas fa-fire text-white"></i> <br>
                                            </h1>
                                            <h6 class="text-white">{{ $monitoring->menu_name }}</h6>
                                        </div>
                                    </div>
                                </div>    
                            @break
                            @case('Monitoring Air')
                                <div class="col-lg col-md col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-body btn bg-primary text-center" onclick="window.location.href='{{ route($monitoring->menu_route) }}'">
                                            <h1 class="d-flex justify-content-center">
                                                <i class="fas fa-tint text-white"></i> <br>
                                            </h1>
                                            <h6 class="text-white">{{ $monitoring->menu_name }}</h6>
                                        </div>
                                    </div>
                                </div>    
                            @break

                            @case('Monitoring Listrik')
                                <div class="col-lg col-md col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-body btn bg-warning text-center" onclick="window.location.href='{{ route($monitoring->menu_route) }}'">
                                            <h1 class="d-flex justify-content-center">
                                                <i class="fas fa-bolt text-white"></i> <br>
                                            </h1>
                                            <h6 class="text-white">{{ $monitoring->menu_name }}</h6>
                                        </div>
                                    </div>
                                </div>    
                            @break
                            @case('Riwayat Pengamatan')
                                <div class="col-lg col-md col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-body btn bg-info text-center" onclick="window.location.href='{{ route($monitoring->menu_route) }}'">
                                            <h1 class="d-flex justify-content-center">
                                                <i class="fas fa-database text-white"></i> <br>
                                            </h1>
                                            <h6 class="text-white">Riwayat Pengamatan</h6>
                                        </div>
                                    </div>
                                </div>    
                            @break
                        @endswitch
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection