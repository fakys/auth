<?php
// механизм авто импорта классов
spl_autoload_register(function (string $class){
    $path = __DIR__. "/$class.php";
    if(is_readable($path)){
        require $path;
    }
    else{
        var_dump("Такого файла не существует!!");
    }
});