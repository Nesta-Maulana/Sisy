@extends('layouts.app')
@section('title')
Monitoring Air 
@endsection
@section('menu-open-pengamatan')
    menu-open
@endsection

@section('active-emon-monitoring-water') 
    active 
@endsection
@section('content')
	<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card ">
					<div class="card-header bg-dark">
						<div class="row no-gutters">
							<div class="col-lg-3 col-md-3 col-sm-3 col-3">
								Lokasi Pengamatan -
							</div> 
							<div class="col-lg-9 col-md-9 col-sm-9 col-9">
								<select name="flowmeter_location" id="flowmeter_location" class="form-control" onchange="document.location.href=this.value">
									@foreach ($flowmeterLocations as $flowmeterLocation)
										<option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocation->id) }}" @if ($flowmeterLocation->id == $flowmeters[0]->flowmeterLocation->id) selected @endif>{{ $flowmeterLocation->flowmeter_location }}</option>
									@endforeach

								</select>
							</div>
						</div>
					</div>
					<div class="card-body">
						@php
							$row	 	= 0;
							$today 		= date('Y-m-d');
						@endphp
						<div class="row">
							@foreach ($flowmeters as $flowmeter)
								@php
									$energyMonitoringToday  = $flowmeter->energyMonitorings->where('monitoring_date',$today)->first();
									if(!is_null($energyMonitoringToday))
									{
										$monitoring_value 	= $energyMonitoringToday->monitoring_value;
									}
									else
									{
										$monitoring_value ="";
									}
								@endphp
								<div class="col-lg-4 col-md-4 col-sm-6 col-12 mt-2">
									<div class="card">
										<div class="card-header text-center" style="padding-left: 0; padding-right: 0;">
											<strong style="font-size: 14px" id="flowmeter_name_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}"> {{ $flowmeter->flowmeter_name }}</strong>
										</div>
										<div class="card-body align-items-stretch no-gutters" style="padding:0px">
										  	<input input type="number" min="0" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47"  @if(is_null($energyMonitoringToday)) class="form-control bg-danger" @else class="form-control bg-success" readonly="true" @endif style="font-size: 25px;" id="monitoring_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}" value="{{ $monitoring_value }}">
										  	<input type="number" class="hidden" id="monitoring_lama_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
										</div>

										<div class="card-footer" style="padding:0px ">
											<div class="row no-gutters">
												<div class="col-lg-12 col-md-12 col-sm-12 col-12 @if (!is_null($energyMonitoringToday))
														hidden
													@endif" id="button_save_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
													<button class=" btn btn-primary form-control " type="button"  onclick="inputMonitoring('{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}')">
														<i style="font-size: 25px;" class="fas fa-save" id="icon_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}"></i>
													</button>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 col-12 @if (is_null($energyMonitoringToday))
														hidden
													@endif" id="button_edit_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
													<button  onclick="editMonitoringData('{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}')" class="btn btn-outline-primary form-control" type="button">
														<i style="font-size: 25px;" class="fas fa-edit" id="icon_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}"></i>
													</button>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-6 hidden" id="button_update_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
													<button onclick="updateMonitoringData('{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}')" class="btn btn-primary form-control" type="button" >
														<i style="font-size: 25px;" class="fas fa-save" id="icon_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}"></i>
													</button>
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-6 col-6 hidden" id="button_cancel_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
													<button class="btn btn-outline-secondary form-control" type="button" onclick="cancelEditMonitoringData('{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}')">
														<i style="font-size: 25px;" class="fas fa-window-close" id="icon_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								{{-- <div class="col-lg-6 col-md-6 col-sm-6" style="padding: 3px;">
									<div class="card">
										<div class="card-header"> <strong> {{ $flowmeter->flowmeter_name }}</strong>	 </div>
										<div class="card-footer bg-primary" style="padding:0.35rem .85rem;">
											@php
												
											@endphp
											<div class="form-group mt-2">
												<div class="input-group mb-3">
												  	<input input type="number" min="0" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47"  class="form-control" style="font-size: 25px;" placeholder="Pengamatan" id="monitoring_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
												  	<div class="input-group-append">
												    	<button class="btn " type="button" id="button_save_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
												    		<i style="font-size: 25px;" class="fas fa-save" id="icon_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}"></i>
												    	</button>
												    	<button class="btn btn-outline-light btn-info hidden" type="button" id="button_edit_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
												    		<i style="font-size: 25px;" class="fas fa-edit" id="icon_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}"></i>
												    	</button>
												    	<button class="btn btn-outline-light btn-primary hidden" type="button" id="button_update_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
												    		<i style="font-size: 25px;" class="fas fa-save" id="icon_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}"></i>
												    	</button>
												    	<button class="btn btn-outline-light btn-secondary hidden" type="button" id="button_cancel_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}">
												    		<i style="font-size: 25px;" class="fas fa-window-close" id="icon_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}"></i>
												    	</button>
												  	</div>
												</div>
											</div>
										</div>
									</div>
								</div> --}}
								{{-- @php
									$row++;
								@endphp
								@if ($row == 2)
									</div>
									<div class="row mt-2">

								@endif --}}
							@endforeach
						</div>	
					</div>
				</div>
			</div>
		</div>	
@endsection
