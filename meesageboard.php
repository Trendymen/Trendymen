<?php
session_start();
require_once('connect to mysql.php');//链接数据库
header("Content-type: text/html; charset=utf-8");//设置编码
//分页
$page = isset($_GET['page']) ? $_GET['page'] : 1;//接收页码
$page = !empty($page) ? $page : 1;
$table_name = "message";//查取表名设置
$perpage = 5;//每页显示的数据个数
$mysql=new mysql();
//最大页数和总记录数
$total_sql = "select count(*) from $table_name";
$total_result = $mysql->select($total_sql);
$total_row = $total_result->fetch_row();
$total = $total_row[0];//获取记录总数
$total_page = ceil($total / $perpage);//获取页码数，向上整数
//临界点
if ($page == 1 ) {
    echo '<style>#首页{display: none;}</style>';
    echo '<style>#上一页{display: none;}</style>';
}
$page = $page > $total_page ? $total_page : $page;//当下一页数大于最大页数时的情况
if ($page == $total_page) {
    echo '<style>#下一页{display: none;}</style>';
    echo '<style>#末页{display: none;}</style>';
}
//分页设置初始化
$start = ($page - 1) * $perpage;

//展示留言
$sql1 = "select * from message order by id desc limit $start,$perpage";
$res = $mysql->select($sql1);


?>
<?php
$user = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$role=isset($_COOKIE['role']) ? $_COOKIE['role'] : '';
if ($user != '') {
    echo '<style>#login{display: none;}</style>';
    if ($role == 'admin') {
        echo '<style>.删除{display: 	inline !important;}</style>';
    }
}
else
{
    echo '<style>form{display: none;}</style>';
    echo '<style>#cancel{display: none;}</style>';
}


$title = isset($_POST['title']) ? $_POST['title'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$path=isset($_POST['file'])?$_POST['file']:'';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($title)) {
        echo "<script>alert('请输入标题');history.go(-1);</script>";
    } elseif (empty($content)) {
        echo "<script>alert('请输入内容');history.go(-1);</script>";
    } else {
        if (!empty($_COOKIE['username'])) {
            $username = $_COOKIE['username'];
            $sql = "insert into message (title,content,username) values('$title','$content',' $username')";
            $result = $mysql->select($sql);
            if ($result) {
                echo "<script>alert('添加留言成功');location.href='meesageboard.php';</script>";
            } else {
                echo "<script>alert('添加留言失败');location.href='meesageboard.php';</script>";
            }
        } else {
            echo "<script>alert('请登录后添加留言');history.go(-1);</script>";
        }
    }
}
?>

<?php
include 'TestFiles/header.php'; ?>
<!--引入wangEditor.css-->
<link rel="stylesheet" type="text/css" href="editor/dist/css/wangEditor.css">
<!--引入jquery和wangEditor.js-->   <!--注意：javascript必须放在body最后，否则可能会出现问题-->
<script type="text/javascript" src="editor/dist/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="editor/dist/js/wangEditor.js"></script>
<style>


    body {
        margin: 0 auto 0 auto;
        width: auto;
    }

    h1 {
        width: 50%;
        text-align: center;
        margin: 0 auto 0 auto;
    }

    form {
        width: 80%;
        border: 1px solid gainsboro;
        margin: 0 auto 0 auto;
    }

    #textarea1 {
        height: 50%;
    }

    input[type="text"] {
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: gainsboro;
    }

    input[type="submit"] {
        outline: 0;
        background-color: whitesmoke;
        border-width: 1px;
        border-style: solid;
        border-radius: 5px;
        border-color: gainsboro;
        cursor: pointer;
        width: 100px;
        height: 30px;
        margin-left: 2.5%;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .wangEditor-container {
        width: 95%;
        margin: 0 auto 0 auto;
    }

    #title {
        margin: 0 auto 0 auto;
        text-align: center;
        width: 95%;
    }

    ol {
        list-style: none;
        width: 80%;
        margin: 0 auto 0 auto;
    }

    .title {
        font-weight: 800;
        background-color: rgba(204, 204, 204, 0.32);
    }

    .content {
        border: solid 2px #b9def0;
        border-radius: 5px;
    }

    blockquote {
        display: block;
        border-left: 8px solid #d0e5f2;
        padding: 5px 10px;
        margin: 10px 0;
        line-height: 1.4;
        font-size: 100%;
        background-color: #f1f1f1;
    }

    a {
        text-decoration: none;
        color:red;
    }

    #login,#cancel {
        text-align: center;
    }
    .删除{
        display: none;
    }
</style>
<h1>据说是个留言板</h1>
<div id="login">
    <a href="login.html">登陆</a>
    <a href="register.html">注册</a>
</div>
<div id="cancel">
    <a href="cancel.php">注销</a>
</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="board" method="post">
    </br>
    <div id="title">
        <input type="text" name="title" placeholder="输入新标题...">
    </div>
    <input type="file" name="file" id="file"><br>
    </br>
    <textarea id="textarea1" name="content"></textarea>
    <input id="btn1" type="submit" value="发表">
    <!--这里引用jquery和wangEditor.js-->
    <script type="text/javascript">
        var editor = new wangEditor('textarea1');
        editor.create();
    </script>

</form>
<ol>


    <?php
    if (empty($res->num_rows)) {
        echo
        "<p>无留言</p>";
    } else
        while ($row = $res->fetch_array()) {
            ?>
            <li>
                <article class="wangEditor-container">
                    <p><?php echo $row['id'] . '楼<br>' . $row['username'] ?></p>
                    <p class=title><?php echo $row['title'] ?></p>
                    <div class="wangEditor-txt content"><?php echo $row['content'] ?></div>
                    <p >时间：<?php echo $row['time'] ?></p>
                    <a class="删除" href="delete.php?id=<?php echo $row['id'] ?>">删除</a>
                </article>
            </li>
            <?php
        }
    ?>
    <tr>
        <td colspan="4" id="td">
            <p><?php echo '第' . $page. '页' ?></p>
            <a id="首页" href="<?php echo "$_SERVER[PHP_SELF]?page=1" ?>">首页</a>
            <a id="上一页" href="<?php echo "$_SERVER[PHP_SELF]?page=" . ($page - 1) ?>">上一页</a>
            <a id="下一页" href="<?php echo "$_SERVER[PHP_SELF]?page=" . ($page + 1) ?>">下一页</a>
            <a id="末页" href="<?php echo "$_SERVER[PHP_SELF]?page={$total_page}" ?>">末页</a>
        </td>
    </tr>
</ol>
</body>
</html>

