<?php
namespace app\Register;
require 'ConnectDataBase.php';
use app\ConnectDataBase\ConnectDataBase;

class Register
{
    private static $model;
    private array $user=[];
    private $db;
    public function __construct(array $user)
    {
        $this->user = $user;

        $db = new ConnectDataBase();
        $this->db = $db->connect();
    }

    public static function objects(array $user)
    {
        if(!self::$model){
            $class = get_class();
            self::$model = new $class($user);
        }
        return self::$model;
    }

    public function create_user()
    {
        $val = "' ". implode("' , '", $this->user). " '";
        $sql = "INSERT INTO users(foi, login, email,  password, ava) VALUES ($val)";
        return $this->db->query($sql);
    }
}
