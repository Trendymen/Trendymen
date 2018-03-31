<?php
/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/11/2 0002
 * Time: 19:02
 */
include("webtop.php");
include("connect to mysql.php");

class cate
{
    public $mysql; /*数据库连接*/
    public $arr;
    var $tree = array();
    var $deep = 1;/* 树形递归的深度*/
    var $icon = array('　　│', '　　├─→', '　　└─→');/* 生成树形的修饰符号*/

    function __construct($id="")  /*获取所有分类 */
    {
        $this->mysql = new mysql();
        $this->getArray();
        $this->deleteCate($id);
        $this->arr=array();
        $this->getArray();

    }

    function getArray(){
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
    /**
     * 生成指定id的下级树形结构
     * @param int $rootid 要获取树形结构的id
     * @param string $add 递归中使用的前缀
     * @param bool $parent_end 标识上级分类是否是最后一个
     */
    function getTree($rootid = 0, $add = "", $parent_end = true)
    {
        $level = 1;
        $child_arr = $this->getChild($rootid);
        if (is_array($child_arr)) {
            $cnt = count($child_arr);
            foreach ($child_arr as $key => $child) {
                $cid = $child['id'];
                $child_child = $this->getChild($cid);
                $space = "";    /* 前缀样式*/
                if ($this->deep > 1) {
                    if ($level == 1 && $this->deep > 1) {
                        if (!$parent_end) {
                            $add .= $this->icon[0];
                        } else $add .= "";
                    }
                    if ($level == $cnt) {
                        $space = $this->icon[2];
                        $parent_end = true;
                    } else {
                        $space = $this->icon[1];
                        $parent_end = false;
                    }
                }
                else{
                    $space="　";
                }
                $this->tree[] = array("spacer" => $add . $space,
                    "name" => $child['name'],
                    "id" => $cid
                );
                $level++;
                $this->deep++;
                if ($this->getChild($cid))
                    $this->getTree($cid, $add, $parent_end);
                $this->deep--;
            }
        }
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

    function deleteCate($id)
    {
        if ($id != "") {
            foreach ($this->arr as $key => $value)
            {
                if ($value["pid"] == $id)
                {
                    echo $value["pid"];
                    echo '这个分类还有子分类不可删除';
                    break;
                }
                else
                {
                    $sql = "Delete from php_type WHERE id=$id";
                    if ($result = $this->mysql->select("$sql")) {
                        $rows = isset($this->mysql->conn->affected_rows) ? $this->mysql->conn->affected_rows : '';
                        if ($rows > 0)
                            echo "删除分类成功";
                    } else {
                        echo "失败";
                    }
                    break;
                }
            }

        }
    }
}

/*实例化*/
$deleteid=isset($_GET["id"])?$_GET["id"]:"";
$cate = new cate($deleteid);
$array = $cate->getTree();
$number = count($array);
echo "<ul class='catelist'>";
for ($i = 0; $i < $number; $i++) {

    ?>
    <li><?php echo $array[$i]["spacer"]?>
        <a class="catelist_a" href="search_result.php?search=<?php echo $array[$i]["name"] ?>">
             <?php echo $array[$i]["name"] ?>
        </a>
        <a href="<?php echo $_SERVER["PHP_SELF"]."?id=".$array[$i]["id"] ?>">delete</a>
        <br></li>
    <?php
}
echo "</ul>";

?>