@extends('layouts.app')
@section('title')
    Data Lokasi Flowmeter
@endsection
@section('menu-open-master-data') 
    active menu-open
@endsection

@section('menu-open-emon') 
    active menu-open
@endsection
@section('active-master-app-master-data-manage-flowmeter-locations') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <form action="kelola-flowmeter-location" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Lokasi Flowmeter
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="flowmeter_category_id">Kategori Flowmeter</label>
                                    <select name="flowmeter_category_id" id="flowmeter_category_id" class="form-control">
                                        <option value="0" disabled selected>-- Harap Pilih Kategori Flowmeter --</option>
                                        @foreach ($flowmeterCategories as $flowmeterCategory)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterCategory->id) }}">{{ $flowmeterCategory->flowmeter_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="flowmeter_location">Lokasi Flowmeter</label>
                                    <input type="text" name="flowmeter_location" id="flowmeter_location" class="form-control" autocomplete="off">
                                    <input type="hidden" name="flowmeter_location_id" id="flowmeter_location_id" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status Lokasi Flowmeter</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Status Lokasi Flowmeter-- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" id="button_simpan">
                                <button class="btn btn-primary form-control">Tambahkan Lokasi</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_update">
                                <button class="btn btn-primary form-control">Ubah Data Lokasi</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_batal">
                                <a class="btn btn-outline-secondary form-control" onclick="window.location.href=''">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Lokasi Flowmeter
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <table class="table table-bordered" id="flowmeter-categories-table" width="100%">
                                <thead >
                                    <tr>
                                        <th>#</th>
                                        <th>Lokasi Flowmeter</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $p = 1;
                                    @endphp
                                    @foreach ($flowmeterLocations as $flowmeterLocation)
                                    <tr>
                                        <td>{{ $p++ }}</td>
                                        <td>{{ $flowmeterLocation->flowmeter_location }}</td>
                                        <td>
                                            @if ($flowmeterLocation->is_active == '0')
                                                Inactive
                                            @else
                                                Active
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="editFlowmeterLocation('{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocation->id) }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
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