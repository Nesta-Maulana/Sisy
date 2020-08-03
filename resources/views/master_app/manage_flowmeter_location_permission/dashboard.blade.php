@extends('layouts.app')
@section('title')
    Hak Akses Lokasi Flowmeter
@endsection
@section('menu-open-master-data') 
    active menu-open
@endsection

@section('menu-open-emon') 
    active menu-open
@endsection
@section('active-master-app-master-data-manage-flowmeter-location-permissions') 
    active 
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                Hak Akses Lokasi Pengamatan
                <div class="float-right {{ Session::get('tambah') }}">
                    <button class="btn btn-outline-primary" onclick="document.location.href='kelola-flowmeter-location-permission/tambah-akses'">Tambah Akses Lokasi</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="manage-menu-permission-table" style="width: 100%"> 
                    <thead class="dark">
                        <tr>
                            <th>Fullname</th>
                            <th>Flowmeter Kategori</th>
                            <th>Flowmeter Location</th>
                            <th>Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flowmeterLocationPermissions as $flowmeterLocationPermission)
                            <tr>
                                <td>{{ $flowmeterLocationPermission->user->employee->fullname }}</td>
                                <td>{{ $flowmeterLocationPermission->flowmeterLocation->flowmeterCategory->flowmeter_category }}</td>
                                <td>{{ $flowmeterLocationPermission->flowmeterLocation->flowmeter_location }}</td>
                                <td>
                                <select class="form-control" name="is_allow" id="is_allow_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocationPermission->id) }}" onchange="changeAccessFlowmeterLocation('{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocationPermission->id) }}')">
                                       <option value="0" @if ($flowmeterLocationPermission->is_allow == '0') selected @endif>Denied</option>
                                       <option value="1" @if ($flowmeterLocationPermission->is_allow == '1') selected @endif>Allowed</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="width: 200px" class="filter-search"></td>
                            <td style="width: 200px" class="filter-search"></td>
                            <td  style="width: 200px" class="filter-search"></td>
                            {{-- <td style="width: 200px" class="filter-search"></td> --}}
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection