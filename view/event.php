<?php
session_start();
include '../functions.php';
include '../models/Model.php';
include '../models/Event.php';
include '../models/User.php';

$data['id'] = $_GET['id'];

$event = Event::findOne($data);

if (!isset($_SESSION['id'])) {
    header('Location: events.php?page=1&error=not_allowed');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="../style/topbar.css">
    <link rel="stylesheet" href="../style/event.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include '../html/topbar.php'; ?> 
    <div class="event-post">
        <div class="alert-text">
            <? include '../alert.php' ?>
        </div>
        <div class="event-img">
            <img src='../img/galerie/<?= $event['image'] ?>' class="event-img">
        </div>
        <div class="event-post-description" >
            <div class="event-post-date">
                <?= $event['date'] ?>
            </div>
            <div class="event-post-title">
                <?= $event['title'] ?>
            </div>
            <div class="event-post-text">
                <?= $event['event_description'] ?>
            </div>

            <div class="event-post-btn">
                <a href="../followed_events/add.php?user_id=<?= $user['id'] ?>&event_id=<?=$event['id']?>" class="btn-event">Слідкувати</a>
                <a href="../followed_events/delete.php?user_id=<?= $user['id'] ?>&event_id=<?=$event['id']?>" class="btn-event">Не слідкувати</a>
            </div>
        </div>
    </div>
    <?php include '../html/footer.html'; ?> 

</body>
</html>