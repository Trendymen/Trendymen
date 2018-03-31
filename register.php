<?php
session_start();
header("Content-type:text/html;charset=utf-8");
include 'connect to mysql.php';?>

<?php
$username=$_POST['username'];
$password=md5($_POST['password']);
$confirm=md5($_POST['confirm']);
$email=$_POST['email'];
$code=strtoupper($_POST['code']);
if($username&&$password&&$confirm&&$email&&$code)
{
    $sql="SELECT * FROM user WHERE username='$username'";
    $result=$conn->query($sql);
    $rows=$result->num_rows;

    if($code==$_SESSION['captcha_code']){
       if(strlen($username)<5 or strlen($username)>10)
       {
           echo '用户名必须在5-10位';
       }
       else if (strlen($password)<5 or strlen($username)>10){
           echo '密码必须在5-10位';
       }
        else if($confirm!=$password){
            echo '两次输入密码不一致';
        }
        elseif (!preg_match('/^[\w\.]+@\w+\.\w+$/i', $email)) {
            echo '邮箱不合法！重新填写';
        }
        //检测用户名是否存在
        else if($rows)
        {
            echo '用户名已存在';
        }
        else{
            $sql1= "insert into user(username, password, email)values('$username','$password','$email')";
            if(!($conn->query($sql1))){
                echo '数据插入失败';
            }else{
                echo '注册成功';

            }
        }
    }
    else{
        echo '验证码错误';
    }
}
else{
    echo '请完整填写';
}
$conn->close();//关闭数据库
$_SESSION['captcha_code']='';
?>
