<?php
namespace app;
require_once('traits/Fields.php');
use app\traits\Fields\Fields;

class Validate
{
    use Fields;
    protected array $post;
    protected static $model;
    protected array $file;
    public array $messages = [];

    public function __construct()
    {
        $this->post = $_POST;
        $this->file =$_FILES;
    }

    protected function add_messages($field , $messages)
    {
        if(empty($this->messages[$field])||!$this->messages[$field]){
            $this->messages[$field] = $messages;
        }
    }
    public function required(string  $field)
    {
        if(!$this->post[$field]){
            $this->add_messages($field, "Поле {$this->get_field($field)} обязательное!!");
        }
    }

    public function email(string $field)
    {
        $this->required($field);
        if(!filter_var($this->post[$field], FILTER_VALIDATE_EMAIL)){
            $this->add_messages($field, "Некорректный {$this->get_field($field)}!!");
        }
    }
    public function password($password,$password_confirm)
    {
        $this->required($password);
        if($this->post[$password] != $this->post[$password_confirm]){
            $this->add_messages($password, "Пороли не совпадают!!");
        }
    }
    public function image(string $field)
    {
        if(empty($this->file[$field])||!$this->file[$field]){
            $this->add_messages($field, "Поле {$this->get_field($field)} обязательное!!");
        }elseif ($this->file[$field]['error'] !=0 || !getimagesize($this->file[$field]['tmp_name'])){
            $this->add_messages($field, "Поле {$this->get_field($field)} должно быть картинкой!!");
        }
    }
    public static function objects()
    {
        if(!self::$model){
            $class = get_class();
            self::$model = new $class;
        }
        return self::$model;
    }
}
