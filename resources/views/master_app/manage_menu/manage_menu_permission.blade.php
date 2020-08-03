@extends('layouts.app')
@section('title')
    Kelola Menu
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
            <div class="card-header bg-dark">
                Hak Akses Menu
                <div class="float-right {{ Session::get('tambah') }}">
                    <button class="btn btn-outline-primary" onclick="document.location.href='kelola-hak-akses-menu/tambah-akses'">Tambah Akses Menu</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="manage-menu-permission-table" style="width: 100%"> 
                    <thead class="dark">
                        <tr>
                            <th style="width: 200px">Fullname</th>
                            <th  style="width: 200px">Aplikasi</th>
                            <th  style="width: 200px">Menu</th>
                            <th  style="width: 200px">Read</th>
                            <th  style="width: 200px">Create</th>
                            <th  style="width: 200px">Update</th>
                            <th  style="width: 200px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @foreach ($user->menuPermissions as $menuPermission)
                            @if (is_null($menuPermission->menu))
                                {{dd($menuPermission)}}
                            @endif
                                <tr>
                                    <td>{{ $user->employee->fullname }}</td>
                                    <td>{{ $menuPermission->menu->application->application_name }}</td>
                                    <td>{{ $menuPermission->menu->menu_name }}</td>
                                    <td>
                                        <select class="form-control" name="permission_view_{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}" id="permission_view_{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}" onchange="changePermission('view','{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}')">
                                            <option value="0" @if (!$menuPermission->view) selected @endif>Denied</option>
                                            <option value="1" @if ($menuPermission->view) selected @endif>Allowed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="permission_create_{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}" id="permission_create_{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}" onchange="changePermission('create','{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}')">
                                            <option value="0" @if (!$menuPermission->create) selected @endif>Denied</option>
                                            <option value="1" @if ($menuPermission->create) selected @endif>Allowed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="permission_edit_{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}" id="permission_edit_{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}" onchange="changePermission('edit','{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}')">
                                            <option value="0" @if (!$menuPermission->edit) selected @endif>Denied</option>
                                            <option value="1" @if ($menuPermission->edit) selected @endif>Allowed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="permission_delete_{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}" id="permission_delete_{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}" onchange="changePermission('delete','{{ app('App\Http\Controllers\ResourceController')->encrypt($menuPermission->id) }}')">
                                            <option value="0" @if (!$menuPermission->delete) selected @endif>Denied</option>
                                            <option value="1" @if ($menuPermission->delete) selected @endif>Allowed</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td  style="width: 200px" class="filter-search">Fullname</td>
                            <td  style="width: 200px" class="filter-search">Aplikasi</td>
                            <td  style="width: 200px">Menu</td>
                            <td  style="width: 200px">Read</td>
                            <td  style="width: 200px">Create</td>
                            <td  style="width: 200px">Update</td>
                            <td  style="width: 200px">Delete</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection