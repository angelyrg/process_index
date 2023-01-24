<?php
//Update process level name
require_once('Master.php');
$master = new Master();

$id = $_POST['id'];
$bizagi_folder = $_POST['bizagi_folder'];

$master->update_json_data($id, null, null, $bizagi_folder, null);

echo $bizagi_folder;
