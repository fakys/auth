<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>ФИО</label>
                <input type="text" name="fio"  class="form-control">
            </div>
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="login" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Аватар</label>
                <input type="file" name="ava"  class="form-control">
            </div>
            <div class="form-group">
                <label>Пороль</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Повторите пароль</label>
                <input type="password" name="repeat_password" class="form-control">
            </div>
            <div><input type="submit" class="btn btn-primary"></div>
        </form>
    </div>
</body>
</html>