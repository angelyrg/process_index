<?php 

include("head.php");
require("Main.php");
require("ExcelData.php");
$main = new Main();
$excel = new ExcelData();
$main->restore_expanded();
$link = $excel->get_link();

?>

    <div class="col-md-8 col-lg-9 mx-auto mt-3">
      <!-- Excel process -->
      <div class="container-fluid" id="excel_content">
        <iframe src="<?= $link->spreadsheets_link ?>" class="col-12" id="excel_viewer"></iframe>
      </div>
    </div>

<?php include("foot.php"); ?>