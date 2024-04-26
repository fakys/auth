<?php
require 'app/auto_loading.php';
Auth::objects()->redirect_user(true, 'profile.php');
require 'form_login.php';

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
    <form method="post" action="login.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
            <?php
            if($login->errors('email')){
                echo"<p class='invalid'>{$login->messages()->email}</p>";
            }
            ?>
        </div>
        <div class="form-group">
            <label>Пороль</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <input id="remember_me" type="checkbox" name="remember_me">
            <label for="remember_me">Запомнить меня</label>
        </div>
        <div><input type="submit" value="Войти" class="btn btn-primary"></div>
        <p class="mt-3">У вас нет аккаунта? <a href="register.php">Зарегистрируйтесь!!</a></p>
    </form>
</div>
</body>
</html>