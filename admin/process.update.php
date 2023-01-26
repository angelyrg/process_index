<?php
//Update process level name
require_once('Master.php');
$master = new Master();

$id = $_POST['process_id'];
$title = isset($_POST['edit_level_name']) ? $_POST['edit_level_name'] : null;

if (isset($_POST['btn_save_changes'])) {
    $master->update_json_data($id, $title, null, null, null);
}

//Upload_attachment files
if (isset($_POST['btn_save_attach'])) {
    $targetfolder = "./../upload/attached/";
    $total = count($_FILES['attach_file']['name']);
    $filesuploaded = [];

    // Loop through each file
    for ($i = 0; $i < $total; $i++) {
        $tmpFilePath = $_FILES['attach_file']['tmp_name'][$i];
        if ($tmpFilePath != "") { //Make sure we have a file path
            //Setup our new file path
            $newFilePath = $targetfolder . $_FILES['attach_file']['name'][$i];
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                array_push($filesuploaded, $_FILES['attach_file']['name'][$i]);
            }
        }
    }
    var_dump($master->insert_attachment_files($id, $filesuploaded));
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
