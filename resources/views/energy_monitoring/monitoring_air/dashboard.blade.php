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
		<di class="col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">
					Lokasi Monitoring Air
				</div>
				<div class="card-body">
					@php
						$row = 0
					@endphp
					<div class="row">
						@foreach ($flowmeterLocations as $flowmeterLocation)
							<div class="col-lg-6 div col-md-6 col-sm-6">
								<div class="card bg-primary text-center text-white">
									<div class="card-body" onclick="window.location.href='monitoring-air/{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeterLocation->id) }}'">
										<h3>
											<i class="fas fa-map-marker-alt"></i>&nbsp; {{ $flowmeterLocation->flowmeter_location }}
										</h3>
									</div>
								</div>
							</div>
							@php
								$row++;
							@endphp
							@if ($row == 2)
								</div>
								<div class="row mt-2">
								@php
									$row = 0;
								@endphp
							@endif
						@endforeach
				</div>
			</div>
		</di>
	</div>   
@endsection
