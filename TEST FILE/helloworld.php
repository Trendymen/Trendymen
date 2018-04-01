<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
echo "Hello World!<br>";
?>
<?php
$x=5;
$y=6;
$z=$x+$y;
echo "$z<br>";
?>


<?php
function myTest($x)
{
    echo $x;
}

myTest(5);

?>
<?php
$cars=array("Volvo","BMW","Toyota");
var_dump($cars);
?>
<?php
$txt1="Hello world!";
$txt2="What a nice day!";
echo $txt1 . " " . $txt2."<br>";
echo strpos($txt1,"e")."<br>";
echo substr($txt1, 0,1)."<br>";
?>
<?php
echo(intdiv(10, 2));
$x=1;
$y=$x;
echo $y."<br>";
?>
<?php
$x = array("a" => "red", "b" => "green");
$y = array("b" => "green", "a" => "red");
$z = $x + $y; // union of $x and $y
var_dump($z);
echo "<br>";
var_dump($x == $y);
echo "<br>";
var_dump($x === $y);
echo "<br>";
var_dump($x != $y);
echo "<br>";
var_dump($x <> $y);
echo "<br>";
var_dump($x !== $y);
echo "<br>";
echo "<br>";
$test = '菜鸟教程';
echo $test.' 字符长度:'.strlen($test).'<br>';
$username = strlen($test)==12 ? $test : 'nobody';
echo $username;
?>
<?php
$t=date("H:i:s");
echo $t;
?>
<?php
echo '<br>';
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");

foreach($age as $x=>$value)
{
    echo "Key=" . $x . ", Value=" . $value;
    echo "<br>";
}
?>
<?php
$cars=array("Volvo","BMW","Toyota");
rsort($cars);
var_dump( $cars);
?>
<?php
echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];
?>
<?php
echo '<br>';
$a='fuck you';
for($i=0;$i<strlen($a);$i+=4)
{
echo '<p>'.(substr($a,$i,4)).'</p>';
}
echo $_SERVER['REMOTE_PORT']
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> <!--action 为指定的数据返回文件名 -->
    Name: <input type="text" name="fname">
    <input type="submit" >
</form>

<?php
$name = isset($_REQUEST['fname'])?$_REQUEST['fname']:'';
echo $name;
?>
<?php
$name = $_POST['fname'];
echo $name;
?>

</body>
</html>