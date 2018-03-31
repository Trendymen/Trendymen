<?PHP
session_start();
header("Content-type:text/html;charset=utf-8");
if (!isset($_POST["submit"])) {
    exit("错误执行");
}//检测是否有submit操作

include('connect to mysql.php');//链接数据库
$name = $_POST['username'];//post获得用户名表单值
$passowrd = md5($_POST['password']);//post获得用户密码单值
$code = strtoupper($_POST['code']);//post获得验证码单值并转为大写
$mysql=new mysql();
if ($name && $passowrd) {//如果用户名和密码都不为空
    if ($code == $_SESSION['captcha_code']) {
        $sql = "select * from user where username = '$name' and password='$passowrd'";//检测数据库是否有对应的username和password的sql
        $result = $mysql->select($sql);//执行sql
        if ($result->num_rows > 0) {//0 false 1 true
            echo '登陆成功,将在两秒后跳转';
            while ($rows = $result->fetch_assoc()) {
                setcookie('username',$rows['username'],time()+3600*24);
                setcookie('role',$rows['role'],time()+3600*24);
                echo $_COOKIE['username'];
                echo $_COOKIE['role'];
                var_dump($rows);
                echo "
              <script>
              setTimeout(function(){window.location.href='meesageboard.php';},2000);
          </script>
                ";

            }
        } else {
            echo "用户名或密码错误";
            echo "
          <script>
              setTimeout(function(){window.location.href='login.html';},1000);
          </script>
 
        ";//如果错误使用js 1秒后跳转到登录页面重试;
        }
    }
    else {//验证码错误
        echo "验证码错误";
        echo "
          <script>
              setTimeout(function(){window.location.href='login.html';},1000);
          </script>
 
        ";
    }

}else {//如果用户名或密码有空
    echo "表单填写不完整";
    echo "
           <script>
              setTimeout(function(){window.location.href='login.html';},1000);
           </script>";

    //如果错误使用js 1秒后跳转到登录页面重试;
}

$conn->close();//关闭数据库
$_SESSION['captcha_code'] = '';
?>