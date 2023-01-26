<?php
session_start();
if( isset($_SESSION['user']) ){
    $user_logged = $_SESSION['user'];
}else{
    header("Location: ../");
}


//Get all data
require("process.index.php");

//Include modals
include("includes/modal_new_level.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- No caché -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
    <link rel="shortcut icon" href="https://bitel.com.pe/upload/2005922/20220219/favicon_53b47.ico" type="image/vnd.microsoft.icon" />
    <title>Admin | Bitel Process</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.scss">
</head>

<body>
<?php

//echo $_SESSION['error'];

if (isset($_SESSION['error'])){
  include("includes/modal_error-admin.php");
  unset($_SESSION['error']);

}elseif(isset($_SESSION['success'])){
    include("includes/modal_success-admin.php");
    unset($_SESSION['success']);
}

?>

    <nav class="navbar navbar-expand-lg my_navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/imgs/bitel.svg" alt="Bitel" class="img-fluid"> <span class="fw-bold">Admin</span>
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-outline-info" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i> User
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-info" href="./../"><i class="fa-solid fa-home"></i> Home</a></li>
                        <li><a class="dropdown-item text-info" href="./../logout.php"> <i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="">
        <div class="row">
            <!-- Menu Items List -->
            <div class="col-md-4 col-lg-3" id="menu">

                <div class="d-grid my-2 pb-3 btn_process_list">
                    <a href="#" class="btn btn-outline-info text-white rounded-pill" id="btn_processes_list">Process List</a>
                </div>

                <div class="row text-end">
                    <spam>
                        <a href="reorganize.php" class="btn btn-outline-light btn-sm rounded-pill"> Reorganize</a>
                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_new_level">
                            <i class="fa-solid fa-plus" aria-hidden="true"></i> New level
                        </button>
                    </spam>
                </div>

                <!-- Accordion -->
                <div class="accordion" id="acco_sample">
                    <?php
                    foreach ($json_data as $data) {
                        $id_item = $data->id;
                        $title = $data->text;
                    ?>
                        <div class="accordion-item border-start rounded border border-info">
                            <h2 class="accordion-header" id="<?= $id_item ?>">

                                <div class="btn-group col-12" role="group" aria-label="Button group with nested dropdown">
                                    <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#id_<?= $id_item ?>" aria-expanded="false" aria-controls="id_<?= $id_item ?>">
                                        <?= $title ?>
                                    </button>

                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <span class="visually-hidden">Options</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button type="button" class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#modal_insert_level_<?= $id_item; ?>" title="Add new level into level">
                                                <i class="fa-solid fa-folder-plus" aria-hidden="true"></i> New level
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Edit level name
                                            </button>
                                        </li>

                                        <li>
                                            <a href="process.destroy.php?id=<?= $id_item ?>" class="dropdown-item text-danger" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete level
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </h2>
                            <?php
                            include("includes/modal_edit_level.php");
                            include("includes/modal_insert_level.php");
                            ?>
                            <div id="id_<?= $id_item ?>" class="accordion-collapse collapse" aria-labelledby="<?= $id_item ?>">
                                <div class="accordion-body pe-0 bg-transparent">
                                    <?php if (isset($data->items)) {
                                        foreach ($data->items as $item) {
                                            $id_item = $item->id;
                                            $title = $item->text;
                                    ?>
                                            <!-- Level 2 -->
                                            <div class="accordion-item border-start rounded border border-info">
                                                <h2 class="accordion-header" id="<?= $id_item ?>">
                                                    <div class="btn-group col-12" role="group" aria-label="Button group with nested dropdown">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id_<?= $id_item ?>" aria-expanded="false" aria-controls="id_<?= $id_item ?>">
                                                            <?= $title ?>
                                                        </button>

                                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                            <span class="visually-hidden">Options</span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <button type="button" class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#modal_insert_level_<?= $id_item; ?>" title="Add new level into level">
                                                                    <i class="fa-solid fa-diagram-project"  aria-hidden="true"></i> New process
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                                    <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Edit level name
                                                                </button>
                                                            </li>

                                                            <li>
                                                                <a href="process.destroy.php?id=<?= $id_item ?>" class="dropdown-item text-danger" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                                    <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete level
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </h2>
                                                <?php
                                                include("includes/modal_edit_level.php");
                                                include("includes/modal_insert_level.php");
                                                ?>
                                                <div id="id_<?= $id_item ?>" class="accordion-collapse collapse" aria-labelledby="<?= $id_item ?>">
                                                    <div class="accordion-body pe-0">
                                                        <?php
                                                        if (isset($item->items)) { ?>
                                                            <ul class="list-group">
                                                                <?php
                                                                foreach ($item->items as $item3) {
                                                                    $id_item = $item3->id;
                                                                    $title = $item3->text;
                                                                ?>
                                                                    <!-- Level 3 -->
                                                                    <div class="accordion-item border-start rounded border border-info">
                                                                        <h2 class="accordion-header" id="<?= $id_item ?>">
                                                                            <div class="btn-group col-12" role="group" aria-label="Button group with nested dropdown">
                                                                                <button id="<?= $id_item ?>" class="accordion-button collapsed item_clickeable" type="button" data-bs-toggle="collapse" data-bs-target="#id_<?= $id_item ?>" aria-expanded="false" aria-controls="id_<?= $id_item ?>">
                                                                                    <i class="fa-solid fa-diagram-project"></i><?= "&nbsp;" . $title ?>
                                                                                </button>

                                                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                                    <span class="visually-hidden">Options</span>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li>
                                                                                        <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                                                            <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Edit process name
                                                                                        </button>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a href="process.destroy.php?id=<?= $id_item ?>" class="dropdown-item text-danger" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                                                            <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete level
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </h2>
                                                                        <?php
                                                                        include("includes/modal_edit_level.php");
                                                                        include("includes/modal_insert_level.php");
                                                                        ?>

                                                                    </div>

                                                            <?php
                                                                }
                                                            } ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div><?php
                            } ?>
                </div>

            </div>
            <!-- Details -->
            <div class="col-md-8 col-lg-9 mx-auto mt-3">

                <!-- main process info -->
                <div class="container-fluid d-none" id="process_info">
                    <div class="d-flex justify-content-between align-items-center my-2 ">
                        <div class="text-info fw-bold" id="process_title">Title</div>
                        <div>

                            <?php
                            include("includes/modal_upload_pdf.php");
                            include("includes/modal_upload_bizagi_folder.php");
                            ?>
                            <button type="button" class="btn btn-info rounded-pill d-none" id="btn_update_pdf" data-bs-toggle="modal" data-bs-target="#modal_upload_pdf">
                                <i class="fa-solid fa-plus" aria-hidden="true"></i> Change PDF file
                            </button>

                            <button type="button" class="btn btn-info rounded-pill" id="btn_upload_bizagi_folder" data-bs-toggle="modal" data-bs-target="#modal_upload_bizagi_folder">
                                <i class="fa-solid fa-plus" aria-hidden="true"></i> Upload Bizagi Folder
                            </button>

                            <a href="" class="btn btn-info rounded-pill d-none" target="_blank" id="link_bizagi_diagram">
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
                                <iframe src="" frameborder="0" id="pdf_viewer" width="100%" class="d-none"></iframe>
                                <div class="text-center" id="no_pdf_viewer">
                                    <img src="assets/imgs/no-file.svg" alt="File not found" class="img-fluid">
                                    <p class="text-secondary"><small>No file to display</small></p>

                                    <button type="button" class="btn btn-outline-info rounded-pill px-5" data-bs-toggle="modal" data-bs-target="#modal_upload_pdf">
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Upload PDF file
                                    </button>
                                </div>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Excel process -->
                <div class="container-fluid border border-info" id="processes_excel">
                    <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_new_excel_link">
                        <i class="fa-solid fa-file-excel" aria-hidden="true"></i> Update excel
                    </button>
                    <?php include("includes/modal_new_excel_link.php"); ?>
                    <iframe src="" class="col-12" id="excel_viewer"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- Upload script is executed automaticatly when select a folder. -->
    <script src="assets/js/upload.js"></script>
    <script>
        // Start datatables
        // $(document).ready(function() {
        //     $('#table_id').DataTable();
        // });

        // Autofocus in new excel modal
        $('#modal_new_excel_link').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });

        // Disable resubmit of form when refresh page
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>