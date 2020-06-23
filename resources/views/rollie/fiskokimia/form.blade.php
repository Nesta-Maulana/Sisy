@extends('layouts.app')
@section('title')
    Fisikokimia | Form Analisa
@endsection
@section('menu-open-data-analisa')
    menu-open
@endsection
@section('active-rollie-analysis-data-'.str_replace('_', '-',app('App\Http\Controllers\ResourceController')->decrypt($params)) )  
    active 
@endsection
@section('content')
@if ($analisaKimia->progress_status == '1')
    @php
        $attribute = 'readonly';
    @endphp
@elseif($analisaKimia->progress_status == '0')
    @php
        $attribute = '';
    @endphp
@endif
   <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="card">
               <div class="card-header bg-dark">
                   <h5>Form Analisa Fisikokimia Produk Jadi</h5>
               </div>
               <div class="card-body">
                    <form action="/rollie/fisiko-kimia-form/input-analisa-fisikokimia" method="post" id="form-fisiko-kimia">
                        {{ csrf_field() }}
                        <input type="hidden" name="analisa_kimia_id" id="analisa_kimia_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaKimia->id) }}">
                        <input type="hidden" name="params" value="{{ $params }}" id="params">
                        <input type="hidden" name="progress_status" id="progress_status" value="{{ $analisaKimia->progress_status }}">
                        @php
                            $wo_number          = '';
                            $tanggal_produksi   = '';
                            $mesin_filling      = '';
                            $lot_number         = '';
                        @endphp
                        @foreach ($analisaKimia->cppHead->woNumbers as $woNumber)
                            @if (strpos($tanggal_produksi,$woNumber->production_realisation_date.', ') !== true)
                                @php
                                    $tanggal_produksi .= $woNumber->production_realisation_date.', '
                                @endphp
                            @endif
                            @if ($woNumber->wo_number.', ' !== $wo_number)
                                @php
                                    $wo_number .= $woNumber->wo_number.', '
                                @endphp
                            @endif
                        @endforeach
                        @foreach ($analisaKimia->cppHead->cppDetails as $cppDetail)
                            @if (strpos($mesin_filling,$cppDetail->fillingMachine->filling_machine_code.', ') !== true)
                                @php
                                    $mesin_filling .= $cppDetail->fillingMachine->filling_machine_code.', '; 
                                @endphp
                            @endif
                            @foreach ($cppDetail->palets as $palet)
                                @if (strpos($lot_number,$cppDetail->lot_number.'-'.$palet->palet.', ') !== true)
                                    @php
                                        $lot_number .= $cppDetail->lot_number.'-'.$palet->palet.', '; 
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="product_name">Nama Produk</label>
                                    <input class="form-control" type="text" name="product_name" id="product_name" value="{{ $analisaKimia->cppHead->product->product_name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="oracle_code">Kode Oracle</label>
                                    <input class="form-control" type="text" name="oracle_code" id="oracle_code" value="{{ $analisaKimia->cppHead->product->oracle_code }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="spek_ts_min">Spek TS Min</label>
                                    <input class="form-control" type="text" name="spek_ts_min" id="spek_ts_min" value="{{ number_format($analisaKimia->cppHead->product->spek_ts_min, 2, '.', ',') }}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="spek_ts_max">Spek TS Max</label>
                                    <input class="form-control" type="text" name="spek_ts_max" id="spek_ts_max" value="{{ number_format($analisaKimia->cppHead->product->spek_ts_max, 2, '.', ',') }}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="spek_ph_min">Spek pH Min</label>
                                    <input class="form-control" type="text" name="spek_ph_min" id="spek_ph_min" value="{{ number_format($analisaKimia->cppHead->product->spek_ph_min, 2, '.', ',') }}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="spek_ph_max">Spek pH Max</label>
                                    <input class="form-control" type="text" name="spek_ph_max" id="spek_ph_max" value="{{ number_format($analisaKimia->cppHead->product->spek_ph_max, 2, '.', ',') }}" readonly>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="wo_number">Nomor Wo</label>
                                    <input id="wo_number" class="form-control" type="text" name="wo_number" value="{{ rtrim($wo_number,', ') }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="production_realisation_date">Tanggal Produksi</label>
                                    <input id="production_realisation_date" class="form-control" type="text" name="production_realisation_date" value="{{rtrim($tanggal_produksi,', ')}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="filling_machine">Mesin Filling</label>
                                    <input id="filling_machine" class="form-control" type="text" name="filling_machine" value="{{ rtrim($mesin_filling,', ') }}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="lot_number">Nomor Lot</label>
                                    <textarea id="lot_number" class="form-control" type="text" name="lot_number" value="{{ rtrim($mesin_filling,', ') }}" rows='8' readonly>{{ rtrim($lot_number,', ') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="accordion" id="accordionTS">
                                    <div class="card">
                                        <div class="card-header bg-dark" id="dataTS" type="button" data-toggle="collapse" data-target="#collapseTS" aria-expanded="true" aria-controls="collapseTS">
                                            <h5 class="mt-2">
                                                Data TS Produk Jadi        
                                                <span class="pull-right"><i class="fas fa-angle-down fa-lg"></i></span>
                                            </h5>
                                        </div>
                                        <div id="collapseTS" class="collapse show" aria-labelledby="dataTS" data-parent="#accordionTS">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="card">
                                                            <div class="card-header text-center bg-secondary">
                                                                <h6>TS Awal</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="ts_awal_1">TS Awal 1</label>
                                                                            <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" @if(!is_null($analisaKimia->ts_awal_1))
                                                                                value="{{ number_format($analisaKimia->ts_awal_1,2,'.',',') }}" 
                                                                            @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" {{ $attribute }} onchange="tsAwal()" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="ts_awal_2">TS Awal 2</label>
                                                                            <input type="text" class="form-control" id="ts_awal_2" name="ts_awal_2" @if (!is_null($analisaKimia->ts_awal_2))
                                                                                value="{{ number_format($analisaKimia->ts_awal_2,2,'.',',') }}"
                                                                            @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" {{ $attribute }} onchange="tsAwal()">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="ts_awal_avg">TS Awal Avg</label>
                                                                            <input type="text" class="form-control" id="ts_awal_avg" name="ts_awal_avg" @if (!is_null($analisaKimia->ts_awal_avg))
                                                                                value="{{ number_format($analisaKimia->ts_awal_avg,2,'.',',') }}"
                                                                            @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="card">
                                                            <div class="card-header text-center bg-secondary">
                                                                <h6>TS Tengah</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="ts_tengah_1">TS Tengah 1</label>
                                                                            <input type="text" class="form-control" id="ts_tengah_1" name="ts_tengah_1" @if (!is_null($analisaKimia->ts_tengah_1))
                                                                                value="{{ number_format($analisaKimia->ts_tengah_1,2,'.',',') }}"
                                                                            @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off"  onchange="tsTengah()" {{ $attribute }}>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="ts_tengah_2">TS Tengah 2</label>
                                                                            <input type="text" class="form-control" id="ts_tengah_2" name="ts_tengah_2" @if (!is_null($analisaKimia->ts_tengah_2))
                                                                                value="{{ number_format($analisaKimia->ts_tengah_2,2,'.',',') }}"
                                                                            @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off"  onchange="tsTengah()" {{ $attribute }}>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="ts_tengah_avg">TS Tengah Avg</label>
                                                                            <input type="text" class="form-control" id="ts_tengah_avg" name="ts_tengah_avg" @if (!is_null($analisaKimia->ts_tengah_avg))
                                                                                value="{{ number_format($analisaKimia->ts_tengah_avg,2,'.',',') }}"
                                                                            @endif  onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="card">
                                                            <div class="card-header text-center bg-secondary">
                                                                <h6>TS Akhir</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="ts_akhir_1">TS Akhir 1</label>
                                                                            <input type="text" class="form-control" id="ts_akhir_1" name="ts_akhir_1" @if (!is_null($analisaKimia->ts_akhir_1))
                                                                                value="{{ number_format($analisaKimia->ts_akhir_1,2,'.',',') }}" 
                                                                            @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" onchange="tsAkhir()" {{ $attribute }}>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="ts_akhir_2">TS Akhir 2</label>
                                                                            <input type="text" class="form-control" id="ts_akhir_2" name="ts_akhir_2" @if (!is_null($analisaKimia->ts_akhir_2))
                                                                                value="{{ number_format($analisaKimia->ts_akhir_2,2,'.',',') }}" 
                                                                            @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" onchange="tsAkhir()" {{ $attribute }}>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="ts_akhir_avg">TS Akhir Avg</label>
                                                                            <input type="text" class="form-control" id="ts_akhir_avg" name="ts_akhir_avg" @if (!is_null($analisaKimia->ts_akhir_avg))
                                                                                value="{{ number_format($analisaKimia->ts_akhir_avg,2,'.',',') }}" 
                                                                            @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" readonly>
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h5 class="mt-2">
                                            Data Fisikokimia Produk Jadi        
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="card">
                                                    <div class="card-header bg-secondary">
                                                        <h6>Data pH Produk Jadi</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="ph_awal">pH Awal</label>
                                                                    <input type="text" class="form-control" id="ph_awal" name="ph_awal" @if (!is_null($analisaKimia->ph_awal))
                                                                    value="{{  number_format($analisaKimia->ph_awal,2,'.',',')  }}"
                                                                    @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="5" onfocusout="ubahStatusAkhir()" autocomplete="off" {{ $attribute }}>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ph_tengah">pH Tengah</label>
                                                                    <input type="text" class="form-control" id="ph_tengah" name="ph_tengah" @if (!is_null($analisaKimia->ph_tengah))
                                                                    value="{{  number_format($analisaKimia->ph_tengah,2,'.',',')  }}"
                                                                    @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="5" onfocusout="ubahStatusAkhir()" autocomplete="off" {{ $attribute }}>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ph_akhir">pH Akhir</label>
                                                                    <input type="text" class="form-control" id="ph_akhir" name="ph_akhir" @if (!is_null($analisaKimia->ph_akhir))
                                                                    value="{{  number_format($analisaKimia->ph_akhir,2,'.',',')  }}"
                                                                    @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="5" onfocusout="ubahStatusAkhir()" autocomplete="off" {{ $attribute }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="card">
                                                    <div class="card-header bg-secondary">
                                                        <h6>Data Sensori Produk Jadi</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="sensori_awal">Sensori Awal</label>
                                                                    @if ($analisaKimia->progress_status == '0')
                                                                        <select class="form-control" id="sensori_awal" name="sensori_awal" onchange="ubahStatusAkhir()">
                                                                            <option value="select" selected disabled>Pilih Status</option>
                                                                            <option value="OK" @if ($analisaKimia->sensori_awal =='OK') selected @endif>OK</option>
                                                                            <option value="#OK" @if ($analisaKimia->sensori_awal =='#OK') selected @endif>#OK</option>
                                                                        </select>  
                                                                    @else
                                                                        <input type="text" value="{{ $analisaKimia->sensori_awal }}" class="form-control" readonly>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="sensori_tengah">Sensori Tengah</label>
                                                                    @if ($analisaKimia->progress_status == '0')
                                                                        <select class="form-control" id="sensori_tengah" name="sensori_tengah" onchange="ubahStatusAkhir()">
                                                                            <option value="select" selected disabled>Pilih Status</option>
                                                                            <option value="OK" @if ($analisaKimia->sensori_tengah =='OK') selected @endif>OK</option>
                                                                            <option value="#OK" @if ($analisaKimia->sensori_tengah =='#OK') selected @endif>#OK</option>
                                                                        </select>
                                                                    @else
                                                                        <input type="text" value="{{ $analisaKimia->sensori_tengah }}" class="form-control" readonly>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="sensori_akhir">Sensori Akhir</label>
                                                                    @if ($analisaKimia->progress_status == '0')
                                                                        <select class="form-control" id="sensori_akhir" name="sensori_akhir" onchange="ubahStatusAkhir()">
                                                                            <option value="select" selected disabled>Pilih Status</option>
                                                                            <option value="OK" @if ($analisaKimia->sensori_akhir =='OK') selected @endif>OK</option>
                                                                            <option value="#OK" @if ($analisaKimia->sensori_akhir =='#OK') selected @endif>#OK</option>
                                                                        </select>
                                                                    @else
                                                                        <input type="text" value="{{ $analisaKimia->sensori_akhir }}" class="form-control" readonly>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="card">
                                                    <div class="card-header bg-secondary">
                                                        <h6>Data Visko Produk Jadi</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="visko_awal">Visko Awal</label>
                                                                    <input type="text" class="form-control" id="visko_awal" name="visko_awal" @if (!is_null($analisaKimia->visko_awal))
                                                                        value="{{ $analisaKimia->visko_awal }}"
                                                                    @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 || event.charCode == 101" maxlength="5" onfocusout="ubahStatusAkhir()" {{ $attribute }}>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="visko_tengah">Visko Tengah</label>
                                                                    <input type="text" class="form-control" id="visko_tengah" name="visko_tengah" @if (!is_null($analisaKimia->visko_tengah))
                                                                        value="{{ $analisaKimia->visko_tengah }}"
                                                                    @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 || event.charCode == 101" maxlength="5" onfocusout="ubahStatusAkhir()"  {{ $attribute }}>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="visko_akhir">Visko Akhir</label>
                                                                    <input type="text" class="form-control" id="visko_akhir" name="visko_akhir" @if (!is_null($analisaKimia->visko_akhir))
                                                                        value="{{ $analisaKimia->visko_akhir }}"
                                                                    @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 || event.charCode == 101" maxlength="5" onfocusout="ubahStatusAkhir()"  {{ $attribute }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="card">
                                                    <div class="card-header bg-secondary">
                                                        <h6>Data Jam Filling </h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="jam_filling_awal">Jam Filling Awal</label>
                                                                    <input type="text" class="form-control datetimepickernya" id="jam_filling_awal" name="jam_filling_awal" value="@if (!is_null($analisaKimia->jam_filling_awal))
                                                                        {{ $analisaKimia->jam_filling_awal }}
                                                                    @endif" {{ $attribute }}>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jam_filling_tengah">Jam Filling Tengah</label>
                                                                    <input type="text" class="form-control datetimepickernya" id="jam_filling_tengah" name="jam_filling_tengah" value="@if (!is_null($analisaKimia->jam_filling_tengah))
                                                                        {{ $analisaKimia->jam_filling_tengah }}
                                                                    @endif" {{ $attribute }}>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jam_filling_akhir">Jam Filling Akhir</label>
                                                                    <input type="text" class="form-control datetimepickernya" id="jam_filling_akhir" name="jam_filling_akhir" value="@if (!is_null($analisaKimia->jam_filling_akhir))
                                                                        {{ $analisaKimia->jam_filling_akhir }}
                                                                    @endif" {{ $attribute }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>   
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label for="kode_batch_standar">Kode Batch Standar</label>
                                                    <input type="text" class="form-control" name="kode_batch_standar" id="kode_batch_standar" value="@if (!is_null($analisaKimia->kode_batch_standar)) {{ $analisaKimia->kode_batch_standar }} @endif" maxlength="7" placeholder="Ex: TC0901C" autocomplete="off" {{ $attribute }}>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label for="analisa_kimia_status">Status Akhir</label>
                                                    <input type="text" class="form-control" name="analisa_kimia_status" id="analisa_kimia_status" @if (!is_null($analisaKimia->analisa_kimia_status))
                                                        @if ($analisaKimia->analisa_kimia_status == '0')
                                                            value="{{ '#OK' }}"
                                                        @else
                                                            value="{{ 'OK' }}"
                                                        @endif
                                                    @endif readonly>
                                                </div>
                                            </div>
                                                
                                            @if ($analisaKimia->progress_status == '0')
                                                <input type="hidden" name="type_input" id="type_input" value="">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <label for="save_to_draft">&nbsp;</label>
                                                        <button class="btn btn-outline-primary form-control" id="save_to_draft"  name="save_to_draft" onclick="$('#type_input').val('draft')">Save To Draft</button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <label for="save_analisa">&nbsp;</label>
                                                        <a class="btn btn-primary form-control text-white" id="save_analisa" name="save_analisa" onclick="saveAnalisaKimia()">Save Analisa</a>
                                                    </div>
                                                </div>
                                            @else
                                                @if ($analisaKimia->analisa_kimia_status == '1')
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <div class="form-group">
                                                            <label for="save_to_draft">&nbsp;</label>
                                                            <a class="btn btn-outline-primary form-control " id="edit_analisa_kimia" name="edit_analisa_kimia" onclick="editAnalisaKimiaOk()">Edit Analisa Kimia</a>
                                                        </div>
                                                    </div>
                                                @elseif($analisaKimia->analisa_kimia_status == '0')
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <div class="form-group">
                                                            <label for="save_to_draft">&nbsp;</label>
                                                            <a class="btn btn-outline-secondary form-control " onclick="">Lihat Follow Up PPQ</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                        @if (app('App\Http\Controllers\ResourceController')->decrypt($params) == 'fiskokimias_qc_penyelia')
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label for="ts_oven_awal">TS Oven Awal</label>
                                                    <input type="text" class="form-control" id="ts_oven_awal" name="ts_oven_awal" @if(!is_null($analisaKimia->ts_oven_awal))
                                                        value="{{ number_format($analisaKimia->ts_oven_awal,2,'.',',') }}" readonly 
                                                    @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off"  >
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label for="ts_oven_tengah">TS Oven 2</label>
                                                    <input type="text" class="form-control" id="ts_oven_tengah" name="ts_oven_tengah" @if (!is_null($analisaKimia->ts_oven_tengah))
                                                        value="{{ number_format($analisaKimia->ts_oven_tengah,2,'.',',') }}" readonly
                                                    @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" >
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label for="ts_oven_akhir">TS Oven akhir</label>
                                                    <input type="text" class="form-control" id="ts_oven_akhir" name="ts_oven_akhir" @if (!is_null($analisaKimia->ts_oven_akhir))
                                                        value="{{ number_format($analisaKimia->ts_oven_akhir,2,'.',',') }}" readonly
                                                    @endif onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" autocomplete="off" >
                                                </div>
                                            </div>
                                            @if (is_null($analisaKimia->ts_oven_awal) || is_null($analisaKimia->ts_oven_tengah) || is_null($analisaKimia->ts_oven_akhir))
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <label for="">&nbsp;</label>
                                                        <a onclick="updateTsOven()" class="form-control btn btn-info text-white">Input Ts Oven</a>
                                                    </div>
                                                </div>  
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
               </div>
           </div>
       </div>
   </div>
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