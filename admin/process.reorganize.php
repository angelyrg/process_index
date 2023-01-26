<?php
//Update process level name
require_once('Master.php');
$master = new Master();

$id_from = $_POST['id_from'];
$id_to = $_POST['id_to'];

var_dump( $master->update_ids($id_from, $id_to) );

?>