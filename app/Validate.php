<?php
require_once('app/traits/Fields.php');
require_once('app/Register.php');

use app\Register\Register;
use app\traits\Fields\Fields;

class Validate
{
    use Fields;
    protected array $post;
    protected static $model;
    protected array $file;

    public array $gets = [];
    protected array $messages = [];

    public function __construct()
    {
        $this->post = $_POST;
        $this->file =$_FILES;
    }

    public function __get($key)
    {
        if(isset($this->gets[$key])){
            return $this->gets[$key];
        }
        return null;
    }

    public function values()
    {
        $this->gets = $this->post;
        return $this;
    }
    public function messages()
    {
        $this->gets = $this->messages;
        return $this;
    }
    public function errors(string $key)
    {
        if(isset($this->messages[$key])){
            return true;
        }
        return false;
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
    public function password( string $password, string $password_confirm)
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
    private  function get_user()
    {
        if(!$this->messages){
            $user = $this->post;
            unset( $user['repeat_password']);
            $user['ava'] = $this->create_user_ava();
            return $user;
        }
        return null;
    }
    private function create_user_ava()
    {
        $file_name = uniqid() .'_'.$this->file['ava']['name'];
        $dirs = "storages/$file_name";
        if(move_uploaded_file($this->file['ava']['tmp_name'], $dirs)){
            return $dirs;
        }
        return null;
    }
    public function register()
    {
        if(empty($this->messages)){
            return Register::objects($this->get_user());
        }
        return null;
    }
}



