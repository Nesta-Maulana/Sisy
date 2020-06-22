@extends('layouts.app')
@section('title')
    RKOL | RKJ Produk   
@endsection
@section('menu-open-rkol')
    menu-open
@endsection
@section('active-rollie-rkol-'.$route) 
    active 
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h5>List RKJ Produk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <table class="table table-bordered" id="ppq-produk-dashboard-table" >
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:200px">Nomor RKJ</th>
                                    <th class="text-center" style="width:250px">Nama Produk</th>
                                    <th class="text-center" style="width:200px">Tanggal Produksi</th>
                                    <th class="text-center" style="width:350px">Lot RKJ</th>
                                    <th class="text-center" style="width:200px">Referensi Nomor PPQ</th>
                                    <th class="text-center" style="width:200px">Referensi Alasan PPQ</th>
                                    <th class="text-center" style="width:200px">Hasil Penelusuran</th>
                                    <th class="text-center" style="width:150px">Status PPQ</th>
                                    <th class="text-center" style="width:200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rkjs as $rkj)
                                    @switch($rkj->status_akhir)
                                        @case('0')
                                            @php
                                                $style  = "background-color:#9ef1e9;";
                                                $status = 'New RKJ' ;
                                            @endphp 
                                        @break
                                        @case('1')
                                            @php
                                                $style  = "background-color:#a3f19e;";
                                                $status = 'On Progress RKJ' ;
                                            @endphp 
                                        @break 
                                        @case('2')
                                            @php
                                                switch ($rkj->followUpRkj->status_produk) 
                                                {
                                                    case '0':
                                                        $status_produk = 'Reject';   
                                                    break;
                                                    case '1':
                                                        $status_produk = 'Release';   
                                                    break;
                                                    case '2':
                                                        $status_produk = 'Release Partial';   
                                                    break;
                                                }
                                                $style  = "background-color:#d9f19e;";
                                                $status = 'Done RKJ - '.$status_produk;
                                            @endphp
                                        @break  
                                    @endswitch
                                    <tr style="{{$style}}" >
                                        <td onclick="prosesFollowUpRkj('{{ app('App\Http\Controllers\ResourceController')->encrypt($rkj->id) }}','{{ $rkj->nomor_rkj }}','{{$rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name}}','{{ $rkj->ppq->alasan }}','{{$rkj->status_akhir}}','{{ app('App\Http\Controllers\ResourceController')->encrypt($route) }}')"> <strong>{{$rkj->nomor_rkj}}</strong> </td>
                                        <input type="hidden" id="follow_up_rkj_id_{{ app('App\Http\Controllers\ResourceController')->encrypt($rkj->id) }}" @if (!is_null($rkj->followUpRkj)) value="{{ app('App\Http\Controllers\ResourceController')->encrypt($rkj->followUpRkj->id) }}" @endif>
                                        <td> {{$rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name}} </td>
                                        <td> {{$rkj->ppq->production_realisation_date}} </td>
                                        <td>
                                            @php
                                                $palet  = '';
                                            @endphp
                                            @foreach ($rkj->ppq->palets as $palet_ppq)
                                                @php
                                                    $palet  .= $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ';
                                                @endphp
                                            @endforeach
                                            {{ rtrim($palet,', ') }}
                                        </td>
                                        <td>
                                           {{$rkj->ppq->nomor_ppq}}
                                        </td>
                                        <td>
                                            {{ $rkj->ppq->alasan }}
                                        </td>
                                        <td>
                                            {{$rkj->ppq->followUpPpq->hasil_analisa}}
                                        </td>
                                        <td>
                                            {{ $status }}
                                        </td>

                                        <td>
                                        <button onclick="prosesFollowUpRkj('{{ app('App\Http\Controllers\ResourceController')->encrypt($rkj->id) }}','{{ $rkj->nomor_rkj }}','{{$rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name}}','{{ $rkj->ppq->alasan }}','{{$rkj->status_akhir}}','{{ app('App\Http\Controllers\ResourceController')->encrypt($route) }}')" class="btn btn-primary form-control">Form Follow Up RKJ</button>
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
</div> 
@endsection