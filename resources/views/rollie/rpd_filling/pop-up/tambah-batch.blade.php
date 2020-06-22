<div class="modal fade" id="tambahBatchFillingModal" tabindex="-1" role="dialog" aria-labelledby="tambahBatchFillingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBatchFillingModalLabel">Tambah Batch Proses Filling</h5>
                <button type="button" id="close-button-tambah-wo" class="close" data-dismiss="modal" aria-label="Close" onclick="hapusDataPopupTambahBatch()" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="tambah-batch-proses" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="rpd_filling_head_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($rpdFillingHead->id) }}">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <label for="jenis_tambah">Jenis Penambahan </label>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7">
                            <div class="form-group">
                                <select name="jenis_tambah" id="jenis_tambah" class="form-control jenis" onchange="getWoFilling()">
                                    <option value="" selected disabled>PILIH JENIS PENAMBAHAN</option>
                                    <option value="1">Tambah WO Beda Mesin</option>
                                    <option value="2">Tambah Batch</option>
                                </select>
                            </div>
                        </div>
                    </div>                       
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <label for="nomor_wo_tambah">Nomor Wo </label>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7">
                            <div class="form-group">
                                <select name="nomor_wo_tambah" id="nomor_wo_tambah" class="form-control jenis">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary form-control" value="Tambah Wo">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
