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
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/reorganize.css">
</head>

<body>
	<header>
		<h3>REORGANIZE ALL PROCESS (Diseño súper XD)</h3>		
	</header>
	<p class="text-center"> You can move any process you want to another level</p>
	<div class="app ps-3">

		<div class="lists row">
			<?php
			// Level 1
			foreach ($json_data as $data) {
				$id_item = $data->id;
				$title = $data->text;
			?>
				<div id="<?= $id_item ?>" class="list rounded border border-info" >
					<p class="text-info fw-bolder text-center"><?= $title ?></p>
					

					<?php if (isset($data->items)) {
						// Level 2
						foreach ($data->items as $item) {

							$id_item = $item->id;
							$title = $item->text;

					?>
							<div id="<?= $id_item ?>" class="col rounded text-center my_draggable" ondrop="drop(event)" ondragover="allowDrop(event)">
								<?= $title ?>

								<?php
								if (isset($item->items)) { ?>
									<?php
									// Level 3
									foreach ($item->items as $item3) {
										$id_item = $item3->id;
										$title = $item3->text;
									?>

										<div id="<?= $id_item ?>" class="list-item col p-2" draggable="true" ondrop="return false;" ondragover="return false;" >
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
	<script src="assets/js/reorganize.js"></script>
</body>

</html>