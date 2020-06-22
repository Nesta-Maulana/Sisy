<div class="modal fade" id="prosesWoModal" tabindex="-1" role="dialog" aria-labelledby="prosesWoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="prosesWoModalLabel">Update Data Proses Produksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body" id="wow">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group hidden" id="product_name_div">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" readonly>
                                <input type="hidden" class="form-control" id="product_id" name="product_id" readonly>
                            </div> 
                            <div class="form-group hidden" id="wo_number_div">
                                <label for="wo_number">Nomor Wo </label>
                                <input type="text" class="form-control" id="wo_number" name="wo_number" >
                                <input type="hidden" class="form-control" id="wo_number_id" name="wo_number_id" readonly>
                            </div> 
                            
                            <div class="form-group hidden" id="production_plan_date_div">
                                <label for="pan_date">Plan Date </label>
                                <input type="text" class="form-control" id="production_plan_date" name="production_plan_date" readonly>
                            </div>
                            <div class="form-group hidden" id="production_plan_date_draft_div">
                                <label for="production_plan_date_draft">Plan Date</label>
                                <input type="date" class="form-control" id="production_plan_date_draft" name="production_plan_date_draft" >
                            </div>  
                            <div class="form-group hidden" id="realisation_date_div">
                                <label for="realisation_date">Realisation Date</label>
                                <input type="date" class="form-control" id="realisation_date" name="realisation_date" >
                            </div> 
                            <div class="form-group hidden" id="label-jangan">
                                <span class="label text-danger" style="font-size:12px">* Wo sudah melakukan proses fillpack , harap menghubungi administrator apabila ada perubahan tanggal produksi</span>
                                
                            </div>
                            <div class="form-group pull-right">
                                <a type="submit" class="btn btn-danger text-white" value="Cancel" data-dismiss="modal">Cancel</a>
                                <a class="btn btn-primary text-white" id="submit_proses" onclick="updateDataWo('realisation')">Proses WO</a>
                                <a class="btn btn-primary text-white" id="submit_proses_draft" onclick="updateDataWo('draft')">Update Data Wo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>