<?php
require_once ("connect to mysql.php");
class typelist
{
    public $array;



    function __construct($pid = 0, &$array = array(), $space = 0)
    {
        $mysql = new mysql();
        $result = $mysql->select("select * from php_type WHERE pid=$pid");
        while ($row = $result->fetch_assoc()) {
            $arrow = $space == 0 ? "" : ">";
            $array[] = str_repeat('-', $space) . $arrow . $row["type_name"];
            $this->__construct($row['id'], $array, $space + 4);

        }

        return $this->array = $array;
    }

    function PrintOut()
    {
        global $number;

       echo "var para=document.createElement(\"select\");
                    para.setAttribute(\"id\",\"select".$number."\");
                    para.setAttribute(\"onchange\",\"showSite(this.value,this.id)\");
                    document.body.appendChild(para);
                    var obj=document.getElementById(\"select".$number."\");";
        $number+=1;
        foreach ($this->array as $key => $value) {


            echo "obj.options.add(new Option(\"".$value."\",\"1\"));";


        }
    }
}
$number=2;
$conn=new mysql();
$q=isset($_GET["q"])?intval($_GET["q"]):"";
$type=new typelist($q);
$type->PrintOut();
echo $number;
?>