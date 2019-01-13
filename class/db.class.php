<?php
class db
{
    private $servername = "192.168.1.12";
    private $dbtype = "mysql";
    private $dbname = "test";
    private $dbuser = "remote";
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