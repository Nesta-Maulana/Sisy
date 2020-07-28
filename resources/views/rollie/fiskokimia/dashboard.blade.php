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
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    List Draft Analisa Fisikokimia Produk Jadi
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="fisikokimia-dashboard-table">
                        <thead>
                            <tr>
                                <th style="width:30px">#</th>
                                <th style="width:300px"> Nama Produk </th>
                                <th style="width:200px"> Tanggal Produksi</th>
                                <th style="width:180px"> Nomor Wo </th>
                                <th style="width:160px"> Status Analisa Kimia </th>
                                <th style="width:100px">Mesin Filling</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cppHeads as $cppHead)
                                @php
                                    $wo_number          = '';
                                    $mesin_filling      = '';
                                    $tanggal_produksi   ='';
                                @endphp
                                @foreach ($cppHead->woNumbers as $woNumber)
                                    @php
                                        $wo_number      .= $woNumber->wo_number.',';
                                        if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                        {
                                            $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                        }
                                    @endphp
                                @endforeach
                                @foreach ($cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails as $fillingMachineGroupDetail)
                                    @php
                                        if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                        {
                                            $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                        }
                                    @endphp
                                @endforeach
                                <tr style="background-color:#ffa6bb;">
                                    <td>
                                        <button onclick="analisaFisikokimiaProduk('{{ $params }}','{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id) }}','{{ $cppHead->product->product_name }}','{{ rtrim($tanggal_produksi,', ') }}')" class="btn btn-primary">
                                            <i class="fas fa-file-signature"></i>
                                        </button>
                                    </td>
                                    <td>{{ $cppHead->woNumbers[0]->product->product_name }}</td>
                                    <td>{{ rtrim($tanggal_produksi,', ') }}</td>
                                    <td>{{ rtrim($wo_number,', ') }}</td>
                                    <td>Belum Analisa</td>
                                    <td>{{ rtrim($mesin_filling,', ') }}</td>
                                </tr>
                            @endforeach
                            @if (!is_null($draftAnalisas))
                                @foreach ($draftAnalisas as $draftAnalisa)
                                    @php
                                        $wo_number          = '';
                                        $mesin_filling      = '';
                                        $tanggal_produksi   ='';
                                    @endphp
                                    @foreach ($draftAnalisa->cppHead->woNumbers as $woNumber)
                                    @php
                                        $wo_number      .= $woNumber->wo_number.',';
                                        if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                        {
                                            $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                        }
                                    @endphp
                                    @endforeach
                                    @foreach ($draftAnalisa->cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails as $fillingMachineGroupDetail)
                                        @php
                                            if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                            {
                                                $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                            }
                                        @endphp
                                    @endforeach
                                    <tr class="bg-warning">
                                        <td>
                                            <button onclick="document.location.href='fisiko-kimia-form/{{ app('App\Http\Controllers\ResourceController')->encrypt($draftAnalisa->id) }}/{{ $params }}'" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                        <td>{{ $draftAnalisa->cppHead->woNumbers[0]->product->product_name }}</td>
                                        <td>{{ rtrim($tanggal_produksi,', ') }}</td>
                                        <td>{{ rtrim($wo_number,', ') }}</td>
                                        <td>Draft Analisa</td>
                                        <td>{{ rtrim($mesin_filling,', ') }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            @if ($params == app('App\Http\Controllers\ResourceController')->encrypt("fiskokimias_qc_penyelia"))
                                @if (!is_null($draftTsOven))
                                    @foreach ($draftTsOven as $draftAnalisa)
                                        @php
                                            $wo_number          = '';
                                            $mesin_filling      = '';
                                            $tanggal_produksi   ='';
                                        @endphp
                                        @foreach ($draftAnalisa->cppHead->woNumbers as $woNumber)
                                        @php
                                            $wo_number      .= $woNumber->wo_number.',';
                                            if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                            {
                                                $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                            }
                                        @endphp
                                        @endforeach
                                        @foreach ($draftAnalisa->cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails as $fillingMachineGroupDetail)
                                            @php
                                                if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                                {
                                                    $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                                }
                                            @endphp
                                        @endforeach
                                        <tr class="bg-warning">
                                            <td>
                                                <button onclick="document.location.href='fisiko-kimia-form/{{ app('App\Http\Controllers\ResourceController')->encrypt($draftAnalisa->id) }}/{{ $params }}'" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                            <td>{{ $draftAnalisa->cppHead->woNumbers[0]->product->product_name }}</td>
                                            <td>{{ rtrim($tanggal_produksi,', ') }}</td>
                                            <td>{{ rtrim($wo_number,', ') }}</td>
                                            <td>Draft Analisa</td>
                                            <td>{{ rtrim($mesin_filling,', ') }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row mt-3">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5>List Analisa Fisikokimia Produk Jadi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="fisikokimia-dashboard-done-table"  >
                        <thead>
                            <tr>
                                <th scope="col" style="width:250px" > Nama Produk </th>
                                <th scope="col" style="width:200px"> Tanggal Produksi</th>
                                <th scope="col" style="width:200px"> Nomor Wo </th>
                                <th scope="col" style="width:200px"> Mesin Filling</th>
                                <th scope="col" style="width:200px"> Status Analisa Kimia</th>
                                <th scope="col" style="width:200px"> #</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doneAnalisa as $analisaKimia)
                                @php
                                    $wo_number          = '';
                                    $mesin_filling      = '';
                                    $tanggal_produksi   ='';
                                @endphp
                                @foreach ($analisaKimia->cppHead->woNumbers as $woNumber)
                                @php
                                    $wo_number      .= $woNumber->wo_number.',';
                                    if ($woNumber->production_realisation_date.', ' !== $tanggal_produksi) 
                                    {
                                        $tanggal_produksi .= $woNumber->production_realisation_date.', ';
                                    }
                                @endphp
                                @endforeach
                                @foreach ($analisaKimia->cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails as $fillingMachineGroupDetail)
                                    @php
                                        if ($mesin_filling !==  $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ') 
                                        {
                                            $mesin_filling      .= $fillingMachineGroupDetail->fillingMachine->filling_machine_code.', ';
                                        }
                                    @endphp
                                @endforeach
                                <tr>
                                    <td>{{ $analisaKimia->cppHead->woNumbers[0]->product->product_name }}</td>
                                    <td>{{ rtrim($tanggal_produksi,', ') }}</td>
                                    <td>{{ rtrim($wo_number,', ') }}</td>
                                    <td>{{ rtrim($mesin_filling,', ') }}</td>
                                    <td>
                                        @if ($analisaKimia->analisa_kimia_status == '1')
                                            OK
                                        @else
                                            {{ $analisaKimia->cppHead->ppq->alasan }} 
                                        @endif
                                    </td>
                                    <td>
                                        <button onclick="document.location.href='fisiko-kimia-form/{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaKimia->id) }}/{{ $params }}'" class="btn btn-primary">Lihat Hasil Analisa</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
