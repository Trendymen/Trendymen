<?php
include ("connect to mysql.php");
?>
<link rel="stylesheet" href="stylesheet.css">
<?php
/**
 * Created by PhpStorm.
 * User: lz199
 * Date: 2017/7/2 0002
 * Time: 20:50
 */


class GetId
{
    public $Search;
    public $pid;
    public $id;
    public $conn;
    public $resultnumber;
    public $sql;

    function __construct($Search,$conn)
    {
        $this->Search = $Search;
        $this->conn=$conn;
    }

    function GetPid()
    {
        $SqlGetPid = "select b.id from products_information a INNER JOIN php_type b ON (a.p_name LIKE  '%" . $this->Search . "%' AND a.p_type=b.id )OR  (b.type_name LIKE '%" . $this->Search . "%')";
        $result = $this->conn->select($SqlGetPid);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            $this->pid = $row["id"];
        }
        else{
            echo "no pid";
        }
    }
    function GetSubid(){
        $sqlid = "select id from php_type WHERE pid=$this->pid";
        $result = $this->conn->select($sqlid);
        $this->resultnumber=$result->num_rows;
        $this->id = array();
        if ($this->resultnumber > 0) {
            for ($i = 0; $row = $result->fetch_array(); $i++) {//将子id逐个装入数组$id之中
                $this->id[$i] = $row["id"];
            }
        }
        else{
            echo "no";
        }
    }
    function CreateSql(){
        $this->sql = "select p_name,p_price,p_picture,id from products_information WHERE p_type=$this->pid ";
        for ($i = 0; $i < $this->resultnumber; $i++) {

            if ($i == ($this->resultnumber - 1)) {
                $this->sql .= "OR p_type=" . $this->id[$i];
            } else
                $this->sql .= "OR p_type=" . $this->id[$i] . " ";
        }
    }
}
class index_exhibition{
    public $sql;
    public $current_records;
    public $result;
    public $rows;
    public $mysql;

    function __construct( $typename)
    {
        $this->mysql=new mysql();
        $getid=new GetId($typename,$this->mysql);
        $getid->GetPid();
        $getid->GetSubid();
        $getid->CreateSql();
        $this->sql=$getid->sql." LIMIT 0,5";
        $this->read_date();
        $this->output();
        $this->mysql->conn->close();
    }
    function read_date(){
        $mysql=$this->mysql;
        $this->result=$mysql->select($this->sql);
        $this->current_records=$this->result->num_rows;
    }
    function output()
{
    if ($this->current_records > 0) //如果数据不为空，则组装数据
    {

        ?>
        <div class="index_products_board" >
        <?php
        while ($row=$this->result->fetch_array()) {
            $title = $row["p_name"];
            $price = $row["p_price"];
            $imageurl = $row["p_picture"];
            $part = substr($price, 0, 400);
            //循环输出每条数据
            ?>
            <a href="product_page.php?id=<?php echo $row["id"]?>" target="view_window" class="index_products_side"  >
                <div class="index_products_image"style="background-image: url(<?php echo $imageurl ?>);" ></div>
                <div class="index_products_title" ><?php echo $title ?><?php echo $row["id"]?></div>
                <div class="index_products_price" >￥<?php echo $part ?></div>
            </a>
            <?php
        }
            ?>
            </div>
            <?php


    }
    else{
        echo "无记录";
    }



}
}

?>
