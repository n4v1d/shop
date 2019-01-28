<?php
class db
{
    private $servername = "localhost";
    private $dbtype = "mysql";
    private $dbname = "shop2";
    private $dbuser = "root";
    private $dbpass = "";
    private $dsn;
    public $connect;

    public function __construct()
    {
        try
        {
            $this->dsn = "{$this->dbtype}:host={$this->servername};port=3306;dbname={$this->dbname};charset=utf8";
            $this->connect = new PDO($this->dsn,$this->dbuser,$this->dbpass);

        }
        catch (PDOException $error)
        {
            echo $error->getMessage();
        }
    }
}