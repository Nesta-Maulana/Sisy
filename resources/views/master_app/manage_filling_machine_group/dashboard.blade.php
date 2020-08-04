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
@section('active-master-app-master-data-manage-filling-machine-groups') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card">
                <div class="card-header bg-dark">
                    Form Filling Machine
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="filling_machine_group_head_id" value="">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="filling_machine_group_name" class="text-bold">Nama Kelompok Mesin Filling</label>
                                    <input type="text" class="form-control text-capitalize" name="filling_machine_group_name" id="filling_machine_group_name" maxlength="20" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="filling_machine_detail" class="text-bold">Mesin Filling Detail</label>
                                    <select name="filling_machine_detail[]" id="filling_machine_detail" class="select select2 form-control" data-placeholder="Pilih Mesin Filling"  multiple required>
                                        @foreach ($fillingMachines as $fillingMachine)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($fillingMachine->id) }}"> {{ $fillingMachine->filling_machine_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="is_active" class="text-bold">Status Kelompok Mesin Filling</label>
                                    <select name="is_active" id="is_active" class="form-control" required>
                                        <option value="2" selected disabled>Pilih Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                
                                <div class="form-group" id="submit-group">
                                    <button class="btn btn-primary form-control">Tambah Kelompok Mesin Filling</button>
                                </div>
                                
                                <div class="form-group hidden" id="edit-group">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <button class="btn btn-outline-primary form-control">Ubah Kelompok Mesin Filling</button>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <button class="btn btn-outline-secondary form-control">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card">
                <div class="card-header bg-dark">
                    Kelola Kelompok Mesin Filling
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kelompok Mesin</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fillingMachineGroups as $fillingMachineGroupHead)
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="changeDataFillingMachineGroup('{{ app('App\Http\Controllers\ResourceController')->encrypt($fillingMachineGroupHead->id) }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-primary" id="heading{{$fillingMachineGroupHead->id}}"  data-toggle="collapse" data-target="#collapse{{$fillingMachineGroupHead->id}}" aria-expanded="true" aria-controls="collapse{{$fillingMachineGroupHead->id}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>{{ $fillingMachineGroupHead->filling_machine_group_name }}</td>
                                        <td>
                                            @if ($fillingMachineGroupHead->is_active == '1' )
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                    </tr>
                                    <tr id="collapse{{$fillingMachineGroupHead->id}}" class="collapse" aria-labelledby="heading{{$fillingMachineGroupHead->id}}" data-parent="#accordionExample">
                                        <td colspan="3">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Filling Machine</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($fillingMachineGroupHead->fillingMachineGroupDetails as $fillingMachineGroupDetail)
                                                        <tr>
                                                            <td>{{ $fillingMachineGroupDetail->fillingMachine->filling_machine_code }}</td>
                                                            <td>
                                                                @if ($fillingMachineGroupDetail->fillingMachine->is_active =='1')
                                                                    Active
                                                                @else
                                                                    Inactive
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection