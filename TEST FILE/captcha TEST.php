<?php
/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/5/6 0006
 * Time: 18:56
 */
include dirname(dirname(__FILE__)).'\captcha.php';?>
<?php
$image=new Captcha();
$image->config();
$image->create();//这样就会向浏览器输出一张图片
?>
