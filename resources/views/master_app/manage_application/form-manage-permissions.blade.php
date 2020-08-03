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
<form action="tambah-akses" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Tambah Akses Aplikasi
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="user_id">Text</label>
                                <select name="user_id[]" id="user_id" class="form-control select2 select" onchange="getApplicationPermission()" multiple>
                                    <option value="0" selected disabled>Pilih Pengguna</option>
                                    <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt('all') }}">Semua Pengguna</option>
                                    @foreach ($users as $user)
                                        <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($user->id) }}">{{ $user->employee->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <table class="table table-bordered" id="add-application-permission-table">
                                    <thead>
                                        <tr>
                                            <th>Application</th>
                                            <th>Access</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add-application-permission-table-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 order-last hidden" id="button_submit">
                            <div class="form-group">
                                <input type="submit" value="Tambah Hak Akses" class="btn btn-primary form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection