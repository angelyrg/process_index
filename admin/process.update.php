<?php
//Update process level name
require_once('Master.php');
$master = new Master();

$id = $_POST['process_id'];
$title = isset($_POST['edit_level_name']) ? $_POST['edit_level_name'] : null;

if (isset($_POST['btn_save_changes'])) {
    $master->update_json_data($id, $title, null, null, null);
}

if (isset($_POST['btn_upload_pdf'])) {
    $targetfolder = "./../upload/pdfs/";
    $targetfolder = $targetfolder . basename($_FILES['pdf_file']['name']);
    $pdf_name = null;
    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $targetfolder)) {
        echo "The file " . basename($_FILES['pdf_file']['name']) . " is uploaded";
        $pdf_name = basename($_FILES['pdf_file']['name']);
        $master->update_json_data($id, $title, $pdf_name, null, null);
    } else {
        echo "Problem uploading file";
    }
}



header("Location: ./");
