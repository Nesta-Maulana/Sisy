<div class="modal fade" id="tambahPiSampelModal" tabindex="-1" role="dialog" aria-labelledby="tambahPiSampelModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="tambahPiSampelModalLabel">Tambah Sampel Analisa</h5>
                <button type="button" id="close-button" class="close text-white" data-dismiss="modal" aria-label="Close" onclick="hapusDataPopupTambahSampel()" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row" id="nomor_wo_sampel_div">
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <label for="nomor_wo_sampel">Nomor Wo / Batch</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <select name="nomor_wo_sampel" id="nomor_wo_sampel" class="select form-control"  required="true" >
                                    <option selected disabled value="">Pilih Wo</option>
                                    @php
                                        $batchke        = 1;
                                        $hitungbatch    = count($rpdFillingHead->woNumbers);  
                                    @endphp

                                    @if (count($rpdFillingHead->rpdFillingDetailPis) == 0)
                                        @foreach ($rpdFillingHead->woNumbers as $wo_number)  
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($wo_number->id) }}" @if ($wo_number->id === $rpdFillingHead->woNumbers[$hitungbatch-1]->id)
                                                selected
                                            @endif>Batch Ke {{ $batchke }} - {{ $wo_number->wo_number }}</option>
                                        @php $batchke++; @endphp 
                                        @endforeach                        
                                    @else
                                        @foreach ($rpdFillingHead->woNumbers as $wo_number)  
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($wo_number->id) }}" 
                                            @if ($wo_number->id === $rpdFillingHead->woNumbers[$hitungbatch-1]->id)
                                                selected
                                            @endif>
                                                Batch Ke {{ $batchke }} - {{ $wo_number->wo_number }}</option>
                                            @php $batchke++; @endphp 
                                        
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2" id="mesin_filling_sampel_div">
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <label for="mesin_filling_sampel">Mesin Filling</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <select name="mesin_filling_sampel" id="mesin_filling_sampel" class="select form-control" style="padding: 0 .8rem;" required="true" onchange="getFillingSampel();">
                                    @if ($rpdFillingHead->woNumbers[0]->product->fillingMachineGroupHead->filling_machine_group_name == 'Prisma')
                                        @foreach ($rpdFillingHead->woNumbers[0]->product->fillingMachineGroupHead->fillingMachineGroupDetails as $fillingMachineGroupDetail)
                                            <option value="cek" selected disabled>Pilih Mesin Filling</option>
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($fillingMachineGroupDetail->fillingMachine->id) }}">{{ $fillingMachineGroupDetail->fillingMachine->filling_machine_code }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled value="">Pilih Mesin Filling</option>
                                        @foreach ($rpdFillingHead->woNumbers[0]->product->fillingMachineGroupHead->fillingMachineGroupDetails as $fillingMachineGroupDetail)
                                            <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($fillingMachineGroupDetail->fillingMachine->id) }}">{{ $fillingMachineGroupDetail->fillingMachine->filling_machine_code }}</option>
                                        @endforeach
                                    @endif
                                </select>    
                            </div>
                        </div>
                        <div class="row mt-2" id="kode_sampel_analisa_div">
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <label for="kode_sampel_analisa" >Kode Analisa</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <select name="kode_sampel_analisa" id="kode_sampel_analisa" class="select form-control" style="padding: 0 .8rem;" required="true" onchange="checkFillingSampel()">
                                    <option selected disabled value="0">Pilih Kode Sampel</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2" id="tanggal_filling_sampel_div">
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <label for="tanggal_filling_sampel">Tanggal Filling</label>    
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <div class='input-group date datepickernya' style="padding-left:0px;">
                                    <input type='text' class="form-control" name="tanggal_filling_sampel" id="tanggal_filling_sampel" value="<?=date('Y-m-d')?>">
                                    <span class="input-group-addon" style="margin-top: 5px; font-size: 20px; margin-left: 10px;">
                                        <span class="fas fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-2" id="jam_filling_sampel_div">
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <label for="jam_filling_sampel">Jam Filling</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <div class='input-group date timepickernya'  style="padding-left: 0px;">
                                    <input type='text' class="form-control" name="jam_filling_sampel" id="jam_filling_sampel" value="">
                                    <span class="input-group-addon" style="margin-top: 5px; font-size: 20px; margin-left: 10px;">
                                       <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>                        
                            </div>
                        </div>

                        <div class="row mt-2" id="event_sampel_div">
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <label for="event_sampel">Keterangan Event</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <select name="event_sampel" id="event_sampel" class="select form-control"  onchange="checkFillingSampel()">
                                    <option value="0"># Event</option>
                                    <option value="1">Event</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2" id="berat_kanan_div">
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <label for="berat_kanan_sampel">Berat Kanan</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <input type="number" name="berat_kanan_sampel" id="berat_kanan_sampel" class="form-control" maxlength="6" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                                <small class="form-text  text-muted text-warning" >Desimal 2 angka dibelakang koma contoh : 222.30</small>
                            </div>
                        </div>
                        <div class="row mt-2" id="berat_kiri_div">
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <label for="berat_kiri_sampel">Berat Kiri</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <input type="number" name="berat_kiri_sampel" id="berat_kiri_sampel" class="form-control " maxlength="6" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                                <small class="form-text text-muted">Desimal 2 angka dibelakang koma contoh : 222.30</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4"></div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <button class="btn btn-outline-secondary form-control" data-dismiss="modal"  onclick="hapusDataPopupTambahSampel()" >Cancel</button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <button class="btn btn-primary form-control" onclick="tambahSampelAnalisa($('#nomor_wo_sampel').val(),$('#mesin_filling_sampel').val(),$('#tanggal_filling_sampel').val(),$('#jam_filling_sampel').val(),$('#kode_sampel_analisa').val(),$('#event_sampel').val(),$('#berat_kanan_sampel').val(),$('#berat_kiri_sampel').val(),'{{ app('App\Http\Controllers\ResourceController')->encrypt(Auth::user()->id) }}',$('#rpd_filling_head_id').val())" id="save_to_draft_pi">
                            Save To Draft
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>