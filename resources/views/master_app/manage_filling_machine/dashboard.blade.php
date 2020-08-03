@extends('layouts.app')
@section('title')
    Data Mesin Filling
@endsection
@section('menu-open-master-data') 
    active menu-open
@endsection

@section('menu-open-rollie') 
    active menu-open
@endsection
@section('active-master-app-master-data-manage-filling-machines') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <form action="kelola-mesin-filling" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="filling_machine_id" name="filling_machine_id" value="">
                <div class="card">
                    <div class="card-header bg-dark">
                        Kelola Mesin Filling
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="filling_machine_code">Kode Mesin Filling</label>
                                    <input id="filling_machine_code" class="form-control" type="text" name="filling_machine_code">
                                </div>
                                
                                <div class="form-group">
                                    <label for="filling_machine_name">Nama Mesin Filling</label>
                                    <input id="filling_machine_name" class="form-control" type="text" name="filling_machine_name">
                                </div>
                                
                                <div class="form-group">
                                    <label for="is_active">Status Mesin Filling</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="id" selected disabled>-- Pilih Status Mesin Filling -- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" id="button_simpan">
                                <button class="btn btn-primary form-control">Tambahkan Mesin Filling</button>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_update">
                                <button class="btn btn-primary form-control">Ubah Data Mesin Filling</button>
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
                    List Mesin Filling
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="filling-machine-table" width="100%">
                        <thead >
                            <tr>
                                <th>#</th>
                                <th>Kode Mesin</th>
                                <th>Nama Mesin</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($fillingMachines as $fillingMachine)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $fillingMachine->filling_machine_code }}</td>
                                    <td>{{ $fillingMachine->filling_machine_name }}</td>
                                    <td>
                                        @if ($fillingMachine->is_active)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-primary" onclick="editFillingMachineData('{{ app('App\Http\Controllers\ResourceController')->encrypt($fillingMachine->id) }}')"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                @php
                                    $i++
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection