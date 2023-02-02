<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- No caché -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <link rel="shortcut icon" href="https://bitel.com.pe/upload/2005922/20220219/favicon_53b47.ico" type="image/vnd.microsoft.icon" />
    <title>Admin | Bitel Process</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.scss">
</head>

<body>
    <nav class="navbar navbar-expand-lg my_navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/imgs/bitel.svg" alt="Bitel" class="img-fluid"> <span class="fw-bold">Admin</span>
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-outline-info" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i> User
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-info" href="./../"><i class="fa-solid fa-home"></i> Home</a></li>
                        <li><a class="dropdown-item text-info" href="./../logout.php"> <i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="">
        <div class="row">
            <!-- Menu Items List -->
            <div class="col-md-4 col-lg-3" id="menu">

                <div class="d-grid my-2 pb-3 btn_process_list">
                    <a href="home.php" class="btn btn-outline-info text-white rounded-pill" id="btn_processes_list">Process List</a>
                </div>

                <div class="row text-end">
                    <spam>
                        <a href="reorganize.php" class="btn btn-outline-light btn-sm rounded-pill"><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Reorganize</a>
                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_new_level">
                            <i class="fa-solid fa-plus" aria-hidden="true"></i> New Division
                        </button>
                    </spam>
                </div>

                <!-- Accordion -->
                <div class="accordion" id="acco_sample">
                    <?php
                    foreach ($json_data as $data) {
                        $id_item = $data->id;
                        $title = $data->text;
                    ?>
                        <div class="accordion-item border-start rounded border border-info">
                            <h2 class="accordion-header" id="<?= $id_item ?>">

                                <div class="btn-group col-12" role="group" aria-label="Button group with nested dropdown">
                                    <button class="accordion-button collapsed text-uppercase " type="button" data-bs-toggle="collapse" data-bs-target="#id_<?= $id_item ?>" aria-expanded="false" aria-controls="id_<?= $id_item ?>">
                                        <?= $title ?>
                                    </button>

                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <span class="visually-hidden">Options</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button type="button" class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#modal_insert_level_<?= $id_item; ?>" title="Add new level into level">
                                                <i class="fa-solid fa-folder-plus" aria-hidden="true"></i> New level
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Edit level name
                                            </button>
                                        </li>

                                        <li>
                                            <a href="process.destroy.php?id=<?= $id_item ?>" class="dropdown-item text-danger" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete level
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </h2>
                            <?php
                            include("includes/modal_edit_level.php");
                            include("includes/modal_insert_level.php");
                            ?>
                            <div id="id_<?= $id_item ?>" class="accordion-collapse collapse <?= ($data->expanded) ? "show" : "" ?>" aria-labelledby="<?= $id_item ?>">
                                <div class="accordion-body pe-0 bg-transparent">
                                    <?php if (isset($data->items)) {
                                        foreach ($data->items as $item) {
                                            $id_item = $item->id;
                                            $title = $item->text;
                                    ?>
                                            <!-- Level 2 -->
                                            <div class="accordion-item border-start rounded border border-info">
                                                <h2 class="accordion-header" id="<?= $id_item ?>">
                                                    <div class="btn-group col-12" role="group" aria-label="Button group with nested dropdown">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id_<?= $id_item ?>" aria-expanded="false" aria-controls="id_<?= $id_item ?>">
                                                            <?= $title ?>
                                                        </button>

                                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                            <span class="visually-hidden">Options</span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <button type="button" class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#modal_insert_level_<?= $id_item; ?>" title="Add new level into level">
                                                                    <i class="fa-solid fa-diagram-project" aria-hidden="true"></i> New process
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                                    <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Edit level name
                                                                </button>
                                                            </li>

                                                            <li>
                                                                <a href="process.destroy.php?id=<?= $id_item ?>" class="dropdown-item text-danger" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                                    <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete level
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </h2>
                                                <?php
                                                include("includes/modal_edit_level.php");
                                                include("includes/modal_insert_level.php");
                                                ?>
                                                <div id="id_<?= $id_item ?>" class="accordion-collapse collapse <?= ($item->expanded) ? "show" : "" ?>" aria-labelledby="<?= $id_item ?>">
                                                    <div class="accordion-body pe-0">
                                                        <?php
                                                        if (isset($item->items)) { ?>
                                                            <ul class="list-group">
                                                                <?php
                                                                foreach ($item->items as $item3) {
                                                                    $id_item = $item3->id;
                                                                    $title = $item3->text;
                                                                ?>
                                                                    <!-- Level 3 -->
                                                                    <div class="accordion-item border-start rounded border border-info">
                                                                        <h2 class="accordion-header" id="<?= $id_item ?>">
                                                                            <div class="btn-group col-12" role="group" aria-label="Button group with nested dropdown">
                                                                                <a id="<?= $id_item ?>" href="index.php?id=<?= $id_item ?>" class="accordion-button collapsed item_clickeable" >
                                                                                    <i class="fa-solid fa-diagram-project"></i><?= "&nbsp;" . $title ?>
                                                                                </a>

                                                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                                    <span class="visually-hidden">Options</span>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li>
                                                                                        <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                                                            <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Edit process name
                                                                                        </button>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a href="process.destroy.php?id=<?= $id_item ?>" class="dropdown-item text-danger" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                                                            <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete level
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </h2>
                                                                        <?php




                                                                        include("includes/modal_edit_level.php");
                                                                        include("includes/modal_insert_level.php");
                                                                        ?>

                                                                    </div>

                                                            <?php
                                                                }
                                                            } ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div><?php
                            } ?>
                </div>
            </div>