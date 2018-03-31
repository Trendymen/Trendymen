<?php include("webtop.php");
?>
<link rel="stylesheet" href="stylesheet.css">
<?php
/**
 * Created by PhpStorm.
 * User: lz199
 * Date: 2017/7/2 0002
 * Time: 20:50
 */

require_once("PageSupport.php");
require_once("connect to mysql.php");

class Page2 extends PageSupport
{
    public $search;

    function __construct($ppage_size = 5, $sql, $search)
    {
        parent::__construct($ppage_size, $sql);
        $this->search = isset($search) ? $search : "";
    }

    function output()
    {
        if ($this->current_records > 0) //如果数据不为空，则组装数据
        {

            ?>
            <div class="products_board">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;共<?php echo $this->total_records; ?>条记录。</p>
                <?php
                for ($i = 0; $i < $this->current_records; $i++) {
                    $id = $this->result[$i]["id"];
                    $title = $this->result[$i]["p_name"];
                    $price = $this->result[$i]["p_price"];
                    $imageurl = $this->result[$i]["p_picture"];

                    $part = substr($price, 0, 400);
                    //循环输出每条数据
                    ?>
                    <a href="product_page.php?id=<?php echo $id ?>" class="products_side" id="result_<?php echo $i ?>">

                        <div class="products_image" style="background-image: url(<?php echo $imageurl ?>);"></div>
                        <div class="products_title"><?php echo str_replace($this->search, "<b class='high_light'>$this->search</b>", $title) ?></div>
                        <div class="products_price">￥<?php echo $part ?></div>
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php


        }


    }

    function full_navigate()
    {
        echo "<div class='navigate' align=center style='clear: both'>";
        echo "<form action=" . $_SERVER['PHP_SELF'] . " method=\"GET\">";

        echo "<font color = red size ='4'>第" . $this->current_page . "页/共" . $this->total_pages . "页</font>";
        echo "    ";
        echo "<input  type=\"hidden\"  name=\"search\" value='" . $this->search . "'/>";
        echo "跳到<input type=\"number\" size=\5\" min=\"1\" name=\"current_page\" value='" . $this->current_page . "'/>页";
        echo "<input type=\"submit\" value=\"提交\"/>";

        //生成导航链接 如1 2 3 ... 10 11
        $front_start = 1;
        if ($this->current_page > $this->display_count) {
            $front_start = $this->current_page - $this->display_count;
        }
        for ($i = $front_start; $i < $this->current_page; $i++) {
            echo "<a href=" . $_SERVER['PHP_SELF'] . "?search=" . $this->search . "&current_page=" . $i . ">[" . $i . "]</a> ";
        }

        echo "[" . $this->current_page . "]";

        $displayCount = $this->display_count;
        if ($this->total_pages > $displayCount && ($this->current_page + $displayCount) < $this->total_pages) {
            $displayCount = $this->current_page + $displayCount;
        } else {
            $displayCount = $this->total_pages;
        }

        for ($i = $this->current_page + 1; $i <= $displayCount; $i++) {
            echo "<a href=" . $_SERVER['PHP_SELF'] . "?search=" . $this->search . "&current_page=" . $i . ">[" . $i . "]</a> ";
        }

        //生成导航链接
        if ($this->current_page > 1) {
            echo "<A href=" . $_SERVER['PHP_SELF'] . "?search=" . $this->search . "&current_page=" . $this->first . ">首页</A>|";
            echo "<A href=" . $_SERVER['PHP_SELF'] . "?search=" . $this->search . "&current_page=" . $this->prev . ">上一页</A>|";
        }

        if ($this->current_page < $this->total_pages) {
            echo "<A href=" . $_SERVER['PHP_SELF'] . "?search=" . $this->search . "&current_page=" . $this->next . ">下一页</A>|";
            echo "<A href=" . $_SERVER['PHP_SELF'] . "?search=" . $this->search . "&current_page=" . $this->last . ">末页</A>";
        }

        echo "</form>";
        echo "</div>";

    }

}

//得到父ID
class GetId
{
    public $Search;
    public $pid;
    public $id;
    public $conn;
    public $resultnumber;
    public $sql;

