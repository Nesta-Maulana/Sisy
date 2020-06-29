@extends('layouts.app')
@section('title')
    Report Rekapitulasi Data Filling
@endsection
@section('menu-open-report')
    menu-open
@endsection
@section('active-rollie-reports-rpd-filling') 
    active 
@endsection
@section('content')
   <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="card">
               <div class="card-header bg-dark">
                   Report RPD Filling
               </div>
               <div class="card-body">
                   <div class="row">
                       <div class="col-lg-6 col-md-6 col-sm-6">
                           <div class="form-group">
                                <label>Filter Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="filter_tanggal">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Nama Produk</label>
                            </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection
@section('extract-plugin-footer')
    <link rel="stylesheet" href="{{ asset('datetime-picker/css/daterangepicker.css') }}">
    <script type="text/javascript" src="{{ asset('datetime-picker/js/moment2.min.js') }}"></script>
    <script src="{{ asset('datetime-picker/js/daterangepicker.js') }}"></script>
    <script>
        $('#filter_tanggal').daterangepicker();
    </script>
@endsection 