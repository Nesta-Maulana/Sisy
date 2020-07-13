{{-- @extends('layouts.app')
@section('title')
    Report Rekapitulasi Data Filling
@endsection
@section('menu-open-report')
    menu-open
@endsection
@section('active-rollie-reports-rpd-filling') 
    active 
@endsection
@section('content')
<table class="table table-bordered text-center" id="report-rpd-filling">
    <thead>
        <tr>
            <th class="no-wrap">Nomor Wo</th>
            <th style="width: 300px">Nama Produk</th>
            <th style="width: 135px">Tanggal Produksi</th>
            <th style="width: 100px">Mesin Filling</th>
            <th style="width: 100px">Sampel</th>
            <th style="width: 120px">Tanggal Filling</th>
            <th style="width: 100px">Jam Filling</th>
            <th style="width: 100px"> Berat Kanan </th> 
            <th style="width: 80px"> Berat Kiri </th> 
            <th style="width: 100px"> Overlap </th> 
            <th style="width: 150px"> Ls Sa Proportion </th> 
            <th style="width: 120px"> Volume Kanan </th> 
            <th style="width: 100px"> Volume Kiri </th> 
            <th style="width: 100px"> Airgap </th> 
            <th style="width: 140px"> Ts Accurate Kanan </th> 
            <th style="width: 135px"> Ts Accurate Kiri </th> 
            <th style="width: 100px"> Ls Accurate </th> 
            <th style="width: 100px"> Sa Accurate </th> 
            <th style="width: 120px"> Surface Check </th> 
            <th style="width: 100px"> Pinching </th> 
            <th style="width: 100px"> Strip Folding </th> 
            <th style="width: 150px"> Konduktivity Kanan </th> 
            <th style="width: 150px"> Konduktivity Kiri </th> 
            <th style="width: 130px"> Design Kanan </th> 
            <th style="width: 100px"> Design Kiri </th> 
            <th style="width: 100px"> Dye Test </th> 
            <th style="width: 100px"> Residu H2o2 </th> 
            <th style="width: 180px"> Prod Code and No Md </th> 
            <th style="width: 100px"> Correction </th> 
            <th style="width: 130px"> Dissolving Test </th> 
            <th style="width: 100px"> Status Akhir </th> 
        </tr>
    </thead>
    <tbody id="isi-report-rpd-filling">
        @foreach ($rpdHeads as $rpdHead)
            @foreach ($rpdHead->rpdFillingDetailPis as $rpdFillingDetail)
                 <tr>
                     <td>{{ $rpdFillingDetail->woNumber->wo_number }}</td>
                     <td>{{ $rpdFillingDetail->woNumber->product->product_name }}</td>
                     <td>{{ $rpdFillingDetail->woNumber->production_realisation_date }}</td>
                     <td>{{ $rpdFillingDetail->fillingMachine->filling_machine_code }}</td>
                     <td>{{ $rpdFillingDetail->fillingSampelCode->filling_sampel_code.' - '.$rpdFillingDetail->fillingSampelCode->filling_sampel_event }}</td>
                     <td>{{ $rpdFillingDetail->filling_date }}</td>
                     <td>{{ $rpdFillingDetail->filling_time }}</td>
                     <td>{{ $rpdFillingDetail->berat_kanan }}</td>
                     <td>{{ $rpdFillingDetail->berat_kiri }}</td>
                     <td>{{ $rpdFillingDetail->overlap }}</td>
                     <td>{{ $rpdFillingDetail->ls_sa_proportion }}</td>
                     <td>{{ $rpdFillingDetail->volume_kanan }}</td>
                     <td>{{ $rpdFillingDetail->volume_kiri }}</td>
                     <td>{{ $rpdFillingDetail->airgap }}</td>
                     <td>{{ $rpdFillingDetail->ts_accurate_kanan }}</td>
                     <td>{{ $rpdFillingDetail->ts_accurate_kiri }}</td>
                     <td>{{ $rpdFillingDetail->ls_accurate }}</td>
                     <td>{{ $rpdFillingDetail->sa_accurate }}</td>
                     <td>{{ $rpdFillingDetail->surface_check }}</td>
                     <td>{{ $rpdFillingDetail->pinching }}</td>
                     <td>{{ $rpdFillingDetail->strip_folding }}</td>
                     <td>{{ $rpdFillingDetail->konduktivity_kanan }}</td>
                     <td>{{ $rpdFillingDetail->konduktivity_kiri }}</td>
                     <td>{{ $rpdFillingDetail->design_kanan }}</td>
                     <td>{{ $rpdFillingDetail->design_kiri }}</td>
                     <td>{{ $rpdFillingDetail->dye_test }}</td>
                     <td>{{ $rpdFillingDetail->residu_h2o2 }}</td>
                     <td>{{ $rpdFillingDetail->prod_code_and_no_md }}</td>
                     <td>{{ $rpdFillingDetail->correction }}</td>
                     <td>
                         @if (is_null($rpdFillingDetail->dissolving_test))
                         -
                         @else
                         {{ $rpdFillingDetail->dissolving_test }}
                         @endif
                     </td>
                     <td>{{ $rpdFillingDetail->status_akhir }}</td>
                 </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection
@section('extract-plugin-footer')
    
    <link rel="stylesheet" href="{{ asset('datetime-picker/css/daterangepicker.css') }}">
    <script type="text/javascript" src="{{ asset('datetime-picker/js/moment2.min.js') }}"></script>
    <script src="{{ asset('datetime-picker/js/daterangepicker.js') }}"></script>
    <script>
        $('#filter_tanggal').daterangepicker({
            startDate: new Date(new Date().getFullYear(), 0, 1),
            endDate: new Date(),
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    </script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.3/xlsx.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.2/dist/FileSaver.min.js"></script>
    <script>
        var wb = XLSX.utils.table_to_book(document.getElementById('report-rpd-filling'), {sheet:"Sheet JS"});
        wb[['!cols'].push({ width: 9 })]
        var wbout = XLSX.write(wb, {bookType:'xlsx', bookSST:true, type: 'binary'});

        function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                return buf;
            }
            
        $(document).ready(function() { 
            saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'test.xlsx');
            setInterval(function() { window.close(); }, 1000);
 
        });


    </script>
@endsection  --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Rpd Filling</title>
    <style>
        .thead
        {
            font-size: 13px;
            background-color: darkgrey;
        }
    </style>
</head>
<body>
    <table class="table table-bordered text-center" id="report-rpd-filling">
        <thead>
            <tr>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Nomor&nbsp;&nbsp;&nbsp;&nbsp;Wo</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Nama Produk</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Tanggal Produksi</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Mesin Filling</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Sampel</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Tanggal Filling</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Jam Filling</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Berat Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Berat Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Overlap </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Ls Sa Proportion </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Volume Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Volume Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Airgap </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Ts Accurate Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Ts Accurate Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Ls Accurate </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Sa Accurate </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Surface Check </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Pinching </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Strip Folding </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Konduktivity Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Konduktivity Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Design Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Design Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Dye Test </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Residu H2o2 </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Prod Code and No Md </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Correction </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Dissolving Test </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Status Akhir </th> 
            </tr>
        </thead>
        <tbody id="isi-report-rpd-filling">
            @foreach ($woNumbers as $woNumber)
                @foreach ($woNumber->rpdFillingHead->rpdFillingDetailPis as $rpdFillingDetail)
                    <tr>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->woNumber->wo_number }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->woNumber->product->product_name }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->woNumber->production_realisation_date }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->fillingMachine->filling_machine_code }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->fillingSampelCode->filling_sampel_code.' - '.$rpdFillingDetail->fillingSampelCode->filling_sampel_event }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->filling_date }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->filling_time }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->berat_kanan }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->berat_kiri }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->overlap }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->ls_sa_proportion }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->volume_kanan }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->volume_kiri }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->airgap }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->ts_accurate_kanan }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->ts_accurate_kiri }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->ls_accurate }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->sa_accurate }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->surface_check }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->pinching }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->strip_folding }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->konduktivity_kanan }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->konduktivity_kiri }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->design_kanan }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->design_kiri }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->dye_test }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->residu_h2o2 }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->prod_code_and_no_md }}</td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->correction }}</td>
                        <td style="border:1px solid black">
                            @if (is_null($rpdFillingDetail->dissolving_test))
                            -
                            @else
                            {{ $rpdFillingDetail->dissolving_test }}
                            @endif
                        </td>
                        <td style="border:1px solid black">{{ $rpdFillingDetail->status_akhir }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>