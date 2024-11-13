<?php
    include '../functions.php';
    include '../models/Model.php';
    include '../models/User.php';
    include '../models/UserToken.php';

    
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="../style/topbar.css">
    <link rel="stylesheet" href="../style/main_page.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include '../html/topbar.php'; ?> 

    <div class="main-page">
        <div class="user-register">
            <? include '../alert.php' ?>
        </div>
        <div class="main-page-head">
            <div class="contact">
                <img src="../img/youtube.png" class="icon-main-page">
                <img src="../img/facebook.png" class="icon-main-page">
                <img src="../img/x.png" class="icon-main-page">
                <img src="../img/instagram.png" class="icon-main-page">
            </div>
            <div class="description-head">
                <div class="galerie">

                </div>
                <div class="description-text">
                    <div class="title">Місія Організації</div>
                    <div class="text">Основна задача нашого проекту зробити можливість, щоб кожен українець міг приймати участь у волонтерьских заходах</div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../html/footer.html'; ?> 
</body>
</html>