@extends('layouts.app')
@section('title')
    RPD Filling
@endsection
@section('menu-open-data-proses')
    menu-open
@endsection
@section('active-rollie-process-data-rpds') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <b>List Produk Fillpack</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="rpd-filling-dashboard-table" style="min-width: 100%" >
                        <thead>
                            <tr class="text-center">
                                <th scope="col" >Nomor Wo</th>
                                <th scope="col" >Nama Produk</th>
                                <th scope="col" >Tanggal Produksi</th>
                                <th scope="col" >Formula</th>
                                <th scope="col" >Status</th>
                                <th scope="col" >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wo_numbers as $wo_number)
                                @switch($wo_number->wo_status)
                                    @case('2')
                                        @php
                                            $status     = 'WIP Fillpack';
                                            $style      = 'background-color:#a6e6ff;';
                                            $button     = 'Proses Filling';
                                            $classbtn   = 'btn btn-primary';
                                            $onclick    = 'prosesWoNumber(\''.$wo_number->product->product_name.'\',\''.$wo_number->wo_number.'\',\''.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->id).'\',\'Filling\')';
                                        @endphp
                                    @break
                                    @case('3')
                                        
                                        @if (is_null($wo_number->cppHead))
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
                                        @php
                                            $button     = 'Ke Form RPD Filling';
                                            $classbtn   = 'btn btn-outline-primary';
                                            $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                        @endphp
                                        @if ($wo_number->rpdFillingHead['rpd_status'] == '1') 
                                            @php
                                                $status     = 'On Progress Packing';
                                                $style      = 'background-color:#00ff7e;';
                                                $button     = 'Closed RPD Filling';
                                                $classbtn   = 'btn btn-outline-secondary';
                                                $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                            @endphp
                                        @endif
                                    @break
                                    @case('4')
                                        @if (is_null($wo_number->cppHead))
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
                                        @php
                                            $button     = 'Ke Form RPD Filling';
                                            $classbtn   = 'btn btn-outline-primary';
                                            $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                        @endphp
                                        @if ($wo_number->rpdFillingHead['rpd_status'] == '1') 
                                            @php
                                                $status     = 'On Progress Packing';
                                                $style      = 'background-color:#00ff7e;';
                                                $button     = 'Closed RPD Filling';
                                                $classbtn   = 'btn btn-outline-secondary';
                                                $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                            @endphp
                                        @endif
                                    @break

                                    @case('5')
                                        @php
                                            $status     = 'Closed Wo';
                                            $style      = 'background-color:#00ff7e;';
                                            $button     = 'Closed RPD Filling';
                                            $classbtn   = 'btn btn-outline-secondary';
                                            $onclick    = 'document.location.href=\'rpd-filling/form/'.app('App\Http\Controllers\ResourceController')->encrypt($wo_number->rpd_filling_head_id).'\'';
                                        @endphp
                                    @break
                                @endswitch
                                <tr style="{{$style}}">
                                    <td style="width:120px;" onclick="{{ $onclick }}">
                                        <strong>{{ $wo_number->wo_number}}</strong>
                                    </td>
                                    <td style="width:250px;">{{ $wo_number->product->product_name}}</td>
                                    <td style="width:150px;">{{ $wo_number->production_realisation_date}}</td>
                                    <td>{{ $wo_number->formula_revision}}</td>
                                    <td style="width:120px;">{{ $status}}</td>
                                    <td style="width:150px">
                                        <button class="{{$classbtn}}" onclick="{{ $onclick}}">{{ $button }}</button>
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