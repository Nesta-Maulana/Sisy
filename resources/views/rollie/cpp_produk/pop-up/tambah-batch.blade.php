<div class="modal fade" id="tambahBatchPackingModal" tabindex="-1" role="dialog" aria-labelledby="tambahBatchPackingModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBatchPackingModalLabel">Tambah Batch Proses Packing</h5>
                <button type="button" id="close-button-tambah-wo" class="close" data-dismiss="modal" aria-label="Close" onclick="hapusDataPopupTambahBatch()" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="tambah-batch-proses" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="cpp_head_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($cppHead->id) }}">
                    <div class="form-group">
                        <label for="jenis_tambah">Pilih Jenis Penambahan: </label>
                        <select name="jenis_tambah" id="jenis_tambah" class="form-control jenis" onchange="getWoPacking()">
                            <option value="" selected disabled>-- PILIH JENIS PENAMBAHAN  --</option>
                            <option value="1">Tambah WO Beda Mesin</option>
                            <option value="2">Tambah Batch</option>
                        </select>
                    </div>                       
                    <div class="form-group">
                        <label for="nomor_wo_tambah" class="">Pilih Nomor Wo: </label>
                        <select name="nomor_wo_tambah" id="nomor_wo_tambah" class="form-control jenis">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Tambah Wo">
                </div>
            </form>


            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>