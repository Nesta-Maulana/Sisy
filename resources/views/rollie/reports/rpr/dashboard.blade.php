@extends('layouts.app')
@section('title')
    Report Produk Release
@endsection
@section('menu-open-report')
    menu-open
@endsection
@section('active-rollie-reports-rpr') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                     <b>Report Produk Release</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="report-release-produk-dashboard">
                        <thead class="">
                            <tr>
                                <th style="width: 200px">Nama Produk</th>
                                <th style="width: 200px">Tanggal Produksi</th>
                                <th style="width: 200px">Nomor WO</th>
                                <th style="width: 200px">Nomor Lot</th>
                                <th style="width: 200px">Tanggal Selesai Filling</th>
                                <th style="width: 200px">Mesin Filling</th>
                                <th style="width: 200px">Brand</th>
                                <th style="width: 200px">Mikro 30</th>
                                <th style="width: 200px">Mikro 55</th>
                                <th style="width: 200px">Kimia</th>
                                <th style="width: 200px">Sortasi</th>
                                <th style="width: 200px">PPQ</th>
                                <th style="width: 200px">Estimasi Release</th>
                                <th style="width: 200px">Status Mutu Akhir FG</th>
                                <th style="width: 200px">Referensi Bar</th>
                                <th style="width: 200px">Tanggal Bar</th>
                                <th style="width: 200px">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($woNumbers) }} --}}
                            @foreach ($woNumbers as $woNumber)
                                @foreach ($woNumber->cppHead->cppDetails as $cppDetail)
                                    @foreach ($cppDetail->palets as $palet)
                                        <tr>
                                            <td>{{ $palet->cppDetail->woNumber->product->product_name }}</td>
                                            <td>{{ $palet->cppDetail->woNumber->production_realisation_date }}</td>
                                            <td>{{ $palet->cppDetail->woNumber->wo_number }}</td>
                                            <td>{{ $palet->cppDetail->lot_number.'-'.$palet->palet }}</td>
                                            <td>{{ substr($woNumber->cppHead->cppDetails[count($woNumber->cppHead->cppDetails)-1]->palets[count($woNumber->cppHead->cppDetails[count($woNumber->cppHead->cppDetails)-1]->palets)-1]->end,0,10) }}</td>
                                            <td>{{ $palet->cppDetail->fillingMachine->filling_machine_code }}</td>
                                            <td>{{ $palet->cppDetail->woNumber->product->subbrand->subbrand_name }}</td>
                                            @if ($palet->analisa_mikro_30_status == '1')
                                                <td class="bg-success">
                                                    OK
                                                </td>
                                            @elseif($palet->analisa_mikro_30_status == '0')
                                                @php
                                                    $analisaMikroResampling30    = $palet->cppDetail->cppHead->analisaMikro->analisaMikroResamplings->where('suhu_preinkubasi','30');  
                                                @endphp
                                                @if ($analisaMikroResampling30[count($analisaMikroResampling30)-1]->progress_status == '0')
                                                    <td class="bg-warning">
                                                        On Progress Resampling
                                                    </td>
                                                @else
                                                    @if ($analisaMikroResampling30[count($analisaMikroResampling30)-1]->analisa_mikro_status == '1')
                                                        <td class="bg-sucess">
                                                            Mikro Resampling OK
                                                        </td>
                                                    @else
                                                        <td class="bg-danger">
                                                            Mikro Resampling #OK
                                                        </td>
                                                    @endif
                                                @endif
                                            @elseif(is_null($palet->analisa_mikro_30_status)) 
                                                <td>
                                                    Analisa Mikro Belum Dilakukan
                                                </td>
                                            @endif
                                            @if ($palet->analisa_mikro_55_status == '1')
                                                <td class="bg-success">
                                                    OK
                                                </td>
                                            @elseif($palet->analisa_mikro_55_status == '0')
                                                @php
                                                    $analisaMikroResampling55    = $palet->cppDetail->cppHead->analisaMikro->analisaMikroResamplings->where('suhu_preinkubasi','55');  
                                                @endphp
                                                @if ($analisaMikroResampling55[count($analisaMikroResampling55)-1]->progress_status == '0')
                                                    <td class="bg-warning">
                                                        On Progress Resampling
                                                    </td>
                                                @else
                                                    @if ($analisaMikroResampling55[count($analisaMikroResampling55)-1]->analisa_mikro_status == '1')
                                                        <td class="bg-sucess">
                                                            Mikro Resampling OK
                                                        </td>
                                                    @else
                                                        <td class="bg-danger">
                                                            Mikro Resampling #OK
                                                        </td>
                                                    @endif
                                                @endif
                                            @elseif(is_null($palet->analisa_mikro_55_status)) 
                                                <td>
                                                    Analisa Mikro Belum Dilakukan
                                                </td>
                                            @endif
                                            @if (is_null($palet->cppDetail->cppHead->analisaKimia))
                                                <td>Analisa Kimia Belum Dilakukan</td>
                                            @else
                                                @if ($palet->cppDetail->cppHead->analisaKimia->progress_status == '0')
                                                    <td class="bg-warning">
                                                        On Progress Analisa
                                                    </td>
                                                @else
                                                    @if ($palet->cppDetail->cppHead->analisaKimia->analisa_kimia_status == '0')
                                                        @switch($palet->cppDetail->cppHead->analisaKimia->ppq->status_akhir)
                                                            @case('0')
                                                                <td style="bg-warning">
                                                                    Analisa Kimia #OK - Draft PPQ
                                                                </td>
                                                            @break
                                                            @case('1')
                                                                <td style="bg-warning">
                                                                    Analisa Kimia #OK - On Progress PPQ
                                                                </td>
                                                            @break
                                                            
                                                            @case('2')
                                                                <td style="bg-warning">
                                                                    Analisa Kimia #OK - On Progress PPQ
                                                                </td>
                                                            @break
                                                                
                                                        @endswitch
                                                    @else
                                                        <td class="bg-sucess">
                                                            OK
                                                        </td>
                                                    @endif
                                                @endif
                                            @endif
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Tanggal Produksi</th>
                                <th>Nomor WO</th>
                                <th>Nomor Lot</th>
                                <th >Tanggal Selesai Filling</th>
                                <th>Mesin Filling</th>
                                <th>Brand</th>
                                <th class="filter-search">Mikro 30</th>
                                <th>Mikro 55</th>
                                <th>Kimia</th>
                                <th>Sortasi</th>
                                <th>PPQ</th>
                                <th>Estimasi Release</th>
                                <th>Status Mutu Akhir FG</th>
                                <th>Referensi Bar</th>
                                <th>Tanggal Bar</th>
                                <th>Keterangan</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection