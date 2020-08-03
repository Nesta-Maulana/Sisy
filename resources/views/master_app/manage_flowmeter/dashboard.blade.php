@extends('layouts.app')
@section('title')
    Data Flowmeter
@endsection
@section('menu-open-master-data') 
    active menu-open
@endsection

@section('menu-open-emon') 
    active menu-open
@endsection
@section('active-master-app-master-data-manage-flowmeters') 
    active 
@endsection
@section('content')
    <div class="row" id="form-manage-flowmeter">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <form action="kelola-flowmeter" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Flowmeter
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="flowmeter_name">Nama Flowmeter</label>
                                    <input type="text" name="flowmeter_name" id="flowmeter_name" class="form-control" autocomplete="off">
                                    <input type="hidden" name="flowmeter_id" id="flowmeter_id" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="flowmeter_unit_id">Satuan Flowmeter</label>
                                    <select name="flowmeter_unit_id" id="flowmeter_unit_id" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Satuan Flowmeter-- </option>
                                        @foreach ($flowmeterUnits as $flowmeterUnit)
                                        <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterUnit->id) }}">{{ $flowmeterUnit->flowmeter_unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="flowmeter_workcenter_id">Workcenter Flowmeter</label>
                                    <select name="flowmeter_workcenter_id" id="flowmeter_workcenter_id" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Workcenter Flowmeter-- </option>
                                        @foreach ($flowmeterWorkcenters as $flowmeterWorkcenter)
                                        <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterWorkcenter->id) }}">{{ $flowmeterWorkcenter->flowmeterCategory->flowmeter_category.' - '.$flowmeterWorkcenter->flowmeter_workcenter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="flowmeter_location_id">Lokasi Flowmeter</label>
                                    <select name="flowmeter_location_id" id="flowmeter_location_id" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Lokasi Flowmeter-- </option>
                                        @foreach ($flowmeterLocations as $flowmeterLocation)
                                        <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocation->id) }}">{{ $flowmeterLocation->flowmeter_location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kategori_pencatatan">Kategori Pencatatan</label>
                                    <select name="kategori_pencatatan" id="kategori_pencatatan" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Kategori Pencatatan -- </option>
                                        <option value="0" >Perhari</option>
                                        <option value="1" >Pershift</option>
                                        <option value="2" >Perjam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Status  Flowmeter</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Status  Flowmeter-- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end" >
                            <div class="col-6">
                                <button class="btn btn-primary form-control" id="button_simpan">Tambahkan </button>
                            </div>
                            <div class="col-3 hidden" id="button_update">
                                <button class="btn btn-primary form-control">Ubah Data </button>
                            </div>
                            
                            <div class="col-3 hidden" id="button_batal">
                                <a class="btn btn-outline-secondary form-control" onclick="window.location.href=''">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-2" id="table-manage-flowmeter">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Flowmeter
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <table class="table table-bordered" id="flowmeter-categories-table" >
                               <thead >
                                     <tr>
                                         <th style="width: 50px">#</th>
                                         <th style="width: 200px">Nama Flowmeter</th>
                                         <th style="width: 200px">Satuan Flowmeter</th>
                                         <th style="width: 200px">Workcenter Flowmeter</th>
                                         <th style="width: 200px">Lokasi Flowmeter</th>
                                         <th style="width: 200px">Status</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($flowmeters as $flowmeter)
                                     <tr>
                                         <td>
                                             <button class="btn btn-outline-primary" onclick="editFlowmeter('{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}')">
                                                 <i class="fa fa-edit"></i>
                                             </button>
                                         </td>
                                         <td>{{ $flowmeter->flowmeter_name }}</td>
                                         <td>{{ $flowmeter->flowmeterUnit->flowmeter_unit }}</td>
                                         <td>{{ $flowmeter->flowmeterWorkcenter->flowmeter_workcenter }}</td>
                                         <td>{{ $flowmeter->flowmeterLocation->flowmeter_location }}</td>
                                         <td>
                                             @if ($flowmeter->is_active == '0')
                                                 Inactive
                                             @else
                                                 Active
                                             @endif
                                         </td>
                                     </tr>
                                     @endforeach
                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection