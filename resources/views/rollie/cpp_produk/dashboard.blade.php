@extends('layouts.app')
@section('title')
    CPP Produk
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
                    List Produk Fillpack
                </div>
                <div class="card-body">
                    <table class="display nowrap table table-bordered" id="dashboard-cpp-produk-tabel" width="100%">
                        <thead >
                            <tr>
                                <th scope="col" >Nomor Wo</th>
                                <th scope="col" >Produk</th>
                                <th scope="col" >Tanggal Produksi</th>
                                <th scope="col" >Status</th>
                                <th scope="col" >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wo_numbers as $wo_number)
                                @switch($wo_number->wo_status)
                                    @case('3')
                                        @if (is_null($wo_number->cppHead))
                                            @php
                                                $status     = 'WIP Packing';
                                                $style      = 'background-color:#a6ffea;';
                                                $button     = 'Proses Packing';
                                                $classbtn   = 'btn btn-primary';
                                                $onclick    = 'prosesWoNumber(\''.$wo_number->product->product_name.'\',\''.$wo_number->wo_number.'\',\''.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->id).'\',\'Packing\')';
                                            @endphp
                                        @else
                                            @php
                                                $status     = 'On Progress Fillpack';
                                                $style      = 'background-color:#00ffb8;';
                                                $button     = 'Ke Form Cpp Produk';
                                                $classbtn   = 'btn btn-outline-primary';
                                                $onclick    = 'document.location.href=\'cpp-produk/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->cpp_head_id).'\'';
                                            @endphp
                                            @if ($wo_number->rpdFillingHead['rpd_status'] == '1') 
                                                @php
                                                    $status     = 'On Progress Packing';
                                                    $style      = 'background-color:#00ff7e;';
                                                    $button     = 'Ke Form Cpp Produk';
                                                    $classbtn   = 'btn btn-outline-primary';
                                                    $onclick    = 'document.location.href=\'cpp-produk/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->cpp_head_id).'\'';
                                                @endphp
                                            @endif
                                        @endif
                                    @break
                                @endswitch
                                <tr style="{{$style}}">
                                    <td  onclick="{{ $onclick }}" >
                                        <strong>{{$wo_number->wo_number}}</strong>
                                    </td>
                                    <td>{{$wo_number->product->product_name}}</td>
                                    <td style="{{ $style }}">{{$wo_number->production_realisation_date}}</td>
                                    <td>
                                        {{ $status }}
                                    </td>
                                    <td>
                                        <button class="{{$classbtn}}" onclick="{{$onclick}}">{{ $button }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection