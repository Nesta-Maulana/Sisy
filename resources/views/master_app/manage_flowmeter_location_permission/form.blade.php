@extends('layouts.app')
@section('title')
    Kelola Menu
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
                    Tambah Hak Akses Lokasi Pengamatan
                </div>
                <div class="card-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="location_permission_user"> Pilih Pengguna </label>
                                    <select name="location_permission_user[]" id="location_permission_user" class="form-control select2 select" data-placeholder="Pilih Pengguna" multiple >
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt(0)}}">Semua Pengguna</option>
                                        @foreach ($users as $user)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($user->id) }}">{{ $user->employee->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" id="permission_user_id">
                                <div class="form-group">
                                    <label for="flowmeter_category_id"> Pilih Kategori Flowmeter </label>
                                    <select name="flowmeter_category_id" id="flowmeter_category_id" class="select custom-select form-control select2"  data-placeholder="Kategori Flowmeter" multiple>
                                        @foreach ($flowmeterCategories as $flowmeterCategory)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterCategory->id)}}">{{ $flowmeterCategory->flowmeter_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-outline-primary form-control" onclick="changeLocationPermissions()">Filter Akses</button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <form action="tambah-akses" method="POST">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <table class="table table-bordered" id="add-location-permission-table">
                                                <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Location</th>
                                                        <th>Access</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="add-location-permission-table-body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
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
        </div>
    </div>
    @section('extract-plugin-footer')
        <script>
            function selectAll(select_multiple_id) 
            {
                $('#'+select_multiple_id+' option').prop('selected', true);
                $('#button_select_all_'+select_multiple_id).attr('onclick','unselectAll("'+select_multiple_id+'")');
                document.getElementById('button_select_all_'+select_multiple_id).innerHTML = "Unselect All"
            }
            
            function unselectAll(select_multiple_id) 
            {
                $('#'+select_multiple_id+' option').prop('selected', false);
                $('#button_select_all_'+select_multiple_id).attr('onclick','selectAll("'+select_multiple_id+'")');
                document.getElementById('button_select_all_'+select_multiple_id).innerHTML = "Select All"
            }
        </script>
    @endsection
@endsection