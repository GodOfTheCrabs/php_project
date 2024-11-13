<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="../style/topbar.css">
    <link rel="stylesheet" href="../style/login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require '../html/topbar.php' ?>
    <div class="container">
        <form class="login-form" method="POST" action="../users/auth.php">
            <p class="title-login">Увійти</p>
            <div class="form-group">
                <label>Електронна пошта</label>
                <input type="email" class="form-control" placeholder="Електронна пошта" name="email">
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" class="form-control" placeholder="Пароль"  name="password" id="password">
                <div style="margin: 5px 0;">
                    <input type="checkbox" id="showPassword" class="form-check-input">
                    <label for="showPassword">Показати Пароль</label>
                </div>
            </div>
            <div class="form-group">
                <div style="margin: 5px 0;">
                    <input type="checkbox" id="rememberMe" class="form-check-input" name="remember_me">
                    <label for="rememberMe">Запам'ятати мене</label>
                </div>
            </div>
            <button type="submit" class="btn btn-border">Підтвердити</button>
            <div class="incorrect-login">
                <?php require '../alert.php'; ?>
            </div>        
            <a class="register-link" href="register_form.php">      
                Створити обліковий запис
            </a>
        </form>
    </div>

    <?php require '../html/footer.html' ?>

    <script>
        let showPassword =document.getElementById('showPassword');
        let password =document.getElementById('password');
        showPassword.onchange = () => {password.type = showPassword.checked ? 'text' : 'password'};
    </script>
</body>
</html>