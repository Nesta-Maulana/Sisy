<div class="modal fade" id="editMtolModal" tabindex="-1" role="dialog" aria-labelledby="editMtolModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="editMtolModalLabel">Upload File Mtol</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" id="upload_mtol">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body" id="wow">
                    <div class="form-group">
                        <label for="mtolFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="mtol_excel" id="mtolFile">
                                <label class="custom-file-label" for="mtolFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <button class="btn btn-info" style="background-color: #00b8ff">Upload</button>
                        <a class="btn btn-danger text-white" data-dismiss="modal">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/production_schedules/pop-up/upload-mtol.blade.php ENDPATH**/ ?>