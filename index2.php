<?php include("head.php"); ?>

<?php
$id = $_GET['id'];

require("admin/Master.php");
$master = new Master();
$data = $master->get_data($id);

var_dump($data);


?>

    <div class="col-md-8 col-lg-9 mx-auto mt-3">
      <!-- Excel process -->
      <div class="container-fluid" id="excel_content">
        <iframe src="" class="col-12" id="excel_viewer"></iframe>
      </div>
      <!-- Main process info -->
      <div class="container-fluid d-none" id="info_content">
        <div class="d-flex justify-content-between">
          <p class="fw-bolder" id="process_title">Title</p>
          <div>
            <button type="button" class="btn btn-info rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#modal_attachments"> <i class="fa-solid fa-list" aria-hidden="true"></i> Download attached files</button>
            <a href="" class="btn btn-info rounded-pill" target="_blank" id="link_bizagi_diagram"><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Open Bizagi </a>
          </div>
          
        </div>
        <div class="col-12 ">
          <iframe src="" width="100%" id="pdf_viewer" frameborder="0"></iframe>
          <div class="text-center align-items-center d-none rounded-3 text-center" id="no_pdf_viewer">
            <div>
              <img src="admin/assets/imgs/no-file.svg" alt="File not found" class="img-fluid">
              <p class="text-secondary"><small>PDF file is in process to be sign.</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Attachment files-->
  <div class="modal fade" id="modal_attachments" tabindex="-1" aria-labelledby="modal_attachments" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content rounded-3">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-info" id="modal_attachments">Attachments</h1>
          <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group" id="files_to_download"></ul>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-info rounded-pill px-5 fw-bolder" data-bs-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>

<?php include("foot.php"); ?>