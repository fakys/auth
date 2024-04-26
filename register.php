<?php
require 'app/auto_loading.php';
Auth::objects()->redirect_user(true, 'profile.php');
require 'form_register.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form method="post" action="register.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>ФИО</label>
                <input type="text" name="fio" value="<?=$validate->values()->fio ?>"  class="form-control">
                <?php
                if($validate->errors('fio')){
                    echo"<p class='invalid'>{$validate->messages()->fio}</p>";
                }
                ?>
            </div>
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="login" value="<?=$validate->values()->login ?>" class="form-control">
                <?php
                if($validate->errors('login')){
                    echo"<p class='invalid'>{$validate->messages()->login}</p>";
                }
                ?>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?=$validate->values()->email ?>" class="form-control">
                <?php
                if($validate->errors('email')){
                    echo"<p class='invalid'>{$validate->messages()->email}</p>";
                }
                ?>
            </div>
            <div class="form-group">
                <label>Аватар</label>
                <input type="file" name="ava"  class="form-control">
                <?php
                if($validate->errors('ava')){
                    echo"<p class='invalid'>{$validate->messages()->ava}</p>";
                }
                ?>
            </div>
            <div class="form-group">
                <label>Пороль</label>
                <input type="password" name="password" value="<?=$validate->values()->password ?>" class="form-control">
                <?php
                if($validate->errors('password')){
                    echo"<p class='invalid'>{$validate->messages()->password}</p>";
                }
                ?>
            </div>
            <div class="form-group">
                <label>Повторите пароль</label>
                <input type="password" name="repeat_password" class="form-control">
            </div>
            <div><input type="submit" class="btn btn-primary"></div>
            <p class="mt-3">У вас есть аккаунт? <a href="login.php">Войдите в него!!</a></p>
        </form>
    </div>
</body>
</html>