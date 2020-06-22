@extends('layouts.app')
@section('title')
    {{ $form }} | PPQ Produk |  {{ $product_name }}
@endsection
@section('menu-open-'.$parent_menu)
    menu-open
@endsection

@section('active-rollie-'.$route) 
    active 
@endsection
@section('content')
 <div class="row">
    <div class="col-lg-12">
        <form action="/rollie/{{ explode('/', \Request::getRequestUri())[2] }}/form/input-ppq" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="jenis_ppq" value="{{ $jenisPpq->id }}">
            <input type="hidden" name="params" value="{{ $params }}">
            @if ($jenisPpq->jenis_ppq == 'Package Integrity')
                <input type="hidden" name="rpd_filling_detail_pi_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($activeVariable->id) }}">
            @elseif($jenisPpq->jenis_ppq == 'Kimia')
                <input type="hidden" name="cpp_head_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($palets[0]->cppDetail->cppHead->id) }}">
            @endif
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="">Nomor PPQ</label>
                        <input type="text" class="form-control" name="nomor_ppq" readonly="true" placeholder="Nomor PPQ" value="{{ $nomor_ppq }}">
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Wo</label>
                        <input type="text" name="wo_number" value="{{ $wo_number }}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" name="product_name" value="{{ $product_name }}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kode Oracle</label>
                        <input type="text" class="form-control" name="oracle_code" readonly="true" placeholder="Kode Oracle" value="{{ $oracle_code }}">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Produksi</label>
                        <input type="text" name="tanggal_produksi" value="{{ $production_realisation_date }}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Mesin Filling</label>
                        <input type="text" name="filling_machine" value="{{ $filling_machine_code }}" readonly class="form-control">
                        <input type="hidden" name="mesin_filling_id" value="{{$filling_machine_id}}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nomor LOT</label>
                        @if (!is_null($palets))
                            <input type="text" class="form-control" name="nomor_lot" value="@foreach ($palets as $palet){{  $palet->cppDetail->lot_number }}-{{ $palet->palet }}, @endforeach" readonly>
                        @else
                            <textarea class="form-control text-white" style="background-color: red" name="nomor_lot" cols="30" rows="2" readonly>Palet belum tersedia, harap hubungi tim packing untuk segera mengisi form packing dan memisahkan pack PPQ</textarea>
                        @endif
                        
                        @if (!is_null($palets))
                        	<input type="hidden" class="form-control" name="nomor_lot_id" value="@foreach ($palets as $palet){{ app('App\Http\Controllers\ResourceController')->encrypt($palet->id) }},@endforeach">
                        @else
                        	<input type="hidden" class="form-control" name="nomor_lot_id" value="0">
                        @endif
                    </div> 
                    <div class="form-group">
                        <label for="">Jumlah (pack) : </label>
                        @if ($jumlahpack !== 0)                        
                            <input type="text" class="form-control" name="jumlah_pack" value="{{ $jumlahpack }}">
                        @else
                            <textarea class="form-control text-white" style="background-color: red" cols="30" rows="2" readonly>Jumlah Pack belum tersedia, harap hubungi tim packing untuk segera mengisi jumlah pack pada form packing dan memisahkan pack PPQ</textarea>
                            <input type="hidden" class="form-control" name="jumlah_pack" value="0">

                        @endif
                    </div>

                    <div class="form-group">
                        <label for="jenis_ppq">Jenis PPQ :</label>
                        <input type="text" class="form-control" value="{{ $jenisPpq->jenis_ppq }}" name="jenis_ppq_keterangan" id="jenis_ppq_keterangan" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="">Tanggal PPQ FG</label>
                        <input type="text" name="tanggal_ppq" value="{{ date('Y-m-d') }}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Jam Filling Awal PPQ : </label>
                        <input type="text" class="form-control" name="jam_filling_mulai"    placeholder="Jam Filiing Awal" value="{{ $jam_filling_mulai }} "readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jam Filling Akhir PPQ : </label>
                        <input type="text" class="form-control"  name="jam_filling_akhir" value="{{ $jam_filling_akhir }} "readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Alasan PPQ : </label>
                        <textarea class="form-control" {{-- inputmode="url" --}} name="alasan_ppq" rows="3" @if ($jenisPpq->jenis_ppq == 'Kimia') readonly @endif required>{{$alasan_ppq}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Detail Titik PPQ : </label>
                        <textarea class="form-control" name="detail_titik_ppq" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori PPQ : </label>
                        <select name="kategori_ppq_value" class="form-control" name="kategori_ppq_value" required>
                            <option value="" selected disabled> Pilih Kategori PPQ </option>
                            @foreach ($kategoriPpqs as $kategoriPpq)
                                <option value="{{ $kategoriPpq->id }}"> {{ $kategoriPpq->kategori_ppq }} </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">PIC Input: </label>
                        <input type="text" class="form-control" value="{{ Auth::user()->employee->fullname }}" readonly>
                    </div>
                    <div class="form-group" style="margin-top: 2.5rem">
                        @if (is_null($palets))
                        	<button class="btn btn-primary form-control">Buat Draft PPQ</button>
                        @else
                        	<button class="btn btn-primary form-control">Buat PPQ</button>
                        @endif

                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div> 

@endsection