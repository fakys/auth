<?php
trait objects// Трейт для создания экземпляра класса через статическую функцию
{
    //его можно использовать при условии, что в класс не передается никаких аргументов
    //именно поэтому в классе register отдельный метод objects
    protected static $model;
    public static function objects()
    {
        if(!self::$model){
            $class = get_class();
            self::$model = new $class;
        }
        return self::$model;
    }
}