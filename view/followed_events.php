<?php
session_start();

include '../functions.php';
include '../models/Model.php';
include '../models/Event.php';
include '../models/User.php';
include '../models/UserToken.php';
include '../classes/Pagination.php';

$pagination = new Pagination(10, $_GET['page'], 'events', $_GET['category'], $_GET['search'], $_GET['sort'], $_GET['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="../style/topbar.css">
    <link rel="stylesheet" href="../style/events.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include '../html/topbar.php'; ?> 
    <div class="events-page">
        <div class="title-event">
            Заходи
        </div>
        <div class="error-text">
            <? include '../alert.php' ?>
        </div>
        <div class="event-content">
            <div class="event-posts">
                <? foreach($pagination->elements as $event): ?>
                    <div>
                        <img src='../img/galerie/<?= $event['image'] ?>' class="event-img">
                        <div class="event-body">
                            <div class="event-title">
                            <?= $event['title'] ?>
                            </div>
                            <button class="btn" style="border:1px solid black"><a href="event.php?id=<?= $event['id'] ?>" class="event-link">Дізнатися більше</a></button>
                        </div>
                    </div> 
                <? endforeach; ?>   
            </div>

            <div class="event-category">
                <div class="search-block">
                    <form action="followed_events.php" method="GET">
                        <input type="hidden" name="page" value="1">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <? if(isset($pagination->category)): ?>
                            <input type="hidden" name="category" value="<?= htmlspecialchars($_GET['category'] ?? '') ?>">
                        <? endif; ?>
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" >
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="category-title">Категорії</div>
                    <div class="category-list">
                        <div class="category-element">
                            <a href="followed_events.php?page=1&category=Допомога цивільним&user_id=<?=$user['id']?>">Допомога цивільним</a>
                        </div>
                        <div class="category-element">
                            <a href="followed_events.php?page=1&category=Допомога військовим&user_id=<?=$user['id']?>">Допомога військовим</a>
                        </div>
                        <div class="category-element">
                            <a href="followed_events.php?page=1&category=Допомога дітям&user_id=<?=$user['id']?>">Допомога дітям</a>                         
                        </div>
                        <div class="category-element">
                            <a href="followed_events.php?page=1&category=Донати&user_id=<?=$user['id']?>">Донати</a>
                        </div>
                        <div class="category-element">
                            <a href="followed_events.php?page=1&category=Сбори речей&user_id=<?=$user['id']?>">Сбори речей</a>
                        </div>
                        <div class="category-element">
                            <a href="followed_events.php?page=1&category=Робоча сила&user_id=<?=$user['id']?>">Робоча сила</a>
                        </div>
                        <div class="category-element">
                            <? if(isset($pagination->sort) && $pagination->sort == 'title_asc'): ?>
                                <a href="followed_events.php?page=1&user_id=<?=$user['id']?>&sort=title_desc<?= isset($pagination->category) ? '&category=' . $pagination->category : '' ?>
                                    <?= isset($pagination->title) ? '&search=' . $pagination->title : '' ?>">
                                    Фільтрувати по назві за спад.
                                </a>
                            <? else: ?>
                                <a href="followed_events.php?page=1&user_id=<?=$user['id']?>&sort=title_asc<?= isset($pagination->category) ? '&category=' . $pagination->category : '' ?>
                                    <?= isset($pagination->title) ? '&search=' . $pagination->title : '' ?>">
                                    Фільтрувати по назві за зрост.
                                </a>
                            <? endif; ?>
                        </div>
                        <div class="category-element">
                            <? if(isset($pagination->sort) && $pagination->sort == 'date_asc'): ?>
                                <a href="followed_events.php?page=1&user_id=<?=$user['id']?>&sort=date_desc<?= isset($pagination->category) ? '&category=' . $pagination->category : '' ?>
                                    <?= isset($pagination->title) ? '&search=' . $pagination->title : '' ?>">
                                    Фільтрувати по даті за спад.
                                </a>
                            <? else: ?>
                                <a href="followed_events.php?page=1&user_id=<?=$user['id']?>&sort=date_asc<?= isset($pagination->category) ? '&category=' . $pagination->category : '' ?>
                                    <?= isset($pagination->title) ? '&search=' . $pagination->title : '' ?>">
                                    Фільтрувати по даті за зрост.
                                </a>
                            <? endif; ?>
                        </div>
                        <div class="category-element">
                            <a href="followed_events.php?page=1&user_id=<?=$user['id']?>">Сбросити фільтер</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <? include 'pagination_f.php' ?>
        </div> 
    </div>
    <?php include '../html/footer.html'; ?> 
</body>
</html>