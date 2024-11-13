<?php

include '../functions.php';
include '../models/Model.php';
include '../models/User.php';

$users = User::findAll();
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
    <title>Користувачі</title>
</head>
<body>
    <div class="container">
		<? include '../html/admin_menu.html'; ?>
			<div class="col-10 mx-auto">
				<a href="form_add.php" class="btn btn-success mb-3">Додати нового користувача</a>
				<a href="fake_form_add.php" class="btn btn-success mb-3">Додати фейкових користувачів</a>
				<? include "../alert.php"?>
				<table class="table table-striped table-bordered table-hover">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Ім`я</th>
							<th>Призвіще</th>
							<th>Почта</th>
							<th>Телефон</th>
							<th>Стать</th>
							<th>Місто</th>
							<th>Фотографія</th>
							<th width="100">Дії</th>
						</tr>
					</thead>
					<? foreach($users as $user): ?>
                        <tr>


                            <td><?= $count++ ?></td>
                            <td><?= $user['first_name'] ?></td>
                            <td><?= $user['last_name']?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['phone'] ?></td>
                            <td><?= $user['gender'] ?></td>
                            <td><?= $user['city'] ?></td>
							<td>
								<?php if ($user['photo'] == null): ?>
									<img src="../img/profile_photo.jpg" style="width:80px;">
								<?php else: ?>
									<img src="../img/users_photo/<?= $user['photo'] ?>" style="width:80px;">
								<?php endif; ?>
							</td>
                            <td>
                                <a href="#" user_id="<?= $user['id']?>" class="btn btn-danger btn-sm btn-delete"><i class="bi bi-trash" style="font-size:18px;"></i></a>
                            </td>
                        </tr>
					<? endforeach; ?> 
				</table>
			</div>
		</div>
    </div>

    <script>
		let btn_delete = document.querySelectorAll('.btn-delete');

		for (let i = 0; i < btn_delete.length; i++) {
			btn_delete[i].onclick = delete_user;			
		}

		function delete_user(e) {
			e.preventDefault()
			let res = confirm("Are you sure")
			if(!res) return
			let id = this.getAttribute('user_id')
			location.href = 'delete.php?id=' + id
		}

	</script>
  
</body>
</html>