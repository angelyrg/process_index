<?php

require_once("includes/upload.class.php");

$up = new UploadFolder();
$up->set_folder("./../upload/bizagi/");
$up->process($_POST["path"], $_FILES["file"]);

?>
 