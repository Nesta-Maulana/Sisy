@extends('layouts.app')
@section('title')
    Fisikokimia 
@endsection
@section('menu-open-data-analisa')
    menu-open
@endsection
@section('active-rollie-analysis-data-'.str_replace('_', '-',app('App\Http\Controllers\ResourceController')->decrypt($params)) ) 
    active 
@endsection
@section('content')
    @switch(app('App\Http\Controllers\ResourceController')->decrypt($params))
        @case('analisa_mikro_produk')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Draft Analisa Mikro Produk Jadi</h5>
                        </div>
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Analisa Mikro Produk Jadi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="analisa-mikro-dashboard-table" width="100%">
                                <thead >
                                    <tr>
                                        <th> # </th>
                                        <th> Nama Produk </th>
                                        <th> Nomor Wo </th>
                                        <th> Tanggal Produksi </th>
                                        <th> Tanggal Analisa </th>
                                        <th> Status Analisa Mikro </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cppHeads as $cppHead)
                                        @if (is_null($cppHead->analisa_mikro_id))
                                            @php
                                                $style      = 'background-color:#a6e6ff';
                                                $onclick    = '';
                                                $status     = 'Belum Analisa'
                                            @endphp
                                        @else
                                            @if ($cppHead->analisaMikro->progress_status == '0')
                                                @php
                                                    $style      = 'background-color:#f5ffa6';
                                                    $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                    $status     = 'Draft Analisa';
                                                @endphp
                                            @else
                                                @if ($cppHead->analisaMikro->analisa_mikro_status == '0')
                                                    @if (is_null($cppHead->analisaMikro->analisaMikroResamplings) || count($cppHead->analisaMikro->analisaMikroResamplings) == 0)
                                                        @php
                                                            $style      = 'background-color:#ffd7a6';
                                                            $onclick    =  str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);;
                                                            $status     = 'Analisa Mikro #OK - Waiting Qc Release Verification';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $style      = 'background-color:#ffa6a6';
                                                            $onclick    =  str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);;
                                                            $status     = 'Analisa Mikro Resampling'
                                                        @endphp
                                                    @endif
                                                @else
                                                    @if ($cppHead->analisaMikro->verifikasi_qc_release == '0')
                                                        @php
                                                            $style      = 'background-color:#ffeca6';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK - Waiting QC Release Verification';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                        <tr style="{{ $style }}">
                                            <td> 
                                                <button class="btn btn-primary" onclick="window.location.href='{{ $onclick }}'"> 
                                                    <i class="fas fa-edit"></i>
                                                </button> 
                                            </td>
                                            <td>
                                                {{$cppHead->woNumbers[0]->product->product_name}}
                                            </td>
                                            <td>
                                                @php
                                                    $wo_number = '';
                                                @endphp
                                                @foreach ($cppHead->woNumbers as $woNumber)
                                                    @php
                                                        $wo_number  .= $woNumber->wo_number.', ';
                                                    @endphp
                                                @endforeach
                                                {{ rtrim($wo_number,', ') }}
                                            </td>
                                            <td>
                                                @php
                                                    $production_realisation_date = '';
                                                @endphp
                                                @foreach ($cppHead->woNumbers as $woNumber)
                                                    @php
                                                        if (strpos($production_realisation_date,$woNumber->production_realisation_date.', ') === false) 
                                                        {
                                                            $production_realisation_date  .= $woNumber->production_realisation_date.', ';
                                                        }
                                                    @endphp
                                                @endforeach
                                                {{ rtrim($production_realisation_date,', ') }}
                                            </td>
                                            <td>
                                                @php
                                                    $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                                                    $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                                                    echo date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)));
                                                @endphp
                                            </td>
                                            <td>
                                                {{ $status }}
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                @section('extract-plugin-footer')
                    <link rel="stylesheet" href=" {{ asset('fullcalendar/fullcalendar/main.min.css') }}">
                    <link rel="stylesheet" href=" {{ asset('fullcalendar/fullcalendar-daygrid/main.min.css') }}">
                    <link rel="stylesheet" href=" {{ asset('fullcalendar/fullcalendar-timegrid/main.min.css') }}">
                    <link rel="stylesheet" href=" {{ asset('fullcalendar/fullcalendar-bootstrap/main.min.css') }}">
                    <!-- fullCalendar 2.2.5 -->
                    <script src="{{ asset('fullcalendar/moment/moment.min.js') }}"></script>
                    <script src="{{ asset('fullcalendar/fullcalendar/main.min.js') }}"></script>
                    <script src="{{ asset('fullcalendar/fullcalendar-daygrid/main.min.js') }}"></script>
                    <script src="{{ asset('fullcalendar/fullcalendar-timegrid/main.min.js') }}"></script>
                    <script src="{{ asset('fullcalendar/fullcalendar-interaction/main.min.js') }}"></script>
                    <script src="{{ asset('fullcalendar/fullcalendar-bootstrap/main.min.js') }}"></script>
                    <script>
                        var Calendar = FullCalendar.Calendar;
                        var calendarEl = document.getElementById('calendar');
                        var date = new Date()
                        var d    = date.getDate(),
                            m    = date.getMonth(),
                            y    = date.getFullYear()
                        var calendar = new Calendar(calendarEl, {
                        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
                        customButtons: {
                            listButton: {
                            text: 'Table List Analisa Mikro',
                            class:'btn btn-primary',
                            click: function() {
                                    $('.btn-primary')[0].focus()
                                }
                            }
                        },
                        header    : {
                            left  : 'prev,today,next',
                            center: 'title',
                            right : 'listButton'
                        },
                        //Random default events
                        events    : [
                            @foreach($cppHeads as $cppHead)
                                @php
                                    $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                                    $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                                @endphp
                                @if(is_null($cppHead->analisa_mikro_id))
                                    { 
                                        /*ini kalo belum analisa mikro*/
                                        id              :'{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id) }}',
                                        title           : '{{ $cppHead->product->product_name }}',
                                        start           : '{{ date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir))) }}', 
                                        textColor       : '#fff',
                                        backgroundColor : "#ff5f5f", 
                                        borderColor     : "#fff", 
                                        fontSize        : "12px",
                                        extendedProps   :
                                        {
                                            progress_status : '0',/* ini untuk proses analisa mikro pertama kali soalnya belum ada */
                                        },
                                    },
                                @else
                                    @if($cppHead->analisaMikro->progress_status == '0')
                                        { 
                                            /*ini kalo belum analisa mikro*/
                                            id                  :'{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id) }}',
                                            title               : '{{ $cppHead->product->product_name }}',
                                            start               : '{{ date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir))) }}', 
                                            textColor           : '#000',
                                            backgroundColor     : "#eeff5f", 
                                            borderColor         : "#fff", 
                                            fontSize            : "12px",
                                            extendedProps       :
                                            {
                                                progress_status : '1', /* ini untuk masuk ke form analisa mikro soalnya udah ada draft analisanya  */ 
                                            },
                                        },
                                    @else
                                        @if($cppHead->analisaMikro->analisa_mikro_status == '1')
                                            { 
                                                /*ini kalo belum analisa mikro*/
                                                id              :'{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id) }}',
                                                title           : '{{ $cppHead->product->product_name }}',
                                                start           : '{{ date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir))) }}', 
                                                textColor       : '#000',
                                                backgroundColor : "#61ff5f", 
                                                borderColor     : "#fff", 
                                                fontSize        : "12px",
                                                extendedProps   :
                                                {
                                                    progress_status          :'2', /* ini untuk masuk ke form analisa mikro soalnya hasilnya udah done dan hasilnya OK  */
                                                },
                                            },
                                        @else
                                            @if( count($cppHead->analisaMikro->analisaMikroResampling) == '0' )
                                                { 
                                                    /*ini kalo belum analisa mikro*/
                                                    id              :'{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id) }}',
                                                    title           : '{{ $cppHead->product->product_name }}',
                                                    start           : '{{ date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir))) }}', 
                                                    textColor       : '#fff',
                                                    backgroundColor : "#ff5f5f", 
                                                    borderColor     : "#fff", 
                                                    fontSize        : "12px",
                                                    extendedProps   :
                                                    {
                                                        progress_status          :'3', /* ini untuk proses analisa mikro resampling yang pertama kali dikarenakan belum ada sama sekali resampling soalnya analisa mikronya #OK */
                                                    },
                                                },
                                            @else
                                                @if($cppHead->analisaMikro->analisaMikroResampling[count($cppHead->analisaMikro->analisaMikroResampling)-1]->progress_status == '0')
                                                    { 
                                                        id              :'{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->analisaMikroResampling[count($cppHead->analisaMikro->analisaMikroResampling)-1]->id) }}',
                                                        title           : '{{ $cppHead->product->product_name }}',
                                                        start           : '{{ date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir))) }}', 
                                                        textColor       : '#000',
                                                        backgroundColor : "#eeff5f",  
                                                        borderColor     : "#fff", 
                                                        fontSize        : "12px",
                                                        extendedProps   :
                                                        {
                                                            progress_status          : '4', /* ini untuk masuk ke form analisa mikro resampling soalnya udah ada draft analisanya  */
                                                        },
                                                    },  
                                                @else
                                                    @if($cppHead->analisaMikro->analisaMikroResampling[count($cppHead->analisaMikro->analisaMikroResampling)-1]->analisa_mikro_status == '1')
                                                        { 
                                                            id              :'{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->analisaMikroResampling[count($cppHead->analisaMikro->analisaMikroResampling)-1]->id) }}',
                                                            title           : '{{ $cppHead->product->product_name }}',
                                                            start           : '{{ date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir))) }}', 
                                                            textColor       : '#000',
                                                            backgroundColor : "#61ff5f", 
                                                            borderColor     : "#fff", 
                                                            fontSize        : "12px",
                                                            status          : '5', /* ini untuk masuk ke form analisa mikro resampling yang hasilnya OK */
                                                        },  
                                                    @else
                                                        { 
                                                            id              :'{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id) }}',
                                                            title           : '{{ $cppHead->product->product_name }}',
                                                            start           : '{{ date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir))) }}', 
                                                            textColor       : '#fff',
                                                            backgroundColor : "#ff5f5f", 
                                                            borderColor     : "#fff", 
                                                            fontSize        : "12px",
                                                            extendedProps   :
                                                            {
                                                                progress_status          : '6', /* ini untuk proses resampling lagi  */
                                                            },
                                                        },  
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                            
                        ],
                        eventClick: function(info) 
                        {
                            /* 
                                disini akan masuk ke alert analisa berdasarkan progress status yang sudah diset
                            */
                        switch (info.event.extendedProps.progress_status) 
                        {
                                case '0':
                                /* ini untuk pertama kali analisa mikro pertama kali */
                                Swal.fire({
                                        title       : 'Apakah Anda Akan Melakukan Analisa Mikro '+info.event.title+' ?',
                                        text        : "Setelah melakukan konfirmasi ini anda akan dialihkan menuju form RPD-M",
                                        type        : 'info',
                                        showCancelButton    : true,
                                        confirmButtonColor  : '#3085d6',
                                        cancelButtonColor   : '#d33',
                                        confirmButtonText   : 'Ya, Proses RPD-M!'
                                    }).then((result) => 
                                    {
                                        if (result.value) 
                                        {
                                            $.ajax({
                                                headers:
                                                {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                url: 'analisa-mikro-produk/proses-analisa-mikro',
                                                method: 'POST',
                                                dataType: 'JSON',
                                                data: 
                                                { 
                                                    'cpp_head_id'   : info.event.id
                                                },
                                                success: function (data) 
                                                {
                                                    if (data.success == true) 
                                                    {
                                                        swal({
                                                            title   : "Proses Berhasil",
                                                            text    : "RPD Mikro telah berhasil digenerate oleh sistem, anda akan di alihkan secara otomatis oleh sistem menuju form input hasil analisa.",
                                                            type    : "success",
                                                        });
                                                        window.setTimeout(function () {
                                                            window.location.href=data.url+'/'+'form/'+data.analisa_mikro_id;
                                                        },1000)
                                                    } 
                                                    else 
                                                    {
                                                        swal({
                                                            title   : "Failed",
                                                            text    : data.message,
                                                            type    : "error"
                                                        });
                                                        window.location.href    = "";
                                                    }
                                                },
                                            });
                                        } 
                                    })
                                break;
                                case '1':
                                    window.location.href = window.location.href+'/form/'+info.event.id;
                                break;
                        }
                        },
                        //editable  : false,
                        droppable : false, // this not allows things to be dropped onto the calendar !!!
                        });

                        calendar.render();
                    </script>
                @endsection
        @break
        @case('analisa_ph_produk')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Analisa Mikro Produk Jadi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="analisa-mikro-dashboard-table" width="100%">
                                <thead >
                                    <tr>
                                        <th> # </th>
                                        <th> Nama Produk </th>
                                        <th> Nomor Wo </th>
                                        <th> Tanggal Produksi </th>
                                        <th> Tanggal Analisa </th>
                                        <th> Status Analisa Mikro </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cppHeads as $cppHead)
                                        @if (is_null($cppHead->analisa_mikro_id))
                                            @php
                                                $style      = 'background-color:#a6e6ff';
                                                $onclick    = '';
                                                $status     = 'Belum Analisa'
                                            @endphp
                                        @else
                                            @if ($cppHead->analisaMikro->progress_status == '0')
                                                @php
                                                    $style      = 'background-color:#f5ffa6';
                                                    $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                    $status     = 'Draft Analisa';
                                                @endphp
                                            @else
                                                @if ($cppHead->analisaMikro->analisa_mikro_status == '0')
                                                    @if (is_null($cppHead->analisaMikro->analisaMikroResamplings) || count($cppHead->analisaMikro->analisaMikroResamplings) == 0)
                                                        @php
                                                            $style      = 'background-color:#ffd7a6';
                                                            $onclick    =  str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);;
                                                            $status     = 'Analisa Mikro #OK - Waiting Qc Release Verification';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $style      = 'background-color:#ffa6a6';
                                                            $onclick    =  str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);;
                                                            $status     = 'Analisa Mikro Resampling'
                                                        @endphp
                                                    @endif
                                                @else
                                                    @if ($cppHead->analisaMikro->verifikasi_qc_release == '0')
                                                        @php
                                                            $style      = 'background-color:#ffeca6';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK - Waiting QC Release Verification';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                        <tr style="{{ $style }}">
                                            <td> 
                                                <button class="btn btn-primary" onclick="window.location.href='{{ $onclick }}'"> 
                                                    <i class="fas fa-edit"></i>
                                                </button> 
                                            </td>
                                            <td>
                                                {{$cppHead->woNumbers[0]->product->product_name}}
                                            </td>
                                            <td>
                                                @php
                                                    $wo_number = '';
                                                @endphp
                                                @foreach ($cppHead->woNumbers as $woNumber)
                                                    @php
                                                        $wo_number  .= $woNumber->wo_number.', ';
                                                    @endphp
                                                @endforeach
                                                {{ rtrim($wo_number,', ') }}
                                            </td>
                                            <td>
                                                @php
                                                    $production_realisation_date = '';
                                                @endphp
                                                @foreach ($cppHead->woNumbers as $woNumber)
                                                    @php
                                                        if (strpos($production_realisation_date,$woNumber->production_realisation_date.', ') === false) 
                                                        {
                                                            $production_realisation_date  .= $woNumber->production_realisation_date.', ';
                                                        }
                                                    @endphp
                                                @endforeach
                                                {{ rtrim($production_realisation_date,', ') }}
                                            </td>
                                            <td>
                                                @php
                                                    $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                                                    $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                                                    echo date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)));
                                                @endphp
                                            </td>
                                            <td>
                                                {{ $status }}
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @break
        @case('analisa_mikro_release')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Draft Analisa Mikro Produk Jadi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="analisa-mikro-dashboard-table">
                                <thead >
                                    <tr>
                                        <th style="width: 20px"> # </th>
                                        <th style="width: 200px"> Nama Produk </th>
                                        <th style="width: 200px"> Nomor Wo </th>
                                        <th style="width: 200px"> Tanggal Produksi </th>
                                        <th style="width: 200px"> Tanggal Analisa </th>
                                        <th style="width: 400px;"> Status Analisa Mikro </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cppHeads as $cppHead)
                                        @if (is_null($cppHead->analisaMikro))
                                            @php
                                                $style      = 'background-color:#a6e6ff';
                                                $onclick    = '';
                                                $status     = 'Belum Analisa'
                                            @endphp
                                        @else
                                            @if ($cppHead->product->productType->product_type == 'Susu')
                                                @if ($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '0' && $cppHead->analisaMikro->progress_status_55 == '0' )
                                                    @php
                                                        $style      = 'background-color:#f5ffa6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa';
                                                    @endphp   
                                                @elseif($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '1' && $cppHead->analisaMikro->progress_status_55 == '0')
                                                    @php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa - Analisa Mikro 30 To Be Confirmed - Analisa Mikro 55 On Progress';
                                                    @endphp
                                                @elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2' && $cppHead->analisaMikro->progress_status_55 == '1')
                                                    @php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa - Analisa Mikro 30 Done - 55 To Be Confirmed ';
                                                    @endphp
                                                @elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2' && $cppHead->analisaMikro->progress_status_55 == '2')
                                                    @if ($cppHead->analisaMikro->analisa_mikro_status =='0')
                                                        @php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $style      = 'background-color:#f5ffa6';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro #OK';
                                                        @endphp
                                                    @endif
                                                @endif
                                            @else
                                                @if ($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '0' )
                                                    @php
                                                        $style      = 'background-color:#f5ffa6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa';
                                                    @endphp   
                                                @elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '1')
                                                    @php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Analisa Mikro 30 To Be Confirmed';
                                                    @endphp
                                                @elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2')
                                                    @if ($cppHead->analisaMikro->analisa_mikro_status =='1')
                                                        @php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        @endphp
                                                    @else
                                                        @if ($cppHead->analisaMikro->analisaMikroResamplings[count($cppHead->analisaMikro->analisaMikroResamplings)-1]->analisa_mikro_status == '1')
                                                            @php
                                                                $style      = 'background-color:#a6ffad';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling OK';
                                                            @endphp
                                                        @elseif($cppHead->analisaMikro->analisaMikroResamplings[count($cppHead->analisaMikro->analisaMikroResamplings)-1]->analisa_mikro_status == '0')
                                                            @php
                                                                $style      = 'background-color:#ffa6a6';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling #OK';
                                                            @endphp
                                                        @else
                                                            @php
                                                                $style      = 'background-color:#f5ffa6';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling On Progress';
                                                            @endphp
                                                        @endif

                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                        @if ($status == 'Draft Analisa' || $status == 'Analisa Mikro 30 To Be Confirmed')
                                            <tr style="{{ $style }}">
                                                <td> 
                                                    <button class="btn btn-primary" onclick="window.location.href='{{ $onclick }}'"> 
                                                        <i class="fas fa-edit"></i>
                                                    </button> 
                                                </td>
                                                <td>
                                                    {{$cppHead->woNumbers[0]->product->product_name}}
                                                </td>
                                                <td>
                                                    @php
                                                        $wo_number = '';
                                                    @endphp
                                                    @foreach ($cppHead->woNumbers as $woNumber)
                                                        @php
                                                            $wo_number  .= $woNumber->wo_number.', ';
                                                        @endphp
                                                    @endforeach
                                                    {{ rtrim($wo_number,', ') }}
                                                </td>
                                                <td>
                                                    @php
                                                        $production_realisation_date = '';
                                                    @endphp
                                                    @foreach ($cppHead->woNumbers as $woNumber)
                                                        @php
                                                            if (strpos($production_realisation_date,$woNumber->production_realisation_date.', ') === false) 
                                                            {
                                                                $production_realisation_date  .= $woNumber->production_realisation_date.', ';
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    {{ rtrim($production_realisation_date,', ') }}
                                                </td>
                                                <td>
                                                    @php
                                                        $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                                                        $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                                                        echo date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)));
                                                    @endphp
                                                </td>
                                                <td>
                                                    {{ $status }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5>List Done Analisa Mikro Produk Jadi </h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="analisa-mikro-dashboard-tabledone">
                                <thead >
                                    <tr>
                                        <th style="width: 20px"> # </th>
                                        <th style="width: 200px"> Nama Produk </th>
                                        <th style="width: 200px"> Nomor Wo </th>
                                        <th style="width: 200px"> Tanggal Produksi </th>
                                        <th style="width: 200px"> Tanggal Analisa </th>
                                        <th style="width: 400px;"> Status Analisa Mikro </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cppHeads as $cppHead)
                                        @if (is_null($cppHead->analisaMikro))
                                            @php
                                                $style      = 'background-color:#a6e6ff';
                                                $onclick    = '';
                                                $status     = 'Belum Analisa'
                                            @endphp
                                        @else
                                            @if ($cppHead->product->productType->product_type == 'Susu')
                                                @if ($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '0' && $cppHead->analisaMikro->progress_status_55 == '0' )
                                                    @php
                                                        $style      = 'background-color:#f5ffa6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa';
                                                    @endphp   
                                                @elseif($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '1' && $cppHead->analisaMikro->progress_status_55 == '0')
                                                    @php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa - Analisa Mikro 30 To Be Confirmed - Analisa Mikro 55 On Progress';
                                                    @endphp
                                                @elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2' && $cppHead->analisaMikro->progress_status_55 == '1')
                                                    @php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa - Analisa Mikro 30 Done - 55 To Be Confirmed ';
                                                    @endphp
                                                @elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2' && $cppHead->analisaMikro->progress_status_55 == '2')
                                                    @if ($cppHead->analisaMikro->analisa_mikro_status =='0')
                                                        @php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $style      = 'background-color:#f5ffa6';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro #OK';
                                                        @endphp
                                                    @endif
                                                @endif
                                            @else
                                                @if ($cppHead->analisaMikro->progress_status =='0' && $cppHead->analisaMikro->progress_status_30 == '0' )
                                                    @php
                                                        $style      = 'background-color:#f5ffa6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Draft Analisa';
                                                    @endphp   
                                                @elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '1')
                                                    @php
                                                        $style      = 'background-color:#ffeca6';
                                                        $onclick    = str_replace('_','-',app('App\Http\Controllers\ResourceController')->decrypt($params)).'/form/'.app('App\Http\Controllers\ResourceController')->encrypt($cppHead->analisaMikro->id);
                                                        $status     = 'Analisa Mikro 30 To Be Confirmed';
                                                    @endphp
                                                @elseif($cppHead->analisaMikro->progress_status =='1' && $cppHead->analisaMikro->progress_status_30 == '2')
                                                    @if ($cppHead->analisaMikro->analisa_mikro_status =='1')
                                                        @php
                                                            $style      = 'background-color:#a6ffad';
                                                            $onclick    =  'javascript:void(0)';
                                                            $status     = 'Analisa Mikro OK';
                                                        @endphp
                                                    @else
                                                        @if ($cppHead->analisaMikro->analisaMikroResamplings[count($cppHead->analisaMikro->analisaMikroResamplings)-1]->analisa_mikro_status == '1')
                                                            @php
                                                                $style      = 'background-color:#a6ffad';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling OK';
                                                            @endphp
                                                        @elseif($cppHead->analisaMikro->analisaMikroResamplings[count($cppHead->analisaMikro->analisaMikroResamplings)-1]->analisa_mikro_status == '0')
                                                            @php
                                                                $style      = 'background-color:#ffa6a6';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling #OK';
                                                            @endphp
                                                        @else
                                                            @php
                                                                $style      = 'background-color:#f5ffa6';
                                                                $onclick    =  'javascript:void(0)';
                                                                $status     = 'Analisa Mikro Resampling On Progress';
                                                            @endphp
                                                        @endif

                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                        <tr style="{{ $style }}">
                                            <td> 
                                                <button class="btn btn-primary" onclick="window.location.href='{{ $onclick }}'"> 
                                                    <i class="fas fa-eye"></i>
                                                </button> 
                                            </td>
                                            <td>
                                                {{$cppHead->woNumbers[0]->product->product_name}}
                                            </td>
                                            <td>
                                                @php
                                                    $wo_number = '';
                                                @endphp
                                                @foreach ($cppHead->woNumbers as $woNumber)
                                                    @php
                                                        $wo_number  .= $woNumber->wo_number.', ';
                                                    @endphp
                                                @endforeach
                                                {{ rtrim($wo_number,', ') }}
                                            </td>
                                            <td>
                                                @php
                                                    $production_realisation_date = '';
                                                @endphp
                                                @foreach ($cppHead->woNumbers as $woNumber)
                                                    @php
                                                        if (strpos($production_realisation_date,$woNumber->production_realisation_date.', ') === false) 
                                                        {
                                                            $production_realisation_date  .= $woNumber->production_realisation_date.', ';
                                                        }
                                                    @endphp
                                                @endforeach
                                                {{ rtrim($production_realisation_date,', ') }}
                                            </td>
                                            <td>
                                                @php
                                                    $paletakhir     = $cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets[count($cppHead->cppDetails[count($cppHead->cppDetails)-1]->palets)-1]->end;
                                                    $waktuanalisa   = "+".$cppHead->woNumbers[0]->product->waktu_analisa_mikro.' day';
                                                    echo date('Y-m-d',strtotime($waktuanalisa,strtotime($paletakhir)));
                                                @endphp
                                            </td>
                                            <td>
                                                {{ $status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @break
    @endswitch

@endsection
