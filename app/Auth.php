<?php
require '../app/auto_loading.php';
require_once 'traits/objects.php';


class Auth//класс для взаимодействия с авторизированным пользователям
{
    use objects;
    public function __construct()
    {
        $this->db = ConnectDataBase::objects()->connect();
    }
    public function auth_user()//провереки авторизирован ли пользователь
    {
        if(isset($_COOKIE['personal_key'])){

            $pk = $_COOKIE['personal_key'];
            $query = $this->db->query("SELECT * FROM users WHERE(personal_key = '$pk')");
            if($query->fetch()){

                return true;
            }
        }
        return false;
    }
    public function user()//получение данных о текущем пользователе
    {
        if($this->auth_user()){
            $pk = $_COOKIE['personal_key'];
            return $this->db->query("SELECT * FROM users WHERE(personal_key = '$pk')")->fetch();
        }
    }
    public function redirect_user(bool $is_auth, string $locate)//редирект пользователя
    {
        if($this->auth_user() == $is_auth){
            header("Location: $locate");
        }
    }
}