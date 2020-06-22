@extends('layouts.app')
@section('title')
    Kelola Aplikasi
@endsection
@section('menu-open-pengaturan-aplikasi') 
    active menu-open
@endsection
@section('active-master-app-manage-applications') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Aplikasi
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h5>Kelola Aplikasi</h5>
                                </div>
                                <div class="card-body">
                                    <form action="kelola-aplikasi" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <input id="application_id" class="form-control" type="hidden" name="application_id">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label for="application_name">Nama Aplikasi</label>
                                                    <input id="application_name" class="form-control" type="text"  name="application_name" required="true" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label for="application_description">Deskripsi Aplikasi</label>
                                                    <textarea id="application_description" class="form-control" type="text"  name="application_description" required="true" autocomplete="off"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="application_link">Link Aplikasi</label>
                                                    <input id="application_link" class="form-control" type="text"  name="application_link" required="true" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label for="application_status">Status Aplikasi</label>
                                                    <select required="true" name="application_status" id="application_status" class="form-control">
                                                        <option value="" selected disabled>-- Pilih Status --</option>
                                                        <option value="0">Deactive</option>
                                                        <option value="1">Active</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" name="simpan" class="btn btn-primary" id="simpan" value="Simpan">   
                                                    <input type="submit" name="update" class="btn btn-primary hidden" id="update" value="Update">   
                                                    <a  name="batal" class="btn btn-danger hidden" id="batal" href="{{ route('master_app.manage_applications') }}">Batal</a>   
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h5>List Aplikasi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <table class="table table-bordered" id="manage-application-table">
                                                <thead>
                                                    <tr>
                                                        <th style="width:20px;">#</th>
                                                        <th style="width:200px;">Nama Aplikasi</th>
                                                        <th style="width:300px;">Deskripsi Aplikasi</th>
                                                        <th style="width:200px;">Link Aplikasi</th>
                                                        <th style="width:200px;">Status Aplikasi</th>
                                                        <th style="width:200px;">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $a = 1;
                                                    @endphp
                                                    @foreach ($applications as $application)
                                                        <tr>
                                                            <td>{{ $a }}</td>
                                                            <td> {{ $application->application_name }} </td>
                                                            <td> {{ $application->application_description }} </td>
                                                            <td> {{ $application->application_link }} </td>
                                                            <td>
                                                                @if ($application->application_status == '0')
                                                                    Deactive
                                                                @else
                                                                    Active
                                                                @endif 
                                                            </td>
                                                            <td>
                                                                <button type="submit" class="btn btn-outline-primary form-control" onclick="editApplication('{{ app('App\Http\Controllers\ResourceController')->encrypt($application->id) }}')"><i class="fa fa-pencil"></i>&nbsp;Edit</button>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $a++
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection