<?php
session_start();
require_once('connect to mysql.php');//链接数据库
header("Content-type: text/html; charset=utf-8");//设置编码
$mysql = new mysql();
require_once ("type test.php");

?>
<?php
//分类获取
$result_type = $mysql->select("select type_name from php_type");
$replace=array("-",">");
$type =str_replace($replace,"",isset($_POST['type']) ? $_POST['type'] : "");
echo  $type;
$result_type_number = $mysql->select("select * from php_type  WHERE type_name='" . $type . "'");
if ($result_type_number) {
    $row_type_number = $result_type_number->fetch_array();
    $type_id=$row_type_number['id'];
} else {
    die('失败<br>' . $mysql->conn->error);
}

//图片上传
$title = isset($_POST['title']) ? $_POST['title'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$LimitExt = array('jpeg', 'png', 'bmp', 'gif', 'jpg');
$LimitExt2 = $LimitExt;
$name = isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"] : "";
foreach ($LimitExt2 as $key => $value) {
    $LimitExt2[$key] = strtoupper($value);
}
$LimitExt = array_merge($LimitExt, $LimitExt2);
var_dump($LimitExt);
$TempExplode = explode('.', $name);
$name = preg_replace('/( |　|\s)*/', '', $name);
$name2 = iconv("utf-8", "gb2312", $name);
$End = end($TempExplode);
echo preg_replace('/( |　|\s)*/', '', $name2) . '<br>';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($title)) {
        echo "<script>alert('请输入标题');history.go(-1);</script>";
    } elseif (empty($price)) {
        echo "<script>alert('请输入价格');history.go(-1);</script>";
    } else if (in_array($End, $LimitExt)) {
        $path = 'upload/' . $name;
        move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $name2);
        $sql = "insert into products_information (p_name,p_price,p_picture,p_type) values('$title','$price',' $path',' $type_id')";
        $result = $mysql->select($sql);
        if ($result) {
            echo "添加留言成功";
            echo("<div style=\"width:300px;height:300px;  background-image:url($path); background-position: center center;background-size: contain;  background-repeat: no-repeat;\"></div>");
        } else {
            echo "添加留言失败<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('格式不对');history.go(-1);</script>";
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
<script>
    function showSite(str,id)
    {
        if (str=="" && id!="select")
        {
            document.getElementById("txtHint").innerHTML="";
            return;
        }
        if (window.XMLHttpRequest)
        {
            // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var mySelect = document.createElement("select");
                mySelect.id = "mySelect";
                document.body.appendChild(mySelect);
                var obj=document.getElementById('mySelect');
//添加一个选项
                obj.options.add(new Option("text","value")); //这个兼容IE与firefox
            }
        }
        xmlhttp.open("GET","ajax_test_php.php?q="+str,true);
        xmlhttp.send();
    }
</script>
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
        color: red;
    }


</style>
<h1>据说是个上传板</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="board" method="post"
      enctype="multipart/form-data"">
</br>
<div id="title">

    <select name="type">
        <?php
        $list = new typelist();
        $list->PrintOut();
        ?>
    </select>




            <input type="text" name="title" placeholder="输入新标题...">
            <input type="number" name="price" placeholder="输入价格">
</div>
<input type="file" name="file" id="file"><br>
</br>

<input id="btn1" type="submit" value="发表">


</form>

</body>
</html>

