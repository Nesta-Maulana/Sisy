@extends('layouts.app')
@section('title')
    Jadwal Produksi
@endsection
@section('active-rollie-production-schedules') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                           Jadwal Produksi Aktif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 {{Session::get('tambah')}}">
                            <div class="form-group float-right">
                                <a class="btn btn-primary" href='jadwal-produksi/tambah-jadwal'><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Jadwal Produksi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="example_wrapper">
                    <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <table class="table table-bordered" id="production-schedules-table" >
                            <thead>
                                <tr class="text-center">
                                    <th style="width:40px" class="@if (Session::get('hapus') == 'show' || Session::get('ubah') == 'show')
                                        show
                                    @else
                                        hidden
                                    @endif">#&nbsp;&nbsp;&nbsp;</th>
                                    <th style="width:120px">Nomor Wo</th>
                                    <th style="width:200px">Nama Produk</th>
                                    <th style="width:120px">Kode Produk</th>
                                    <th style="width:115px">Plan Date</th>
                                    <th style="width:130px">Realisation Date</th>
                                    <th style="width:115px">Status</th>
                                    <th style="width:115px">Plan Batch Size</th>
                                    <th style="width:130px">Actual Batch Size</th>
                                    <th style="width:115px">Keterangan 1</th>
                                    <th style="width:115px">Keterangan 2</th>
                                    <th style="width:115px">Keterangan 3</th>
                                    <th style="width:115px">Lot FG</th>
                                    <th style="width:300px">Revisi Formula</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                @switch($schedule->wo_status)
                                    @case('0')
                                        @php
                                            $status     = 'Pending | WIP Mixing';
                                            $style      = 'background-color:white';
                                        @endphp
                                    @break
                                    @case('1')
                                        @php
                                            $status     = 'On Progress Mixing';
                                            $style      = 'background-color:#a6b1ff;';
                                        @endphp
                                    @break
                                    @case('2')
                                        @php
                                            $status     = 'WIP Fillpack';
                                            $style      = 'background-color:#a6e6ff;';
                                        @endphp
                                    @break
                                    @case('3')
                                        @if (is_null($schedule->cppHead))
                                            @php
                                                $status     = 'On Progress Filling';
                                                $style      = 'background-color:#a6ffea;';
                                            @endphp
                                        @else
                                            @php
                                                $status     = 'On Progress Fillpack';
                                                $style      = 'background-color:#00ffb8;';
                                            @endphp
                                        @endif
                                    @break
                                    @case('4')
                                        @php
                                            $status     = 'Waiting For Close';
                                            $style      = 'background-color:#a6ffb1;';
                                        @endphp
                                    @break
                                    @case('5')
                                        @php
                                            $status     = 'Closed Wo';
                                            $style      = 'background-color:#44d44f;';
                                        @endphp
                                    @break
                                    @case('6')
                                        @php
                                            $status     = 'Canceled';
                                            $style      = 'background-color:#ffa6bb;';
                                        @endphp
                                    @break
                                        
                                @endswitch
                                <tr style="{{ $style }}" >
                                    <td>
                                        @if ($status == 'Canceled')
                                            
                                        @else
                                            @if (Session::get('ubah') == 'show')
                                                <a class="text-primary" onclick="setUpdateDataWo('realisation','{{ app('App\Http\Controllers\ResourceController')->encrypt($schedule->id) }}')" data-toggle="modal" data-target="#prosesWoModal"> <i class="fa fa-edit"></i></a>&nbsp;|&nbsp;<a class="text-danger" onclick="deleteWo('{{ $schedule->wo_number }}','{{ $schedule->product->product_name}}','{{ app('App\Http\Controllers\ResourceController')->encrypt($schedule->id) }}')"> <i class="fa fa-trash"></i></a>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $schedule->wo_number }}</td>
                                    <td>{{ $schedule->product->product_name }}</td>
                                    <td>{{ $schedule->product->oracle_code }}</td>
                                    <td>{{ $schedule->production_plan_date }}</td>
                                    <td>{{ $schedule->production_realisation_date }}</td>
                                    <td> {{ $status}} </td>
                                    <td>{{ $schedule->plan_batch_size }}</td>
                                    <td>{{ $schedule->actual_batch_size }}</td>
                                    <td>{{ $schedule->explanation_1 }}</td>
                                    <td>{{ $schedule->explanation_2 }}</td>
                                    <td>{{ $schedule->explanation_3 }}</td>
                                    <td>-</td>
                                    <td>{{ $schedule->formula_revision }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('rollie.production_schedules.pop-up.update-data-wo')
@endsection