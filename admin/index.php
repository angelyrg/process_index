
<?php
session_start();
if (isset($_SESSION['user'])) {
    $user_logged = $_SESSION['user'];
} else {
    header("Location: ../");
}

require("Master.php");
$master = new Master();

if ( !isset($_GET['id']) || (strlen($_GET['id']) <= 1) ) {
    header("Location: home.php");
}

$id = $_GET['id'];

$master->make_expand($id);

$process = $master->get_sigle_data($id);
$json_data = $master->get_all_data();

include("head.php");

//Include modals
include("includes/modal_new_level.php");

?>

<!-- Details -->
<div class="col-md-8 col-lg-9 mx-auto mt-3">

    <!-- main process info -->
    <div class="container-fluid" id="process_info">
        <div class="d-flex justify-content-between align-items-center my-2 ">
            <div class="text-info fw-bold" id="process_title"><?= $process["text"]; ?></div>
            <div>

                <?php
                include("includes/modal_upload_pdf.php");
                include("includes/modal_upload_bizagi_folder.php");
                ?>
                <button type="button" class="btn btn-info rounded-pill <?= ( $process["file_name"] != null && $process["file_name"] != "" ) ? "" : "d-none"; ?>" id="btn_update_pdf" data-bs-toggle="modal" data-bs-target="#modal_upload_pdf">
                    <i class="fa-solid fa-plus" aria-hidden="true"></i> Change PDF file
                </button>

                <button type="button" class="btn btn-info rounded-pill" id="btn_upload_bizagi_folder" data-bs-toggle="modal" data-bs-target="#modal_upload_bizagi_folder">
                    <i class="fa-solid fa-plus" aria-hidden="true"></i> Upload Bizagi Folder
                </button>

                <a href="../upload/bizagi/<?= $process["bizagi_folder"] ?>/index.html" class="btn btn-info rounded-pill <?= ( $process["bizagi_folder"] != null && $process["bizagi_folder"] != "" ) ? "" : "d-none"; ?>" target="_blank" id="link_bizagi_diagram">
                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Open Bizagi
                </a>

            </div>
        </div>
        <nav class="nav nav-tabs d-flex justify-content-center pt-3 pb-2 border-top" id="nav-tab-details" role="tablist">
            <a class="nav-link btn active text-center my_btn" id="nav-pdf-tab" data-bs-toggle="tab" href="#nav-pdf" role="tab" aria-controls="nav-pdf" aria-selected="true">PDF</a>
            <a class="nav-link btn text-center my_btn" id="nav-attach-tab" data-bs-toggle="tab" href="#nav-attach" role="tab" aria-controls="nav-attach" aria-selected="false">Attached files</a>
        </nav>
        <div class="tab-content " id="nav-tabContent">
            <div class="tab-pane fade show active " id="nav-pdf" role="tabpanel" aria-labelledby="nav-pdf-tab">
                <div class="container pt-0 d-flex align-items-center justify-content-center rounded-3" id="pdf_content">
                    <?php if( isset($process["file_name"]) && ($process["file_name"] != null && $process["file_name"] != "") ){ ?>
                    <iframe src="../upload/pdfs/<?= $process["file_name"] ?>" width="100%" id="pdf_viewer" frameborder="0"></iframe>
                    <?php }else{ ?>
                    <div class="text-center" id="no_pdf_viewer">
                        <img src="assets/imgs/no-file.svg" alt="File not found" class="img-fluid">
                        <p class="text-secondary"><small>No file to display</small></p>

                        <button type="button" class="btn btn-outline-info rounded-pill px-5" data-bs-toggle="modal" data-bs-target="#modal_upload_pdf">
                            <i class="fa-solid fa-plus" aria-hidden="true"></i> Upload PDF file
                        </button>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="tab-pane fade " id="nav-attach" role="tabpanel" aria-labelledby="nav-attach-tab">
                <div class="d-flex justify-content-between align-items-center my-2 ">
                    <div class="text-info">Atachment files</div>
                    <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_upload_attach">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add file
                    </button>

                    <?php include("includes/modal_upload_attach.php"); ?>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>File's name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="attached_table">
                        <?php foreach ($process['attachment_files'] as $key => $value) { ?>
                            <tr>
                                <td>1</td>
                                <td><?=$value["attach_file_name"] ?></td>
                                <td>
                                    <a href="attach.destroy.php?parent_id=<?=$process["id"] ?>&id=<?=$value["id"] ?>" class="btn btn-outline-danger btn-sm rounded-pill" onclick="if(confirm('Are you sure to delete this item?') === false) event.preventDefault();">
                                        <i class="fa fa-trash"></i> Remove
                                    </a>
                                    <a href="../upload/attached/<?=$value["attach_file_name"] ?>" class="btn btn-sm btn-outline-dark rounded-pill" download>
                                        <i class="fa-solid fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>                 
                            <?php
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include("foot.php"); ?>