<?php
require_once '../app/traits/Fields.php';
require_once 'auto_loading.php';
require_once 'traits/errors.php';
require_once 'traits/objects.php';


class Validate// класс валидации при регистрации
{
    use Fields;
    use errors;
    use objects;
    protected array $post;
    protected array $file;
    private $db;

    public function __construct()
    {
        $this->post = $_POST;
        $this->file =$_FILES;
        $this->db = ConnectDataBase::objects()->connect();// подключение к БД
    }

    public function __get($key)//ввывод информации из контекста
    {
        if(isset($this->gets[$key])){
            return $this->gets[$key];
        }
        return null;
    }

    public function values()// при вызове этого метода в контекс передаются введенные данные
    {
        $this->gets = $this->post;// trait errors !!!!
        return $this;
    }

    public function email(string $field)// Валидация Email
    {

        $this->required($field);
        if(!filter_var($this->post[$field], FILTER_VALIDATE_EMAIL)){
            $this->add_messages($field, "Некорректный {$this->get_field($field)}!!");
        }else{
            $email = $this->post[$field];
            if($this->db->query("SELECT * FROM users WHERE(email='$email')")->fetch()){
                $this->add_messages($field, "Такой {$this->get_field($field)} уже существует!!");
            }
        }
    }
    public function password( string $password, string $password_confirm)// Валидация пороля
    {
        $this->required($password);
        if($this->post[$password] != $this->post[$password_confirm]){
            $this->add_messages($password, "Пороли не совпадают!!");
        }
    }
    public function image(string $field)// Валидация аватарки
    {
        if(empty($this->file[$field])||!$this->file[$field]){
            $this->add_messages($field, "Поле {$this->get_field($field)} обязательное!!");
        }elseif ($this->file[$field]['error'] !=0 || !getimagesize($this->file[$field]['tmp_name'])){
            $this->add_messages($field, "Поле {$this->get_field($field)} должно быть картинкой!!");
        }
    }
    private  function get_user()// вернет отвалидированные данные пользователя
    {
        if(!$this->messages){
            $user = $this->post;
            unset( $user['repeat_password']);
            $user['ava'] = $this->file['ava'];
            return $user;
        }
        return null;
    }
    public function register()//Создает экземпляра класса Register и вызывает метод для регистрации
    {
        if(empty($this->messages)){
            Register::objects($this->get_user())->create_user();
        }
    }
}



