<?php
require_once('Master.php');
$master = new Master();

$id = $_GET['id']; //
$parent_id = $_GET['parent_id'];


var_dump($master->delete_attached_file($parent_id, $id));

header('location: ./');

?>