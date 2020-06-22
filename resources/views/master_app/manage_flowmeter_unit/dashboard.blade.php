@extends('layouts.app')
@section('title')
    Data Satuan Flowmeter
@endsection
@section('menu-open-master-data') 
    active menu-open
@endsection
@section('active-master-app-master-data-manage-flowmeter-units') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <form action="kelola-flowmeter-unit" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Satuan Flowmeter
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="flowmeter_unit">Satuan Flowmeter</label>
                                    <input type="text" name="flowmeter_unit" id="flowmeter_unit" class="form-control">
                                    <input type="hidden" name="flowmeter_unit_id" id="flowmeter_unit_id" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status Satuan Flowmeter</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Status Satuan Flowmeter-- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" id="button_simpan">
                                <button class="btn btn-primary form-control">Tambahkan Satuan</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_update">
                                <button class="btn btn-primary form-control">Ubah Data Satuan</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_batal">
                                <a class="btn btn-outline-secondary form-control" onclick="window.location.href=''">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Workcenter Flowmeter
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <table class="table table-bordered" id="flowmeter-categories-table" width="100%">
                                <thead >
                                    <tr>
                                        <th>#</th>
                                        <th>Satuan Flowmeter</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $p = 1;
                                    @endphp
                                    @foreach ($flowmeterUnits as $flowmeterUnit)
                                    <tr>
                                        <td>{{ $p++ }}</td>
                                        <td>{{ $flowmeterUnit->flowmeter_unit }}</td>
                                        <td>
                                            @if ($flowmeterUnit->is_active == '0')
                                                Inactive
                                            @else
                                                Active
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="editFlowmeterUnit('{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterUnit->id) }}')">
                                                Ubah Data
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