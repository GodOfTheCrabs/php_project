<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Добавить заход</title>
</head>
<body>
    
    <div class="container">
        <? include '../html/admin_menu.html'?>
        <div class="row">
            <div class="col-4 mx-auto">
                <h2>Напишіть кількість даних яких хочете додати</h2>
                <form action="/events/fake_add.php" method="POST">
                    <div class="form-group">
                        <label for="name">Кількість</label>
                        <input type="number" class="form-control" name="count">
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