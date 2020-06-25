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
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header bg-dark">
                    Export Data RPR
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Filter Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="filter_tanggal">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="product_name">Nama Produk</label>
                                <select name="product_name" id="product_name" class="form-control select2 select " style="width: 100%;height: calc(1.5em + .75rem + 2px);">
                                    <option value="all" selected>All product</option>
                                    @foreach ($woNumbers->unique('product_id') as $woNumber)
                                    <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($woNumber->id) }}">{{ $woNumber->product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header bg-dark">
                    Upload Data BAR
                </div>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam blanditiis vero eum earum! Vel quod iste inventore totam. Dolores vero excepturi ad velit consequuntur quaerat eaque consectetur illum modi voluptate?
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
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
                                <th style="width: 500px">PPQ</th>
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
                                        @php
                                            $status_mutu_fg = '';
                                        @endphp
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
                                                    @php
                                                        $status_mutu_fg = 'On Progress';
                                                    @endphp
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
                                                @php
                                                    $status_mutu_fg = 'On Progress';
                                                @endphp
                                            @endif

                                            @if ($palet->cppDetail->woNumber->product->productType->product_type =='Susu')
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
                                                        @php
                                                            $status_mutu_fg = 'On Progress';
                                                        @endphp
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
                                                    @php
                                                        $status_mutu_fg = 'On Progress';
                                                    @endphp
                                                @endif
                                            @else
                                                <td>
                                                    -
                                                </td>
                                            @endif
                                            @if (is_null($palet->cppDetail->cppHead->analisaKimia))
                                                <td>Analisa Kimia Belum Dilakukan</td>
                                            @else
                                                @if (is_null($palet->cppDetail->cppHead->analisaKimia->ppq->palets->where('palet_id',$palet->id)->first()))
                                                    <td class="bg-success">OK</td>
                                                @else
                                                    @if ($palet->cppDetail->cppHead->analisaKimia->progress_status == '0')
                                                        <td class="bg-warning">
                                                            On Progress Analisa
                                                        </td>
                                                    @else
                                                        @if ($palet->cppDetail->cppHead->analisaKimia->analisa_kimia_status == '0')
                                                            @switch($palet->cppDetail->cppHead->analisaKimia->ppq->status_akhir)
                                                                @case('0')
                                                                    @php
                                                                        $status_mutu_fg = 'On Progress';
                                                                    @endphp
                                                                    <td class="bg-warning">
                                                                        Analisa Kimia #OK {{ $palet->cppDetail->cppHead->analisaKimia->ppq->alasan }} - Draft PPQ
                                                                    </td>
                                                                @break
                                                                @case('1')
                                                                    @php
                                                                        $status_mutu_fg = 'On Progress';
                                                                    @endphp
                                                                    <td class="bg-warning">
                                                                        Analisa Kimia #OK {{ $palet->cppDetail->cppHead->analisaKimia->ppq->alasan }} - On Progress PPQ
                                                                    </td>
                                                                @break
                                                                
                                                                @case('2')
                                                                    @switch($palet->cppDetail->cppHead->analisaKimia->ppq->followUpPpq->status_produk)
                                                                        @case('0')
                                                                            <td class="bg-danger">
                                                                                Analisa Kimia #OK {{ $palet->cppDetail->cppHead->analisaKimia->ppq->alasan }} - Reject 
                                                                            </td>    
                                                                        @break
                                                                        @case('1')
                                                                            <td class="bg-success">
                                                                                Analisa Kimia #OK {{ $palet->cppDetail->cppHead->analisaKimia->ppq->alasan }} - Release 
                                                                            </td>    
                                                                        @break                                                                       
                                                                        
                                                                        @case('2')
                                                                            <td class="bg-warning">
                                                                                Analisa Kimia #OK {{ $palet->cppDetail->cppHead->analisaKimia->ppq->alasan }} - Release Partial 
                                                                            </td>    
                                                                        @break                                                                       
                                                                    @endswitch
                                                                @break     
                                                            @endswitch
                                                        @else
                                                            <td class="bg-sucess">
                                                                OK
                                                            </td>
                                                        @endif
                                                    @endif

                                                @endif
                                            @endif
                                            <td>-</td>
                                            <td>
                                            @foreach ($palet->paletPpqs as $paletPpq)
                                                @switch($paletPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq)
                                                    @case('Package Integrity')
                                                        {{ $paletPpq->ppq->nomor_ppq.' - '.$paletPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq.' - '.$paletPpq->ppq->alasan }} <br>
                                                    @break
                                                    @case('Kimia')
                                                        {{ $paletPpq->ppq->nomor_ppq.' - '.$paletPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq.' - '.$paletPpq->ppq->alasan }} <br>
                                                    @break
                                                @endswitch
                                            @endforeach
                                            </td>
                                            <td>
                                                <?php
                                                        $tanggalfilling = $palet->end;
                                                        $sla = "+".$woNumber->product->sla." day";
                                                        $tanggalestimasi = strtotime($sla,strtotime($tanggalfilling));
                                                        echo date('Y-m-d',$tanggalestimasi);
                                                 ?>
                                            </td>
                                                @switch($status_mutu_fg)
                                                    @case('')
                                                        <td class="bg-success">OK</td>
                                                    @break
                                                    @case('On Progress')
                                                        <td class="bg-warning">On Progress Analisa</td>
                                                    @break
                                                @endswitch
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
@section('extract-plugin-footer')
    <link rel="stylesheet" href="{{ asset('datetime-picker/css/daterangepicker.css') }}">
    <script type="text/javascript" src="{{ asset('datetime-picker/js/moment2.min.js') }}"></script>
    <script src="{{ asset('datetime-picker/js/daterangepicker.js') }}"></script>
    <script>
        $('#filter_tanggal').daterangepicker();
    </script>
@endsection