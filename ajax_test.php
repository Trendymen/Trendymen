<?php
require_once ("connect to mysql.php");
$conn=new mysql();
$result=$conn->select("Select * from php_type WHERE pid=0");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>菜鸟教程(runoob.com)</title>
    <script>
        function showSite(str,id)
        {
            if (str=="")
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
                if (xmlhttp.readyState==4 && xmlhttp.status==200 )
                {

                    eval(xmlhttp.responseText);

                }
            }
            xmlhttp.open("GET","ajax_test_php.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
</head>
<body>

<form>
    <select id="select" name="users" onchange="showSite(this.value,this.id)">
        <option value="">选择一个网站:</option>
        <?php
        while($row=$result->fetch_assoc()) {
            ?>
            <option value="<?php echo $row["id"] ?>"><?php echo $row["type_name"] ?></option>
            <?php
        }
        ?>

    </select>
</form>
<br>
<div id="txtHint"><b>网站信息显示在这里……</b></div>

</body>
</html>

