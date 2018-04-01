<?php include dirname(dirname(__FILE__)).'/connect to mysql.php';?>

<?php
$table_name="message";//查取表名设置
$perpage=5;//每页显示的数据个数

//最大页数和总记录数
$total_sql="select count(*) from $table_name";
$total_result =$conn->query($total_sql);
$total_row=$total_result->fetch_row();
$total = $total_row[0];//获取最大页码数

//临界点

//展示留言
$sql1 = "select * from message order by id desc limit 0,5";
$res = $conn->query($sql1);
//$row=mysql_fetch_array($res);
if($res->num_rows>0)
{
    $row=$res->fetch_array(MYSQLI_ASSOC);
    $row2=$res->fetch_array(MYSQLI_ASSOC);
    print_r($row) ;
    echo "<br>";
    print_r($row2);
    echo "<br>";

}
else{
    echo $res->num_rows;
    echo '0结果';
}

?>
