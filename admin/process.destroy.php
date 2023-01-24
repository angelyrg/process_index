<?php
require_once('Master.php');
$master = new Master();

$id = $_GET['id'];

$master->delete_data($id);

header('location: ./');

?>