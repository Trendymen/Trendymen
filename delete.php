<?php
/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/5/9 0009
 * Time: 20:58
 */
include 'connect to mysql.php';?>
<?php
$mysql=new mysql();
$delete_id=isset($_GET['id'])?$_GET['id']:'';
$sql="delete from message where id ='$delete_id' ";
$mysql->select($sql);
$rows=isset($mysql->conn->affected_rows)?$conn->affected_rows:'';
if($rows and $mysql->select($sql) )
{
echo '删除成功';
}
else{
    echo '删除失败';
}
?>
