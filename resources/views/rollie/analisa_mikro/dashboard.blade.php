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
                                        @if (is_null($cppHead->analisaMikro) || $cppHead->analisaMikro->verifikasi_qc_release == '0')
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
                                                            $status     = 'Draft Analisa - Analisa Mikro 30 To Be Confirmed ';
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
                                       {{--  @if ($cppHead->analisaMikro->verifikasi_qc_release == '1')
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
                                            
                                        @endif --}}
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