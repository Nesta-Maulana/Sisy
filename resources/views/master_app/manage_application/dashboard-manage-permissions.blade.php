@extends('layouts.app')
@section('title')
    Kelola Hak Akses Aplikasi
@endsection
@section('menu-open-general-setting') 
    active menu-open
@endsection
@section('active-master-app-application-permissions') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5>
                        Hak Akses Aplikasi 
                        <div class="float-right">
                            <button class="btn btn-outline-primary" onclick="document.location.href='kelola-hak-akses-aplikasi/tambah-akses'">Tambah Akses Aplikasi</button>
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="manage-application-permission-table"> 
                        <thead class="dark">
                            <tr>
                                <th>Fullname</th>
                                <th >Aplikasi</th>
                                <th  >Access?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @foreach ($user->applicationPermissions as $applicationPermission)
                                    <tr>
                                        <td>{{ $user->employee->fullname }}</td>
                                        <td>{{ $applicationPermission->application->application_name }}</td>
                                        <td>
                                            <select class="form-control"  name="application_permission_{{ app('App\Http\Controllers\ResourceController')->encrypt($applicationPermission->id) }}" id="application_permission_{{ app('App\Http\Controllers\ResourceController')->encrypt($applicationPermission->id) }}" onchange="changeApplicationPermission('{{ app('App\Http\Controllers\ResourceController')->encrypt($applicationPermission->id) }}')">
                                                <option value="0" @if ($applicationPermission->is_active == '0') selected @endif>Denied</option>
                                                <option value="1" @if ($applicationPermission->is_active == '1') selected @endif>Allowed</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td  class="filter-search">Fullname</td>
                                <td  class="filter-search">Aplikasi</td>
                                <td >Access?</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection