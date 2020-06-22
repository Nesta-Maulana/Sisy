@extends('layouts.app')
@section('title')
    Jadwal Produksi | Tambah Jadwal
@endsection
@section('active-rollie-production-schedules') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Tambah Jadwal Produksi
                </div>
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <button class="btn btn-outline-info addRow" ><i class="fas fa-pencil-alt"></i>Add WO</button>
                            <button class="btn btn-info" data-toggle="modal" data-target="#editMtolModal" style="background-color: #00b8ff"><i class="fas fa-plus"></i>Upload Mtol</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group pull-right">
                                <a onclick="backToSchedulePage()" class="btn btn-outline-secondary"> <i class="fa fa-arrow-left"></i> Back To Schedule Page</a>
                                <button type="submit" class="btn btn-primary" onclick="$('#approve-jadwal').submit()" id="button-finalize"><i class="fa fa-check"></i> &nbsp;Finalize Schedules</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <form action="approve-jadwal" method="post" id="approve-jadwal">
                                {{ csrf_field() }}
                                <table class="table table-bordered" id="production-schedule-draft-table">
                                    <thead>
                                        <tr>
                                            <th style="width:70px">Wo Number</th>
                                            <th style="width:200px">Product Name</th>
                                            <th style="width:100px">Oracle Code</th>
                                            <th style="display: none;width:100px">Production Plan Date</th>
                                            <th style="width:100px">Production Plan Date</th>
                                            <th style="width:50px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        @php
                                            $draft_id= '';
                                        @endphp
                                        @foreach ($draft_schedules as $draft_schedule)
                                            <tr>
                                                <td>{{ $draft_schedule->wo_number }}</td>
                                                <td>{{ $draft_schedule->product->product_name }}</td>
                                                <td>{{ $draft_schedule->product->oracle_code }}</td>
                                                <td style="display: none">{{ $draft_schedule->production_plan_date }}</td>
                                                <td >{{ $draft_schedule->production_plan_date }}</td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#prosesWoModal" onclick="setUpdateDataWo('draft','{{ app('App\Http\Controllers\ResourceController')->encrypt($draft_schedule->id) }}')" class="text-primary"><i class="fa fa-pencil"></i></a> &nbsp;|&nbsp; 
                                                    <a class="text-danger" onclick="deleteWo('{{ $draft_schedule->wo_number }}','{{ $draft_schedule->product->product_name}}','{{ app('App\Http\Controllers\ResourceController')->encrypt($draft_schedule->id) }}')"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $draft_id .= app('App\Http\Controllers\ResourceController')->encrypt($draft_schedule->id).',';
                                            @endphp
                                        @endforeach
                                            <tr class="bg-warning hidden tambah-jadwal">
                                                <td>
                                                    <input type="text" name="wo_number[]" placeholder="Harap Isi Nomor Wo" class="form-control" required>
                                                </td>
                                                <td>
                                                    <select name="product_id[]" class="form-control" style="width:100%" required>
                                                        <option value="" selected disabled>Harap Pilih Produk</option>
                                                        @foreach ($products as $product) 
                                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    Kode oracle akan terinput secara otomatis by sistem
                                                </td>
                                                <td style="display: none">9999-01-01</td>
                                                <td>
                                                    <input type="date" id="production_plan_date[]" name="production_plan_date[]" class="form-control" required>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger text-white" onclick="removeWo(this)"> &nbsp;<i class="fa fa-trash"></i>&nbsp;&nbsp;Delete WO</a>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                                @php
                                    $draft_id  = rtrim($draft_id,',');
                                @endphp
                                <input type="hidden" name="draft_id" value="{{ $draft_id }}">
                            </form>

                        </div>
                    </div>
                    <br />
                    <div class="row hidden" id="bottom-action">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <button class="btn btn-outline-info addRow" ><i class="fas fa-pencil-alt"></i>Add WO</button>
                            <button class="btn btn-info" data-toggle="modal" data-target="#editMtolModal"><i class="fas fa-plus"></i>Upload Mtol</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group pull-right">
                                <a class="btn btn-outline-secondary" onclick="backToSchedulePage()"> <i class="fa fa-arrow-left"></i> Back To Schedule Page</a>
                                <button type="submit" class="btn btn-primary" onclick="$('#approve-jadwal').submit()"><i class="fa fa-check"></i> &nbsp; Finalize Schedules</button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('rollie.production_schedules.pop-up.upload-mtol')
    @include('rollie.production_schedules.pop-up.update-data-wo')
@endsection