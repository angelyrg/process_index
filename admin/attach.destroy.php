<?php
require_once('Master.php');
$master = new Master();

$id = $_POST['id_att'];
$parent_id = $_POST['id_parent'];

$result = $master->delete_attached_file($parent_id, $id);

echo $result;
//header('location: ./');

?>