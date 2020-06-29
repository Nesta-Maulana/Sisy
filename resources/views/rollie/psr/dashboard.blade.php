@extends('layouts.app')
@section('title')
    PSR Produk
@endsection
@section('menu-open-data-proses')
    menu-open
@endsection

@section('active-rollie-process-data-psr') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Permintaan Sampel RTD
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Produksi</th>
                                <th>Nomor Wo</th>
                                <th>Kode Batch 1</th>
                                <th>Kode Batch 2</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Sampel</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($draftPsr as $woNumber)
                                <tr>
                                    <td>
                                        <button class="btn-primary btn">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>{{ $woNumber->production_realisation_date }}</td>
                                    <td>{{ $woNumber->wo_number }}</td>
                                    @if (count($woNumber->cppDetails) == 1)
                                        @if ($woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'A3CF B' || $woNumber->cppDetails[0]->fillingMachine->filling_machine_code == 'TPA A')
                                            <td>{{ $woNumber->cppDetails[0]->lot_number }}</td>
                                            <td>-</td>
                                        @else
                                            <td>-</td>
                                            <td>{{ $woNumber->cppDetails[0]->lot_number }}</td>
                                            
                                        @endif
                                    @else
                                        @foreach ($woNumber->cppDetails as $cppDetails)
                                            <td>{{ $cppDetails->lot_number }}</td>
                                        @endforeach
                                    @endif
                                    <td>{{ $woNumber->product->oracle_code }}</td>
                                    <td>{{ $woNumber->product->product_name }}</td>
                                    <td>{{ $woNumber->jumlah_psr }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection