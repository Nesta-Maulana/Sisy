@extends('layouts.app')
@section('title')
    Form Cpp Produk
@endsection
@section('menu-open-data-proses')
    menu-open
@endsection

@section('active-rollie-process-data-cpps') 
    active 
@endsection
@section('content')
<div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    CPP Produk {{ $cppHead->woNumbers[0]->product->product_name }}
                </div>
                <div class="card-body">
                    {{-- Start detail product --}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="produk">Nama Produk : </label>
                                    @if (count($activeCppProduct) > 1)
                                        <select name="nama_produk" id="nama_produk" onchange="changeProduct(this)" class="form-control">
                                            @foreach ($activeCppProduct as $cpp_active)
                                                <option value="{{  app('App\Http\Controllers\ResourceController')->encrypt($cpp_active->id) }}" @if ($cpp_active->woNumbers[0]->product->id === $cppHead->woNumbers[0]->product->id)
                                                    selected
                                                @endif>{{ $cpp_active->woNumbers[0]->product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="text" value="{{ $cppHead->woNumbers[0]->product->product_name }}" name="nama_produk" id="nama_produk" class="form-control" readonly>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="noWo">No WO : </label>
                                    @if (count($cppHead->woNumbers) > 1)
                                        <select name="no_wo" id="no_wo" class="form-control" onchange="refreshTableCpp()">
                                            @foreach ($cppHead->woNumbers as $wo_number)
                                                <option value="{{  app('App\Http\Controllers\ResourceController')->encrypt($wo_number->id) }}">{{ $wo_number->wo_number }}</option>
                                            @endforeach
                
                                        </select>
                                    @else
                                        <input type="text" value="{{ $cppHead->woNumbers[0]->wo_number }}" name="nomor_wo" id="nomor_wo" class="form-control" readonly>
                                        <input type="hidden" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->woNumbers[0]->id) }}" name="no_wo" id="no_wo" class="form-control" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                
                                <div class="form-group">
                                    <label for="tglMixing">Tanggal Packing : </label>
                                    <input type="text" value="{{ $cppHead->packing_date }}" name="tglMixing" id="tglMixing" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="noWo">Expired Date : </label>
                                    <input type="text" value="@foreach ($cppHead->woNumbers as $wo_number) {{ $wo_number->expired_date.',' }} @endforeach" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    {{-- end detail product --}}

                    {{-- Start Button Tambah Wo --}}
                    @if (Session::get('tambah') == 'show' && Session::get('ubah') =='show')
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group ">
                                    <button class="btn btn-outline-primary form-control" data-toggle="modal" data-target="#tambahBatchPackingModal">Tambah Wo</button>
                                </div>
                            </div>
                            @foreach ($cppHead->woNumbers[0]->product->fillingMachineGroupHead->fillingMachineGroupDetails as $mesinfilling)
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group" >
                                        <button class="btn btn-primary form-control" onclick="addPalet('{{ app('App\Http\Controllers\ResourceController')->encrypt($mesinfilling->fillingMachine->id) }}',$('#no_wo').val(),'{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id) }}')">
                                            Tambah Palet {{ $mesinfilling->fillingMachine->filling_machine_name }}
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <button class="btn btn-success form-control" onclick="closeCppProduct()">
                                        Close CPP
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <button class="btn btn-outline-primary form-control" onclick="refreshTableCpp()">Refresh Table</button>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- End Button tambah wo --}}

                    {{-- start tabel cpp --}}
                    @foreach ($cppHead->woNumbers[0]->product->fillingMachineGroupHead->fillingMachineGroupDetails as $fillingMachineDetail)
                        @php
                            $index_code     = strlen($fillingMachineDetail->fillingMachine->filling_machine_code);
                            $machine_code   = $fillingMachineDetail->fillingMachine->filling_machine_code[$index_code-1];
                        @endphp
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group col-lg-12 text-center">
                                <hr>
                                    <h5>{{ $fillingMachineDetail->fillingMachine->filling_machine_code }}</h5>
                                <hr>
                                </div>
                                <table class="table table-bordered" id="table-cpp-{{ strtolower($fillingMachineDetail->fillingMachine->filling_machine_name) }}">
                                    <thead class="bg-dark text-center text-white" >
                                        <tr>
                                            <th width="250px">Palet</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Box</th>
                                            <th class="{{Session::get('hapus')}}">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail-cpp-{{strtolower($fillingMachineDetail->fillingMachine->filling_machine_name)}}">
                                        @foreach ($cppHead->cppDetails as $cppDetail)
                                            @if ($cppDetail->wo_number_id === $cppHead->woNumbers[0]->id)
                                                @if (strpos($cppDetail->lot_number,$machine_code))
                                                    @foreach ($cppDetail->palets as $palet)
                                                         <tr @if (count($palet->atEvents)>0) class="bg-warning" @endif>
                                                             <td>
                                                                <div class="form-inline">
                                                                    <label class="col-lg-6 col-md-6 col-sm-6" style="font-size: 15px;"> {{ $cppDetail->lot_number }} - </label>
                                                                    <input type="text" value="{{ $palet->palet }}" class="col-lg-6 col-sm-6 col-md-6 form-control"  id="nomor_palet_{{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }}" 
                                                                    @if (Session::get('ubah') == 'show')
                                                                        onfocusout="changePalet('{{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }}')"
                                                                    @else
                                                                    readonly 
                                                                    @endif>
                                                                </div>
                                                             </td>
                                                             <td>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                        <input type="text" class="datetimepickernya form-control" id="start_palet_{{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }}" value="{{ $palet->start }}" @if (Session::get('ubah') == 'show')
                                                                            onfocusout="changeStart('{{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }}')" 
                                                                        @else
                                                                            readonly 
                                                                        @endif>
                                                                    </div>
                                                                </div>
                                                             </td>
                                                             <td>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" class="datetimepickernya form-control" value="{{ $palet->end }}" id="end_palet_{{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }}" @if (Session::get('ubah') == 'show')
                                                                            onfocusout="changeEnd('{{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }}')"
                                                                            @else
                                                                            readonly 
                                                                            @endif >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             </td>
                                                             <td>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text"  id="box_palet_{{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }}" value="{{ $palet->jumlah_box }}" class="form-control" @if (Session::get('ubah') =='show')
                                                                            onfocusout="changeBox('{{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }}')"
                                                                            @else
                                                                                readonly 
                                                                            @endif>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             </td>
                                                             <td>
                                                                 <div class="row">
                                                                     <div class="col-lg-12 col-md-12 col sm-12">
                                                                         <div class="form-group">
                                                                             <a onclick="deletePalet('{{ $cppDetail->lot_number }}-{{ $palet->palet }}','{{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }}')" class="btn btn-danger text-white form-control">
                                                                                <i class="fas fa-trash"></i>
                                                                            </a>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </td>
                                                         </tr>
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group ">
                                    <button class="btn btn-outline-primary form-control" data-toggle="modal" data-target="#tambahBatchPackingModal">Tambah Wo Proses</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group" >
                                    <button class="btn btn-primary form-control" onclick="addPalet('{{ app('App\Http\Controllers\ResourceController')->encrypt($fillingMachineDetail->fillingMachine->id) }}',$('#no_wo').val(),'{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id) }}')">
                                        Tambah Palet {{ $fillingMachineDetail->fillingMachine->filling_machine_name }}
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                    {{-- end tabel cpp --}}
                </div>
            </div>
            {{-- <button onclick="refreshTableCpp()">CLICK ME !!</button> --}}
        </div>
    </div>
    <input type="hidden" name="cpp_head_id" id="cpp_head_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id) }}">
    @include('rollie.cpp_produk.pop-up.tambah-batch')
@endsection
@section('extract-plugin-footer')
    <script src="{{ asset('datetime-picker/js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('datetime-picker/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('datetime-picker/css/bootstrap-datetimepicker.min.css') }}">
    <script type="text/javascript" src="{{ asset('datetime-picker/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $('.timepickernya').datetimepicker({
            format: 'HH:mm:ss',
            locale:'en',
            date: new Date()
        }); 
        $('.datepickernya').datetimepicker({
            format: 'YYYY-MM-DD',
            locale:'en',
            date: new Date()
        }); 

        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            locale:'en'
        }); 
        $('.datetimepickernya').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
        }); 
    </script> 
    <script type="text/javascript" src="{{ asset('datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
@endsection