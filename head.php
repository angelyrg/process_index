<!-- <!DOCTYPE html-->
<html lang="en">

<head>
    <link rel="shortcut icon" href="https://bitel.com.pe/upload/2005922/20220219/favicon_53b47.ico" type="image/vnd.microsoft.icon" />
    <title>Bitel Process</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CDNs -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/22.2.3/css/dx.light.css" />


    <link rel="stylesheet" href="assets/css/style_main.css">
    <link rel="stylesheet" href="assets/devexpress/styles.css" />
    <link rel="stylesheet" href="assets/css/bizagi.css">
    <link rel="stylesheet" href="assets/css/upload_style.css">

</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['error'])) {
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
                if (isset($_SESSION['user'])) {
                ?>
                    <a href="admin/" class="btn btn-outline-info">Admin</a>
                <?php
                } else {
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
                    <a href="home.php" class="btn btn-outline-light btn-sm rounded-pill" id="btn_process_list">Process List</a>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="#" id="btn_expand_tree" class="btn btn-sm btn-outline-light">Expand all</a>
                    <a href="#" id="btn_collapse_tree" class="btn btn-sm btn-outline-light">Collapse all</a>
                </div>
                <div class="mt-3" id="treeview"></div>
            </div>
        </nav>