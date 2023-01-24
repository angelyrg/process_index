<?php
//Update excel link
require_once('Excel.php');
$excel = new Excel();

$new_link = $_POST['excel_link'];
$excel->update_excel_link($new_link);

header("Location: ./");
