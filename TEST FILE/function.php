<?php include 'header.php' ?>
<?php
/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/4/29 0029
 * Time: 15:11
 */
function fuck($times)
{
    for($i=0;$i<$times;$i++)
    echo '<p>fuck<br></p>';
}

?>
<form method="post" action="function.php">
    <input type="text" name="time">
    <input type="submit" value="fuck">
</form>
<?php
fuck(isset($_POST['time'])?$_POST['time']:'');
?>
</body>
</html>
