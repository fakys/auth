<?php
require 'auto_loading.php';
require_once 'traits/errors.php';
require_once 'traits/objects.php';
require_once 'traits/Fields.php';

class Login// класс для авторизации пользователя
{
    use Fields;
    use objects;
    use errors;
    protected array $post;
    private $user;
    private $db;

    public function __construct()
    {
        $this->post = $_POST;
        $this->db = ConnectDataBase::objects()->connect();// подключение к БД
    }
    public function __get($key)//ввывод информации из контекста
    {
        if(isset($this->gets[$key])){
            return $this->gets[$key];
        }
        return null;
    }

    private function check_user()//проверяет есть ли пользователь с таким email и поролем
    {
        $email = $this->post['email'];
        $password = md5($this->post['password']);
        $sql = "SELECT * FROM users WHERE(email = '$email' and password = '$password')";
        $query = $this->db->query($sql)->fetch();

        if(!$query){
            $this->add_messages('email', 'Не верный логин или пороль');
            return false;
        }
        $this->user = $query;
        return true;
    }

    public function login()// авторизация пользователя
    {
        if(empty($this->messages) && $this->check_user()){
            if(isset($this->post['remember_me']) && $this->post['remember_me']){
                setcookie('personal_key', $this->user['personal_key'], time() + (86400 * 30));
            }else{
                setcookie('personal_key', $this->user['personal_key'], time() + 3600);
            }
            header("Location: profile.php");
        }
    }
}