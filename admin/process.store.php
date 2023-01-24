<?php
//Insert new process level data into JSON file
require_once('Master.php');
$master = new Master();

$title = $_POST['level_name'];

$master->insert_to_json($title, "bizagi_folder_name");

header("Location: ./");

?>
