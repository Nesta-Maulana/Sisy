@extends('layouts.app')
@section('title')
    Kelola Menu | Tambah Akses Menu
@endsection
@section('menu-open-general-setting') 
    active menu-open
@endsection
@section('active-master-app-menu-permissions') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Tambah Hak Akses Menu
                </div>
                <div class="card-body">
                    <form action="tambah-akses" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="menu_permission_user"> Pilih Pengguna </label>
                                    <select name="menu_permission_user[]" id="menu_permission_user" class="form-control select2 select" onchange="changeApplicationMenuPermission()" multiple>
                                        <option value="0" selected disabled>Pilih Pengguna</option>
                                        <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt('all') }}">Semua Pengguna</option>
                                        @foreach ($users as $user)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($user->id) }}">{{ $user->employee->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" id="permission_user_id">
                                <div class="form-group">
                                    <label for="menu_permission_application"> Pilih Aplikasi </label>
                                    <select name="menu_permission_application" id="menu_permission_application" class="select custom-select form-control select2" onchange="changeApplicationMenuPermission()">
                                        <option value="0" selected disabled>Pilih Aplikasi</option>
                                        @foreach ($applications as $application)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($application->id) }}">{{ $application->application_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 div col-md-8 col-sm-8">
                                <table class="table table-bordered" id="add-menu-permission-table">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>View</th>
                                            <th>Create</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add-menu-permission-table-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col-lg-8 order-last hidden" id="button_submit">
                                <div class="form-group">
                                    <input type="submit" value="Tambah Hak Akses" class="btn btn-primary form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection