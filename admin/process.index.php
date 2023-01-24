<?php
//Get all process data from Master file
include_once("Master.php");

$master = new Master();
$json_data = $master->get_all_data();

?>