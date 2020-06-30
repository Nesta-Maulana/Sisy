<div class="modal fade" id="lihatDetailPsr" tabindex="-1" role="dialog" aria-labelledby="lihatDetailPsrLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="lihatDetailPsrLabel">Detail PSR - <span id="psr_number"></span></h5>
                <button type="button" id="close-button-detail-psr" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="product_name">
                                <span>Nama Produk</span>
                            </label>
                            <input type="text" id="product_name" value="Nama Produk" class="form-control" readonly >
                        </div>
                        <div class="form-group">
                            <label for="wo_number">
                                <span >Nomor WO</span>
                            </label>
                            <input type="text" id="wo_number" value="Nomor WO" class="form-control" readonly >
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="production_realisation_date">
                                <span >Tanggal Produksi</span>
                            </label>
                            <input type="text" id="production_realisation_date" value="Tanggal Produksi" class="form-control" readonly >
                        </div>
                        <div class="form-group">
                            <label for="psr_qty">
                                <span >PSR QTY</span>
                            </label>
                            <input type="text" id="psr_qty" value="Jumlah PSR" class="form-control" readonly >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode Sampel</th>
                                    <th>Mesin Filling</th>
                                    <th>Jumlah Sampel</th>
                                    <th>Jumlah PSR per Sampel</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="detail_psr">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/psr/pop-up/lihat-detail-psr.blade.php ENDPATH**/ ?>