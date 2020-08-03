@extends('layouts.app')
@section('title')
    Kelola Menu
@endsection
@section('menu-open-general-setting') 
    active menu-open
@endsection
@section('active-master-app-manage-menu') 
    active 
@endsection
@section('content')
<div class="row {{ Session::get('tambah') }}">
    <div class="col-lg-12 div col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-dark">
                Kelola Menu
            </div>
            <div class="card-body">
                <form action="kelola-menu" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group ">
                                <label for="aplikasi_id">Application :</label>
                                <select name="aplikasi_id" id="aplikasi_id" class="form-control" onchange="changeApplication()" required>
                                    <option value="" selected disabled>-- Choose Application --</option>
                                    @foreach ($applications as $application)
                                    <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($application->id) }}">{{ $application->application_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="parent_menu">Parent Menu :</label>
                                <select name="parent_menu" id="parent_menu" class="form-control" onchange="changeParent()">
                                    <option value="" disabled selected>-- Choose Parent --</option>
                                    <option value="0">JADIKAN PARENT</option>
                               
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="route_name"> Route Menu :</label>
                                <input type="text" name="route_name" id="route_name" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label for="urutan"> Position :</label>
                                <input type="text" name="urutan" value="0" readonly id="urutan" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="menu">Menu Name :</label>
                                <input type="text" name="menu" id="menu" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group ">
                                <label for="icon">Icon :</label>
                                {{-- @foreach ($icons as $icon)
                                    {{$icon->icons}}
                                @endforeach --}}
                                <select name="icon" id="icons" class="form-control select2" >
                                    <option value="" disabled selected>-- Choose Icon --</option>
                                    @foreach ($icons as $icon)
                                        <option value="{{$icon->icons}}" data-icon="{{$icon->icons}}">{{$icon->icons}}</option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <div class="form-group ">
                                <label for="status"> Status :</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected disabled>-- Choose Status --</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group row" style="margin-top: 1.5rem!important;">
                                {{-- <label style="visibility: hidden;">.</label> --}}
                                <a href="" class="btn btn-outline-secondary mt-4 col-lg hidden" id="batal" onclick=""  style="margin-right: 10px;">Cancel</a>
                                <input type="submit" value="Update" id="update" class="btn mt-4 btn-outline-primary col-lg hidden"  style="margin-right: 10px;">
                                <input type="submit" value="Save" id="simpan" class="btn mt-4 btn-primary col-lg" style="margin-right: 10px;" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-dark">
                Data Menu
            </div>
            <div class="card-body">
                {{ Session::get('edit') }}
                <table class="table table-bordered " id="manage-menu-table">
                    <thead>
                        <tr>
                            @if (Session::get('ubah') == 'show')
                                <th> Action </th>
                            @endif
                            <th style="width: 250px;" class="search-application">Application</th>
                            <th style="width: 250px;">Parent Menu</th>
                            <th style="width: 250px;">Menu Name</th>
                            <th style="width: 250px;">Route Menu</th>
                            <th style="width: 100px;">Position</th>
                            <th style="width: 100px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus_data->sortBy('application_id') as $menu)
                        <tr>
                            @if (Session::get('ubah') == 'show')
                            <td>
                                <button onclick="editMenu('{{ app('App\Http\Controllers\ResourceController')->encrypt($menu->id) }}')" class="btn btn-outline-info form-control">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </td>
                            @endif
                            <td>
                                {{ $menu->application->application_name }}
                            </td>
                            <td>
                            @if ($menu->parent_id == 0)
                                -
                            @else
                                {{ $menu->parentMenu->menu_name }}
                            @endif
                            </td>
                            <td>{{ $menu->menu_name }}</td>
                            <td>{{ $menu->menu_route }}</td>
                            <td>{{ $menu->menu_position }}</td>
                            <td>
                                @if ($menu->is_active)
                                    Active
                                @else
                                    Inactive
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
@endsection
