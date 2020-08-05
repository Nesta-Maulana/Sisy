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
                                                        <th style="width: 30px">
                                                            <i class="fas fa-mail-bulk"></i>
                                                        </th>
                                                        <th style="width: 100px">
                                                            <i class="fas fa-list-alt"></i>
                                                        </th>
                                                        <th style="width: 30px">
                                                            <i class="fas fa-print"></i>
                                                        </th>
                                                        <th style="width: 120px">Nomor PSR</th>
                                                        <th style="width: 250px">Nama Produk</th>
                                                        <th style="width: 120px">Nomor Wo</th>
                                                        <th style="width: 120px">Jumlah Sampel</th>
                                                        <th style="width: 120px">Note</th>
                                                        <th style="width: 150px">Tanggal Produksi</th>
                                                        <th style="width: 120px">Kode Batch 1</th>
                                                        <th style="width: 120px">Kode Batch 2</th>
                                                        <th style="width: 120px">Kode Produk</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($psrs as $psr)
                                                        <tr>
                                                            @if ($psr->psr_status  == '0') {{-- ini jika psr belum dikirim email yaa  --}}
                                                                <td>
                                                                    <div class="button-awal">
                                                                        <input type="checkbox" style="height: 22px;width: 25px;" name="sendmail[]" class="sendmail" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}" onclick="handleChangeMail()">                                                                    
                                                                    </div>
                                                                </td>
                                                            @else {{-- ini jika status psr sudah dikirim email --}}
                                                                <td>
                                                                    <i class="fas fa-check"></i>
                                                                </td>
                                                            @endif
                                                            @if ($psr->psr_status == '0')
                                                                <td>
                                                                    <div class="button-awal">
                                                                        <button class="btn-primary btn" onclick="editPsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>
                                                                        <button class="btn-secondary btn" onclick="getPsrDetail('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}','{{ $psr->woNumber->product->product_name }}','{{ $psr->woNumber->wo_number }}','{{ $psr->woNumber->production_realisation_date }}','{{ $psr->psr_qty }}','{{ $psr->psr_number }}')" data-toggle="modal" data-target="#lihatDetailPsr">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="button-ubah hidden">
                                                                        <button class="btn btn-primary" onclick="updatePsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                            <i class="fas fa-save text-white" ></i>
                                                                        </button>
                                                                        <button class="btn btn-secondary" onclick="cancelEditPsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                            <i class="fas fa-window-close"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <div class="button-awal">
                                                                        <button class="btn-primary btn" onclick="editPsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                            <i class="fas fa-mail-bulk"></i><i class="fas fa-pencil-alt"></i> 
                                                                        </button>
                                                                        <button class="btn-secondary btn" onclick="getPsrDetail('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}','{{ $psr->woNumber->product->product_name }}','{{ $psr->woNumber->wo_number }}','{{ $psr->woNumber->production_realisation_date }}','{{ $psr->psr_qty }}','{{ $psr->psr_number }}')" data-toggle="modal" data-target="#lihatDetailPsr">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="button-ubah hidden">
                                                                        <button class="btn btn-primary" onclick="updatePsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                            <i class="fas fa-save text-white" ></i>
                                                                        </button>
                                                                        <button class="btn btn-secondary" onclick="cancelEditPsr('{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}')">
                                                                            <i class="fas fa-window-close"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                            @if ($psr->psr_status == '1')
                                                                <td>
                                                                    <div class="button-awal">
                                                                        <input type="checkbox" style="height: 22px;width: 25px;" name="printpsr[]" class="sendmail" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}" onchange="handlePrintPsr()">
                                                                    </div>
                                                                </td>
                                                            @else
                                                                @if ($psr->psr_status == '0')
                                                                    <td>
                                                                        <i class="fas fa-window-close"></i>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <i class="fas fa-check"></i>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                            <td>{{ $psr->psr_number}}</td>
                                                            <td>{{ $psr->woNumber->product->product_name }}</td>
                                                            <td>{{ $psr->woNumber->wo_number }}</td>
                                                            <td id="qty_{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}">{{ $psr->psr_qty }}</td>
                                                            <td id="note_{{ app('App\Http\Controllers\ResourceController')->encrypt($psr->id) }}">{{ $psr->note }}</td>
                                                            <td>{{ $psr->woNumber->production_realisation_date }}</td>
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
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-8 col-md-8 col-sm-8"></div>
                                        <div class="col-lg col-md col-sm hidden" id="print_psr">
                                            <div class="form-group">
                                                <button class="btn btn-primary form-control" onclick="printPsr()">
                                                    <i class="fas fa-print"></i> Print PSR
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg col-md col-sm hidden" id="mail_psr">
                                            <div class="form-group">
                                                <button class="btn btn-primary form-control" onclick="sendMailPsr()">
                                                    <i class="fas fa-mail-bulk"></i> Send PSR
                                                </button>
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
    </div>
    @include('rollie.psr.pop-up.lihat-detail-psr')

@endsection