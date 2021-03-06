@extends('layouts.app')
@section('title')
    Form RPD Filling | Draft PPQ
@endsection
@section('menu-open-data-proses')
    menu-open
@endsection

@section('active-rollie-process-data-rpds') 
    active 
@endsection
@section('content')
	@if (count($ppqs) > 0	)
    	<div class="accordion" id="accordionExample">
			@foreach ($ppqs as $ppq)
			  	<div class="row">
			  		<div class="col-lg-12 col-md-12 col-sm-12">
			  			<div class="card">
					    	<div class="card-header bg-dark" id="ppq{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						      	<h5 class="mt-2">
					        		PPQ PI {{ $ppq->nomor_ppq }}		
						        	<span class="float-right" style="font-size: 30px;transform: rotate(90deg);">&#10145;</span>
						      	</h5>
						    </div>
						    <div id="collapseOne" class="collapse" aria-labelledby="ppq{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" data-parent="#accordionExample">
						      	<div class="card-body">
						        	<div class="row">
						                <div class="col-lg-6 col-md-6 col-sm-6">
						                    <div class="form-group">
						                        <label for="">Nomor PPQ</label>
						                        <input type="text" class="form-control" id="nomor_ppq_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" readonly="true" placeholder="Nomor PPQ" value="{{ $ppq->nomor_ppq }}">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Nomor Wo</label>
						                        <input type="text" id="wo_number_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="{{ $ppq->rpdFillingDetailPi->woNumber->wo_number }}" readonly class="form-control">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Nama Produk</label>
						                        <input type="text" id="product_name_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="{{ $ppq->rpdFillingDetailPi->woNumber->product->product_name }}" readonly class="form-control">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Kode Oracle</label>
						                        <input type="text" class="form-control" id="oracle_code_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" readonly="true" placeholder="Kode Oracle" value="{{ $ppq->rpdFillingDetailPi->woNumber->product->oracle_code }}">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Tanggal Produksi</label>
						                        <input type="text" id="tanggal_produksi_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="{{ $ppq->rpdFillingDetailPi->woNumber->production_realisation_date }}" readonly class="form-control">
						                    </div>
					                        <div class="form-group">
					                            <label for="">Mesin Filling</label>
					                            <input type="text" id="filling_machine_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="{{ $ppq->rpdFillingDetailPi->fillingMachine->filling_machine_code }}" readonly class="form-control">
					                            <input type="hidden" id="mesin_filling_id_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->rpdFillingDetailPi->fillingMachine->id) }}" readonly class="form-control">
					                        </div>
						                    <div class="form-group">
						                        <label for="">Nomor LOT</label>
						                        @if (count($ppq->palets) > 0)
						                            <input type="text" class="form-control" id="nomor_lot_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="@foreach ($ppq->palets as $palet_ppq){{  $palet_ppq->palet->cppDetail->lot_number }}-{{ $palet_ppq->palet->palet }}, @endforeach" readonly>
						                        @else
						                            <textarea class="form-control text-white" style="background-color: red" id="nomor_lot_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" cols="30" rows="2" readonly>Palet belum tersedia, harap hubungi tim packing untuk segera mengisi form packing dan memisahkan pack PPQ</textarea>
						                        @endif
						                        
						                        @if (!is_null($ppq->palets))
						                        	<input type="hidden" class="form-control" id="nomor_lot_id_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="@foreach ($ppq->palets as $palet_ppq){{ app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id) }},@endforeach">
						                        @else
						                        	<input type="hidden" class="form-control" id="nomor_lot_id_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="0">
						                        @endif
						                    </div> 
						                    <div class="form-group">
						                        <label for="">Jumlah (pack) : </label>
						                        @if ($ppq->jumlah_pack !== 0)                        
						                            <input type="text" class="form-control" id="jumlah_pack_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="{{ $ppq->jumlah_pack }}">
						                        @else
						                            <textarea class="form-control text-white" style="background-color: red" cols="30" rows="2" readonly>Jumlah Pack belum tersedia, harap hubungi tim packing untuk segera mengisi jumlah pack pada form packing dan memisahkan pack PPQ</textarea>
						                            <input type="hidden" class="form-control" id="jumlah_pack_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="0">

						                        @endif
						                    </div>
						                </div>
						                <div class="col-lg-6 col-md-6 col-sm-6">
						                    <div class="form-group">
						                        <label for="">Tanggal PPQ FG</label>
						                        <input type="text" id="tanggal_ppq_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="{{ date('Y-m-d') }}" readonly class="form-control">
						                    </div>
						                    <div class="form-group">
						                        <label for="">Jam Filling Awal PPQ : </label>
						                        <input type="text" class="form-control" id="jam_filling_mulai_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" placeholder="Jam Filiing Awal" value="{{ $ppq->jam_awal_ppq }} "readonly>
						                    </div>
						                    <div class="form-group">
						                        <label for="">Jam Filling Akhir PPQ : </label>
						                        <input type="text" class="form-control"  id="jam_filling_akhir_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" value="{{ $ppq->jam_akhir_ppq }} "readonly>
						                    </div>
						                    <div class="form-group">
						                        <label for="">Alasan PPQ : </label>
						                        <textarea class="form-control" inputmode="url" id="alasan_ppq_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" required>{{$ppq->alasan}}</textarea>
						                    </div>
						                    <div class="form-group">
						                        <label for="">Detail Titik PPQ : </label>
						                        <textarea class="form-control" id="detail_titik_ppq_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" required>{{ $ppq->detail_titik_ppq }}</textarea>
						                    </div>
						                    <div class="form-group">
						                        <label for="">Kategori PPQ : </label>
						                        <select id="kategori_ppq_{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}" class="form-control" required>
						                            <option value="" selected disabled> Pilih Kategori PPQ </option>
						                            @foreach ($kategoriPpqs as $kategoriPpq)
						                            	<option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($kategoriPpq->id) }}" @if ($ppq->kategori_ppq_id == $kategoriPpq->id) selected @endif> {{ $kategoriPpq->kategori_ppq }} </option>
						                            @endforeach
						                        </select>
						                    </div>
						                    
						                    <div class="form-group">
						                        <label for="">PIC Input: </label>
						                        <input type="text" class="form-control" value="{{ $ppq->userCreate->employee->fullname }}" readonly>
						                    </div>
						                    <div class="form-group">
						                        @if (is_null($ppq->palets))
						                        	<button class="btn btn-primary form-control" onclick="update_draft_ppq('{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}','{{ $ppq->nomor_ppq }}')">Update Draft PPQ</button>
						                        @else
						                        	<button class="btn btn-primary form-control" onclick="proses_draft_ppq('{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq->id) }}','{{ $ppq->nomor_ppq }}')">Proses PPQ</button>
						                        @endif

						                    </div>
						                </div>
						            </div>
						      	</div>
						    </div>
					  	</div>
			  		</div>
			  	</div>
			@endforeach
		</div>
	@else
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-header bg-dark">
						<strong>List Draft PPQ {{ $rpdFillingHead->product->product_name }} {{ $rpdFillingHead->woNumbers[0]->production_realisation_date }}</strong>
					</div>
					<div class="card-body">	
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h4 class="text-center text-danger">
									Tidak Ada Draft PPQ
								</h4>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-lg-12 col-md-12 col-sm-12 ">
								<div class="form-group d-flex justify-content-center">
									<button class="btn btn-outline-secondary" onclick="window.location.href='/rollie/rpd-filling/form/list-ppq-pi/{{ app('App\Http\Controllers\ResourceController')->encrypt($rpdFillingHead->id) }}'">Go To List Done PPQ PI {{ $rpdFillingHead->product->product_name }}</button> &nbsp;
									<button class="btn btn-outline-primary" onclick="window.location.href='/rollie/rpd-filling/form/{{ app('App\Http\Controllers\ResourceController')->encrypt($rpdFillingHead->id) }}'">Back To RPD Filling Product {{ $rpdFillingHead->product->product_name }}</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
@endsection