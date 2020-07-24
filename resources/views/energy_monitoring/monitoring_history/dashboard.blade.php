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
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered
        {
            line-height: 35px;
        }
        .select2-container .select2-selection--single
        {
            height: 35px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Filter Riwayat Pengamatan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="monitoring_month_filter">Bulan Monitoring</label>
                                <div class='input-group date' >
                                    <input type='month' class="form-control" name="monitoring_month_filter" id="monitoring_month_filter" value="{{ date('Y-m') }}" min="2019-01" max="{{ date('Y-m') }}" onchange="refreshTableMonitoringHistory()">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="flowmeter_monitoring_category">Kategori Flowmeter</label>
                                <select name="flowmeter_monitoring_category" id="flowmeter_monitoring_category" class="form-control select2" onchange="refreshTableMonitoringHistory()">
                                    <option value="0" selected disabled>-- Pilih Kategori Pengamatan --</option>
                                    @foreach ($flowmeterCategory as $key => $flowmeter_category)
                                        <option value="{{$key}}">{{ $flowmeter_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="flowmeter_workcenter_filter">Flowmeter Workcenter</label>
                                <select name="flowmeter_workcenter_filter" id="flowmeter_workcenter_filter" class="form-control select2" onchange="refreshTableMonitoringHistory()">
                                    <option value="0" selected disabled>-- Pilih Flowmeter Workcenter --</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="">Monitoring Bulan <span id="month_label">{{ date('F').' '.date('Y') }}</span></h5>
                </div>
                <div class="card-body" style="padding: 0px">
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
                                    <th colspan="{{ $colspan }}" class="text-center" id="colpan_tanggal">Tanggal</th>
                                </tr>
                                <tr id="monitoring_history_head">
                                    <th style="border: 0px" class="hidden"></th>
                                    @foreach ($allDay as $day)
                                        <td>{{$day}}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody id="monitoring_history_table_body">
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
