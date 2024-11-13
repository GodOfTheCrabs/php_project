<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Додати захід</title>
</head>
<body>
    
    <div class="container">
        <? include '../html/admin_menu.html'?>
        <div class="row">
            <div class="col-4 mx-auto">
                <h2>Додати захід</h2>
                <? include "../alert.php"?>
                <form action="/events/add.php" method="POST">
                    <div class="form-group">
                        <label for="name">Назва</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="name">Опис</label>
                        <textarea name="event_description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Выберіть категорію</label>
                        <select name="category" class="form-control">
                            <option value="Допомога цивільним" selected>Допомога цивільним</option>
                            <option value="Допомога військовим">Допомога військовим</option>
                            <option value="Допомога дітям">Допомога дітям</option>
                            <option value="Донати">Донати</option>
                            <option value="Сбори речей">Сбори речей</option>
                            <option value="Робоча сила">Робоча сила</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Назва зображення</label>
                        <input type="text" name="image" class="form-control"></input>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-success" value="Сохранить">
                    </div>
                </form>
            </div>
        </div>
     
    </div>
</body>
</html>