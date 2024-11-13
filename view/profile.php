<?php
    include '../functions.php';
    include '../models/Model.php';
    include '../models/User.php';

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/topbar.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <? include '../html/topbar.php' ?>
<section style="background-color: #eee; height: 100vh;" v-if="user.length > 0">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4" style="width:350px;">
        <div class="card mb-4">
          <div class="card-body text-center">
            <?if($user['photo'] == null): ?>
              <img src="../img/profile_photo.jpg" class="rounded-circle img-fluid" style="width: 150px;">
            <? else: ?>
              <img src="../img/users_photo/<?= $user['photo'] ?>" class="rounded-circle img-fluid" style="width: 150px;">
            <? endif; ?>
            <h5 class="my-3"><?= $user['first_name'] . " " . $user['last_name']?></h5>
            <p class="text-muted mb-1">Full Stack Developer</p>
            <p class="text-muted mb-4"><?= $user['city'] ?></p>
            <div class="d-flex justify-content-center mb-2">
                <a href="followed_events.php?page=1&user_id=<?=$user['id']?>"  type="button"  class="btn btn-primary btn-border profile-link">Підписки</a>
                <a href="../users/edit_form.php?id=<?=$user['id']?>" type="button"  class="btn btn-primary btn-border profile-link">Редагувати Профіль</a>
                <? if($user['email'] == 'admin@gmail.com'): ?>
                  <a href="../admin_page.php" class="btn btn-primary btn-border profile-link" >Адмінка</a>
                <? endif; ?> 
                
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Ім'я та Призвіще: &nbsp</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <?=  $user['first_name'] . " " . $user['last_name']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Електронна адреса: &nbsp</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $user['email']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Номер телефону: &nbsp</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $user['phone'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Адреса: &nbsp</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">Місто <?= $user['city']?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Стать: &nbsp</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <?= $user['gender']?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<? require '../html/footer.html' ?>
</body>
</html>