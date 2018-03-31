<?php

/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/5/1 0001
 * Time: 21:32
 */
class mysql
{
    public $severname = 'localhost';
    public $username = 'root';
    public $password = '';
    public $dbname = 'mydb';
    public $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->severname, $this->username, $this->password, $this->dbname);
        $this->connect_error();
    }

    function connect_error()
    {
        if ($this->conn->connect_error) {
            die('连接失败' . $this->conn->connect_error);
        } else {
            $this->conn->query("set character set 'utf8'");//读库
            $this->conn->query("set names 'utf8'");//写库
        }
    }

    function select($sql)
    {
        $result = $this->conn->query($sql) or die($this->conn->connect_error);
        return $result;

    }

}



?>