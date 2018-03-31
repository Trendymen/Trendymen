<?php
/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/5/2 0002
 * Time: 20:28
 */
$conn=new mysqli('localhost','root','2266803','mydb');
if($conn)
{
    echo '连接成功';
}
else
{
    echo '连接失败';
}
$ct="CREATE TABLE USER (
id INT(6) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP
)";
if($conn->query($ct))
{
    echo '表建立成功';
}
else
{
    echo '创建数据表错误'.$conn->error;
}