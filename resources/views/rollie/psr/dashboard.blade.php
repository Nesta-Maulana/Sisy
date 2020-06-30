@extends('layouts.app')
@section('title')
    PSR Produk
@endsection
@section('menu-open-data-proses')
    menu-open
@endsection

@section('active-rollie-process-data-psr') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Permintaan Sampel RTD
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    Draft PSR 
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <table class="table table-bordered" style="overflow-x: scroll;" id="permintaan-sampel-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th style="width: 150px">#</th>
                                                        <th style="width: 150px">Tanggal Produksi</th>
                                                        <th style="width: 120px">Nomor Wo</th>
                                                        <th style="width: 120px">Kode Batch 1</th>
                                                        <th style="width: 120px">Kode Batch 2</th>
                                                        <th style="width: 120px">Kode Produk</th>
                                                        <th style="width: 250px">Nama Produk</th>
                                                        <th style="width: 120px">Jumlah Sampel</th>
                                                        <th style="width: 120px">Note</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($psrs as $psr)
                                                        <tr>
                                                            <td>
                                                                <div class="button-awal">
                                                                    <input type="checkbox" style="height: 22px;width: 25px;" name="sendmail[]" class="sendmail" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}">
                                                                    <button class="btn-primary btn" onclick="editPsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <button class="btn-secondary btn" onclick="getPsrDetail('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}','{{ $psr->woNumber->product->product_name }}','{{ $psr->woNumber->wo_number }}','{{ $psr->woNumber->production_realisation_date }}','{{ $psr->psr_qty }}','{{ $psr->psr_number }}')" data-toggle="modal" data-target="#lihatDetailPsr">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="button-ubah hidden">
                                                                    <button class="btn btn-primary">
                                                                        <i class="fas fa-save text-white" onclick="updatePsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')"></i>
                                                                    </button>
                                                                    <button class="btn btn-secondary" onclick="cancelEditPsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                        <i class="fas fa-window-close"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            <td>{{ $psr->woNumber->production_realisation_date }}</td>
                                                            <td>{{ $psr->woNumber->wo_number }}</td>
                                                            @if (count($psr->woNumber->cppDetails) == 1)
                                                                @if ($psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'A3CF B' || $psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'TPA A')
                                                                    <td>{{ $psr->woNumber->cppDetails[0]->lot_number }}</td>
                                                                    <td>-</td>
                                                                @else
                                                                    <td>-</td>
                                                                    <td>{{ $psr->woNumber->cppDetails[0]->lot_number }}</td>
                                                                    
                                                                @endif
                                                            @else
                                                                @foreach ($psr->woNumber->cppDetails as $cppDetails)
                                                                    <td>{{ $cppDetails->lot_number }}</td>
                                                                @endforeach
                                                            @endif
                                                            <td>{{ $psr->woNumber->product->oracle_code }}</td>
                                                            <td>{{ $psr->woNumber->product->product_name }}</td>
                                                            <td id="qty_{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}">{{ $psr->psr_qty }}</td>
                                                            <td id="note_{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}">{{ $psr->note }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if (count($psrs) > 0)
                                    <div class="row mt-2">
                                        <div class="col-lg-10 col-md-10 col-sm-10"></div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <button class="btn btn-primary form-control" onclick="sendMailPsr()">
                                                    <i class="fas fa-mail-bulk"></i> Send PSR
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    List PSR 
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <table class="table table-bordered" style="overflow-x: scroll;" id="permintaan-sampel-rtd-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th style="width: 150px">#</th>
                                                        <th style="width: 150px">Tanggal Produksi</th>
                                                        <th style="width: 120px">Nomor Wo</th>
                                                        <th style="width: 120px">Kode Batch 1</th>
                                                        <th style="width: 120px">Kode Batch 2</th>
                                                        <th style="width: 120px">Kode Produk</th>
                                                        <th style="width: 250px">Nama Produk</th>
                                                        <th style="width: 120px">Jumlah Sampel</th>
                                                        <th style="width: 120px">Note</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($psrs as $psr)
                                                        <tr>
                                                            <td>
                                                                <div class="button-awal">
                                                                    <input type="checkbox" style="height: 22px;width: 25px;" name="sendmail[]" class="sendmail" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}">
                                                                    <button class="btn-primary btn" onclick="editPsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <button class="btn-secondary btn" onclick="getPsrDetail('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}','{{ $psr->woNumber->product->product_name }}','{{ $psr->woNumber->wo_number }}','{{ $psr->woNumber->production_realisation_date }}','{{ $psr->psr_qty }}','{{ $psr->psr_number }}')" data-toggle="modal" data-target="#lihatDetailPsr">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="button-ubah hidden">
                                                                    <button class="btn btn-primary">
                                                                        <i class="fas fa-save text-white" onclick="updatePsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')"></i>
                                                                    </button>
                                                                    <button class="btn btn-secondary" onclick="cancelEditPsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                        <i class="fas fa-window-close"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            <td>{{ $psr->woNumber->production_realisation_date }}</td>
                                                            <td>{{ $psr->woNumber->wo_number }}</td>
                                                            @if (count($psr->woNumber->cppDetails) == 1)
                                                                @if ($psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'A3CF B' || $psr->woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'TPA A')
                                                                    <td>{{ $psr->woNumber->cppDetails[0]->lot_number }}</td>
                                                                    <td>-</td>
                                                                @else
                                                                    <td>-</td>
                                                                    <td>{{ $psr->woNumber->cppDetails[0]->lot_number }}</td>
                                                                    
                                                                @endif
                                                            @else
                                                                @foreach ($psr->woNumber->cppDetails as $cppDetails)
                                                                    <td>{{ $cppDetails->lot_number }}</td>
                                                                @endforeach
                                                            @endif
                                                            <td>{{ $psr->woNumber->product->oracle_code }}</td>
                                                            <td>{{ $psr->woNumber->product->product_name }}</td>
                                                            <td id="qty_{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}">{{ $psr->psr_qty }}</td>
                                                            <td id="note_{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}">{{ $psr->note }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if (count($psrs) > 0)
                                    <div class="row mt-2">
                                        <div class="col-lg-10 col-md-10 col-sm-10"></div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <button class="btn btn-primary form-control" onclick="sendMailPsr()">
                                                    <i class="fas fa-mail-bulk"></i> Send PSR
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('rollie.psr.pop-up.lihat-detail-psr')

@endsection