<?php
require 'app/auto_loading.php';
require_once 'traits/objects.php';


class Auth
{
    use objects;
    public function __construct()
    {
        $db = new ConnectDataBase();
        $this->db = $db->connect();
    }
    public function auth_user()
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
    public function user()
    {
        if($this->auth_user()){
            $pk = $_COOKIE['personal_key'];
            return $this->db->query("SELECT * FROM users WHERE(personal_key = '$pk')")->fetch();
        }
    }
    public function redirect_user(bool $is_auth, string $locate)
    {
        if($this->auth_user() == $is_auth){
            header("Location: $locate");
        }
    }
}