    function __construct($Search, $conn)
    {
        $this->Search = $Search;
        $this->conn = $conn;
    }

    function GetPid()
    {
        $SqlGetPid = "select b.id from products_information a INNER JOIN php_type b ON (a.p_name LIKE  '%" . $this->Search . "%' AND a.p_type=b.id )OR  (b.type_name LIKE '%" . $this->Search . "%')";
        $result = $this->conn->select($SqlGetPid);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            $this->pid = $row["id"];
        } else {
            echo "无结果";
        }
    }

    function GetSubid()
    {
        $sqlid = "select id from php_type WHERE pid=$this->pid";
        $result = $this->conn->select($sqlid);
        $this->resultnumber = $result->num_rows;
        $this->id = array();
        if ($this->resultnumber > 0) {
            for ($i = 0; $row = $result->fetch_array(); $i++) {//将子id逐个装入数组$id之中
                $this->id[$i] = $row["id"];
            }
        }

    }

    function CreateSql()
    {

        $this->sql = "select p_name,p_price,p_picture,id from products_information WHERE p_type=$this->pid OR p_name LIKE  '%" . $this->Search . "%' ";
        for ($i = 0; $i < $this->resultnumber; $i++) {

            if ($i == ($this->resultnumber - 1)) {
                $this->sql .= "OR p_type=" . $this->id[$i];
            } else
                $this->sql .= "OR p_type=" . $this->id[$i] . " ";
        }
        $this->sql .= " order by (CASE WHEN p_name LIKE '%$this->Search%' THEN 2 ELSE 0 END)DESC";
    }
}

//$Search = isset($_GET["search"]) ? $_GET["search"] : '';
//$sqlpid = "select b.id from products_information a INNER JOIN php_type b ON (a.p_name LIKE  '%" . $Search . "%' AND a.p_type=b.id )OR  (b.type_name LIKE '%" . $Search . "%' AND a.p_type=b.id )";
//$conn = new mysql();
//$result = $conn->select($sqlpid);
//if ($result->num_rows > 0) {
//    $row = $result->fetch_array();
//    $pid = $row["id"];
////得到子ID
//    $sqlid = "select id from php_type WHERE pid=$pid";
//    $result = $conn->select($sqlid);
//    $id = array();
//    if ($result->num_rows > 0) {
//        for ($i = 0; $row = $result->fetch_array(); $i++) {//将子id逐个装入数组$id之中
//            $id[$i] = $row["id"];
//        }
//    }
////$sql="select a.id,a.p_name,a.p_price,a.p_picture from products_information a INNER JOIN php_type b ON (a.p_name LIKE  '%".$Search."%' AND a.p_type=b.id )OR  (b.type_name LIKE '%".$Search."%' AND a.p_type=b.id )";
////用for逐步将子id放到sql语句中
//    $sql = "select p_name,p_price,p_picture,id from products_information WHERE p_type=$pid ";
//    for ($i = 0; $i < $result->num_rows; $i++) {
//
//        if ($i == ($result->num_rows - 1)) {
//            $sql .= "OR p_type=" . $id[$i];
//        } else
//            $sql .= "OR p_type=" . $id[$i] . " ";
//    }
//调用类里面的这个函数，显示出分页HTML
$mysql = new mysql();
$Search = isset($_GET["search"]) ? $_GET["search"] : '';
$getid = new GetId($Search, $mysql);
$getid->GetPid();
$getid->GetSubid();
$getid->CreateSql();

$ProductsPage = new Page2(8, $getid->sql, $Search);
$ProductsPage->output();
if ($ProductsPage->total_pages > 1) {
    $ProductsPage->full_navigate();
}

//} else {
//    echo "无结果";
//}
include("bottom.html");

?>
