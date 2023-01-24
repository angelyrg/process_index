<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="shortcut icon" href="https://bitel.com.pe/upload/2005922/20220219/favicon_53b47.ico" type="image/vnd.microsoft.icon" />
  <title>Bitel Process</title>

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

  <nav class="navbar navbar-expand-lg my_navbar px-4">
    <div class="container-fluid">
      <a class="navbar-brand m-0" href="#">
        <img src="assets/img/bitel_logo.svg" alt="Bitel" class="img-fluid m-0 p-0" width="200px">
      </a>
      <div class="d-flex align-items-center">
        <button type="button" class="btn btn-info rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#modal_login">
          <i class="fa fa-user"></i> Login
        </button>
        <?php include("include/modal_login.php"); ?>

      </div>
    </div>
  </nav>

  <div class="row">
    <nav id="sidebarMenu" class="col-md-4 col-lg-3 d-md-block sidebar collapse shadow">
      <div class="demo-container ps-4">
        <div class="d-grid my-2 pb-3 btn_process_list">
          <a href="#" class="btn btn-outline-light rounded-pill" id="btn_process_list">Process List</a>
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
        <div class="col-12 text-end mb-2">
          <button type="button" class="btn btn-info rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#modal_attachments"> <i class="fa-solid fa-list" aria-hidden="true"></i> Download attached files</button>
          <a href="" class="btn btn-info rounded-pill" target="_blank" id="link_bizagi_diagram"><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Open Bizagi </a>
        </div>
        <div class="col-12 ">
          <iframe src="" width="100%" id="pdf_viewer" frameborder="0"></iframe>
          <div class="text-center align-items-center d-none rounded-3" id="no_pdf_viewer">
            <img src="admin/assets/imgs/no-file.svg" alt="File not found" class="img-fluid">
            <p class="text-secondary"><small>No file to display</small></p>
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

  <!-- Modal Upload folder-->
  <div class="modal fade" id="modal_upload_folder" tabindex="-1" aria-labelledby="modal_attachments" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_attachments">Upload bizagi folder</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="p-4">
            <p>Choose a folder, and all files in that folder will be uploaded recursively.</p>
            <p><small>Make sure all attachment files are into that folder</small></p>
            <div class="picker">
              <input type="file" id="picker" name="fileList" webkitdirectory multiple>
            </div>
            <br>
            <p class="mb-0">Percentage</p>
            <span id="box">0%</span>
            <br>
            <p class="mb-0">Progress</p>
            <div id="myProgress">
              <div id="myBar"></div>
            </div>
            <p>Files Uploaded</p>
            <span id="listing"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary rounded-pill" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    $(document).on("change", function() {
      $(".biz-ex-navigation-left").remove()
    });
  </script>
  <script src="assets/js/upload.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>