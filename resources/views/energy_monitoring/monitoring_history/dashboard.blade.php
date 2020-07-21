@extends('layouts.app')
@section('title')
    Riwayat Pengamatan
@endsection
@section('menu-open-pengamatan')
    menu-open
@endsection
@section('active-emon-monitoring-histories') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Filter Riwayat Pengamatan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="flowmeter_monitoring_category">Kategori Flowmeter</label>
                                <select name="flowmeter_monitoring_category" id="flowmeter_monitoring_category" class="form-control select2">
                                    <option value="0" selected disabled>-- Pilih Kategori Pengamatan --</option>
                                    @foreach ($menus->where('id','70')->first()->childMenus as $monitoring)
                                        @switch($monitoring->menu_name)
                                            @case('Monitoring Gas')
                                                <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt('2') }}">Gas</option>    
                                            @break
                                            @case('Monitoring Air')
                                                <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt('1') }}">Air</option>    
                                            @break
                
                                            @case('Monitoring Listrik')
                                                <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt('3') }}">Listrik</option>    
                                            @break
                                        @endswitch
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="monitoring_month_filter">Bulan Monitoring</label>
                                <div class='input-group date' >
                                    <input type='month' class="form-control" name="monitoring_month_filter" id="monitoring_month_filter" value="{{ date('Y-m') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="flowmeter_workcenter_filter">Flowmeter Workcenter</label>
                                <select name="flowmeter_workcenter_filter" id="flowmeter_workcenter_filter" class="form-control select2"></select>
                            </div>
                            <div class="form-group">
                                <label for="button_filter">&nbsp;</label>
                                <div class="row">
                                    <div class="col-lg col-md col-sm col" id="button_filter">
                                        <button class="btn btn-primary form-control">Filter</button>
                                    </div>
                                    
                                    <div class="col-lg col-md col-sm col hidden" id="button_remove_filter">
                                        <button class="btn btn-secondary form-control">Remove Filter</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-responsive">
                <style>
                    tr {
                        white-space: nowrap;
                    }
                    th:first-child,td:first-child
                    {
                        position:sticky;
                        left:0px;
                    }
                </style>
                <table class="table table-bordered" id="monitoring_history_table" style="overflow-x: overflow;">
                    <thead class="bg-dark">
                        <tr>
                            <th rowspan="2" class="bg-dark" style="background-color: black;color:white">Nama Flowmeter</th>
                            <th rowspan="2" style="vertical-align: bottom">Flowmeter Workcenter</th>
                            <th colspan="{{ $colspan }}" class="text-center">Tanggal</th>
                        </tr>
                        <tr>
                            <th style="border: 0px" class="hidden"></th>
                            @foreach ($allDay as $day)
                                <td>{{$day}}</td>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flowmeters as $flowmeter)
                            <tr>
                                <td style="background-color: black;color:white">
                                    {{$flowmeter->flowmeter_name}}
                                </td>
                                <td>
                                    {{ $flowmeter->flowmeterWorkcenter->flowmeter_workcenter }}
                                </td>
                                @foreach ($flowmeter->monitoringHistories as $monitoringHistory)
                                    <td id="td_{{ app('App\Http\Controllers\ResourceController')->encrypt($monitoringHistory['monitoring_date']) }}_{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}" onclick="editMonitoringHistory('{{ app('App\Http\Controllers\ResourceController')->encrypt($monitoringHistory['monitoring_date']) }}','{{ app('App\Http\Controllers\ResourceController')->encrypt($flowmeter->id) }}')">{{ $monitoringHistory['monitoring_value'] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @section('extract-plugin-footer')
        <script src="{{ asset('datetime-picker/js/jquery.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('datetime-picker/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('datetime-picker/css/bootstrap-datetimepicker.min.css') }}">
        <script type="text/javascript" src="{{ asset('datetime-picker/js/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script>
            
            $('.timepickernya').datetimepicker({
                viewMode: 'years',
                format: 'MMMM/YYYY',
                date: new Date()

            }); 
        </script>
    @endsection
@endsection
