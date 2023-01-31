<?php 

include("head.php"); 

if (!isset( $_GET['id'] )){
  header("Location: home.php");
}
$id = $_GET['id'];

require("Main.php");
$main = new Main();

$main->restore_expanded();
$main->make_expand($id);
$process = $main->get_data($id);

?>

  <div class="col-md-8 col-lg-9 mx-auto mt-3">
    <!-- Main process info -->
    <div class="container-fluid" id="info_content">
      <div class="d-flex justify-content-between">
        <p class="fw-bolder" id="process_title"><?= $process["text"]; ?></p>
        <div>
          <button type="button" class="btn btn-info rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#modal_attachments"> <i class="fa-solid fa-list" aria-hidden="true"></i> Download attached files</button>
          <a href="upload/bizagi/<?= $process["bizagi_folder"] ?>/index.html" class="btn btn-info rounded-pill <?= ( $process["bizagi_folder"] != null && $process["bizagi_folder"] != "" ) ? "" : "disabled"; ?>" target="_blank" ><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Open Bizagi </a>
        </div>
        
      </div>
      <div class="col-12 ">
        <?php if( isset($process["file_name"]) && ($process["file_name"] != null && $process["file_name"] != "") ){ ?>
        <iframe src="upload/pdfs/<?= $process["file_name"] ?>" width="100%" id="pdf_viewer" frameborder="0"></iframe>
        <?php }else{ ?>
        <div class="text-center align-items-center rounded-3 text-center" id="no_pdf_viewer">
          <div>
            <img src="admin/assets/imgs/no-file.svg" alt="File not found" class="img-fluid">
            <p class="text-secondary"><small>PDF file is in process to be sign.</small></p>
          </div>
        </div>
        <?php } ?>
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
          <ul class="list-group" id="files_to_download">
            <?php if ( count($process['attachment_files']) == 0 ){ ?>
              <label>No attachments yet.</label>
              <?php }else{ ?>
            <?php foreach ($process['attachment_files'] as $key => $value) { ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= $value['attach_name'] ?>
                <a href="upload/attached/<?= $value["attach_file_name"] ?>" class="btn btn-sm btn-outline-info rounded-pill" download>
                  <i class="fa-solid fa-download"></i> Download
                </a>
              </li>                 
                <?php
              }
              } ?>
          </ul>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-info rounded-pill px-5 fw-bolder" data-bs-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>

<?php include("foot.php"); ?>