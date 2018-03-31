<?php
/**
 * Created by PhpStorm.
 * User: lz199
 * Date: 2018/1/9 0009
 * Time: 17:54
 */
$name=($_POST["name"])?$_POST["name"]:"";
$email=($_POST["email"])?$_POST["email"]:"";
$message=($_POST["message"])?$_POST["message"]:"";
echo $name."</br>".$email."</br>".$message;