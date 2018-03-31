<form action="get_cate_id.php" method="post">
    属性值<input type="text" name="value">
    属性对应分类<input type="number" name="typeid">
    属性名称id<input type="number" name="attr_id">
    <input type="submit">
</form>

<?php
/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/11/20 0020
 * Time: 14:14
 */
include("connect to mysql.php");
class getcateid
{
    public $mysql; /*数据库连接*/
    public $arr;
    var $tree = array();
    var $deep = 1;/* 树形递归的深度*/

    function __construct($rootid)  /*获取所有分类 */
    {
        $this->mysql = new mysql();
        $this->arr = array();
        $this->getArray();
        $this->getTree($rootid);
    }

    function getArray()
    {
        $sql = "select id,pid,type_name from php_type ";
        $result = $this->mysql->select($sql);
        $i = 1;
        /*将分类写入数组arr */
        while ($row = $result->fetch_assoc()) {
            $this->arr[$i]["id"] = $row["id"];
            $this->arr[$i]["pid"] = $row["pid"];
            $this->arr[$i]["name"] = $row["type_name"];
            $i = $i + 1;
        }
    }

    function getTree($rootid = 1)
    {
        $level = 1;
        $child_arr = $this->getChild($rootid);
        if (is_array($child_arr)) {
            foreach ($child_arr as $key => $child) {
                $cid = $child['id'];
                $this->tree[] = array(
                    "id" => $cid
                );
                $level++;
                $this->deep++;
                if ($this->getChild($cid))
                    $this->getTree($cid);
                $this->deep--;
            }
        }
        $this->tree[]=array("id"=>$rootid);
        return $this->tree;
    }

    /**
     * 获取下级分类数组
     * @param int $root
     */
    function getChild($root = 0)
    {
        $child = array();
        foreach ($this->arr as $id => $a) {
            if ($a['pid'] == $root) {
                $child[$a['id']] = $a;
            }
        }
        return $child ? $child : false;
    }

    function CreatSQL1($attr_value,$attr_id)
    {
        $value="";
        foreach ($this->tree as $k => $v) {
            $value.="('".$v["id"]."','$attr_id','$attr_value','500'),";
        }
        $value=rtrim($value, ',');
        $sql = "insert into php_goods_attr (type_id, attr_id, attr_value,attr_price) values $value ";
        echo $sql;
        $result=$this->mysql->select($sql);
        if($result){
            echo "s";
        }


    }
    function CreatSQL2($attr_name,$attr_type){
        $value="";
        foreach ($this->tree as $k => $v) {
            $value.="('".$v["id"]."','$attr_type','$attr_name'),";
        }
        $value=rtrim($value, ',');
        $sql = "insert into php_attr (type_id,attr_type,attr_name) values $value ";
        echo $sql;
        $result=$this->mysql->select($sql);
        if($result){
            echo "s";
        }
    }

}
if($value=$_POST["value"] and $typeid=$_POST["typeid"] and $attr_id=$_POST["attr_id"] ){
$grt=new getcateid($typeid) ;
$grt->CreatSQL1($value,$attr_id);
}
?>

