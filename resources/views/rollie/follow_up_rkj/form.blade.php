@extends('layouts.app')
@section('title')
    RKOL | Follow Up PPQ Form   
@endsection
@section('menu-open-rkol')
    menu-open
@endsection
@section('active-rollie-rkol-'.$route) 
    active 
@endsection
@section('content')
    
<form action="/rollie/form-follow-up-rkj/update-follow-up-rkj" method="POST">
        {{ csrf_field() }}
    <input type="hidden" name="follow_up_rkj_id" id="follow_up_rkj_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($followUpRkj->id) }}">
    <input type="hidden" name="params" id="params" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($route) }}">
    <input type="hidden" name="rkj_id" id="rkj_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($followUpRkj->rkj->id) }}">
    <input type="hidden" name="params_route" id="params_route" value="{{$route}}">
    @if (strpos($route,'rkj-rnd-produk') !== false)
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Follow Up RKJ</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h5>Form Follow Up RKJ</h5>
                                    </div>
                                    @if ($followUpRkj->status_follow_up_rkj == '1')
                                        @php
                                            $attribute ='readonly'
                                        @endphp
                                    @else
                                        @php
                                            $attribute =''
                                        @endphp
                                    @endif
                                    <div class="card-body">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="dugaan_penyebab" class="control-label">Dugaan Penyebab</label>
                                                <div>
                                                    <textarea class="form-control" name="dugaan_penyebab" id="dugaan_penyebab" {{ $attribute }} >@if (!is_null($followUpRkj->dugaan_penyebab)){{ $followUpRkj->dugaan_penyebab }}@endif</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="hasil_analisa" class="control-label">Hasil Analisa</label>
                                                <div>
                                                    <textarea class="form-control" name="hasil_analisa" id="hasil_analisa" {{ $attribute }} >@if (!is_null($followUpRkj->hasil_analisa)){{ $followUpRkj->hasil_analisa }}@endif</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="status_produk" class="control-label">Status Produk</label>
                                                @if ($attribute == 'readonly')
                                                    <input type="text" class="form-control" @switch($followUpRkj->status_produk)
                                                        @case('0')
                                                        value="Reject" style="background-color:#f19e9e;"
                                                        @break
                                                        @case('1')
                                                        value="Release" style="background-color:#a3f19e;" 
                                                        @break
                                                        @case('2')
                                                        value="Release Partial" style="background-color:#e4f19e"
                                                        @break
                                                    @endswitch
                                                    {{ $attribute }}>
                                                @else
                                                    <select class="form-control" name="status_produk" id="status_produk">
                                                        <option value="10" selected readonly> Pilih Status Produk </option>
                                                        <option value="0" @if ($followUpRkj->status_produk == '0')  selected @endif> Reject </option>
                                                        <option value="1" @if ($followUpRkj->status_produk == '1')  selected @endif> Release </option>
                                                        <option value="2" @if ($followUpRkj->status_produk == '2')  selected @endif> Release Partial </option>
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_status_produk" class="control-label">Tanggal Status Produk</label>
                                                @if ($attribute == 'readonly')
                                                    <input type='text' class="form-control" name="tanggal_status_produk" id="tanggal_status_produk" value="@if (!is_null($followUpRkj->tanggal_status_produk)){{ $followUpRkj->tanggal_status_produk }} @endif" {{ $attribute }}>
                                                
                                                @else
                                                    <div class='input-group date datepicker' style="padding-left:0px;">
                                                        <input type='text' class="form-control" name="tanggal_status_produk" id="tanggal_status_produk" value="@if (!is_null($followUpRkj->tanggal_status_produk))  {{ $followUpRkj->tanggal_status_produk }} @endif">
                                                        <span class="input-group-addon" style="margin-top: 5px; font-size: 20px; margin-left: 10px;">
                                                            <span class="fas fa-calendar"></span>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                                <h6>Corrective Action</h6>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                @if ($attribute !== 'readonly')
                                                    <a class="btn btn-outline-primary text-secondary pull-right" onclick="cloneCorrectiveAction()"><i class="fa fa-plus"></i> Corrective Action</a>
                                                @endif
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="card-body" id="corrective_action_body">
                                        <div id="corrective_action_div">
                                            @if (count($followUpRkj->correctiveActions) > 0)
                                                @foreach ($followUpRkj->correctiveActions as $correctiveAction)
                                                    @if ($correctiveAction->createdBy->id !== Auth::user()->id)
                                                        @php
                                                            $attribute_corrective = 'readonly';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $attribute_corrective = '';
                                                        @endphp
                                                    @endif
                                                    @if ($followUpRkj->status_follow_up_rkj =='0')
                                                        <div class="form-group">
                                                            <label for="corrective_action" class="control-label">Corrective Action</label>
                                                            <div>
                                                                <textarea type="text" class="form-control corrective_action" name="corrective_action[]" id="corrective_action" placeholder="Corrective Action" {{ $attribute }}>{{ $correctiveAction->corrective_action }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic_corrective_action" class="control-label">PIC Corrective Action </label>
                                                            <input type="text" class="form-control pic_corrective_action" name="pic_corrective_action[]" id="pic_corrective_action" placeholder="PIC Corrective Action" value="{{ $correctiveAction->pic_corrective_action }}" {{ $attribute }}>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="due_date_corrective_action" class="control-label">Due Date Corrective Action </label>
                                                            <input type="date" class="form-control due_date_corrective_action" name="due_date_corrective_action[]" id="due_date_corrective_action" value="{{ $correctiveAction->due_date_corrective_action }}" {{ $attribute }}>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="status_corrective_action" class="control-label">Status Corrective Action </label>
                                                            <select name="status_corrective_action[]" id="status_preventive_action" class="form-control status_preventive_action" @if ($attribute == 'readonly') disabled

                                                            @endif>
                                                                <option value="0" @if ($correctiveAction->status_corrective_action == '0') selected @endif>On Progress</option>
                                                                <option value="1" @if ($correctiveAction->status_corrective_action == '1') selected @endif>Done</option>
                                                            </select>
                                                        </div>
                                                    @else
                                                        @if ($correctiveAction->status_corrective_action == '0')
                                                            @php
                                                                $status_corrective  = ''; 
                                                                $draft              = 1;
                                                                @endphp
                                                        @else
                                                            @if ($attribute == 'readonly')
                                                                @php
                                                                    $status_corrective  = 'readonly';
                                                                    $draft              = 0;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $status_corrective  = '';
                                                                    $draft              = 0;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                        <div class="form-group">
                                                            <label for="corrective_action" class="control-label">Corrective Action</label>
                                                            <div>
                                                                <textarea type="text" class="form-control corrective_action" name="corrective_action[]" id="corrective_action" placeholder="Corrective Action" {{ $attribute_corrective }} {{ $status_corrective }}>{{ $correctiveAction->corrective_action }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic_corrective_action" class="control-label">PIC Corrective Action </label>
                                                            <input type="text" class="form-control pic_corrective_action" name="pic_corrective_action[]" id="pic_corrective_action" placeholder="PIC Corrective Action" value="{{ $correctiveAction->pic_corrective_action }}" {{ $attribute_corrective }} {{ $status_corrective }}>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="due_date_corrective_action" class="control-label">Due Date Corrective Action </label>
                                                            <input type="date" class="form-control due_date_corrective_action" name="due_date_corrective_action[]" id="due_date_corrective_action" value="{{ $correctiveAction->due_date_corrective_action }}" {{ $attribute_corrective }} {{ $status_corrective }}>
                                                            <input type="hidden" class="form-control corrective_action_id" name="corrective_action_id[]" id="corrective_action_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($correctiveAction->id) }}" {{ $attribute_corrective }} {{ $status_corrective }}>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status_corrective_action" class="control-label">Status Corrective Action </label>
                                                            <select name="status_corrective_action[]" id="status_preventive_action" class="form-control status_preventive_action" @if ($attribute_corrective == 'readonly' || $status_corrective == 'readonly') disabled

                                                            @endif>
                                                                <option value="0" @if ($correctiveAction->status_corrective_action == '0') selected @endif>On Progress</option>
                                                                <option value="1" @if ($correctiveAction->status_corrective_action == '1') selected @endif>Done</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="verifikasi_corrective_action" class="control-label">Verifikasi Corrective Action </label>
                                                            <textarea type="text" class="form-control verifikasi_corrective_action" name="verifikasi_corrective_action[]" id="verifikasi_corrective_action" {{ $attribute_corrective }} {{ $status_corrective }}>{{ $correctiveAction->verifikasi_corrective_action }}</textarea>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="form-group">
                                                    <label for="corrective_action" class="control-label">Corrective Action</label>
                                                    <div>
                                                        <textarea type="text" class="form-control" name="corrective_action[]" id="corrective_action[]" placeholder="Corrective Action" {{ $attribute }}></textarea>
                                                    </div>
                                                </div>
                
                                                <div class="form-group">
                                                    <label for="pic_corrective_action" class="control-label">PIC Corrective Action </label>
                                                    <input type="text" class="form-control" name="pic_corrective_action[]" id="pic_corrective_action[]" placeholder="PIC Corrective Action" {{ $attribute }}>
                                                </div>
                                                <div class="form-group">
                                                    <label for="due_date_corrective_action" class="control-label">Due Date Corrective Action </label>
                                                    <input type="date" class="form-control" name="due_date_corrective_action[]" id="due_date_corrective_action[]" {{ $attribute }}>
                                                </div>
                
                                                <div class="form-group">
                                                    <label for="status_corrective_action" class="control-label">Status Corrective Action </label>
                                                    <select name="status_corrective_action[]" id="status_preventive_action[]" class="form-control" @if ($attribute == 'readonly')
                                                        disabled 
                                                    @endif>
                                                        <option value="0">On Progress</option>
                                                        <option value="1">Done</option>
                                                    </select>
                                                </div>
                                            @endif
                                        <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if ($attribute !== 'readonly')
                                                            
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            </div>  
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <button class="btn btn-outline-primary form-control" name="params_save" value="draft">Simpan Draft Penelusuran</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <a class="btn btn-primary form-control text-white " value="draft" onclick="validasiInputFollowUpRkj()">Simpan Hasil Penelusuran</a>
                                </div>
                            </div>

                        </div>
                        @else 
                            @if ($draft > 0)
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <a href="{{ route('rollie.rkol.rkj_rnd_produk_'.strtolower($followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->subbrand->brand->brand_name)) }}" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard PPQ</a>
                                    </div>  
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-outline-primary form-control" name="params_save" value="updatenya">Update Corrective Action & Preventive Action</button>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href="{{ route('rollie.rkol.rkj_rnd_produk_'.strtolower($followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->subbrand->brand->brand_name)) }}" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard RKJ</a>
                                </div>  
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    @else
        @if ($followUpRkj->status_follow_up_qa == '1')
            @php
                $attribute ='readonly'
            @endphp
        @else
            @php
                $attribute =''
            @endphp
        @endif
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5>Follow Up RKJ</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h5>Form Follow Up RKJ</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="nomor_rkp" class="control-label">Nomor RKP</label>
                                                <div>
                                                    <input class="form-control" name="nomor_rkp" id="nomor_rkp" value="@if (!is_null($followUpRkj->nomor_rkp)){{ $followUpRkj->nomor_rkp }}@endif" {{ $attribute }} >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="hasil_investigasi" class="control-label">Hasil Investigasi</label>
                                                <div>
                                                    <textarea class="form-control" name="hasil_investigasi" id="hasil_investigasi" {{ $attribute }} >@if (!is_null($followUpRkj->hasil_investigasi)){{ $followUpRkj->hasil_investigasi }}@endif</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_loi" class="control-label">Tanggal LOI</label>
                                                @if ($attribute == 'readonly')
                                                    <input type='text' class="form-control" name="tanggal_loi" id="tanggal_loi" value="@if (!is_null($followUpRkj->tanggal_loi)){{ $followUpRkj->tanggal_loi }} @endif" {{ $attribute }}>
                                                
                                                @else
                                                    <div class='input-group date datepicker' style="padding-left:0px;">
                                                        <input type='text' class="form-control" name="tanggal_loi" id="tanggal_loi" value="@if (!is_null($followUpRkj->tanggal_loi))  {{ $followUpRkj->tanggal_loi }} @endif">
                                                        <span class="input-group-addon" style="margin-top: 5px; font-size: 20px; margin-left: 10px;">
                                                            <span class="fas fa-calendar"></span>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="status_case" class="control-label">Status Case</label>
                                                @if ($attribute == 'readonly' && $followUpRkj->status_case == '1')
                                                    <input type="text" class="form-control" @switch($followUpRkj->status_case)
                                                        @case('0')
                                                        value="On Progress" style="background-color:#f19e9e;"
                                                        @break
                                                        @case('1')
                                                        value="Done" style="background-color:#a3f19e;" 
                                                        @break
                                                    @endswitch
                                                    {{ $attribute }}>
                                                <input type="hidden" name="status_case" id="status_case" value="{{ $followUpRkj->status_case }}">
                                                @else
                                                    <select class="form-control" name="status_case" id="status_case">
                                                        <option value="10" selected readonly> Pilih Status Case </option>
                                                        <option value="0" @if ($followUpRkj->status_case == '0')  selected @endif> On Progress </option>
                                                        <option value="1" @if ($followUpRkj->status_case == '1')  selected @endif> Done </option>
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                                <h6>Preventive Action</h6>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                @if ($attribute !== 'readonly')
                                                <a class="btn btn-outline-primary text-white pull-right" onclick="clonePreventiveAction()"><i class="fa fa-plus"></i> Preventive Action</a>
                                                @endif
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="card-body" id="preventive_action_body">
                                        <div id="preventive_action_div">
                                            @if (count($followUpRkj->preventiveActions) > 0)
                                                @foreach ($followUpRkj->preventiveActions as $preventiveAction)
                                                    @if ($preventiveAction->createdBy->id !== Auth::user()->id)
                                                        @php
                                                            $attribute_preventive = 'readonly';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $attribute_preventive = '';
                                                        @endphp
                                                    @endif
                                                    @if ($followUpRkj->status_follow_up_qa =='0')
                                                        <div class="form-group">
                                                            <label for="preventive_action" class="control-label">Corrective Action</label>
                                                            <div>
                                                                <textarea type="text" class="form-control preventive_action" name="preventive_action[]" id="preventive_action" placeholder="Corrective Action" {{ $attribute }}>{{ $preventiveAction->preventive_action }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic_preventive_action" class="control-label">PIC Corrective Action </label>
                                                            <input type="text" class="form-control pic_preventive_action" name="pic_preventive_action[]" id="pic_preventive_action" placeholder="PIC Corrective Action" value="{{ $preventiveAction->pic_preventive_action }}" {{ $attribute }}>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="due_date_preventive_action" class="control-label">Due Date Corrective Action </label>
                                                            <input type="date" class="form-control due_date_preventive_action" name="due_date_preventive_action[]" id="due_date_preventive_action" value="{{ $preventiveAction->due_date_preventive_action }}" {{ $attribute }}>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="status_preventive_action" class="control-label">Status Corrective Action </label>
                                                            <select name="status_preventive_action[]" id="status_preventive_action" class="form-control status_preventive_action" @if ($attribute == 'readonly') disabled

                                                            @endif>
                                                                <option value="0" @if ($preventiveAction->status_preventive_action == '0') selected @endif>On Progress</option>
                                                                <option value="1" @if ($preventiveAction->status_preventive_action == '1') selected @endif>Done</option>
                                                            </select>
                                                        </div>
                                                    @else
                                                        @if ($preventiveAction->status_preventive_action == '0')
                                                            @php
                                                                $status_preventive  = ''; 
                                                                $draft              = 1;
                                                                @endphp
                                                        @else
                                                            @if ($attribute == 'readonly')
                                                                @php
                                                                    $status_preventive  = 'readonly';
                                                                    $draft              = 0;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $status_preventive  = '';
                                                                    $draft              = 0;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                        <div class="form-group">
                                                            <label for="preventive_action" class="control-label">Corrective Action</label>
                                                            <div>
                                                                <textarea type="text" class="form-control preventive_action" name="preventive_action[]" id="preventive_action" placeholder="Corrective Action" {{ $attribute_preventive }} {{ $status_preventive }}>{{ $preventiveAction->preventive_action }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic_preventive_action" class="control-label">PIC Corrective Action </label>
                                                            <input type="text" class="form-control pic_preventive_action" name="pic_preventive_action[]" id="pic_preventive_action" placeholder="PIC Corrective Action" value="{{ $preventiveAction->pic_preventive_action }}" {{ $attribute_preventive }} {{ $status_preventive }}>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="due_date_preventive_action" class="control-label">Due Date Corrective Action </label>
                                                            <input type="date" class="form-control due_date_preventive_action" name="due_date_preventive_action[]" id="due_date_preventive_action" value="{{ $preventiveAction->due_date_preventive_action }}" {{ $attribute_preventive }} {{ $status_preventive }}>
                                                            <input type="hidden" class="form-control preventive_action_id" name="preventive_action_id[]" id="preventive_action_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($preventiveAction->id) }}" {{ $attribute_preventive }} {{ $status_preventive }}>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status_preventive_action" class="control-label">Status Corrective Action </label>
                                                            <select name="status_preventive_action[]" id="status_preventive_action" class="form-control status_preventive_action" @if ($attribute_preventive == 'readonly' || $status_preventive == 'readonly') disabled

                                                            @endif>
                                                                <option value="0" @if ($preventiveAction->status_preventive_action == '0') selected @endif>On Progress</option>
                                                                <option value="1" @if ($preventiveAction->status_preventive_action == '1') selected @endif>Done</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="verifikasi_preventive_action" class="control-label">Verifikasi Corrective Action </label>
                                                            <textarea type="text" class="form-control verifikasi_preventive_action" name="verifikasi_preventive_action[]" id="verifikasi_preventive_action" {{ $attribute_preventive }} {{ $status_preventive }}>{{ $preventiveAction->verifikasi_preventive_action }}</textarea>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="form-group">
                                                    <label for="preventive_action" class="control-label">Corrective Action</label>
                                                    <div>
                                                        <textarea type="text" class="form-control" name="preventive_action[]" id="preventive_action[]" placeholder="Corrective Action" {{ $attribute }}></textarea>
                                                    </div>
                                                </div>
                
                                                <div class="form-group">
                                                    <label for="pic_preventive_action" class="control-label">PIC Corrective Action </label>
                                                    <input type="text" class="form-control" name="pic_preventive_action[]" id="pic_preventive_action[]" placeholder="PIC Corrective Action" {{ $attribute }}>
                                                </div>
                                                <div class="form-group">
                                                    <label for="due_date_preventive_action" class="control-label">Due Date Corrective Action </label>
                                                    <input type="date" class="form-control" name="due_date_preventive_action[]" id="due_date_preventive_action[]" {{ $attribute }}>
                                                </div>
                
                                                <div class="form-group">
                                                    <label for="status_preventive_action" class="control-label">Status Corrective Action </label>
                                                    <select name="status_preventive_action[]" id="status_preventive_action[]" class="form-control" @if ($attribute == 'readonly')
                                                        disabled 
                                                    @endif>
                                                        <option value="0">On Progress</option>
                                                        <option value="1">Done</option>
                                                    </select>
                                                </div>
                                            @endif
                                        <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if ($attribute !== 'readonly')
                                                            
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            </div>  
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <button class="btn btn-outline-primary form-control" name="params_save" value="draft">Simpan Draft Penelusuran</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <a class="btn btn-primary form-control text-white " value="draft" onclick="validasiInputFollowUpRkj()">Simpan Hasil Penelusuran</a>
                                </div>
                            </div>

                        </div>
                        @else 
                            @if ($draft > 0)
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <a href="{{ route('rollie.rkol.rkj_qa')}}" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard PPQ</a>
                                    </div>  
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-outline-primary form-control" name="params_save" value="updatenya">Update Corrective Action & Preventive Action</button>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href="{{ route('rollie.rkol.rkj_qa')}}" class="btn btn-outline-secondary form-control">Kembali Ke Dashboard RKJ</a>
                                </div>  
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    @endif
    
</form>
@endsection