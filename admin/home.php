<?php

session_start();
if (isset($_SESSION['user'])) {
    $user_logged = $_SESSION['user'];
} else {
    header("Location: ../");
}

require("Master.php");
$master = new Master();
$master->restore_expanded();
$json_data = $master->get_all_data();

include("head.php");
require("Excel.php");
$excel = new Excel();
$link = $excel->get_excel_link();

include("includes/modal_new_level.php");
?>

<!-- Details -->
<div class="col-md-8 col-lg-9 mx-auto mt-3">
    <!-- Excel process -->
    <div class="container-fluid border border-info" id="processes_excel">
        <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_new_excel_link">
            <i class="fa-solid fa-file-excel" aria-hidden="true"></i> Update excel
        </button>
        <?php include("includes/modal_new_excel_link.php"); ?>
        <iframe src="<?= $link->spreadsheets_link; ?>" class="col-12" id="excel_viewer"></iframe>
    </div>
</div>

<?php include("foot.php"); ?>