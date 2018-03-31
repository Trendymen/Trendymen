<?php
/**
 * Created by PhpStorm.
 * User: lz199
 * Date: 2018/2/28 0028
 * Time: 16:21
 */
$cookie = isset($_COOKIE["user"]) ? $_COOKIE["user"] : "";
if (!$cookie) {
    setcookie("user", 1);
} else {
    echo '{"cookie":' . $cookie .
        '}';
}
