<?php

/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/4/29 0029
 * Time: 18:51
 */
class site
{
    /* 成员变量 */
    var $url;
    var $title;

    /* 成员函数 */
    function setUrl($par){
        $this->url = $par;
    }

    function getUrl(){
        echo $this->url.'<br>';
    }

    function setTitle($par){
        $this->title = $par;
    }

    function getTitle(){
        echo $this->title.'<br>';
    }
}
?>