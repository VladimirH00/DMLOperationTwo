<?php


require_once "MySqlUpdate.php";
require_once "Where.php";

use VladimirH00\DMLOperationTwo\MySqlUpdate as MySqlUpdate;
use VladimirH00\DMLOperationTwo\Where as Where;

$where = new Where(array("age",">", 15));

$query = (new MySqlUpdate())->from(array("table"))
    ->set(array("table.name"=>"'Stepa'","table.money"=>560))
    ->where($where);

echo $query->getRaw();
echo "<br>";

$where = new Where(array("table.age","<", 15));

$query = (new MySqlUpdate())->from(array("table1"=>"t1", "table2"=>"t2"))
    ->set(array("table.name"=>"'Stepa'","table.money"=>560))
    ->where($where);
echo $query->getRaw();
echo "<br>";

$where = (new Where(array("table.age","=", 15)))->andWhere(array("table2.pole1","NOT in",array(123,534543,67876)));

$query = (new MySqlUpdate())->from(array("table"=>"t1", "table2"=>"t2"))
    ->set(array("table.name"=>"'Stepa'","table.money"=>560))
    ->where($where);
echo $query->getRaw();