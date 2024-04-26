<?php
require_once 'app/Validate.php';


$validate = Validate::objects();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validate->required('fio');
    $validate->required('login');
    $validate->email('email');
    $validate->image('ava');
    $validate->password('password', 'repeat_password');
    $validate->register();
}