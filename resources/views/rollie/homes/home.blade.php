@extends('layouts.app')
@section('title')
    Home
@endsection
@section('active-rollie-show-home') 
    active 
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group text-center">
                            <h1>
                                <span class="wow slideInLeft animated">Selamat</span><span class="text-primary wow slideInRight animated"> Datang</span>
                            </h1>
                            <h2 class="text-primary d-flex justify-content-center wow fadeInDown animated"> Di</h2>
                            <h1 class="text-primary d-flex justify-content-center wow fadeInDown animated"> Aplikasi {{ $menus[0]->application->application_name }}</h1>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div style="min-height: 250px;margin-top: 3px" class="card-body text-center bg-primary text-white wow slideInLeft animated" data-wow-delay="0.05s">
                            <h2>
                                Fast 
                            </h2>
                            <h2 class="d-flex justify-content-center">
                                <i class="fa fa-bolt"></i>
                            </h2>
                            <h5 class="text-justify">
                                Menghasilkan data secara realtime sesuai kebutuhan anda.
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div style="min-height: 250px;margin-top: 3px" class="card-body text-center bg-primary text-white wow slideInLeft animated" data-wow-delay="0.05s">
                            <h2>Accurate</h2>
                            <h2 class="d-flex justify-content-center">
                                <i class="fa fa-check"></i>
                            </h2>
                            <h5 class="text-justify">
                                Melakukan sistem perhitungan data yang akurat 
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div style="min-height: 250px;margin-top: 3px" class="card-body text-center bg-primary text-white wow slideInRight animated" data-wow-delay="0.05s">
                            <h2>Reliable</h2>
                            <h2 class="d-flex justify-content-center">
                                <i class="fa fa-user"></i>
                            </h2>
                            <h5 class="text-justify">
                                Andal dalam memper-mudah pekerjaan anda
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div style="min-height: 250px;margin-top: 3px" class="card-body text-center bg-primary text-white wow slideInRight animated" data-wow-delay="0.05s">
                            <h2>Trustworthy</h2>
                            <h2 class="d-flex justify-content-center">
                                <i class="fa fa-clock-o"></i>
                            </h2>
                            <h5 class="text-justify">
                                Dapat dipercaya menjaga seluruh data perusahaan
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection