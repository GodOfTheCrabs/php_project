<?php
session_start();
// unset($_SESSION["register_data"]);
$first_name = $_SESSION['register_data']['first_name'];
$last_name = $_SESSION['register_data']['last_name'];
$email = $_SESSION['register_data']['email'];
$phone = $_SESSION['register_data']['phone'];
$password = $_SESSION['register_data']['password'];
$gender = $_SESSION['register_data']['gender'];
$city = $_SESSION['register_data']['city'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/register.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <? include '../html/admin_menu.html' ?>
    <section class="h-100 bg-dark" style="height: 100vh">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col"> 
            <form action="../users/add.php" method="POST" enctype="multipart/form-data">
                <div class="card card-registration my-4">
                <div class="row g-0 d-flex justify-content-around align-items-center">
                    <div class="col-xl-6">
                        <div class="card-body p-md-5 text-black">
                            <h3 class="mb-5 text-uppercase">Реєстраційна форма</h3>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <? include '../alert.php' ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div data-mdb-input-init class="form-outline">
                                    <input type="text" class="form-control form-control-lg" name="first_name" value="<?= $first_name ?>"/>
                                    <label class="form-label">Ім'я</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div data-mdb-input-init class="form-outline">
                                    <input type="text" class="form-control form-control-lg" name="last_name" value="<?= $last_name ?>"/>
                                    <label class="form-label">Прізвище</label>
                                    </div>
                                </div>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" class="form-control form-control-lg" name="email" value="<?= $email ?>"/>
                                <label class="form-label">Електронна пошта</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="tel" id="phone" name="phone" placeholder="+380 098-668-49-67"  pattern="^\+380\s\d{3}-\d{3}-\d{2}-\d{2}$" required value="<?= $phone ?>">
                                <label class="form-label">Номер телефона</label>
                            </div>
        
                            <div data-mdb-input-init class="form-outline mb-2">
                                <input type="password" class="form-control form-control-lg" name="password" id="password"  value="<?= $password ?>"/>
                                <div style="margin: 5px 0 0 20px;">
                                    <input type="checkbox" id="showPassword" class="form-check-input">
                                    <label for="showPassword">Показати Пароль</label>
                                </div>
                            </div>
        
                            <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
                                <input type="hidden" name="gender" value="">
                                <h6 class="mb-0 me-4">Стать: </h6>
                                <div class="form-check form-check-inline mb-0 me-4">
                                <input class="form-check-input" type="radio" value="Жінка" name="gender" <?= ($gender == 'Жінка') ? 'checked' : '' ?>/>
                                <label class="form-check-label">Жінка</label>
                            </div>
        
                            <div class="form-check form-check-inline mb-0 me-4">
                                <input class="form-check-input" type="radio" value="Чоловік" name="gender" <?= ($gender == 'Чоловік') ? 'checked' : '' ?>/>
                                <label class="form-check-label">Чоловік</label>
                            </div>
                        </div>
    
                        <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-check-label">Виберіть місто</label>
                            <select data-mdb-select-init class="form-control" name="city">
                                <option value="Київ" <?= ($city == 'Київ') ? 'selected' : '' ?>>Київ</option>
                                <option value="Дніпропетровськ" <?= ($city == 'Дніпропетровськ') ? 'selected' : '' ?>>Дніпропетровськ</option>
                                <option value="Кам'янське" <?= ($city == "Кам'янське") ? 'selected' : '' ?>>Кам'янське</option>
                            </select>
                        </div>
                        </div>
    
                        <div class="d-flex pt-3">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-border">Надіслати форму</button>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl- d-flex">
                        <div class="form-group">
                            <img id="profilePhoto" ref="profilePhoto" src="../img/profile_photo.jpg" alt="Profile Photo" class="profile-photo">
                            <input type="file" class="form-control-file" id="photoUpload"  accept="image/*" onchange="previewPhoto(event)" name="photo"/>
                            <small>Необов'язково</small>
                        </div>
                    </div>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>
<script>
    let showPassword =document.getElementById('showPassword');
    let password =document.getElementById('password');
    showPassword.onchange = () => {password.type = showPassword.checked ? 'text' : 'password'};
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePhoto').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
</body>
</html>