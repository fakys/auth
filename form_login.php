<?php
require_once 'app/auto_loading.php';


$login = Login::objects();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login->required('email');
    $login->login();
}