<?php

/**
 * Created by PhpStorm.
 * User: lz199
 * Date: 2017/7/16 0016
 * Time: 11:39
 */
class typelist
{
    public $array;


    function __construct($pid = 0, &$array = array(), $space = 0)
    {
        $mysql = new mysql();
        $result = $mysql->select("select * from php_type WHERE pid=$pid");
        while ($row = $result->fetch_assoc()) {
            $arrow = $space == 0 ? "" : "->";
            $array[] = str_repeat('-', $space) . $arrow . $row["type_name"];
            $this->__construct($row['id'], $array, $space + 4);

        }

        return $this->array = $array;
    }

    function PrintOut()
    {
        foreach ($this->array as $key => $value) {
            ?>
            <option>
                <?php echo $value; ?>
            </option>
            <?php
        }
    }
}

class typelink
{
    public $name;

    function __construct($id, &$name = array())
    {
        $mysql = new mysql();
        $result = $mysql->select("select * from php_type WHERE id=$id");
        while ($row = $result->fetch_assoc()) {
            $name[] = $row['type_name'];
            $this->__construct($row['pid'], $name);
            return $this->name = $name;
        }
    }

    function printout()
    {
        $array = $this->name;
        krsort($array);
        foreach ($array as $key => $value) {
            echo $value . ">";
        }
    }
}





