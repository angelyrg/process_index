<?php
require_once('Master.php');
$master = new Master();

$id = $_GET['id'];

var_dump($master->delete_data($id));

header('location: ./');

?>