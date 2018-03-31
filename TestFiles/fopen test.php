<?php include 'header.php';?>

<?php
$file=fopen('test.txt','r');
while(!feof($file))
{
    echo fgetc($file). "<br>";
}
echo filetype('test.txt');
fclose($file);
?>