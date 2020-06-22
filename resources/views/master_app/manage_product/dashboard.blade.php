@extends('layouts.app')
@section('title')
    Data Produk
@endsection
@section('menu-open-master-data') 
    active menu-open
@endsection
@section('active-master-app-master-data-manage-products') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Kelola Data Produk
                </div>
                <div class="card-body">
                    <form action="kelola-produk" method="POST">
                        {{ csrf_field() }}
                        <input  type="hidden" class="form-control" id="product_id" name="product_id">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="product_name">Nama Produk</label>
                                    <input required="true" autocomplete="off" type="text" class="form-control" id="product_name" name="product_name">
                                </div>
                                <div class="form-group">
                                    <label for="oracle_code">Kode Oracle</label>
                                    <input required="true" autocomplete="off" type="text" class="form-control" id="oracle_code" name="oracle_code">
                                </div>
                                <div class="form-group">
                                    <label for="subbrand_id">Brand</label>
                                    <select name="subbrand_id" id="subbrand_id" class="form-control">
                                        <option value="id" selected disabled>-- Pilih Brand -- </option>
                                        @foreach ($subbrands as $subbrand)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($subbrand->id) }}">{{ $subbrand->subbrand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_type_id">Jenis Produk</label>
                                    <select name="product_type_id" id="product_type_id" class="form-control">
                                        <option value="id" selected disabled>-- Pilih Jenis Produk -- </option>
                                        @foreach ($productTypes as $productType)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($productType->id) }}">{{ $productType->product_type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="filling_machine_group_head_id">Jenis Pack</label>
                                    <select name="filling_machine_group_head_id" id="filling_machine_group_head_id" class="form-control">
                                        <option value="id" selected disabled>-- Pilih Jenis Pack -- </option>
                                        @foreach ($fillingMachineGroups as $fillingMachineGroup)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($fillingMachineGroup->id) }}">{{ $fillingMachineGroup->filling_machine_group_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="expired_range">Expired Range (dalam bulan) </label>
                                    <input required="true" autocomplete="off" type="text" name="expired_range" class="form-control" id="expired_range" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="2">
                                </div>
                                <div class="form-group">
                                    <label for="trial_code">Trial Code </label>
                                    <input required="true" autocomplete="off" type="text" name="trial_code" class="form-control" id="trial_code">
                                </div>
                                <div class="form-group">
                                    <label for="sla">SLA (dalam hari) </label>
                                    <input required="true" autocomplete="off" type="text" name="sla" class="form-control" id="sla" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="2">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="spek_ts_min">Spek TS Min </label>
                                    <input required="true" autocomplete="off" type="text" name="spek_ts_min" class="form-control" id="spek_ts_min" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="spek_ts_max">Spek TS Max </label>
                                    <input required="true" autocomplete="off" type="text" name="spek_ts_max" class="form-control" id="spek_ts_max" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="spek_ph_min">Spek pH Min </label>
                                    <input required="true" autocomplete="off" type="text" name="spek_ph_min" class="form-control" id="spek_ph_min" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="spek_ph_max">Spek pH Max </label>
                                    <input required="true" autocomplete="off" type="text" name="spek_ph_max" class="form-control" id="spek_ph_max" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_analisa_mikro">Waktu Analisa Mikro (dalam hari) </label>
                                    <input required="true" autocomplete="off" type="text" name="waktu_analisa_mikro" class="form-control" id="waktu_analisa_mikro" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="2">
                                </div>

                                <div class="form-group">
                                    <label for="inkubasi">Waktu Inkubasi (dalam hari) </label>
                                    <input required="true" autocomplete="off" type="text" name="inkubasi" class="form-control" id="inkubasi" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47" maxlength="2">
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status Produk</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="id" selected disabled>-- Pilih Status Produk -- </option>
                                        <option value="1" >Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" id="button_simpan">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <input type="submit" class="btn btn-primary form-control" value="Simpan Produk Baru">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_update">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <input type="submit" class="btn btn-primary form-control" value="Update Data Produk">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 hidden" id="button_batal">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            
                                            <a class="btn btn-outline-secondary form-control" href="">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Produk
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <table class="table table-bordered" id="product-data-table">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Brand</th>
                                        <th style="width: 100px">Jenis Produk</th>
                                        <th style="width: 250px">Nama Produk</th>
                                        <th style="width: 150px">Kode Oracle</th>
                                        <th style="width: 100px">Spek Ts Min</th>
                                        <th style="width: 100px">Spek Ts Max</th>
                                        <th style="width: 100px">Spek pH Min</th>
                                        <th style="width: 120px">Spek pH Max</th>
                                        <th style="width: 200px">SLA <br>( Dalam Hari )</th>
                                        <th style="width: 200px">Waktu Analisa Mikro <br>( Dalam Hari )</th>
                                        <th style="width: 200px">Waktu Inkubasi <br>( Dalam Hari )</th>
                                        <th style="width: 150px">Trial Code</th>
                                        <th style="width: 200px">Expired Range <br>( Dalam Bulan )</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no =1;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <button class="form-control btn btn-outline-primary" onclick="editProductData('{{ app('App\Http\Controllers\ResourceController')->encrypt($product->id) }}')"><i class="fa fa-pencil"></i></button>
                                            </td>
                                            <td>{{ $product->subbrand->subbrand_name }}</td>
                                            <td>{{ $product->productType->product_type }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->oracle_code }}</td>
                                            <td>{{ $product->spek_ts_min }}</td>
                                            <td>{{ $product->spek_ts_max }}</td>
                                            <td>{{ $product->spek_ph_min }}</td>
                                            <td>{{ $product->spek_ph_max }}</td>
                                            <td>{{ $product->sla }}</td>
                                            <td>{{ $product->waktu_analisa_mikro }}</td>
                                            <td>{{ $product->inkubasi }}</td>
                                            <td>{{ $product->trial_code }}</td>
                                            <td>{{ $product->expired_range }}</td>
                                        </tr>
                                    @php
                                        $no++
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection