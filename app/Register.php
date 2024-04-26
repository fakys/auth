<?php
require 'auto_loading.php';
require_once 'traits/objects.php';

class Register
{
    use objects;
    private array $user=[];
    protected static $model;
    private $db;
    public function __construct(array $user)
    {
        $this->user = $user;
        $this->db = ConnectDataBase::objects()->connect();
    }
    private function create_user_ava()
    {
        $file_name = uniqid() .'_'.$this->user['ava']['name'];
        $dirs = "storages/$file_name";
        if(move_uploaded_file($this->user['ava']['tmp_name'], $dirs)){
            $this->user['ava'] = $dirs;
        }else{
            $this->user['ava'] = null;
        }
    }
    private function hash_password()
    {
        $this->user['password']=md5($this->user['password']);
    }
    private function add_personal_key()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pk = substr(str_shuffle($permitted_chars), 0, 26) . substr(str_shuffle($permitted_chars), 0, 26);
        if($this->db->query("SELECT * FROM users WHERE(personal_key = '$pk')")->fetch()){
            $this->add_personal_key();
        }else{
            $this->user['personal_key'] = $pk;
            $this->add_cookie($pk);
        }
    }
    protected function add_cookie($pk)
    {
        setcookie('personal_key', $pk, time() + (86400 * 30));
    }
    public function create_user()
    {
        $this->create_user_ava();
        $this->hash_password();
        $this->add_personal_key();

        $val = "'". implode("' , '", $this->user). "'";
        $sql = "INSERT INTO users(fio, login, email,  password, ava, personal_key) VALUES ($val)";
        if($this->db->query($sql)){
            header("Location: profile.php");
        }
    }

    public static function objects($user)
    {
        if(!self::$model){
            $class = get_class();
            self::$model = new $class($user);
        }
        return self::$model;
    }
}
