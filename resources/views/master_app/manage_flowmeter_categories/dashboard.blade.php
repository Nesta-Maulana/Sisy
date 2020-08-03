@extends('layouts.app')
@section('title')
    Data Kategori Flowmeter
@endsection
@section('menu-open-master-data') 
    active menu-open
@endsection

@section('menu-open-emon') 
    active menu-open
@endsection
@section('active-master-app-master-data-manage-flowmeter-categories') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <form action="kelola-kategori-flowmeter" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="flowmeter_category_id" name="flowmeter_category_id" value="">
                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Kategori Flowmeter
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="flowmeter_category">Kategori Flowmeter</label>
                                    <input id="flowmeter_category" class="form-control" type="text" name="flowmeter_category" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="is_active">Status Kategori Flowmeter</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="id" selected disabled>-- Pilih Status Mesin Filling -- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" id="button_simpan">
                                <button class="btn btn-primary form-control">Tambahkan Kategori</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_update">
                                <button class="btn btn-primary form-control">Ubah Data Kategori</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_batal">
                                <button class="btn btn-outline-secondary form-control">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-lg-7 col-md-7 col-sm-7">
            <div class="card">
                <div class="card-header bg-dark">
                    List Kategori Flowmeter
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="flowmeter-categories-table" width="100%">
                        <thead >
                            <tr>
                                <th>#</th>
                                <th>Kategori Flowmeter</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($flowmeterCategories as $flowmeterCategory)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $flowmeterCategory->flowmeter_category }}</td>
                                    <td>
                                        @if ($flowmeterCategory->is_active)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-primary" onclick="editFlowmeterCategory('{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterCategory->id) }}')">
                                            <i class="fa fa-pencil"></i></button>
                                    </td>
                                </tr>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection