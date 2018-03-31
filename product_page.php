<?php

/**
 * Created by PhpStorm.
 * User: lz199
 * Date: 2017/8/4 0004
 * Time: 19:57
 */
class getattr
{
    public $id;
    public $cateid;
    public $mysql;
    public $array;

    function __construct($id, $cateid, $mysql)
    {
        $this->id = $id;
        $this->cateid = $cateid;
        $this->mysql = $mysql;
    }

    function get_attr_name()
    {
        $sql = "select attr_name,id from php_attr WHERE   attr_type='1'";
        $result = $this->mysql->select($sql);
        while ($row = $result->fetch_assoc()) {
            $this->array[] = array("name" => $row["attr_name"], "attr_id" => $row["id"]);
        }
        return $this->array;

    }

    function get_attr_value()
    {
        $this->array = array();
        $sql = "select * from php_goods_attr WHERE type_id=$this->cateid";
        $result = $this->mysql->select($sql);
        while ($row = $result->fetch_assoc()) {
            $this->array[] = $row;
        }
        return $this->array;
    }

}

include("webtop.php");
require_once("connect to mysql.php");
$id = $_GET["id"];
$conn = new mysql();
$result = $conn->select("select * from products_information WHERE id=$id");
?>

    <div class="product_page_board">
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product_page_board_picture" style="background-image: url(<?php echo $row["p_picture"] ?>)">
            </div>
            <div class="product_page_board_right">
                <p class="product_page_board_title"><?php echo $row["p_name"] ?></p>
                <div class="product_page_board_hr"></div>
                <div class="product_page_board_price"><span class="product_page_board_price_span">价格</span>
                    ￥<?php echo $row["p_price"] ?></div>
                <?php
                $cateid = $row["p_type"];
                $get = new getattr($id, $cateid, $conn);
                $namearray = $get->get_attr_name();
                $valuearray = $get->get_attr_value();

                foreach ($namearray as $k => $v) {

                    foreach ($valuearray as $k1 => $v1) {
                        if ($v1["attr_id"] == $v["attr_id"]) {
                            echo "<br><p>" . $v["name"] . "</p>";
                            break;
                        }
                    }
                    foreach ($valuearray as $k2 => $v2) {
                        if ($v2["attr_id"] == $v["attr_id"]) {
                            echo "<button>" . $v2["attr_value"] . "</button> ";
                        }
                    }
                } ?>
                <div class="product_page_board_hr"></div>
                <div class="button">
                    <div class="product_page_board_buybutton">立即购买</div>
                    <div class="product_page_board_购物车">加入购物</div>

                </div>
            </div>
            <?php
        }
        ?>

    </div>
    <div class="product_page_detail">
        <div class="pick"></div>
        <div class="pick"></div>
        <div class="pick"></div>
    </div>
<?php
include("bottom.html")

?>