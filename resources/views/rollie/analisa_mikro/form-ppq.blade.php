@extends('layouts.app')
@section('title')
    Form PPQ | Analisa Mikrobiologi 
@endsection
@section('menu-open-data-analisa')
    menu-open
@endsection
@section('active-rollie-analysis-data-analisa-mikro-release') 
    active 
@endsection
@section('content')
<input type="hidden" id="decode_1" value="{{ app('App\Http\Controllers\ResourceController')->decrypt(Request::Segment(4)) }}">
<input type="hidden" id="decode_2" value="{{ app('App\Http\Controllers\ResourceController')->decrypt(Request::Segment(5)) }}">
<input type="hidden" id="encode_1" value="{{ Request::Segment(4) }}">
<input type="hidden" id="encode_2" value="{{ Request::Segment(5) }}">
<input type="hidden" id="auto_code" value="{{ app('App\Http\Controllers\ResourceController')->encrypt('null') }}">
<div class="accordion" id="accordionExample">
	@if ($ppq_30 !== 'null' && !is_null($ppq_30) )
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-header bg-dark" id="ppq30" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="openClose()">
						<h5>
							<b>PPQ Analisa Kimia Suhu 30 - {{ $ppq_30->cppHead->product->product_name }}</b>
							<i class="pull-right fa fa-arrow-down open" id="iconnya"></i>
							{{-- <span class="pull-right" style="font-size: 30px;transform: rotate(90deg);">&#10145;</span> --}}
						</h5>
					</div>
					@php
						$wo_number 						= '';
						$production_realisation_date 	= '';
						$filling_machine 				= '';
						$filling_machine_id 			= '';
						$nolot 							= '';
						$nolot_id 						= '';
						$jumlah_pack 					= 0;
					@endphp	
					@foreach ($ppq_30->palets as $palet_ppq)
						@if (strpos($wo_number,$palet_ppq->palet->cppDetail->woNumber->wo_number.', ') === false)
							@php
								$wo_number 	.= $palet_ppq->palet->cppDetail->woNumber->wo_number.', ';
							@endphp
						@endif
						@if (strpos($production_realisation_date,$palet_ppq->palet->cppDetail->woNumber->production_realisation_date.', ') === false)
							@php
								$production_realisation_date 	.= $palet_ppq->palet->cppDetail->woNumber->production_realisation_date.', ';
							@endphp
						@endif
						
						@if (strpos($filling_machine,$palet_ppq->palet->cppDetail->fillingMachine->filling_machine_code.', ') === false)
							@php
								$filling_machine 	.= $palet_ppq->palet->cppDetail->fillingMachine->filling_machine_code.', ';
							@endphp
						@endif
						
						@if (strpos($filling_machine_id,app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->cppDetail->fillingMachine->filling_machine_id).', ') === false)
							@php
								$filling_machine_id 	.= app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->cppDetail->fillingMachine->filling_machine_id).', ';
							@endphp
						@endif
	
						
						@if (strpos($nolot,$palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ') === false)
							@php
								$nolot 	.= $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ';
							@endphp
						@endif
	
						@if (strpos($nolot_id,app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id).', ') === false)
							@php
								$nolot_id 	.= app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id).', ';
							@endphp
						@endif
						@php
							$jumlah_pack 	+= $palet_ppq->palet->jumlah_pack;
						@endphp
					@endforeach
					<div id="collapseOne" class="collapse show" aria-labelledby="ppq30" data-parent="#accordionExample">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="">Nomor PPQ</label>
										<input readonly="true" type="text" class="form-control" id="nomor_ppq_30" placeholder="Nomor PPQ" value="{{ $ppq_30->nomor_ppq }}">
										<input readonly="true" type="hidden" class="form-control" id="ppq_id_30" placeholder="Nomor PPQ" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq_30->id) }}">
									</div>
									<div class="form-group">
										<label for="">Nomor Wo</label>
										<input readonly="true" type="text" id="wo_number_30" value="{{ rtrim($wo_number,', ') }}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Nama Produk</label>
										<input readonly="true" type="text" id="product_name_30" value="{{ $ppq_30->cppHead->product->product_name }}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Kode Oracle</label>
										<input readonly="true" type="text" class="form-control" id="oracle_code_30" placeholder="Kode Oracle" value="{{ $ppq_30->cppHead->product->oracle_code }}">
									</div>
									<div class="form-group">
										<label for="">Tanggal Produksi</label>
										<input readonly="true" type="text" id="tanggal_produksi_30" value="{{ trim($production_realisation_date,', ') }}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Mesin Filling</label>
										<input readonly="true" type="text" id="filling_machine_30" value="{{ rtrim($filling_machine,', ') }}"  class="form-control">
										<input readonly="true" type="hidden" id="mesin_filling_id_30" value="{{rtrim($filling_machine_id,', ')}}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="nolot">No Lot</label>
										<input id="nolot_30" class="form-control" type="text" name="nolot_30" value="{{ rtrim($nolot,', ') }}" readonly>
										<input id="nolot_id_30" class="form-control hidden" type="hidden" name="nolot_id" value="{{ rtrim($nolot_id,', ') }}">
									</div>
									<div class="form-group">
										<label for="jumlah_pack">Jumlah Pack</label>
										<input id="jumlah_pack_30" class="form-control" type="text" name="jumlah_pack_30" value="{{ $ppq_30->jumlah_pack }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 ">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="">Tanggal PPQ Mikro</label>
										<input readonly="true" type="text" id="tanggal_ppq_30" value="{{ $ppq_30->ppq_date }}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Jam Filling Awal PPQ : </label>
										<input readonly="true" type="text" class="form-control" id="jam_filling_mulai_30" placeholder="Jam Filiing Awal" value="{{ $ppq_30->jam_awal_ppq }} ">
									</div>
									<div class="form-group">
										<label for="">Jam Filling Akhir PPQ : </label>
										<input readonly="true" type="text" class="form-control"  id="jam_filling_akhir_30" value="{{ $ppq_30->jam_akhir_ppq }} ">
									</div>
									<div class="form-group">
										<label for="">Alasan PPQ : </label>
										<textarea class="form-control" inputmode="url" id="alasan_ppq_30" rows="2" required >{{$ppq_30->alasan}}</textarea>
									</div>
									<div class="form-group">
										<label for="">Detail Titik PPQ : </label>
										<textarea class="form-control" id="detail_titik_ppq_30" rows="4" required>{{ html_entity_decode(rtrim($ppq_30->detail_titik_ppq,'14&#13;&#10;')) }}</textarea>
									</div>
									<div class="form-group">
										<label for="">Kategori PPQ : </label>
										<select id="kategori_ppq_id_30" class="form-control" name="kategori_ppq_id">
											<option value="" selected disabled> Pilih Kategori PPQ </option>
											@foreach ($jenisPpq->kategoriPpqs as $kategoriPpq)
												<option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($kategoriPpq->id) }}" @if ($kategoriPpq->id === $ppq_30->kategori_ppq_id) {{'selected'}}  @endif> {{ $kategoriPpq->kategori_ppq }}</option>
											@endforeach
										</select>
									</div>
									
									<div class="form-group">
										<label for="">PIC Input: </label>
										<input readonly="true" type="text" class="form-control" value="{{ $ppq_30->userCreate->employee->fullname }}" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<button class="btn-primary btn form-control" onclick="prosesPpqAnalisaMikro('30')">Proses data PPQ 30</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	@if ($ppq_55 !== 'null' && !is_null($ppq_55) )
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-header bg-dark" id="ppq55" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="openClose()">
						<h5>
							<b>PPQ Analisa Kimia Suhu 55 - {{ $ppq_55->cppHead->product->product_name }}</b>
							<i class="pull-right fa fa-arrow-down open" id="iconnya"></i>
							{{-- <span class="pull-right" style="font-size: 55px;transform: rotate(90deg);">&#10145;</span> --}}
						</h5>
					</div>
					@php
						$wo_number 						= '';
						$production_realisation_date 	= '';
						$filling_machine 				= '';
						$filling_machine_id 			= '';
						$nolot 							= '';
						$nolot_id 						= '';
						$jumlah_pack 					= 0;
					@endphp	
					@foreach ($ppq_55->palets as $palet_ppq)
						@if (strpos($wo_number,$palet_ppq->palet->cppDetail->woNumber->wo_number.', ') === false)
							@php
								$wo_number 	.= $palet_ppq->palet->cppDetail->woNumber->wo_number.', ';
							@endphp
						@endif
						@if (strpos($production_realisation_date,$palet_ppq->palet->cppDetail->woNumber->production_realisation_date.', ') === false)
							@php
								$production_realisation_date 	.= $palet_ppq->palet->cppDetail->woNumber->production_realisation_date.', ';
							@endphp
						@endif
						
						@if (strpos($filling_machine,$palet_ppq->palet->cppDetail->fillingMachine->filling_machine_code.', ') === false)
							@php
								$filling_machine 	.= $palet_ppq->palet->cppDetail->fillingMachine->filling_machine_code.', ';
							@endphp
						@endif
						
						@if (strpos($filling_machine_id,app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->cppDetail->fillingMachine->filling_machine_id).', ') === false)
							@php
								$filling_machine_id 	.= app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->cppDetail->fillingMachine->filling_machine_id).', ';
							@endphp
						@endif

						
						@if (strpos($nolot,$palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ') === false)
							@php
								$nolot 	.= $palet_ppq->palet->cppDetail->lot_number.'-'.$palet_ppq->palet->palet.', ';
							@endphp
						@endif

						@if (strpos($nolot_id,app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id).', ') === false)
							@php
								$nolot_id 	.= app('App\Http\Controllers\ResourceController')->encrypt($palet_ppq->palet->id).', ';
							@endphp
						@endif
						@php
							$jumlah_pack 	+= $palet_ppq->palet->jumlah_pack;
						@endphp
					@endforeach
					<div id="collapseOne" class="collapse show" aria-labelledby="ppq55" data-parent="#accordionExample">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="">Nomor PPQ</label>
										<input readonly="true" type="text" class="form-control" id="nomor_ppq_55" placeholder="Nomor PPQ" value="{{ $ppq_55->nomor_ppq }}">
										<input readonly="true" type="hidden" class="form-control" id="ppq_id_55" placeholder="Nomor PPQ" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($ppq_55->nomor_ppq) }}">
									</div>
									<div class="form-group">
										<label for="">Nomor Wo</label>
										<input readonly="true" type="text" id="wo_number_55" value="{{ rtrim($wo_number,', ') }}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Nama Produk</label>
										<input readonly="true" type="text" id="product_name_55" value="{{ $ppq_55->cppHead->product->product_name }}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Kode Oracle</label>
										<input readonly="true" type="text" class="form-control" id="oracle_code_55" placeholder="Kode Oracle" value="{{ $ppq_55->cppHead->product->oracle_code }}">
									</div>
									<div class="form-group">
										<label for="">Tanggal Produksi</label>
										<input readonly="true" type="text" id="tanggal_produksi_55" value="{{ trim($production_realisation_date,', ') }}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Mesin Filling</label>
										<input readonly="true" type="text" id="filling_machine_55" value="{{ rtrim($filling_machine,', ') }}"  class="form-control">
										<input readonly="true" type="hidden" id="mesin_filling_id_55" value="{{rtrim($filling_machine_id,', ')}}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="nolot">No Lot</label>
										<input id="nolot_55" class="form-control" type="text" name="nolot_55" value="{{ rtrim($nolot,', ') }}" readonly>
										<input id="nolot_id_55" class="form-control hidden" type="hidden" name="nolot_id" value="{{ rtrim($nolot_id,', ') }}">
									</div>
									<div class="form-group">
										<label for="jumlah_pack">Jumlah Pack</label>
										<input id="jumlah_pack_55" class="form-control" type="text" name="jumlah_pack_55" value="{{ $jumlah_pack }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 ">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group">
										<label for="">Tanggal PPQ Mikro</label>
										<input readonly="true" type="text" id="tanggal_ppq_55" value="{{ $ppq_55->ppq_date }}"  class="form-control">
									</div>
									<div class="form-group">
										<label for="">Jam Filling Awal PPQ : </label>
										<input readonly="true" type="text" class="form-control" id="jam_filling_mulai_55" placeholder="Jam Filiing Awal" value="{{ $ppq_55->jam_awal_ppq }} ">
									</div>
									<div class="form-group">
										<label for="">Jam Filling Akhir PPQ : </label>
										<input readonly="true" type="text" class="form-control"  id="jam_filling_akhir_55" value="{{ $ppq_55->jam_akhir_ppq }} ">
									</div>
									<div class="form-group">
										<label for="">Alasan PPQ : </label>
										<textarea class="form-control" inputmode="url" id="alasan_ppq_55" rows="2" required >{{$ppq_55->alasan}}</textarea>
									</div>
									<div class="form-group">
										<label for="">Detail Titik PPQ : </label>
										<textarea class="form-control" id="detail_titik_ppq_55" rows="4" required>{{ html_entity_decode(rtrim($ppq_55->detail_titik_ppq,'14&#13;&#10;')) }}</textarea>
									</div>
									<div class="form-group">
										<label for="">Kategori PPQ : </label>
										<select id="kategori_ppq_id_55" class="form-control" name="kategori_ppq_id">
											<option value="" selected disabled> Pilih Kategori PPQ </option>
											@foreach ($jenisPpq->kategoriPpqs as $kategoriPpq)
												<option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($kategoriPpq->id) }}" @if ($kategoriPpq->id === $ppq_55->kategori_ppq_id) {{'selected'}}  @endif> {{ $kategoriPpq->kategori_ppq }}</option>
											@endforeach
										</select>
									</div>
									
									<div class="form-group">
										<label for="">PIC Input: </label>
										<input readonly="true" type="text" class="form-control" value="{{ $ppq_55->userCreate->employee->fullname }}" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<button class="btn-primary btn form-control" onclick="prosesPpqAnalisaMikro('55')">Proses data PPQ 55</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>

@endsection