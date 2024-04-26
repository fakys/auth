<?php
require_once 'traits/objects.php';
class ConnectDataBase
{
    use objects;
    public  $db_name;
    public  $user_name;
    public  $password;
    public  $host;

    function __construct()
    {
        $this->host = $this->reading_connect_db()->server_name;
        $this->db_name = $this->reading_connect_db()->db_name;
        $this->user_name = $this->reading_connect_db()->user_name;
        $this->password = $this->reading_connect_db()->password;
    }
    private function reading_connect_db()
    {
        $connect_db = json_decode(file_get_contents(dirname(__DIR__).'/connect_db.json'));


        return $connect_db;
    }

    public function connect()
    {
        try {
            $dbh = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,
                $this->user_name,
                $this->password
            );
        }
        catch (PDOException $e) {
            var_dump("Error: " . $e->getMessage());
            return $e;
        }
        return $dbh;
    }
}