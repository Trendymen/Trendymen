<?php include 'connect to mysql.php' ?>
<?php
$insert="INSERT INTO user(name, email)
VALUES ('lz','lz19960426@163.com')";
if($conn->query($insert))
{
    echo '新纪录插入成功';
}
else
{
    echo '插入失败<br>'.$conn->error;
}
?>
