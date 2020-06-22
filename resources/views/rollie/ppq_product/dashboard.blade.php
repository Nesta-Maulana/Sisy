@extends('layouts.app')
@section('title')
    RKOL | PPQ Produk   
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
                <h5>List PPQ Produk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <table class="table table-bordered" id="ppq-produk-dashboard-table" >
                            <thead>
                                <tr>
                                    <th class="text-center" style="">#</th>
                                    <th class="text-center" style="width:200px">Nomor PPQ</th>
                                    <th class="text-center" style="width:250px">Nama Produk</th>
                                    <th class="text-center" style="width:200px">Tanggal Produksi</th>
                                    <th class="text-center" style="width:350px">Lot PPQ</th>
                                    <th class="text-center" style="width:200px">Jenis PPQ</th>
                                    <th class="text-center" style="width:200px">Alasan PPQ</th>
                                    <th class="text-center" style="width:200px">Jumlah PPQ</th>
                                    <th class="text-center" style="width:150px">Status PPQ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ppqs as $ppq)
                                    @switch($ppq->status_akhir)
                                        @case('0')
                                            @php
                                                $style  = "background-color:#f19e9e;";
                                                $status = 'New PPQ';
                                                $button = 'Proses Follow Up PPQ';
                                            @endphp 
                                        @break
                                        @case('1')
                                            @php
                                                $style  = "background-color:#d9f19e;";
                                                $status = 'On Progress PPQ' ;
                                                $button = 'Form Follow Up PPQ';
                                            @endphp 
                                        @break
                                        @case('2')
                                            @php
                                                if ($route == 'ppq-engineering') 
                                                {
                                                    if (is_null($ppq->followUpPpq->status_case) || $ppq->followUpPpq->status_case == '0' || $ppq->followUpPpq->status_case == '' )
                                                    {
                                                        $style  = "background-color:#d9f19e;";
                                                        $status = 'On Progress PPQ' ;
                                                        $button = 'Form Follow Up PPQ';
                                                    }
                                                    else if (!is_null($ppq->followUpPpq->status_case) && $ppq->followUpPpq->status_case =='1')
                                                    {
                                                        $style  = "background-color:#a3f19e;";
                                                        $status = $ppq->followUpPpq->status_produk ;       
                                                        $button = 'Lihat Hasil Follow Up';
                                                    }
                                                }
                                                else
                                                {
                                                    $style  = "background-color:#a3f19e;";
                                                    $status = $ppq->followUpPpq->status_produk ;
                                                    $button = 'Lihat Hasil Follow Up';
                                                }
                                                switch ($status) 
                                                {
                                                    case '0':
                                                        $status = 'Reject';
                                                        $style  = "background-color:#ff1d1d;";
                                                    break;
                                                    
                                                    case '1':
                                                        $status = 'Release';
                                                    break;
                                                    
                                                    case '2':
                                                        $status = 'Release Partial';
                                                    break;
                                                }
                                            @endphp 
                                        @break
                                        @case('3')
                                            @php
                                                $style  = "background-color:#f19e9e;";
                                                $status = 'On Progress RKJ' ;
                                                $button = 'Lihat Hasil Follow Up';
                                            @endphp 
                                        @break 
                                        @case('4')
                                            @php
                                                $style  = "background-color:#d9f19e;";
                                                $status = 'Done RKJ' ;
                                                $button = 'Lihat Hasil Follow Up';
                                            @endphp
                                        @break 
                                        @case('5')
                                            @php
                                                $style  = "background-color:beige;";
                                                $status = 'Draft PPQ' ;
                                                // $button = 'Lihat Hasil Follow Up';
                                            @endphp
                                        @break      
                                    @endswitch
                                    @switch($route)
                                        @case('ppq-qc-release')
                                            @php
                                                $onclick    = "prosesFollowUpPpq('".app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)."','".$ppq->nomor_ppq."','".$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name."','".$ppq->alasan."','".$ppq->status_akhir."','".app('App\Http\Controllers\ResourceController')->encrypt($route)."','".app('App\Http\Controllers\ResourceController')->encrypt('null')."')";
                                            @endphp
                                        @break

                                        @case('ppq-qc-tahanan')
                                            @switch($ppq->kategoriPpq->jenisPpq->jenis_ppq)
                                                @case('Package Integrity')
                                                    @php
                                                        $onclick    = "prosesFollowUpPpq('".app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)."','".$ppq->nomor_ppq."','".$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name."','".$ppq->alasan."','".$ppq->status_akhir."','".app('App\Http\Controllers\ResourceController')->encrypt('ppq-qc-release')."','".app('App\Http\Controllers\ResourceController')->encrypt($route)."')";     
                                                    @endphp
                                                @break
                                                @case('Kimia')
                                                    @php
                                                        $onclick    = "prosesFollowUpPpq('".app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)."','".$ppq->nomor_ppq."','".$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name."','".$ppq->alasan."','".$ppq->status_akhir."','".app('App\Http\Controllers\ResourceController')->encrypt($route)."','".app('App\Http\Controllers\ResourceController')->encrypt('null')."')";
                                                    @endphp
                                                @break
                                            @endswitch
                                        @break
                                        @case('ppq-engineering')
                                            @php
                                                $onclick    = "prosesFollowUpPpq('".app('App\Http\Controllers\ResourceController')->encrypt($ppq->id)."','".$ppq->nomor_ppq."','".$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name."','".$ppq->alasan."','".$ppq->status_akhir."','".app('App\Http\Controllers\ResourceController')->encrypt($route)."','".app('App\Http\Controllers\ResourceController')->encrypt('null')."')";     
                                            @endphp
                                        @break
                                        
                                    @endswitch
                                    <tr style="{{$style}}" >
                                        <td>
                                            <button class="btn btn-primary" onclick="{{ $onclick }}"><i class="fas fa-pencil-square-o"></i></button>
                                        </td>
                                        <td > <span style="font-weight: 800;">{{$ppq->nomor_ppq}}</span> </td>
                                        <input type="hidden" id="follow_up_ppq_id_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" @if (!is_null($ppq->followUpPpq)) value="{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->followUpPpq->id) }}" @endif>
                                        <td> {{$ppq->palets[0]->palet->cppDetail->woNumber->product->product_name}} </td>
                                        <td> {{$ppq->production_realisation_date}} </td>
                                        <td>
                                            @php
                                                $palet  = '';
                                            @endphp
                                            @foreach ($ppq->palets as $palet_ppq)
                                                @php
                                                    $palet  .= $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ';
                                                @endphp
                                            @endforeach
                                            {{ rtrim($palet,', ') }}
                                        </td>
                                        <td>
                                            {{ $ppq->kategoriPpq->jenisPpq->jenis_ppq }}
                                        </td>
                                        <td>
                                            {{ $ppq->alasan }}
                                        </td>
                                        <td>
                                            {{$ppq->jumlah_pack}}
                                        </td>
                                        <td>
                                            {{ $status }}
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