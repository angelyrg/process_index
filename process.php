<?php

require_once("include/upload.class.php");

$up = new UploadFolder();
$up->set_folder("bizagi");
$up->process($_POST["path"], $_FILES["file"]);

// Read data from JSON file
$jsonData = file_get_contents('data.json');
$data = json_decode($jsonData, true);

$file_dir = explode("/", $_POST["path"] );
$foldername = $file_dir[0];

$data_len = 0;
if (count($data) > 0){
    $data_len = count($data);
}

$item = array([
    'id' => strval( $data_len + 1 ),
    'text' => $foldername,
    'clickeable' => true,
    'file_name' => '', 
    'bizagi_folder' => $foldername
]);
$data_added = array_merge($data, $item);

// Write modified data to JSON file
$new_data = json_encode($data_added);
file_put_contents('result.json', $new_data);


copy("result.json", "data2.json");

?>
 