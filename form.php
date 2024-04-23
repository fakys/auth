<?php
require_once('app/Validate.php');
use app\Validate;


$validate =  Validate::objects();
$validate->required('fio');
$validate->required('login');
$validate->email('email');
$validate->image('ava');
$validate->password('password', 'repeat_password');
var_dump($validate->messages);