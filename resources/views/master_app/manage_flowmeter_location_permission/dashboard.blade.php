@extends('layouts.app')
@section('title')
    Hak Akses Lokasi Flowmeter
@endsection
@section('menu-open-master-data') 
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
                            <th>Flowmeter Workcenter</th>
                            <th>Flowmeter Location</th>
                            <th>Akses</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td  style="width: 200px" class="filter-search">Fullname</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection