<?php
//Update process level name
require_once('Master.php');
$master = new Master();

$id = $_POST['id'];
$bizagi_folder = $_POST['bizagi_folder'];

// $id = $_GET['id'];
// $bizagi_folder = $_GET['bizagi_folder'];

var_dump($master->update_bizagi_folder($id, $bizagi_folder));

echo $bizagi_folder;

//header("Location: index.php?id=".$id);