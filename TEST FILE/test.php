<?php
$LimitExt = array('jpeg', 'png', 'bmp', 'gif', 'jpg');
var_dump($LimitExt);
$LimitExt2 = $LimitExt;
foreach ($LimitExt2 as $key=>$value)
{
    $LimitExt2[$key]=strtoupper($value).'2';
}
$LimitExt=array_merge($LimitExt,$LimitExt2);
var_dump($LimitExt);

?>
