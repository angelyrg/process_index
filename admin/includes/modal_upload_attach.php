<!-- Modal edit level-->
<div class="modal fade" id="modal_upload_attach" tabindex="-1" aria-labelledby="modalPDFUploading" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPDFUploading">New attachment file</h5>
        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="process.update.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="process_id" id="process_id" value="" required >
          <div class="mb-3">
            <label for="pdf_file" class="form-label">Upload PDF file</label>
            <!-- <input type="file" class="form-control rounded-pill" id="pdf_file" name="pdf_file" required accept=".pdf"> -->
            <input type="file" name="attach_file[]" id="attach_file" class="form-control rounded-pill" required multiple>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn rounded-pill btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn rounded-pill btn-info" id="btn_save_attach" name="btn_save_attach"><i class="fa fa-upload"></i> Upload files</button>
        </div>
      </form>
    </div>
  </div>
</div>