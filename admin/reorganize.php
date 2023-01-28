<?php
session_start();
if ( isset($_SESSION['user'])) {
	$user_logged = $_SESSION['user'];
	//Get all data
	require("process.index.php");
	//print_r($json_data);
} else {
	header("Location: ../");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Bitel Process</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.scss">
	<link rel="stylesheet" href="assets/css/reorganize.css">
</head>

<body>
	<nav class="navbar navbar-expand-lg my_navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/imgs/bitel.svg" alt="Bitel" class="img-fluid"> <span class="fw-bold">Admin</span>
            </a>
        </div>
    </nav>

	<div class="d-flex container-fluid justify-content-between my-1">
		<a href="./" class="btn btn-outline-info rounded-pill" ><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to admin</a>
		<p class="text-center"> You can move any process to another level in the same level</p>
		<p></p>
	</div>
	<div class="app ps-3">

		<div class="lists row" ondrop="return false;" ondragover="return false;">
			<?php
			// Level 1
			foreach ($json_data as $data) {
				$id_item = $data->id;
				$title = $data->text;
			?>
				<div id="<?= $id_item ?>" class="list rounded border border-info level_1" >
					<p class="text-info fw-bolder text-center"><?= $title ?></p>
					

					<?php if (isset($data->items)) {
						// Level 2
						foreach ($data->items as $item) {

							$id_item = $item->id;
							$title = $item->text;

					?>
							<div id="<?= $id_item ?>" class="col rounded text-center my_draggable level_2" ondrop="drop(event)" ondragover="allowDrop(event)">
								<?= $title ?>

								<?php
								if (isset($item->items)) { ?>
									<?php
									// Level 3
									foreach ($item->items as $item3) {
										$id_item = $item3->id;
										$title = $item3->text;
									?>

										<div id="<?= $id_item ?>" class="list-item col p-2 level_3" draggable="true" ondrop="return false;" ondragover="return false;" >
											<i class="fa fa-diagram-project" aria-hidden="true"></i>
											<?= $title ?>
										</div>


								<?php
									}
								} ?>
								
								<!-- <div id="dragdrop_animation" class="col p-2 rounded mb-0" draggable="false"><small>Drop here...</small></div> -->

							</div>

							<?php

							?>
					<?php
						}
					} ?>
				</div>
			<?php
			}
			?>


		</div>

	</div>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="assets/js/reorganize.js"></script>
</body>

</html>