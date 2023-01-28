<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="shortcut icon" href="https://bitel.com.pe/upload/2005922/20220219/favicon_53b47.ico" type="image/vnd.microsoft.icon" />
  <title>Bitel Process</title>

  <!-- No caché -->
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">


  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script>
    window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))
  </script>
  <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/22.2.3/css/dx.light.css" />
  <script src="https://cdn3.devexpress.com/jslib/22.2.3/js/dx.all.js"></script>

  <!-- Get All data -->
  <script src="assets/js/get_data.js"></script>

  <script src="assets/devexpress/index.js"></script>
  <link rel="stylesheet" href="assets/css/style_main.css">
  <link rel="stylesheet" type="text/css" href="assets/devexpress/styles.css" />
  <link rel="stylesheet" href="assets/css/bizagi.css">

  <link rel="stylesheet" href="assets/css/upload_style.css">


</head>

<body>

<?php
session_start();
if (isset($_SESSION['error'])){
  include("include/modal_error.php");
  unset($_SESSION['error']);
}

?>

  <nav class="navbar navbar-expand-lg my_navbar px-4">
    <div class="container-fluid">
      <a class="navbar-brand m-0" href="#">
        <img src="assets/img/bitel_logo.svg" alt="Bitel" class="img-fluid m-0 p-0" width="200px">
      </a>
      <div class="d-flex align-items-center">

      <?php
      if(isset($_SESSION['user'])){
        ?>
        <a href="admin/" class="btn btn-outline-info">Admin</a>
        <?php
      }else{
        ?>
        <button type="button" class="btn btn-info rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#modal_login">
          <i class="fa fa-user"></i> Login
        </button>
        <?php
        include("include/modal_login.php"); 
        }
        ?>

      </div>
    </div>
  </nav>

  <div class="row">
    <nav id="sidebarMenu" class="col-md-4 col-lg-3 d-md-block sidebar collapse shadow">
      <div class="demo-container ps-4">
        <div class="d-grid my-2 pb-3 btn_process_list">
          <a href="#" class="btn btn-outline-light btn-sm rounded-pill" id="btn_process_list">Process List</a>
        </div>
        <div class="d-flex justify-content-end">
          <a href="#" id="btn_expand_tree" class="btn btn-sm btn-outline-light">Expand all</a>
          <a href="#" id="btn_collapse_tree" class="btn btn-sm btn-outline-light">Collapse all</a>
        </div>
        <div class="mt-3" id="treeview"></div>
      </div>
    </nav>

    <div class="col-md-8 col-lg-9 mx-auto mt-3">
      <!-- Excel process -->
      <div class="container-fluid" id="excel_content">
        <iframe src="" class="col-12" id="excel_viewer"></iframe>
      </div>
      <!-- Main process info -->
      <div class="container-fluid d-none" id="info_content">
        <div class="d-flex justify-content-between">
          <p class="fw-bolder" id="process_title">Title</p>
          <div>
            <button type="button" class="btn btn-info rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#modal_attachments"> <i class="fa-solid fa-list" aria-hidden="true"></i> Download attached files</button>
            <a href="" class="btn btn-info rounded-pill" target="_blank" id="link_bizagi_diagram"><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Open Bizagi </a>
          </div>
          
        </div>
        <div class="col-12 ">
          <iframe src="" width="100%" id="pdf_viewer" frameborder="0"></iframe>
          <div class="text-center align-items-center d-none rounded-3 text-center" id="no_pdf_viewer">
            <div>
              <img src="admin/assets/imgs/no-file.svg" alt="File not found" class="img-fluid">
              <p class="text-secondary"><small>PDF file is in process to be sign.</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Attachment files-->
  <div class="modal fade" id="modal_attachments" tabindex="-1" aria-labelledby="modal_attachments" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content rounded-3">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-info" id="modal_attachments">Attachments</h1>
          <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group" id="files_to_download"></ul>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-info rounded-pill px-5 fw-bolder" data-bs-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script>
    // $(document).on("change", function() {
    //   $(".biz-ex-navigation-left").remove()
    // });
  </script>
  <script src="assets/js/main.js"></script>

</body>

</html>