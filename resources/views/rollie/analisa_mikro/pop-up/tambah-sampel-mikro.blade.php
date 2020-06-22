<div class="modal fade bd-example-modal-lg" id="tambahSampelAnalisaMikro" tabindex="-1" role="dialog" aria-labelledby="tambahSampelAnalisaMikro" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title">Tambah Sampel Analisa Mikro <span id="nama_produk_analisa_at_event"></span></h5>
                <button type="button" id="close-button-at-event" class="close" data-dismiss="modal" onclick="resetPiAtEvent()">
                   <span aria-hidden="true" class="text-white"> &times; </span>
                </button>
            </div>
            <div class="modal-body">
                <form action="tambah-sampel-analisa-mikro" id="form-analisa-mikro" method="POST">
                    {{  csrf_field() }}
                    <input type="hidden" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($analisaMikro->id) }}" name="analisa_mikro_id">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="filling_machine_id">Mesin Filling</label>
                                <select name="filling_machine_id" id="filling_machine_id" class="form-control" onchange="getFillingSampelMikro()" required>
                                    <option value="0" selected disabled>-- Pilih Mesin Filling --</option>
                                    @foreach ($analisaMikro->analisaMikroDetails->unique('filling_machine_id') as $itemMachine)
                                        <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($itemMachine->fillingMachine->id) }}"> {{ $itemMachine->fillingMachine->filling_machine_code }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="kode_sampel_analisa">Kode Sampel Analisa</label>
                                <select name="filling_sampel_code_id" id="kode_sampel_analisa" class="form-control" required>
                                    <option value="0" selected disabled>-- Pilih Kode Sampel PI --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">                            
                            <div class="form-group">
                                <label for="jam_filling_sampel">Jam Filling Sampel</label>
                                <input type="text" class="datetimepickernya form-control" value="" name ="jam_filling_sampel" id="jam_filling_sampel" placeholder="Harap Isi Jam Filling Sampel" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg col-sm col-md">
                            <div class="form-group">
                                <a id="submit" class="form-control btn btn-outline-secondary" name="cancel" data-dismiss="modal"> Batal </a>
                            </div>
                        </div>
                        <div class="col-lg col-sm col-md">
                            <div class="form-group">
                                <a class="form-control btn btn-primary text-white" name="submit" onclick="
                                    Swal.fire({
                                            title       : 'Apakah data yang anda masukan sudah sesuai dengan kode sampel pada fisik yang tertera?',
                                            text        : 'Harap cek kembali inputan anda untuk memastikan semuanya sesuai',
                                            type        : 'info',
                                            showCancelButton    : true,
                                            cancelButtonColor   : '#d33',
                                            confirmButtonColor  : '#3085d6',
                                            cancelButtonText   : 'Cek kembali',
                                            confirmButtonText   : 'Ya, Sudah sesuai',
                                        }).then((result) => 
                                        {
                                            if (result.value) 
                                            {
                                                $('#form-analisa-mikro').submit();
                                            }})
                                "> Tambah Sampel </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
