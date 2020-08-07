@extends('layouts.app')
@section('title')
    Analisa Mikrobiologi 
@endsection
@section('menu-open-data-analisa')
    menu-open
@endsection
@section('active-rollie-analysis-data-'.str_replace('_', '-',app('App\Http\Controllers\ResourceController')->decrypt($params)) ) 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form action="submit-hasil-analisa" method="post">
                <input type="hidden" name="analisa_mikro_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikro->id)  }}">
                <input type="hidden" name="product_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikro->cppHead->product->id)  }}">
                <input type="hidden" id="product_type_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikro->cppHead->product->productType->id)  }}">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="row">
                            <div class="col-lg col-md col-sm">
                                <h5>Form Analisa Mikro Produk {{ $analisaMikro->cppHead->product->product_name }}</h5> 
                            </div>
                            @if (app('App\Http\Controllers\ResourceController')->decrypt($params) == 'analisa_ph_produk' || app('App\Http\Controllers\ResourceController')->decrypt($params) == 'analisa_mikro_release') 
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <a class="btn btn-outline-primary form-control" data-toggle="modal" data-target="#tambahSampelAnalisaMikro"><i class="fa fa-plus"></i>&nbsp; Tambah Sampel</a>
                                </div> 
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                @switch(app('App\Http\Controllers\ResourceController')->decrypt($params))
                                    @case('analisa_mikro_produk')
                                        @php
                                            $sampelbiasa    = 0;
                                            $tabindex       = 0;
                                        @endphp
                                        @foreach ($analisaMikro->analisaMikroDetails->unique('filling_machine_id') as $itemMachine)
                                            <table class="table analisa-mikro-form" >
                                                <thead >
                                                    <tr>
                                                        <th style="display: none"></th>
                                                        <th title="Field #1" >
                                                            Mesin
                                                        </th>
                                                        <th title="Field #2">
                                                            Kode Sampel
                                                        </th>
                                                        <th title="Field #3">
                                                            Jam Filling
                                                        </th>
                                                        <th title="Field #4" >
                                                            Suhu
                                                        </th>
                                                        <th title="Field #6">
                                                            TPC
                                                        </th>
                                                        @if ($analisaMikro->cppHead->product->oracle_code == '7300861')
                                                            <th title="Field #7" >
                                                                Yeast
                                                            </th>
                                                            <th title="Field #8" >
                                                                Mold
                                                            </th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($analisaMikro->analisaMikroDetails->sortBy(function($item){  return $item->suhu_preinkubasi.'-'.$item->urutan; } ) as $analisaMikroDetail)
                                                        @if ($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id)
                                                            @if ($analisaMikroDetail->kode_sampel !== 'S1' && $analisaMikroDetail->kode_sampel !== 'S2' && $analisaMikroDetail->kode_sampel !== 'S3' &&  strpos($analisaMikroDetail->kode_sampel,'R') === false) 
                                                                <tr>
                                                                    @php
                                                                        preg_match("/([0-9]+)/", $analisaMikroDetail->kode_sampel, $matches);
                                                                    @endphp
                                                                    <td style="display: none">  {{ $matches[0] }} <?php $sampelbiasa+=intval($matches); ?></td>
                                                                    <td>
                                                                        {{ $analisaMikroDetail->fillingMachine->filling_machine_code }}
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        @switch($analisaMikroDetail->kode_sampel)
                                                                            @case('S1')
                                                                                {{ 'AW' }}
                                                                            @break
                                                                            @case('S2')
                                                                                {{ 'TG' }}
                                                                            @break
                                                                            @case('S3')
                                                                                {{ 'AK' }}
                                                                            @break
                                                                        
                                                                            @default
                                                                                {{ $analisaMikroDetail->kode_sampel }}
                                                                        @endswitch
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" readonly class="datetimepickernya form-control" value="{{ $analisaMikroDetail->jam_filling }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[jam_filling]" id="jam_filling_{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}" onfocusout="changeFillingMikro('{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        {{ $analisaMikroDetail->suhu_preinkubasi }}&deg;
                                                                    </td>
                                                                    @php
                                                                        if(is_null($analisaMikroDetail->tpc))
                                                                        {
                                                                            $tpc    = 0;
                                                                        }
                                                                        else {
                                                                            $tpc    = $analisaMikroDetail->tpc;
                                                                        }
                                                                        
                                                                        if(is_null($analisaMikroDetail->yeast))
                                                                        {
                                                                            $yeast    = 0;
                                                                        }
                                                                        else {
                                                                            $yeast    = $analisaMikroDetail->yeast;
                                                                        }
                                                                        
                                                                        if(is_null($analisaMikroDetail->mold))
                                                                        {
                                                                            $mold    = 0;
                                                                        }
                                                                        else {
                                                                            $mold    = $analisaMikroDetail->mold;
                                                                        }
                                                                    @endphp
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $tpc }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[tpc]">
                                                                    </td>
                                                                    @if ($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861')
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $yeast }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $mold }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[mold]" maxlength="4">
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @foreach ($analisaMikro->analisaMikroDetails as $analisaMikroDetail)
                                                        @if ($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id)
                                                            @if (strpos($analisaMikroDetail->kode_sampel,'R') !== false) 
                                                                <tr>
                                                                    <td style="display: none"><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        {{ $analisaMikroDetail->fillingMachine->filling_machine_code }}
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        @switch($analisaMikroDetail->kode_sampel)
                                                                            @case('S1')
                                                                                {{ 'AW' }}
                                                                            @break
                                                                            @case('S2')
                                                                                {{ 'TG' }}
                                                                            @break
                                                                            @case('S3')
                                                                                {{ 'AK' }}
                                                                            @break
                                                                        
                                                                            @default
                                                                                {{ $analisaMikroDetail->kode_sampel }}
                                                                        @endswitch
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="{{ $analisaMikroDetail->jam_filling }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[jam_filling]" id="jam_filling_{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}" onfocusout="changeFillingMikro('{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}')" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td style="text-align: center;">
                                                                        {{ $analisaMikroDetail->suhu_preinkubasi }}&deg;
                                                                    </td>
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->tpc }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[tpc]">
                                                                    </td>
                                                                    @if ($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861')
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->yeast }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->mold }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[mold]" maxlength="4">
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @foreach ($analisaMikro->analisaMikroDetails as $analisaMikroDetail)
                                                        @if ($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id)
                                                            @if ($analisaMikroDetail->kode_sampel == 'S1' || $analisaMikroDetail->kode_sampel == 'S2' || $analisaMikroDetail->kode_sampel == 'S3') 
                                                                <tr>
                                                                    <td style="display: none" ><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        {{ $analisaMikroDetail->fillingMachine->filling_machine_code }}
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        @switch($analisaMikroDetail->kode_sampel)
                                                                            @case('S1')
                                                                                {{ 'AW' }}
                                                                            @break
                                                                            @case('S2')
                                                                                {{ 'TG' }}
                                                                            @break
                                                                            @case('S3')
                                                                                {{ 'AK' }}
                                                                            @break
                                                                        
                                                                            @default
                                                                                {{ $analisaMikroDetail->kode_sampel }}
                                                                        @endswitch
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="{{ $analisaMikroDetail->jam_filling }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[jam_filling]" id="jam_filling_{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}" onfocusout="changeFillingMikro('{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}')" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        {{ $analisaMikroDetail->suhu_preinkubasi }}&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->tpc }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[tpc]">
                                                                    </td>
                                                                    @if ($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861')
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->yeast }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->mold }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[mold]" maxlength="4">
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    @break
                                    
                                    @case('analisa_ph_produk')
                                        @php
                                            $sampelbiasa    = 0;
                                            $tabindex       = 0;
                                        @endphp
                                    
                                        @foreach ($analisaMikro->analisaMikroDetails->unique('filling_machine_id') as $itemMachine)
                                            <table class="table analisa-mikro-form" >
                                                <thead >
                                                    <tr>
                                                        <th style="display:none;"></th>
                                                        <th title="Field #1" >
                                                            Mesin
                                                        </th>
                                                        <th title="Field #2">
                                                            Kode Sampel
                                                        </th>
                                                        <th title="Field #3">
                                                            Jam Filling
                                                        </th>
                                                        <th title="Field #4" >
                                                            Suhu
                                                        </th>
                                                        <th title="Field #6">
                                                            PH
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($analisaMikro->analisaMikroDetails->sortBy(function($item){  return $item->suhu_preinkubasi.'-'.$item->urutan; } ) as $analisaMikroDetail)
                                                        @if ($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id)
                                                            @if ($analisaMikroDetail->kode_sampel !== 'S1' && $analisaMikroDetail->kode_sampel !== 'S2' && $analisaMikroDetail->kode_sampel !== 'S3' &&  strpos($analisaMikroDetail->kode_sampel,'R') === false) 
                                                                <tr>
                                                                    @php
                                                                        preg_match("/([0-9]+)/", $analisaMikroDetail->kode_sampel, $matches);
                                                                    @endphp
                                                                    <td style="display:none;"> {{ $matches[0] }} <?php $sampelbiasa+=intval($matches); ?></td>
                                                                    <td>
                                                                        {{ $analisaMikroDetail->fillingMachine->filling_machine_code }}
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        @switch($analisaMikroDetail->kode_sampel)
                                                                            @case('S1')
                                                                                {{ 'AW' }}
                                                                            @break
                                                                            @case('S2')
                                                                                {{ 'TG' }}
                                                                            @break
                                                                            @case('S3')
                                                                                {{ 'AK' }}
                                                                            @break
                                                                        
                                                                            @default
                                                                                {{ $analisaMikroDetail->kode_sampel }}
                                                                        @endswitch
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" tabindex="{{ $tabindex+1 }}" class="datetimepickernya form-control" value="{{ $analisaMikroDetail->jam_filling }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[jam_filling]" id="jam_filling_{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}" onfocusout="changeFillingMikro('{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        {{ $analisaMikroDetail->suhu_preinkubasi }}&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" class="form-control" tabindex="{{ $tabindex+1 }}" value="@if(!is_null($analisaMikroDetail->ph)) {{ number_format($analisaMikroDetail->ph, 2, '.', ',') }} @endif" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[ph]">
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @foreach ($analisaMikro->analisaMikroDetails as $analisaMikroDetail)
                                                        @if ($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id)
                                                            @if (strpos($analisaMikroDetail->kode_sampel,'R') !== false) 
                                                                <tr>
                                                                    <td style="display:none;"><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        {{ $analisaMikroDetail->fillingMachine->filling_machine_code }}
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        @switch($analisaMikroDetail->kode_sampel)
                                                                            @case('S1')
                                                                                {{ 'AW' }}
                                                                            @break
                                                                            @case('S2')
                                                                                {{ 'TG' }}
                                                                            @break
                                                                            @case('S3')
                                                                                {{ 'AK' }}
                                                                            @break
                                                                        
                                                                            @default
                                                                                {{ $analisaMikroDetail->kode_sampel }}
                                                                        @endswitch
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" tabindex="{{ $tabindex+1 }}" class="datetimepickernya form-control" value="{{ $analisaMikroDetail->jam_filling }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[jam_filling]" id="jam_filling_{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}" onfocusout="changeFillingMikro('{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}')">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td style="text-align: center;">
                                                                        {{ $analisaMikroDetail->suhu_preinkubasi }}&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="@if(!is_null($analisaMikroDetail->ph)) {{ number_format($analisaMikroDetail->ph, 2, '.', ',') }} @endif" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[ph]">
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @foreach ($analisaMikro->analisaMikroDetails as $analisaMikroDetail)
                                                        @if ($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id)
                                                            @if ($analisaMikroDetail->kode_sampel == 'S1' || $analisaMikroDetail->kode_sampel == 'S2' || $analisaMikroDetail->kode_sampel == 'S3') 
                                                                <tr>
                                                                    <td style="display:none;" ><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        {{ $analisaMikroDetail->fillingMachine->filling_machine_code }}
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        @switch($analisaMikroDetail->kode_sampel)
                                                                            @case('S1')
                                                                                {{ 'AW' }}
                                                                            @break
                                                                            @case('S2')
                                                                                {{ 'TG' }}
                                                                            @break
                                                                            @case('S3')
                                                                                {{ 'AK' }}
                                                                            @break
                                                                        
                                                                            @default
                                                                                {{ $analisaMikroDetail->kode_sampel }}
                                                                        @endswitch
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" tabindex="{{ $tabindex+1 }}" value="{{ $analisaMikroDetail->jam_filling }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[jam_filling]" id="jam_filling_{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}" onfocusout="changeFillingMikro('{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        {{ $analisaMikroDetail->suhu_preinkubasi }}&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="@if(!is_null($analisaMikroDetail->ph)) {{ number_format($analisaMikroDetail->ph, 2, '.', ',') }} @endif" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[ph]">
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    @break    

                                    @case('analisa_mikro_release')
                                        @php
                                            $tabindex       = 0;
                                            $sampelbiasa = 0;
                                        @endphp
                                    
                                        @foreach ($analisaMikro->analisaMikroDetails->unique('filling_machine_id') as $itemMachine)
                                            <table class="table analisa-mikro-form" >
                                                <thead >
                                                    <tr>
                                                        <th style="display:none;"></th>
                                                        <th title="Field #1" >
                                                            Mesin
                                                        </th>
                                                        <th title="Field #2">
                                                            Kode Sampel
                                                        </th>
                                                        <th title="Field #3">
                                                            Jam Filling
                                                        </th>
                                                        <th title="Field #4" >
                                                            Suhu
                                                        </th>
                                                        <th title="Field #6">
                                                            PH
                                                        </th>
                                                        
                                                        <th title="Field #7">
                                                            TPC
                                                        </th>
                                                        @if ($analisaMikro->cppHead->product->oracle_code == '7300861')
                                                            <th title="Field #8" >
                                                                Yeast
                                                            </th>
                                                            <th title="Field #9" >
                                                                Mold
                                                            </th>
                                                        @endif
                                                        <th title="Field #10">
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($analisaMikro->analisaMikroDetails->sortBy(function($item){  return $item->suhu_preinkubasi.'-'.$item->urutan; } ) as $analisaMikroDetail)
                                                        @if ($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id)
                                                            @if ($analisaMikroDetail->kode_sampel !== 'S1' && $analisaMikroDetail->kode_sampel !== 'S2' && $analisaMikroDetail->kode_sampel !== 'S3' &&  strpos($analisaMikroDetail->kode_sampel,'R') === false) 
                                                                <tr @if($analisaMikro->cppHead->product->oracle_code == '7300861') @if(!is_null($analisaMikroDetail->tpc) && !is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->yeast) && !is_null($analisaMikroDetail->mold) && $analisaMikroDetail->status == '0') class="bg-danger" @endif @else @if(!is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->tpc) && $analisaMikroDetail->status == '0') class="bg-danger"  @endif @endif>
                                                                    @php
                                                                        preg_match("/([0-9]+)/", $analisaMikroDetail->kode_sampel, $matches);
                                                                    @endphp
                                                                    <td style="display:none;"> {{ $matches[0] }} <?php $sampelbiasa+=intval($matches); ?> </td>
                                                                    <td>
                                                                        {{ $analisaMikroDetail->fillingMachine->filling_machine_code }}
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        @switch($analisaMikroDetail->kode_sampel)
                                                                            @case('S1')
                                                                                {{ 'AW' }}
                                                                            @break
                                                                            @case('S2')
                                                                                {{ 'TG' }}
                                                                            @break
                                                                            @case('S3')
                                                                                {{ 'AK' }}
                                                                            @break
                                                                        
                                                                            @default
                                                                                {{ $analisaMikroDetail->kode_sampel }}
                                                                        @endswitch
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="{{ $analisaMikroDetail->jam_filling }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[jam_filling]" id="jam_filling_{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}" onfocusout="changeFillingMikro('{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        {{ $analisaMikroDetail->suhu_preinkubasi }}&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" class="form-control" tabindex="{{ $tabindex+1}}" value="@if(!is_null($analisaMikroDetail->ph)) {{ number_format($analisaMikroDetail->ph, 2, '.', ',') }} @endif" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[ph]">
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->tpc }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[tpc]">
                                                                    </td>
                                                                    @if ($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861')
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->yeast }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->mold }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[mold]" maxlength="4">
                                                                        </td>
                                                                    @endif
                                                                    <td>
                                                                        <select class="form-control" tabindex="{{ $tabindex+1 }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[status]">
                                                                            <option value="0" @if ($analisaMikroDetail->status == '0') selected  @endif>#OK</option>
                                                                            <option value="1" @if ($analisaMikroDetail->status == '1') selected  @endif>OK</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @foreach ($analisaMikro->analisaMikroDetails as $analisaMikroDetail)
                                                        @if ($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id)
                                                            @if (strpos($analisaMikroDetail->kode_sampel,'R') !== false) 
                                                                <tr @if($analisaMikro->cppHead->product->oracle_code == '7300861') @if(!is_null($analisaMikroDetail->tpc) && !is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->yeast) && !is_null($analisaMikroDetail->mold) && $analisaMikroDetail->status == '0') class="bg-danger" @endif @else @if(!is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->tpc) && $analisaMikroDetail->status == '0') class="bg-danger"  @endif @endif>
                                                                    <td style="display:none;"><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        {{ $analisaMikroDetail->fillingMachine->filling_machine_code }}
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        @switch($analisaMikroDetail->kode_sampel)
                                                                            @case('S1')
                                                                                {{ 'AW' }}
                                                                            @break
                                                                            @case('S2')
                                                                                {{ 'TG' }}
                                                                            @break
                                                                            @case('S3')
                                                                                {{ 'AK' }}
                                                                            @break
                                                                        
                                                                            @default
                                                                                {{ $analisaMikroDetail->kode_sampel }}
                                                                        @endswitch
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="{{ $analisaMikroDetail->jam_filling }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[jam_filling]" id="jam_filling_{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}" onfocusout="changeFillingMikro('{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}')">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td style="text-align: center;">
                                                                        {{ $analisaMikroDetail->suhu_preinkubasi }}&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1}}" class="form-control" value="@if(!is_null($analisaMikroDetail->ph)) {{ number_format($analisaMikroDetail->ph, 2, '.', ',') }} @endif" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[ph]">
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->tpc }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[tpc]">
                                                                    </td>
                                                                    @if ($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861')
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->yeast }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->mold }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[mold]" maxlength="4">
                                                                        </td>
                                                                    @endif
                                                                    
                                                                    <td>
                                                                        <select class="form-control" tabindex="{{ $tabindex+1 }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[status]">
                                                                            <option value="0" @if ($analisaMikroDetail->status == '0') selected  @endif>#OK</option>
                                                                            <option value="1" @if ($analisaMikroDetail->status == '1') selected  @endif>OK</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @foreach ($analisaMikro->analisaMikroDetails as $analisaMikroDetail)
                                                        @if ($analisaMikroDetail->filling_machine_id === $itemMachine->filling_machine_id)
                                                            @if ($analisaMikroDetail->kode_sampel == 'S1' || $analisaMikroDetail->kode_sampel == 'S2' || $analisaMikroDetail->kode_sampel == 'S3') 
                                                                <tr @if($analisaMikro->cppHead->product->oracle_code == '7300861') @if(!is_null($analisaMikroDetail->tpc) && !is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->yeast) && !is_null($analisaMikroDetail->mold) && $analisaMikroDetail->status == '0') class="bg-danger" @endif @else @if(!is_null($analisaMikroDetail->ph) && !is_null($analisaMikroDetail->tpc) && $analisaMikroDetail->status == '0') class="bg-danger"  @endif @endif>
                                                                    <td style="display:none;" ><?=$sampelbiasa+=1; ?></td>
                                                                    <td>
                                                                        {{ $analisaMikroDetail->fillingMachine->filling_machine_code }}
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        @switch($analisaMikroDetail->kode_sampel)
                                                                            @case('S1')
                                                                                {{ 'AW' }}
                                                                            @break
                                                                            @case('S2')
                                                                                {{ 'TG' }}
                                                                            @break
                                                                            @case('S3')
                                                                                {{ 'AK' }}
                                                                            @break
                                                                        
                                                                            @default
                                                                                {{ $analisaMikroDetail->kode_sampel }}
                                                                        @endswitch
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">                            
                                                                                <input type="text" class="datetimepickernya form-control" value="{{ $analisaMikroDetail->jam_filling }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[jam_filling]" id="jam_filling_{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}" onfocusout="changeFillingMikro('{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}')">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <td style="text-align: center;">
                                                                        {{ $analisaMikroDetail->suhu_preinkubasi }}&deg;
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1}}" class="form-control" value="@if(!is_null($analisaMikroDetail->ph)) {{ number_format($analisaMikroDetail->ph, 2, '.', ',') }} @endif" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[ph]">
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input @if (Session::get('ubah') == 'hidden')
                                                                            readonly 
                                                                        @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->tpc }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[tpc]">
                                                                    </td>
                                                                    @if ($analisaMikroDetail->analisaMikroHead->cppHead->product->oracle_code == '7300861')
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->yeast }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[yeast]">
                                                                        </td>
                                                                        <td>
                                                                            <input @if (Session::get('ubah') == 'hidden')
                                                                                readonly 
                                                                            @endif type="text" tabindex="{{ $tabindex+1 }}" class="form-control" value="{{ $analisaMikroDetail->mold }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[mold]" maxlength="4">
                                                                        </td>
                                                                    @endif
                                                                    
                                                                    <td>
                                                                        <select class="form-control" tabindex="{{ $tabindex+1 }}" name ="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikroDetail->id) }}[status]">
                                                                            <option value="0" @if ($analisaMikroDetail->status == '0') selected  @endif>#OK</option>
                                                                            <option value="1" @if ($analisaMikroDetail->status == '1') selected  @endif>OK</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    @break
                                @endswitch
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg col-md col-sm">
                                <div class="form-group">
                                    <button class="btn btn-outline-secondary form-control" value="draft" name="simpan">Simpan Sebagai Draft</button>
                                </div>
                            </div>
                            @if (Session::get('ubah') == 'show')
                                <div class="col-lg col-md col-sm">
                                    <div class="form-group">
                                        <button class="btn btn-primary form-control" value="simpan" name="simpan">Simpan Hasil Analisa</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('rollie.analisa_mikro.pop-up.tambah-sampel-mikro')
@endsection