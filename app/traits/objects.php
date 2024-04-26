<?php
trait objects
{
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