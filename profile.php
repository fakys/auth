<?php
require 'app/auto_loading.php';
Auth::objects()->redirect_user(false, 'login.php');
$user = Auth::objects()->user();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>profile</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-5">Профиль</h1>
        <div class="d-flex">
            <div class="d-flex flex-column"><img src="<?=$user['ava']?>" width="200">Ваше фото</div>
            <ul>
                <li>
                    ФИО: <?=$user['fio']?>
                </li>
                <li>
                    Логин: <?=$user['login']?>
                </li>
                <li>
                    Email: <?=$user['email']?>
                </li>
                <a href="logout.php" class="btn btn-danger mt-3">Выйти</a>
            </ul>
        </div>

    </div>
</body>
</html>
