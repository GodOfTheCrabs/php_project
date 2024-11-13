<?php

include '../functions.php';
include '../models/Model.php';
include '../models/Event.php';

$events = Event::findAll();
$count = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Заходи</title>
</head>
<body>
    <div class="container">
		<? include '../html/admin_menu.html'; ?>
			<div class="col-10 mx-auto">
				<a href="form_add.php" class="btn btn-success mb-3">Додати новий захід</a>
				<a href="fake_form_add.php" class="btn btn-success mb-3">Додати фейкові заходи</a>
				<? include "../alert.php"?>
				<table class="table table-striped table-bordered table-hover">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Назва</th>
							<th>Опыс</th>
							<th>Категорія</th>
							<th>Дата</th>
							<th>Фото</th>
							<th width="100">Дії</th>
						</tr>
					</thead>
					<!-- <? foreach($events as $event): ?> -->
					<tr>


						<td><?= $count++ ?></td>
						<td><?= $event['title'] ?></td>
						<td><?= $event['event_description']?></td>
						<td><?= $event['category'] ?></td>
                        <td><?= $event['date'] ?></td>
                        <td><img src="../img/galerie/<?= $event['image'] ?>" style="width:80px"></td>
						<td>
							<a href="edit_form.php?id=<?= $event['id']?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil" style="font-size:18px;"></i></a>
							<a href="#" event_id="<?= $event['id']?>" class="btn btn-danger btn-sm btn-delete"><i class="bi bi-trash" style="font-size:18px;"></i></a>
						</td>
					</tr>
					<!-- <? endforeach; ?> -->
				</table>
			</div>
		</div>
    </div>

    <script>
		let btn_delete = document.querySelectorAll('.btn-delete');

		for (let i = 0; i < btn_delete.length; i++) {
			btn_delete[i].onclick = delete_events;			
		}

		function delete_events(e) {
			e.preventDefault()
			let res = confirm("Are you sure")
			if(!res) return
			let id = this.getAttribute('event_id')
			location.href = 'delete.php?id=' + id
		}

	</script>
  
</body>
</html>