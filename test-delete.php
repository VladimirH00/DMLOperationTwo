<?php


require_once "MySqlDelete.php";
require_once "Where.php";

use VladimirH00\DMLOperationTwo\MySqlDelete as MySqlDelete;
use VladimirH00\DMLOperationTwo\Where as Where;

$where = (new Where(array("age","IN", array(9,8,7))));


$query = (new MySqlDelete())->from(array("table","table2"))->where($where);

echo $query->getRaw();
echo "<br>";
$where = (new Where(array("age", ">", 46)))->andWhere(array("age", "=", 24));

$query = (new MySqlDelete())->from("`tb`")->where($where);

echo $query->getRaw();
echo "<br>";

$where = (new Where(array("price","<", 24)))->orWhere(array("price", ">", 46));

$query = (new MySqlDelete())->from(array("table1 as T1"))->where($where);

echo $query->getRaw();
