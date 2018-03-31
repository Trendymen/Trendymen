<?php
/**
 * Created by PhpStorm.
 * User: lz199
 * Date: 2017/7/1 0001
 * Time: 23:23
 */
$str="fuck you";
$explode=explode(' ',$str);
foreach ($explode as $key=> $l)
{
    echo $key.'=>'.$l.'<br>';
}