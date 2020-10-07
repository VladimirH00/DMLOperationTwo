<?php

require_once "MySqlSelect.php";
require_once "Where.php";

use VladimirH00\DMLOperationTwo\MySqlSelect as MySqlSelect;
use VladimirH00\DMLOperationTwo\Where as Where;
$where = (new Where(array("id_person", "<", "100")))->orWhere(array("bdate",">","1990-04-05"));

$query = (new MySqlSelect())
    ->select(array(
        "table as id_person","table2 as 
         CONCAT(first_name, second_name) as full_name"
    ))
    ->from(array("table1"=>"t1","table2"=>"t2","table3"=>"t3"))
    ->limit(10)->orderBy(array("id_type_doc"))->offset(2)->where($where);
echo $query->getRaw();
echo "<br>";

$where = (new Where(array("age","IN",array("25", "24"))))->andWhere(array("name", "=", "stepan"));

$query = (new MySqlSelect())
    ->select()
    ->from("table1")
    ->join("INNER JOIN","table1",array('t.id'=>'t1.user_id'))
    ->where($where)
    ->limit(10)->orderBy(array("id_type_doc"))->offset(2);
echo $query->getRaw();

echo "<br>";

$where = (new Where(array("table1.id", ">", "100")))->andWhere(array("id", '=', "1"));

$query = (new MySqlSelect())
    ->select(array("table1 as t1"))
    ->from("table2")
    ->join("LEFT JOIN",array("table1"=>"t1"),array(array("table2.id"=>"t1.id"),array("table2.count"=>"t1.count")))->where($where)
    ->limit(10)->groupBy(array("id_type_doc"))->offset(2);
echo $query->getRaw();