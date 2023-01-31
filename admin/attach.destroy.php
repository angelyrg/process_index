<?php
require_once('Master.php');
$master = new Master();

$id = $_GET['id'];
$parent_id = $_GET['parent_id'];

$result = $master->delete_attached_file($parent_id, $id);

header('location: ./index.php?id='.$parent_id);

?>