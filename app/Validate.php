<?php
require_once 'app/traits/Fields.php';
require_once 'auto_loading.php';
require_once 'traits/errors.php';
require_once 'traits/objects.php';


class Validate
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
        $this->db = ConnectDataBase::objects()->connect();
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

    public function email(string $field)
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
    private  function get_user()
    {
        if(!$this->messages){
            $user = $this->post;
            unset( $user['repeat_password']);
            $user['ava'] = $this->file['ava'];
            return $user;
        }
        return null;
    }
    public function register()
    {
        if(empty($this->messages)){
            Register::objects($this->get_user())->create_user();
        }
    }
}



